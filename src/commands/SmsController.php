<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Sms;
use yii\console\Controller;
use yii\helpers\Json;

class SmsController extends Controller
{
    public function actionSend()
    {
        $queued = Sms::find()->where(['status' => Sms::STATUS_PENDING])->all();
        foreach ($queued as $sms) {
            $sms->refresh();
            if ($sms->status !== Sms::STATUS_PENDING) {
                exit("Collision occured. Skipping..");
            }
            $response = $this->sendSms($sms['phone_number'], $sms['message']);
            if (isset($response['send'][0]['status']) && $response['send'][0]['status'] == '0') {
                $sms->status = Sms::STATUS_SENT;
            } else {
                $sms->status = Sms::STATUS_FAILED;
            }
            $sms->save();
        }
    }
    private function sendSms($phoneNumber, $message)
    {
        echo "Sending sms $message to $phoneNumber";
        $data = [
            'apikey' => getenv("SMS_PILOT_KEY"),
            'send' => [
                [
                    'to' => $phoneNumber,
                    'text' => $message,
                ]
            ]
        ];

        $ch = curl_init('https://smspilot.ru/api2.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return Json::decode($response);
    }
}
