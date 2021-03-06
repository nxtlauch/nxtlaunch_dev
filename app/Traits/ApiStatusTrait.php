<?php
/**
 * Created by PhpStorm.
 * User: Thowhidur Rahman
 * Date: 12/31/2017
 * Time: 11:36 AM
 */

namespace App\Traits;


trait ApiStatusTrait
{
    public $successStatus = 200;
    public $failureStatus = 100;

    public function successApiResponse($response){
        return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
    }
    public function failureApiResponse($response){
        return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
    }


}