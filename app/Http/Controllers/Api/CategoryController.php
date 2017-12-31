<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Traits\ApiStatusTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use ApiStatusTrait;

    public $successStatus = 200;
    public $failureStatus = 100;

    public function index()
    {
        $category = Category::all();
        if ($category->count()>0) {
            $response['categories'] = $category;
            $response['message'] = "All Category Render";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No Category Found";
            return $this->failureApiResponse($response);
        }

    }
}
