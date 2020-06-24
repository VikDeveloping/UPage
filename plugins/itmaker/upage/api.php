<?php

use Illuminate\Http\Request;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    //'domain' => 'api.upage.uz'
    /*'middleware' => ['client', 'localization']*/
], function (){
    Route::post('/register', 'itmaker\upage\controllers\API\PassportController@register');
    Route::post('/login', 'itmaker\upage\controllers\API\PassportController@login');

    /**
     * Phone Verification
     */
    Route::post('sms/send', 'itmaker\upage\controllers\API\PhoneVerificationController@sendMessage');
    Route::post('sms/resend', 'itmaker\upage\controllers\API\PhoneVerificationController@resendMessage');
    Route::post('sms/verification', 'itmaker\upage\controllers\API\PhoneVerificationController@verification');

    Route::group([
        'middleware' => 'auth:api'
    ], function (){
        /**
         * Auth
         */
        Route::get('logout', 'itmaker\upage\controllers\API\PassportController@logout');
        Route::get('user', 'itmaker\upage\controllers\API\PassportController@getUser');
        Route::put('user', 'itmaker\upage\controllers\API\PassportController@updateUser');

        /**
         * Favorites
         */
        Route::post('favorites', 'itmaker\upage\controllers\API\FavoriteController@associate');
        Route::delete('favorites', 'itmaker\upage\controllers\API\FavoriteController@detach');
        Route::get('favorites', 'itmaker\upage\controllers\API\FavoriteController@favorites');

    });

    /**
     * Categories
     */
    Route::get('categories', 'itmaker\upage\controllers\API\CategoryController@index');
    Route::get('categories/root', 'itmaker\upage\controllers\API\CategoryController@rootCategories');
    Route::get('categories/{category}/children', 'itmaker\upage\controllers\API\CategoryController@getChildrenByRoot');
    Route::get('categories/{category}/companies', 'itmaker\upage\controllers\API\CategoryController@getCompaniesByCategory');

    /**
     * Cities
     */
    Route::get('cities', 'itmaker\upage\controllers\API\CityController@getCities');

    /**
     * Districts
     */
    Route::get('districts', 'itmaker\upage\controllers\API\DistrictController@getDistricts');

    /**
     * Companies
     */
    Route::get('companies', 'itmaker\upage\controllers\API\CompanyController@index');
    Route::post('companies', 'itmaker\upage\controllers\API\CompanyController@search');
    Route::get('companies/{id}', 'itmaker\upage\controllers\API\CompanyController@show');

    /**
     * Reviews
     */
    Route::get('review/{company}', 'itmaker\upage\controllers\API\ReviewController@getReviewsByCompany');
    Route::post('review', 'itmaker\upage\controllers\API\ReviewController@store');



    /**
     * Posts
     */
    Route::get('posts', 'itmaker\upage\controllers\API\PostController@getPosts');

    /**
     * Interestings
     */
    Route::get('interesting', 'itmaker\upage\controllers\API\InterestingController@getInterestings');
});







//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});




Route::get('/api/category/{id}', function($id) {
    return Itmaker\Upage\Models\Category::with('icon')->where('id', $id)->first();
});

Route::get('/api/posts', function() {
    return Itmaker\Upage\Models\Poster::remember(10)->get();
});

Route::get('/api/interesting', function() {
    return Itmaker\Upage\Models\Interesting::remember(10)->get();
});

Route::get('/api/companies', function() {
    return Itmaker\Upage\Models\Company::remember(10)->get();
});

Route::get('/api/companies/{id}', function($id) {
    return Itmaker\Upage\Models\Company::remember(10)->find($id);
});

Route::post('/api/companies', function(Request $request) {
    $sorted = Company::search($request)->with('companySchedules', 'companyReviews', 'locations')->get();
    return ($sorted->values()->all());
});







/**
 * Categories

 */
Route::get('categories', 'itmaker\upage\controllers\API\CategoryController@index');

Route::get('categories/root', 'itmaker\upage\controllers\API\CategoryController@rootCategories');
Route::get('categories/{category}/children', 'itmaker\upage\controllers\API\CategoryController@getChildrenByRoot');
Route::get('categories/{category}/companies', 'itmaker\upage\controllers\API\CategoryController@getCompaniesByCategory');
/**
 * Cities
 */
Route::get('cities', 'itmaker\upage\controllers\API\CityController@getCities');

/**
 * Districts
 */
Route::get('districts', 'itmaker\upage\controllers\API\DistrictController@getDistricts');

/**
 * Companies
 */
Route::get('companies', 'itmaker\upage\controllers\API\CompanyController@getCompanies');
Route::post('companies', 'itmaker\upage\controllers\API\CompanyController@search');
Route::get('companies/{id}', 'itmaker\upage\controllers\API\CompanyController@show');

/**
 * Reviews
 */
Route::get('review/{company}', 'itmaker\upage\controllers\API\ReviewController@getReviewsByCompany');
Route::post('review', 'itmaker\upage\controllers\API\ReviewController@store');



/**
 * Posts
 */
Route::get('posts', 'itmaker\upage\controllers\API\PostController@getPosts');

/**
 * Interestings
 */
Route::get('interesting', 'itmaker\upage\controllers\API\InterestingController@getInterestings');


// interesting


//








