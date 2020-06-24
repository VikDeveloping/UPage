<?php

namespace App\Http\Controllers\API;

use App\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Company::all());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $sorted = Company::search($request)->with('days', 'reviews', 'district', 'city', 'parameters')->get();
        if ($request->input('filter.sort.orderBy') == 'open')
        {
            if ($request->input('filter.sort.orderDirection') == 'asc')
            {
                $sorted = $sorted->sortBy($request->input('filter.sort.orderBy'));
            }
            if ($request->input('filter.sort.orderDirection') == 'desc')
            {
                $sorted = $sorted->sortByDesc($request->input('filter.sort.orderBy'));
            }
        }

        return response()->json($sorted->values()->all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Company::find($id)->load('days', 'reviews', 'district', 'city', 'parameters'));
    }
}