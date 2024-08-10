<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Modules\Affiliate\Classes\SummaryInfo;
use Modules\Core\Classes\Common;
use Modules\Mail\Classes\Mailer;
use Modules\Payment\Classes\PaymentProcessor;
use Modules\Payment\Models\Transaction;
use Modules\Withdraw\Models\Rate;
use Modules\Withdraw\Models\Setting;
use Modules\Withdraw\Models\Withdraw;

class WithdrawProcessor
{
    public function autoWithdrawal()
    {
        // Placeholder code for auto withdrawal
        return false;

        $payment_processor = new PaymentProcessor();
        $source = $payment_processor->getSourceorNew('withdraw', 'Withdraw');

        $resultList = [];

        $queryResult = DB::select("
            SELECT pt.partner_id, au.username, (SUM(pt.money_in) - SUM(pt.money_out)) AS Results
            FROM public.payment_transaction as pt
            LEFT JOIN public.auth_user as au ON pt.partner_id = au.id
            LEFT JOIN public.affiliate_affiliate as aa ON aa.partner_id = au.id
            WHERE aa.status = true
            GROUP BY au.username, pt.partner_id
            HAVING (SUM(pt.money_in) - SUM(pt.money_out)) > 10
            ORDER BY Results DESC
        ");

        foreach ($queryResult as $row) {
            $partner_id = $row->partner_id;
            $amount = (int) $row->Results - 1;

            $setting = Setting::where('partner_id', $partner_id)->first();

            if ($setting && !$setting->user->is_staff) {
                $withdraw = new Withdraw();
                $withdraw->partner_id = $setting->user->id;
                $withdraw->gateway_id = $setting->gateway->id;
                $withdraw->amount = $amount;
                $withdraw->description = 'Withdrawal of ' . $amount;
                $withdraw->save();
            }
        }

    }

    public function withdrawReversal($withdraw)
    {
        $summary_info = new SummaryInfo();

        if (!$withdraw->paid_status) {
            $this->sendEmail($withdraw, 'withdraws.withdraws.reversal');

            $withdraw->is_canceled = true;
            $withdraw->save();

            $transactions = Transaction::where('user', $withdraw->user)
                ->where('type', 'withdraw-rate')
                ->where('source_ident', $withdraw->id)
                ->get();

            $transactions_main = Transaction::where('user', $withdraw->user)
                ->where('type', 'withdraw')
                ->where('source_ident', $withdraw->id)
                ->get();

            foreach ($transactions as $transaction) {
                $transaction->is_canceled = true;
                $transaction->save();

                Transaction::create([
                    'user' => $transaction->user,
                    'from_user' => $transaction->user,
                    'description' => 'Withdraw Reversal: ' . $transaction->description,
                    'money_in' => $transaction->money_out,
                    'type' => $transaction->type,
                    'source' => $transaction->source,
                    'year' => date('Y'),
                    'month' => date('m'),
                    'rate' => $transaction->rate,
                    'source_ident' => $transaction->source_ident,
                ]);
            }

            foreach ($transactions_main as $transaction) {
                $transaction->is_canceled = true;
                $transaction->save();

                Transaction::create([
                    'user' => $transaction->user,
                    'from_user' => $transaction->user,
                    'description' => 'Withdraw Reversal: ' . $transaction->description,
                    'money_in' => $transaction->money_out,
                    'type' => $transaction->type,
                    'source' => $transaction->source,
                    'year' => date('Y'),
                    'month' => date('m'),
                    'rate' => $transaction->rate,
                    'source_ident' => $transaction->source_ident,
                ]);
            }

            $summary_info->clearAmountCache($withdraw->partner_id);
        }
    }

    public function processWithdraw($withdraw)
    {
        $summary_info = new SummaryInfo();

        if ($this->checkValidity($withdraw)) {
            $rate_amount = 0;
            $payment_processor = new PaymentProcessor();
            $source = $payment_processor->getSourceorNew('withdraw', 'Withdraw');
            $rates = $payment_processor->getPaymentGatewayInvoiceRates($withdraw, $withdraw->gateway, 'withdraw');

            foreach ($rates as $rate) {
                if (!str_contains($rate['title'], 'Total')) {
                    $rate_obj = Rate::find($rate['id']);
                    $rate_amount += $rate['amount'];

                    Transaction::create([
                        'user' => $withdraw->user,
                        'from_user' => $withdraw->user,
                        'description' => $rate['title'] . ' ' . $rate['amount'] . ' [Txn:' . $withdraw->id . ']',
                        'money_in' => $rate['amount'] > 0 ? abs($rate['amount']) : null,
                        'money_out' => $rate['amount'] < 0 ? abs($rate['amount']) : null,
                        'type' => 'withdraw-rate',
                        'year' => date('Y'),
                        'month' => date('m'),
                        'source' => $source,
                        'rate' => $rate_obj,
                        'source_ident' => $withdraw->id,
                    ]);
                }
            }

            Transaction::create([
                'user' => $withdraw->user,
                'from_user' => $withdraw->user,
                'description' => 'Withdrawal of ' . $withdraw->amount . ' [Txn:' . $withdraw->id . ']',
                'money_out' => $withdraw->amount + $rate_amount,
                'type' => 'withdraw',
                'year' => date('Y'),
                'month' => date('m'),
                'source' => $source,
                'source_ident' => $withdraw->id,
            ]);

            $withdraw->amount += $rate_amount;
            $withdraw->save();

            $this->sendEmail($withdraw);
            $this->sendNotification();

            $summary_info->clearAmountCache($withdraw->partner_id);
        }
    }

    public function checkValidity($withdraw)
    {
        $valid = true;
        $request = Request::instance();
        $money_in = Transaction::where('user', $withdraw->user)->sum('money_in');
        $money_out = Transaction::where('user', $withdraw->user)->sum('money_out');
        $money_in = $money_in ?? 0;
        $money_out = $money_out ?? 0;
        $total = $money_in - $money_out;

        if ($withdraw->amount < 10) {
            $valid = false;
            Session::flash('error', 'Your Withdrawal was rejected. The amount submitted of ' . $withdraw->amount . ' is less than the minimum amount $10.');
        }

        if ($withdraw->amount >= $total) {
            $valid = false;
            Session::flash('error', 'Your Withdrawal was rejected. The amount submitted of ' . $withdraw->amount . ' is more than the available amount ' . $total . '.');
        }

        if (!$valid) {
            $withdraw->delete();
        } else {
            Session::flash('success', 'Record Created Successfully');
        }

        return $valid;
    }

    public function sendEmail($withdraw, $template = 'withdraws.withdraws.fundwithdraw')
    {
        $mailer = new Mailer();
        $email_parameters = [
            'to' => $withdraw->user->email,
            'withdraw' => $withdraw,
            'user' => $withdraw->user,
        ];

        $mailer->sendTemplateMail($template, $email_parameters);
    }

    public function sendNotification()
    {
        $common = new Common();
        $common->sendNoticationContext('Withdraw Fund');
    }
}
