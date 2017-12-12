<?php

namespace App\Http\Controllers\Api;

use App\UserCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCategoryController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index()
    {
        $category = UserCategory::select('id','name')->get();
        if ($category->count() > 0) {
            $response['categories'] = $category;
            $response['message'] = "All Categories";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Categroy Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
