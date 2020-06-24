<?php

namespace App\Http\Controllers\API;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function rootCategories()
    {
        return response()->json(Category::whereIsRoot()->get());
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChildrenByRoot(Category $category)
    {
        return response()->json($category->children()->get());
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompaniesByCategory(Category $category)
    {
        return response()->json($category->companies()->with('days', 'reviews', 'district', 'city', 'parameters')->get());
    }
}
