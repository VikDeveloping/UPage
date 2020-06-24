<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function associate(Request $request)
    {
        \Auth::user()->favoritesCompanies()->attach($request->input('company_id'));

        return response()->json([
            'success' => 200,
            'favorites' => \Auth::user()->favoritesCompanies()->get()
            ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Request $request)
    {
        \Auth::user()->favoritesCompanies()->detach($request->input('company_id'));

        return response()->json([
            'success' => 200,
            'favorites' => \Auth::user()->favoritesCompanies()->get()
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favorites()
    {
        return response()->json([
            'success' => 200,
            'favorites' => \Auth::user()->favoritesCompanies()->get()
        ]);
    }
}
