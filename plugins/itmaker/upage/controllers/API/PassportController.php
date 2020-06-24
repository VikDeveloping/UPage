<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserUpdateRequest;
use App\Jobs\UserUpdateJob;
use App\Role;
use App\User;
use App\VerificationMessage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    /**
     * Success code
     *
     * @var int
     */
    public $successStatus = 200;
    public $username = 'upageuz';
    public $password = 'Tc1yRQl35';
    public $originator = '3700';
    public $baseUrl = 'http://91.204.239.42:8083/broker-api';


    private function auth() {
		return JWTAuth::parseToken()->authenticate();
	}
    
    /**
     * User registration
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        if ($request->has('email')){
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'c_password' => 'required|min:6|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
        }

        if ($request->has('phone')){
            $exists = VerificationMessage::wherePhone($request->input('phone'))->get();
            $verified = $exists->where('verified', '1')->count();
            $error = [];



            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required|phone|unique:users',
                'password' => 'required|min:6',
                'c_password' => 'required|min:6|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }

            if ($verified <= 0){
                $error['verified'] = ['Не подтвержден'];
            }

            if ($exists->count() > 0 or $verified > 0){
                return response()->json([
                    'error' => $error
                ], 419);
            }
        }

        if(!$request->has('phone') and !$request->has('email')){
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required_unless:phone,null|unique:users|email',
                'password' => 'required|min:6',
                'c_password' => 'required|min:6|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user->roles()->attach(Role::where('slug', 'user')->first()->id);
        $success['token'] = $user->createToken('upage')->accessToken;
        $success['name'] = $user->name;

        if ($request->has('phone')){

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
                                'text' => 'Ваш код подтверждения: '.$code
                            ]
                        ]
                    ]
                ]
            ];

            $sms = new VerificationMessage();
            $sms->phone = $request->input('phone');
            $sms->code = $code;
            $sms->user_id = $user->id;
            $sms->save();

            try {
                $client->request('POST', "{$this->baseUrl}/send", [
                    'auth' => array($this->username, $this->password),
                    'body' => json_encode($message)
                ]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

            $success['sms_id'] = $sms->id;
            $success['user_id'] = $user->id;
        }


        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * User login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $request->input('login'))){
            $validator = \Validator::make($request->all(), [
                'login' => 'required|max:255|email|exists:users,email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=> $validator->errors()], 401);
            } else {
                if(\Auth::attempt(['email' => request('login'), 'password' => request('password')])){
                    $user = \Auth::user();
                    $success['token'] =  $user->createToken('upage')->accessToken;
                    return response()->json(['success' => $success], $this->successStatus);
                }

                return response()->json([
                    'error' => [
                        'password' => ['Неверный пароль'],
                    ]
                ], 401);
            }
        }

        if (preg_match('/(?:\+[9]{2}[8][0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2})/', $request->input('login'))){
            $exists = VerificationMessage::wherePhone($request->input('login'))->get();
            $verified = $exists->where('verified', '1')->count();


            $validator = \Validator::make($request->all(), [
                'login' => 'required|max:255|phone|exists:users,phone',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=> $validator->errors()], 401);
            } else {
                if ($verified <= 0){
                    return response()->json([
                        'error' => [
                            'verified' => ['Не подтвержден'],
                            'user_id' => [User::wherePhone($request->input('login'))->first()->id]
                        ]
                    ], 401);
                }
                if(\Auth::attempt(['phone' => request('login'), 'password' => request('password')])){
                    $user = \Auth::user();
                    $success['token'] =  $user->createToken('upage')->accessToken;
                    return response()->json(['success' => $success], $this->successStatus);
                }

                return response()->json([
                    'error' => [
                        'password' => ['Неверный пароль'],
                    ]
                ], 401);
            }
        }

        if (!preg_match('/(?:\+[9]{2}[8][0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2})/', $request->input('login')) and !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $request->input('login'))){
            return response()->json([
                'error' => [
                    'login' => ['Вы можете войти через Email либо через Телефон'],
                ]
            ], 401);
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ], $this->successStatus);
    }

    /**
     * Get authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        $user = \Auth::user();
        $var = $user->avatar;

        $user->avatar = env('APP_URL').'/uploads/avatars/'.$var;

        return response()->json($user, $this->successStatus);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request)
    {
        if ($request->has('email')){
            $validator = \Validator::make($request->all(), [
//            'name' => 'required',
//            'surname' => 'required',
                'email' => 'email|unique:users',
                'password' => 'min:6',
//            'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
        }

        if ($request->has('phone')){
            $validator = \Validator::make($request->all(), [
//            'name' => 'required',
//            'surname' => 'required',
                'phone' => 'phone|unique:users',
                'password' => 'min:6',
//            'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
        }

        if(!$request->has('phone') and !$request->has('email')){
            $validator = \Validator::make($request->all(), [
//            'name' => 'required',
//            'surname' => 'required',
                'email' => 'required_unless:phone,null|unique:users',
                'password' => 'min:6',
//            'c_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
        }

        dispatch_now(new UserUpdateJob($request, User::find(\Auth::user()->id)));

        return response()->json(User::find(\Auth::user()->id), $this->successStatus);
    }
}
