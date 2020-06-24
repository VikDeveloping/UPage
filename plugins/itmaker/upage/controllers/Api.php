<?php namespace Itmaker\Upage\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Input;
use JWTAuth;
use RainLab\User\Models\User;
use Itmaker\Upage\Models\PhoneVerification;

// models
use Itmaker\Upage\Models\Poster;
use Itmaker\Upage\Models\Category;
use Itmaker\Upage\Models\Company;
use Itmaker\Upage\Models\Interesting;
use Itmaker\Upage\Models\Location;
use Itmaker\Upage\Models\CompanyReview;
use Itmaker\Upage\Models\Favorite;

class Api extends Controller  
{

    public function index() {   
        echo 'I am API';
    }


    public function getPosts() {
        return Poster::with(['posterSchedules', 'image'])->where('is_active', true)->remember(10)->get();
    }
    
    public function getInterestings()
    {
        return Interesting::with('image')->where('is_active', true)->remember(10)->get();
    }

    // categories
    public function getCategories() {
        return Category::with('icon')->getAllRoot();
    }
    public function getCollectedCategories() {
        return Category::getCollectedCategories();
    }
    public function getCategory($id) {
        return Category::with(['icon', 'children'])->where('id', $id)->first();
    }

    public function getCompaniesByCategory($id) {
        return Company::companyList(['category' => $id]);
    }

    public function getDistricts()
    {
        return Location::with('parent')->where('nest_depth', 1)->remember(10)->get();
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities()
    {
        return Location::with('children')->where('nest_depth', 0)->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $user = $this->auth();
        
        if (!$user) 
        {
            return response()->json(['error' => 'invalid_token'], 401);
        }

        $validator = \Validator::make($request->all(), [
            'review' => 'required',
            'companyId' => 'integer|required|exists:itmaker_upage_companies,id',
        ]);

        

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $review = new CompanyReview();
        $review->review = $request->input('review');
        $review->user_id = $user->id;
        $review->company_id = $request->input('companyId');
        if ($request->input('raiting')){
            $review->rating = $request->input('rating');
        }
        $review->save();

        return Company::with('reviews')->find($request->input('companyId'))->reviews;
    }

    public function getReviewsByCompany($company)
    {
        return CompanyReview::where('company_id', $company)->remember(10)->get();
    }
    
    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    
    
    public function getCompanies(Request $request)
    {
        $page = $request['page'];
        return Company::remember(10)->with('companySchedules')->CompanyList([
            'search'   => $request['search'],
            'page'     => $request['page'],
            'category' => $request['category'],
            'city'     => $request['city'],
            'district' => $request['district'],
            'perPage' => $request['per_page']
        ]);
    }
    
    public function show($id)
    {
        return Company::with([
            'logo', 
            'location', 
            'categories', 
            'companyViews', 
            'companySchedules'
        ])->find($id);
    }

    public function associate(Request $request){
        $user = $this->auth();

        if (!$user) {
            return response()->json([
                'error' => 'invalid_token'
            ]);
        }

        $validator = \Validator::make($request->all(), [
            'company_id' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $fav = Favorite::where('company_id', $request['company_id'])->where('user_id', $user->id)->first();
        
        if($fav) {
            Favorite::where('company_id', $request['company_id'])->delete();
            $favorites = Favorite::where('user_id', $user->id)->lists('company_id');

            if (empty($favorites)) {
                return [];
            }

            return Company::whereIn('id', $favorites)->with(['logo', 'categories'])->get();
        }else{
            $favorite = new Favorite();
            $favorite->company_id = $request['company_id'];
            $favorite->user_id = $user->id;
            $favorite->save();
            $favorites = Favorite::where('user_id', $user->id)->lists('company_id');
            if (empty($favorites)) {
                return [];
            }
            return Company::whereIn('id', $favorites)->with(['logo', 'categories'])->get();
        }    
    }
    
    public function favorites() {
        $user = $this->auth();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $favorites = Favorite::where('user_id', $user->id)->lists('company_id');

        if (empty($favorites)) {
            return [];
        }

        return Company::whereIn('id', $favorites)->with(['logo', 'categories'])->get();
    }

    
    // private methods
    
    private function auth() {
		return JWTAuth::parseToken()->authenticate();
	}

    public function getUser () {
        $user = $this->auth();
        return response()->json([
            'user' => $user,
        ]);
    }
   
    public function updateUser (Request $request) {
        $user = $this->auth();

        if (!$user) {
            return response()->json(['error' => 'invalid_token'], 401);
        }
        
        if (Input::hasFile('avatar')) {
            $user->avatar = Input::file('avatar');
        }

        try {
            $user->fill(post());
            $user->save();
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function phoneVerification (Request $request) {
        $validation = \Validator::make($request->all(), [
            'phone' => 'required|exists:users'
        ]);

        if ($validation->fails())
        {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user->is_activated) {
            $validator = \Validator::make($request->all(), [
                'code'   => 'integer|required|exists:itmaker_upage_phone_verifications'
            ]);    

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }
            $phoneVerification = PhoneVerification::where([
                ['user_id', $user->id],
                ['code', $request->code],
            ]);
            if ($phoneVerification) {
                $phoneVerification->delete();

                $user->is_activated = true;
                $user->activated_at = time();
                $user->update();
                $status = 'ok';
            } else {
                $status = 'failed';
            }
            
        } else {
            $status = 'user has been activated before';
        } 

        
        
        return response()->json([
            'status' => $status,
            'user'   => $user
        ]);
    }
    public function emailVerification (Request $request) {
        $user = $this->auth();
        $validator = \Validator::make($request->all(), [
            'code'   => 'required'
        ]);
        $data = explode("-", $request->code);

         if ($user->id == $data[0] && $user->activation_code == $data[0].'-'.$data[1]) {
            $user->activation_code = null;
            $user->is_activated = true;
            $user->activated_at = $user->freshTimestamp();
            $user->forceSave();
            return true;
        }
        return response()->json(['user' => $user]);
    }
    public function resendMessage (Request $request) {

        $validator = \Validator::make($request->all(), [
            'phone' => 'required|exists:users'
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }
        $user = User::where('phone', $request['phone'])->first();

        if (!$user['is_activated']) {   

            $phoneVerification = PhoneVerification::resendMessage([
                'user_id'=> $user['id'],
                'user_phone'=> $user['phone'],
            ]);
            $status = 'ok';
            
            return response()->json([
                'sms_id' => $phoneVerification,
                'status' => $status
            ]);
        } else {
            $status = 'user has been activated before';
            return response()->json([
                'status' => $status
            ]);
        } 
    }
}
