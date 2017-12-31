<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiStatusTrait;
use App\UserCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCategoryController extends Controller
{
    use ApiStatusTrait;

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index()
    {
        $category = UserCategory::select('id','name')->get();
        if ($category->count() > 0) {
            $response['categories'] = $category;
            $response['message'] = "All Categories";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No Categroy Found";
            return $this->failureApiResponse($response);
        }
    }
}
