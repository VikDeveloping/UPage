<?php

namespace App\Http\Controllers\API;

use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts()
    {
        return response()->json(District::all());
    }
}
