<?php

namespace App\Http\Controllers\API;

use App\Interesting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterestingController extends Controller
{
    public function getInterestings()
    {
        return response()->json(Interesting::all());
    }
}
