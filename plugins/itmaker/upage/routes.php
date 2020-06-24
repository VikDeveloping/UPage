<?php
use RainLab\User\Models\User as UserModel;
use GuzzleHttp\Client;
use Itmaker\Upage\Models\PhoneVerification;


Route::group(['prefix' => 'api'], function () {  
    
    // start
    Route::get('/', 'itmaker\upage\controllers\Api@index');

          
    // Categories
    Route::get('categories', 'itmaker\upage\controllers\Api@getCategories');
    Route::get('categories/collected', 'itmaker\upage\controllers\Api@getCollectedCategories');
    Route::get('category/{id}', 'itmaker\upage\controllers\Api@getCategory');
    Route::get('category/{id}/companies', 'itmaker\upage\controllers\Api@getCompaniesByCategory');

    // Posts
    Route::get('posts', 'itmaker\upage\controllers\Api@getPosts');

    // Interestings
    Route::get('interestings', 'itmaker\upage\controllers\Api@getInterestings');
    
    //Cities
    Route::get('cities', 'itmaker\upage\controllers\Api@getCities');
    
    //Locations
    Route::get('districts', 'itmaker\upage\controllers\Api@getDistricts');
    
    //Reviews
    Route::get('review/{company}', 'itmaker\upage\controllers\Api@getReviewsByCompany');
    Route::post('review', 'itmaker\upage\controllers\Api@store')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    
    //Companies
    Route::get('companies', 'itmaker\upage\controllers\Api@getCompanies');
    Route::get('company/{id}', 'itmaker\upage\controllers\Api@show');
    
    /**
     * Favorites
     */
    Route::get('favorites', 'itmaker\upage\controllers\Api@favorites')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    Route::post('favorites', 'itmaker\upage\controllers\Api@associate')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    Route::delete('favorites', 'itmaker\upage\controllers\Api@detach')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    
    Route::post('test', function (\Request $request) {
        return $response->json(('ok!'));
    })->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    
});



