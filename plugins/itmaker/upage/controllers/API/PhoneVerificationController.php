<?php

namespace App\Http\Controllers\API;

use App\VerificationMessage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneVerificationController extends Controller
{
    public $username = 'upageuz';
    public $password = 'Tc1yRQl35';
    public $originator = '3700';
    public $baseUrl = 'http://91.204.239.42:8083/broker-api';


    public function resendMessage(Request $request)
    {
        $timer =  VerificationMessage::whereUser_id($request->input('user_id'))->orderBy('created_at', 'desc')->first()->created_at->addMinute();

        if (Carbon::now() > $timer){
            $client = new  Client([
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $code = rand(100000, 999999);

            $message_id = Carbon::now()->format("Y-m-d-H-i-s");

            $message = [
                'messages' => [
                    [
                        'recipient' => $request->input('phone'),
                        'message-id' => $message_id,
                        'sms' => [
                            'originator' => $this->originator,
                            'content' => [
                                'text' => 'Ваш код подтверждения: ' . $code
                            ]
                        ]
                    ]
                ]
            ];

            $sms = new VerificationMessage();
            $sms->phone = $request->input('phone');
            $sms->code = $code;
            $sms->resend = true;
            $sms->user_id = $request->input('user_id');
            $sms->save();

            try {
                $client->request('POST', "{$this->baseUrl}/send", [
                    'auth' => array($this->username, $this->password),
                    'body' => json_encode($message)
                ]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            return response()->json(['error' => 'Смс можно отправлять раз в минуту'], 403);
        }

        return response()->json(['sms_id' => $sms->id]);
    }

    public function verification(Request $request)
    {
        $msg = VerificationMessage::find($request->input('id'));

        if ($msg){
            $message = VerificationMessage::find($request->input('id'));

            if ($message->code == $request->input('code')) {

                $message->verified = true;
                $message->save();

                return response()->json([
                    'success' => ['Верный код'],
                ], 200);
            }
        }


        return response()->json([
            'error' => [
                'code' => ['Неверный код'],
            ]
        ], 401);
    }

}
