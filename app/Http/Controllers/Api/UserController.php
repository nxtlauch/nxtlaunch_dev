<?php

namespace App\Http\Controllers\Api;

use App\DeviceToken;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public $failureStatus = 100;

    /*Login function*/
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            if (Auth::user()->status != 1) {
                $response['message'] = "Your Id is Banned";
                return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
            }
            $deviceToken = DeviceToken::where('user_id', Auth::id())->where('device_token', $request->device_token)->first();
            if ($deviceToken) {
                $deviceToken->status = 1;
                $deviceToken->save();
            } else {
                $deviceToken = new DeviceToken();
                $deviceToken->device_token = $request->device_token;
                $deviceToken->user_id = Auth::id();
                $deviceToken->save();
            }
            $response['token'] = 'Bearer ' . $user->createToken($request->device_token)->accessToken;
            $response['user'] = $user;
            $response['message'] = "Login Successfull";
            return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));
        } else {
            $response['message'] = "Credentials do not match";
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));

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
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $deviceToken = DeviceToken::where('user_id', $user->id)->where('device_token', $request->device_token)->first();
        if ($deviceToken) {
            $deviceToken->status = 1;
            $deviceToken->save();
        } else {
            $deviceToken = new DeviceToken();
            $deviceToken->device_token = $request->device_token;
            $deviceToken->user_id = $user->id;
            $deviceToken->save();
        }
        $response['token'] = 'Bearer ' . $user->createToken($request->device_token)->accessToken;
        $response['user'] = $user;
        return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));

    }


    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        if (Auth::check()) {
            $deviceToken = DeviceToken::where('user_id', Auth::id())->where('device_token', $request->device_token)->first();
            if ($deviceToken) {
                $deviceToken->status = 0;
                $deviceToken->save();
            }
            Auth::user()->token()->revoke();
            $success['message'] = "Logout succesfull";
            return response()->json(['response' => $success], $this->successStatus);
        }
    }

    public function userDetails()
    {
        $user = Auth::user();
        if ($user) {
            if (@$user->userDetails->profile_picture) {
                $user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $user->profile_picture = "avatar.png";
            }
            $response['user'] = $user;
            $response['message'] = "User Information";
            return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));
        } else {
            $response['message'] = "No user found";
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

    }

    public function userDetailsById($id)
    {
        $user = User::where('id', $id)->with('userDetails')->first();

        if ($user) {
            if (@$user->userDetails->profile_picture) {
                $user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $user->profile_picture = "avatar.png";
            }
            $response['user'] = $user;
            $response['message'] = "User Information";
            return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));
        } else {
            $response['message'] = "No user found";
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));

        }
    }

    public function my_following(){
        $users = User::whereHas('followers', function ($q){
                $q->where('followed_by',Auth::id());
            })
            ->get();

        foreach ($users as $user) {
            $user->followed_by_me=1;
            if (@$user->userDetails->profile_picture) {
                $user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $user->profile_picture = "avatar.png";
            }
        }
        if ($users->count()>0) {
            $response['brands'] = $users;
            $response['message'] = "Brand  Information";
            return response()->json(array('meta' => array('status' => $this->successStatus), 'response' => $response));
        } else {
            $response['message'] = "No brands found";
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
    }


}