<?php

namespace App\Http\Controllers\API;

use App\Company;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'review' => 'required',
            'rating' => 'required',
            'company_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $review = new Review;
        $review->review = $request->input('review');
        $review->rating = $request->input('rating');
        $review->user_id = \Auth::user()->id;
        $review->company_id = $request->input('company_id');
        $review->save();

        return response()->json(
            Company::find($request->input('company_id'))->reviews()->get()
            );
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReviewsByCompany(Company $company)
    {
        return response()->json($company->reviews()->get());
    }
}
