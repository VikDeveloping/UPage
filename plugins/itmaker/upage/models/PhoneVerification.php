<?php namespace Itmaker\Upage\Models;

use Model;
use GuzzleHttp\Client;
/**
 * Model
 */
class PhoneVerification extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'itmaker_upage_phone_verifications';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $username = 'upageuz';
    public $password = 'Tc1yRQl35';
    public $originator = '3700';
    public $baseUrl = 'http://91.204.239.42:8083/broker-api';
    
    public function scopeVeritification ($query, $options) {
        /*
        ** default options
        */
        extract(array_merge([
            'user_id'         => null,
            'verification_id' => null,
            'code'            => null,
            'user_phone'      => null
        ], $options));

        

    }
    
    function generateMessage ($user_phone, $code) {

        $message_id = date("Y-m-d-H-i-s");

        $message = [
            'messages' => [
                [
                    'recipient' => $user_phone,
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
        return $message;
    }

    public function scopeSendMessage ($query, $options) {
        /*
        ** default options
        */
        extract(array_merge([
            'user_id'         => null,
            'user_phone'      => null
        ], $options));

        $code = rand(100000, 999999);
        $message = $this->generateMessage ($user_phone, $code);

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);        

        try {
            $client->request('POST', "{$this->baseUrl}/send", [
                'auth' => array($this->username, $this->password),
                'body' => json_encode($message)
            ]);
            $sms = new PhoneVerification();
            $sms->phone = $user_phone;
            $sms->code = $code;
            $sms->user_id = $user_id;
            $sms->save();
            $message = 'SMS sented';
            $sms_id = $sms->id;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $message = "provaleno!";
        }
       

        return $sms_id;
    }
    public function scopeResendMessage($query, $options) {
        /*
        ** default options
        */
        extract(array_merge([
            'user_id'         => null,
            'user_phone'      => null
        ], $options));

        $code = rand(100000, 999999);
        $message = $this->generateMessage ($user_phone, $code);

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);        

        try {
            $client->request('POST', "{$this->baseUrl}/send", [
                'auth' => array($this->username, $this->password),
                'body' => json_encode($message)
            ]);
            $sms = PhoneVerification::where('user_id', $user_id)->first();
            $sms_id = $sms->id;
            $sms->code = $code;
            $sms->update();
            $message = 'SMS resented';
        } catch (\Exception $e) {
            echo $e->getMessage();
            $message = "provaleno!";
        }
       

        return $sms_id;
    }
    
}
