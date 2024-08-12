<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Modules\Core\Models\Currency;
use Modules\Mail\Classes\Mailer;
use Modules\Withdraw\Models\Gateway;
use Modules\Withdraw\Models\Masspay;
use Modules\Withdraw\Models\Setting;
use Modules\Withdraw\Models\Withdraw;

class MasspayProcessor
{
    public function completeProcess($token)
    {
        Masspay::where('token', $token)->update(['is_processed' => 1]);
        Withdraw::where('token', $token)->update(['paid_status' => 1]);
    }

    public function generateMasspay()
    {
        $gateways = Gateway::all();

        foreach ($gateways as $gateway) {
            $this->processGatewayMasspay($gateway);
        }
    }

    public function processGatewayMasspay($gateway)
    {
        $total_withdraws = Withdraw::whereNull('token')
            ->where('is_canceled', 0)
            ->where('gateway', $gateway->gateway)
            ->count();

        $conversion_rate = 1;

        if ($gateway->currency) {
            if ($gateway->currency->selling) {
                $conversion_rate = $gateway->currency->selling;
            } elseif ($gateway->currency->rate) {
                $conversion_rate = $gateway->currency->rate;
            }
        }

        if ($total_withdraws) {
            $limit = $gateway->file_limit ?: 2000;

            $withdraws = Withdraw::whereNull('token')
                ->where('is_canceled', 0)
                ->where('gateway', $gateway->gateway)
                ->take($limit)
                ->get();

            $unique_id = rand(100000, 999999);
            [$web_path, $file_path] = $this->prepareFile($unique_id, $gateway->gateway, $gateway->file_type);

            $this->openFile($file_path, $gateway->file_prefix);

            foreach ($withdraws as $withdraw) {
                if ($withdraw->amount) {
                    $withdraw->converted_amount = (float) $withdraw->amount * (float) $conversion_rate;
                }

                $this->processSingleWithdrawal($file_path, $withdraw, $gateway, $unique_id);
            }

            $this->writeToFile($file_path, $gateway->file_suffix);
            $masspay = $this->saveMassPay($gateway, $unique_id, $web_path);

            $this->sendEmail($gateway, $masspay, $file_path);

            if ($total_withdraws > $limit) {
                $this->processGatewayMasspay($gateway);
            }
        }
    }

    public function writeToFile($file_path, $content)
    {
        if ($content) {
            $newcontent = $content . "\r\n";
            File::append($file_path, $newcontent);
        }
    }

    public function openFile($file_path, $content)
    {
        if ($content) {
            $newcontent = $content . "\r\n";
            File::put($file_path, $newcontent);
            $this->writeToFile($file_path, $content);
        }
    }

    public function sendEmail($gateway, $masspay, $file_path)
    {
        $attachments = [];

        if (File::exists($file_path)) {
            $attachments = [$file_path];

            $email_parameters = [
                'masspay' => $masspay,
                'gateway' => $gateway->gateway,
            ];

            $this->exactMailSender('kamundeh@gmail.com', $email_parameters, $attachments);
            $this->exactMailSender('essysonya@gmail.com', $email_parameters, $attachments);
            $this->exactMailSender('dedanirungu@gmail.com', $email_parameters, $attachments);
            $this->exactMailSender('fridamonicah@gmail.com', $email_parameters, $attachments);
        }
    }

    public function exactMailSender($email, $email_parameters, $attachments)
    {
        $mailer = new Mailer();

        $email_parameters['to'] = $email;

        $mailer->sendTemplateMail('withdraw.masspay.generatefile', $email_parameters, $attachments);
    }

    public function saveMassPay($gateway, $unique_id, $web_path)
    {
        [$year, $month, $date] = explode('-', Carbon::today());

        $masspay = Masspay::updateOrCreate([
            'year' => $year,
            'month' => $month,
            'date' => $date,
            'type' => $gateway->gateway,
            'token' => $unique_id,
        ], [
            'file' => $web_path,
            'max_limit' => $gateway->file_limit,
        ]);

        return $masspay;
    }

    public function processSingleWithdrawal($file_path, $withdraw, $gateway, $unique_id)
    {
        $tmp_structure = '{{user.name}},{{user.username}},{{user.email}},{{withdraw.converted_amount}},{{user.id}},{{user.id}}';

        $structure = $gateway->file_structure ?: $tmp_structure;

        $setting = Setting::where('user', $withdraw->user)
            ->where('gateway', $gateway->gateway)
            ->first();

        $data = [
            'withdraw' => $withdraw,
            'gateway' => $gateway,
            'setting' => $setting,
            'user' => $withdraw->user,
        ];

        $withdraw_str = $this->getTemplateString($structure, $data);

        $this->writeToFile($file_path, $withdraw_str);

        $withdraw->token = $unique_id;
        $withdraw->save();
    }

    public function getTemplateString($template, $context)
    {
        $template = Template::create($template);
        return $template->render($context);
    }

    public function prepareFile($unique_id, $file_name, $file_ext = 'txt')
    {
        [$year, $month, $date] = explode('-', Carbon::today());

        $relative_path = "uploads/withdraws/masspay/{$year}/{$month}/{$date}/";
        $web_path = "{$relative_path}{$file_name}{$unique_id}.{$file_ext}";
        $absolute_path = base_path("{$relative_path}");
        $file_path = base_path("{$web_path}");

        if (!File::exists($absolute_path)) {
            File::makeDirectory($absolute_path, 0755, true);
        }

        return [$web_path, $file_path];
    }
}
