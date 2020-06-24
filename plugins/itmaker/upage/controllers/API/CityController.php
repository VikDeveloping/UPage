<?php

namespace App\Http\Controllers\API;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities()
    {
        return response()->json(City::all());
    }
}
