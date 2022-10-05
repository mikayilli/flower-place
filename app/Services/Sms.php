<?php

namespace App\Services;

use SMSGlobal\Credentials;
use SMSGlobal\Resource\Sms as SmsAlias;

class Sms
{
    private $sms;
    public function __construct()
    {
        Credentials::set(config("app.sms_api_key"), config("app.sms_api_secret_key"));
        $this->sms = new SmsAlias();
    }

    public function sendOne($phone, $message)
    {
        try {
            $response = $this->sms->sendToOne($phone, $message);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
