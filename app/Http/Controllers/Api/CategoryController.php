<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index()
    {
        $category = Category::all();
        if ($category->count()>0) {
            $response['categories'] = $category;
            $response['message'] = "All Category Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Category Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }
}
