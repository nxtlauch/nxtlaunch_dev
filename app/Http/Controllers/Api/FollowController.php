<?php

namespace App\Http\Controllers\Api;

use App\Follow;
use App\Traits\ApiStatusTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
    use ApiStatusTrait;
    public $successStatus = 200;
    public $failureStatus = 100;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$likes = Like::all();
        if (!empty($likes)) {
            $response['likes'] = $likes;
            $response['message'] = "All Likes Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Like Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }
        $follow_exist = Follow::where('user_id', $request->user_id)->where('followed_by', Auth::id())->first();
        if ($follow_exist) {
            $follow_exist->delete();
            $response['message'] = "unfollowed this user";
            $response['followed'] = 0;
            return $this->successApiResponse($response);
        } else {
            $follow = new Follow();
            $follow->user_id = $request->user_id;
            $follow->followed_by = Auth::id();
            if ($follow->save()) {
                $response['follow_id'] = $follow->id;
                $response['followed'] = 1;
                $response['message'] = "followed this user successfully";
                return $this->successApiResponse($response);
            } else {
                $response['message'] = "User can't Follow";
                return $this->failureApiResponse($response);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $follow = Follow::find($id);
        if ($follow->delete()) {
            $response['message'] = "Post Unfollowed Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Post Doesn't Unfollow";
            return $this->failureApiResponse($response);
        }
    }

    /*Authenticated User following Post*/
    public function my_following()
    {
        $follows = Follow::where('followed_by', Auth::id())->with(['user.userDetails'])->orderBy('id', 'desc')->get()->pluck('user');
        if ($follows->count()>0) {
            foreach ($follows as $brand) {
                $brand->followed_by_me = 1;

            }
            $response['brands'] = $follows;
            $response['message'] = "My following users";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No Post Found";
            return $this->failureApiResponse($response);
        }
    }
    /*End Authenticated User following Post*/
}
