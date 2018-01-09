<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiStatusTrait;
use App\Traits\DeviceTokenTrait;
use App\Traits\PostApiTrait;
use App\Traits\UserApiTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiStatusTrait,DeviceTokenTrait,UserApiTrait,PostApiTrait;
    public $successStatus = 200;
    public $failureStatus = 100;

    /*Login function*/
    public function login(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            if (Auth::user()->status != 1) {
                $response['message'] = "Your Id is Banned";
                return $this->failureApiResponse($response);
            }
            $deviceToken = $this->findDeviceToken(Auth::id(),$request->device_token);
            if ($deviceToken) {
                $deviceToken->status = 1;
                $deviceToken->save();
            } else {
                $this->createDeviceTokenForApi($user->id, $request->device_token);
            }
            $response['token'] = 'Bearer ' . $user->createToken($request->device_token)->accessToken;
            $response['user'] = $user;
            $response['message'] = "Login Successfull";
            return $this->successApiResponse($response);
//            return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));
        } else {
            $response['message'] = "Credentials do not match";
            return $this->failureApiResponse($response);
//            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
    }

    /*Register function*/
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
//            'location' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $deviceToken = $this->findDeviceToken($user->id,$request->device_token);
        if ($deviceToken) {
            $deviceToken->status = 1;
            $deviceToken->save();
        } else {
            $this->createDeviceTokenForApi($user->id, $request->device_token);
        }
        $response['token'] = 'Bearer ' . $user->createToken($request->device_token)->accessToken;
        $response['user'] = $user;
        return $this->successApiResponse($response);

    }


    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }
        if (Auth::check()) {
            $deviceToken = $this->findDeviceToken(Auth::id(),$request->device_token);
            if ($deviceToken) {
                $deviceToken->status = 0;
                $deviceToken->save();
            }
            Auth::user()->token()->revoke();
            $response['message'] = "Logout succesfull";
            return $this->successApiResponse($response);
        }else{
            $response['message'] = "Logout succesfull";
            return $this->failureApiResponse($response);
        }
    }

    public function userDetails()
    {
        $dt = Carbon::now()->toDateTimeString();
        $user = Auth::user();
        if ($user) {
            $this->userProfilePictureNullCheck($user);
            $posts = clone $user->posts;
            $this->postStructure($posts,Auth::id());
            $response['user'] = $user;
            $response['posts_launches'] = $posts->where('expire_date', '>', $dt);
            $response['posts_launched'] = $posts->where('expire_date', '<', $dt);
            $response['message'] = "User Information";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No user found";
            return $this->failureApiResponse($response);
        }

    }


    public function userDetailsById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }
        $dt = Carbon::now()->toDateTimeString();
        $id = $request->user_id;
        $user = User::where('id', $id)->with('userDetails')->first();

        if ($user) {
            $this->userProfilePictureNullCheck($user);
            $posts = clone $user->posts;
            $this->postStructure($posts,Auth::id());
            $response['user'] = $user;
            $response['posts_launches'] = $posts->where('expire_date', '>', $dt);
            $response['posts_launched'] = $posts->where('expire_date', '<', $dt);
            $response['message'] = "User Information";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No user found";
            return $this->failureApiResponse($response);

        }
    }
}