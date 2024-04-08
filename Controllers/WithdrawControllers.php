<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Replace with your WithdrawProcessor class
use Illuminate\Support\Facades\Session; // Replace with your Withdraw model
use Illuminate\Support\Facades\View; // Replace with your Gateway model
use Modules\Affiliate\Entities\Affiliate; // Replace with your Affiliate model
use Modules\Withdraw\Classes\WithdrawProcessor; // Replace with your Setting model
use Modules\Withdraw\Entities\Gateway;
use Modules\Withdraw\Entities\Setting;
use Modules\Withdraw\Entities\Withdraw;

class WithdrawController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Withdraws",
        ];

        return view('withdraws.index', $data);
    }

    public function withdrawalReversal(Request $request, $pk)
    {
        $withdraw = Withdraw::find($pk);

        $withdrawProcessor = new WithdrawProcessor();

        $withdrawProcessor->withdrawReversal($withdraw);

        return redirect()->route('manage_withdraw_list');
    }

    public function autoWithdrawal(Request $request)
    {
        $withdrawProcessor = new WithdrawProcessor();

        $withdrawProcessor->autoWithdrawal();

        return redirect()->route('manage_withdraw_list');
    }

    public function masspayGenerate(Request $request)
    {
        $masspayProcessor = new MasspayProcessor();

        $masspayProcessor->generateMasspay();

        return redirect()->route('manage_dashboard');
    }

    public function masspayComplete(Request $request)
    {
        $token = $request->query('token');

        $masspayProcessor = new MasspayProcessor();

        $masspayProcessor->completeProcess($token);

        return redirect()->route('manage_withdraw_masspay_list');
    }

    public function saveSetting(Request $request)
    {
        $idPassport = $request->input('id_passport');
        $govtPin = $request->input('govt_pin');
        $gateway = $request->input('gateway');
        $account = $request->input('account');
        $bankAccountName = $request->input('bank_account_name');
        $bankName = $request->input('bank_name');
        $bankBranch = $request->input('bank_branch');
        $userId = $request->input('partner_id');
        $nextTo = $request->input('next_to', 'manage_withdraw_setting_list');

        $gatewayObj = Gateway::where('short_name', $gateway)->first();
        $affiliate = Affiliate::where('partner_id', $userId)->first();

        $data = [];

        if ($gateway == 'bank') {
            $data = [
                'bank_account' => $account,
                'bank_account_name' => $bankAccountName,
                'bank_name' => $bankName,
                'bank_branch' => $bankBranch,
            ];
        }

        Setting::where('partner_id', $userId)->delete();

        $setting = new Setting();
        $setting->partner_id = $affiliate->partner_id;
        $setting->id_passport = $idPassport;
        $setting->account = $account;
        $setting->govt_pin = $govtPin;
        $setting->gateway = $gatewayObj->gateway;
        $setting->params = $data;
        $setting->save();

        return redirect($nextTo);
    }
}