Route::group(['prefix' => 'api/user'], function() {
    Route::post('login', function (\Request $request) {


        if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", Request::get('login'))){

            $validator = \Validator::make(Request::all(), [
                'login' => 'required|max:255|email|exists:users,email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()
                ], 401);
            } else {
                $credentials = [
                    'email' => Request::get('login'),
                    'password' => Request::get('password')
                ];
                try {
                    // verify the credentials and create a token for the user
                    if (! $token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'error' => [
                                'password' => 'wrong password'
                            ]
                        ], 401);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
                $userModel = JWTAuth::authenticate($token);
                if ($userModel->methodExists('getAuthApiSigninAttributes')) {
                    $user = $userModel->getAuthApiSigninAttributes();
                } else {
                    $user = [
                        'id' => $userModel->id,
                        'name' => $userModel->name,
                        'surname' => $userModel->surname,
                        'username' => $userModel->username,
                        'email' => $userModel->email,
                        'is_activated' => $userModel->is_activated,
                    ];
                }
                //if no errors are encountered we can return a JWT
                return response()->json(compact('token', 'user'));


                // return response()->json([
                //     'error' => [
                //         'password' => ['Неверный пароль'],
                //     ]
                // ], 401);
            }
        }

        if (preg_match('/(?:\+[9]{2}[8][0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2})/', Request::get('login'))){


            $validator = \Validator::make(Request::all(), [
                'login' => 'required|max:255|exists:users,phone',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=> $validator->errors()], 401);
            } else {

                $credentials = [
                    'phone' => Request::get('login'),
                    'password' => Request::get('password')
                ];
                try {
                    // verify the credentials and create a token for the user
                    if (! $token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'error' => [
                                'password' => 'wrong password'
                            ]
                        ], 401);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
                $userModel = JWTAuth::authenticate($token);
                if ($userModel->methodExists('getAuthApiSigninAttributes')) {
                    $user = $userModel->getAuthApiSigninAttributes();
                } else {
                    $user = [
                        'id' => $userModel->id,
                        'name' => $userModel->name,
                        'surname' => $userModel->surname,
                        'username' => $userModel->username,
                        'email' => $userModel->email,
                        'is_activated' => $userModel->is_activated,
                    ];
                }

                if (!$user['is_activated']) {
                    return response()->json([
                        'error' => [
                            'phone' => 'phone number not verified'
                        ]
                    ], 401);
                }

                //if no errors are encountered we can return a JWT
                return response()->json(compact('token', 'user'));
            }
        }

        if (!preg_match('/(?:\+[9]{2}[8][0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2})/', Request::get('login')) and !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", Request::get('login'))){
            return response()->json([
                'error' => [
                    'login' => ['You can log in via Email or Phone'],
                ]
            ], 401);
        }

        // try {
        //     // verify the credentials and create a token for the user
        //     if (! $token = JWTAuth::attempt($credentials)) {
        //         return response()->json(['error' => 'invalid_credentials'], 401);
        //     }
        // } catch (JWTException $e) {
        //     // something went wrong
        //     return response()->json(['error' => 'could_not_create_token'], 500);
        // }
        // $userModel = JWTAuth::authenticate($token);
        // if ($userModel->methodExists('getAuthApiSigninAttributes')) {
        //     $user = $userModel->getAuthApiSigninAttributes();
        // } else {
        //     $user = [
        //         'id' => $userModel->id,
        //         'name' => $userModel->name,
        //         'surname' => $userModel->surname,
        //         'username' => $userModel->username,
        //         'email' => $userModel->email,
        //         'is_activated' => $userModel->is_activated,
        //     ];
        // }
        // // if no errors are encountered we can return a JWT
        // return response()->json(compact('token', 'user'));
    });
    
    
    Route::post('refresh', function (Request $request) {
        $token = Request::get('token');
        try {
            // attempt to refresh the JWT
            if (!$token = JWTAuth::refresh($token)) {
                return response()->json(['error' => 'could_not_refresh_token'], 401);
            }
        } catch (Exception $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_refresh_token'], 500);
        }
        // if no errors are encountered we can return a new JWT
        return response()->json(compact('token'));
    });
    
    Route::post('invalidate', function (Request $request) {
        $token = Request::get('token');
        try {
            // invalidate the token
            JWTAuth::invalidate($token);
        } catch (Exception $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_invalidate_token'], 500);
        }
        // if no errors we can return a message to indicate that the token was invalidated
        return response()->json('token_invalidated');
    });
    
    Route::post('signup', function () {
        $credentials = Input::only('name', 'phone', 'email', 'password', 'password_confirmation');
        
        $rules = [
            'name'      => 'required',
            'phone'     => 'required_without:email|unique:users',
            'email'     => 'required_without:phone|unique:users',
            'password'  => 'required|min:8',
            'password_confirmation' => 'required|same:password' 
        ];


        $validation = Validator::make($credentials, $rules);
        if ($validation->fails()) {
            return response()->json([ 
                'error' => $validation->errors()
            ], 401);
        }
        
        if (!isset($credentials['email'])) {
            $credentials['email'] = $credentials['phone'] . '@testmail.uz';
        }
        
        try {
            $userModel = UserModel::create($credentials);
            
            if ($userModel->methodExists('getAuthApiSignupAttributes')) {
                $user = $userModel->getAuthApiSignupAttributes();
            } else {
                $user = [
                    'id' => $userModel->id,
                    'name' => $userModel->name,
                    'surname' => $userModel->surname,
                    'username' => $userModel->username,
                    'phone' => $userModel->phone,
                    'email' => $userModel->email,
                    'is_activated' => $userModel->is_activated,
                ];
            }
            
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 401);
        }
        
        $token = JWTAuth::fromUser($userModel);
        
        /*
        **
        **  Phone verification
        **
        */

        if ($user['email'] == $user['phone'] . '@testmail.uz') {
            $sms_id = PhoneVerification::sendMessage([
                'user_id'    => $user['id'],
                'user_phone' => $user['phone']
            ]);
        } else {
            $message = 'email authentication'; 
            
            $userModel->activation_code = $code = implode('-', [$userModel->id, rand(1111, 9999)]);
            $userModel->save();

            $data = [
                'name' => $userModel->name,
                'code' => $code
            ];

            \Mail::send('itmaker.upage::mail.activate', $data, function($message) use ($userModel) {
                $message->to($userModel->email, $userModel->name);
            });
        }
        

        return Response::json(compact('token', 'user', 'message', 'sms_id'));
    });

    Route::get('get-user', 'itmaker\upage\controllers\Api@getUser')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    Route::post('update-user', 'itmaker\upage\controllers\Api@updateUser')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    
    Route::post('phone-verification', 'itmaker\upage\controllers\Api@phoneVerification');
    Route::post('email-verification', 'itmaker\upage\controllers\Api@emailVerification')->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
    Route::post('resend-message', 'itmaker\upage\controllers\Api@resendMessage');
    
});



