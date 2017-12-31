<?php

namespace App\Http\Controllers\Api;

use App\Like;
use App\Traits\ApiStatusTrait;
use App\Traits\LikeApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    use ApiStatusTrait,LikeApiTrait;
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
            'post_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }
        $like_exist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($like_exist) {
            $like_exist->delete();
            $response['message'] = "Post Unlike Successfully";
            $response['liked'] = 0;
            return $this->successApiResponse($response);
        } else {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id = $request->post_id;
            if ($like->save()) {
                $response['like_id'] = $like->id;
                $response['liked'] = 1;
                $response['message'] = "Post Liked Successfully";
                return $this->successApiResponse($response);
            } else {
                $response['message'] = "Something Wrong";
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
        $like = Like::find($id);
        if ($like->delete()) {
            $response['message'] = "Post Unliked Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Post Doesn't Unliked";
            return $this->failureApiResponse($response);
        }
    }
    public function myLiked(){
        $dt = Carbon::now()->toDateTimeString();
        $likes = Like::where('user_id', Auth::id())
            ->whereHas('post')
            ->with('post.user','post.likes.user:id,name','post.comments.user:id,name','post.follows')
            ->orderBy('id', 'desc')->get();
        $this->likedPostStructure($likes);
        if ($likes->count()>0) {
            $response['posts_launches'] = $likes->where('post.expire_date', '>', $dt)->pluck('post');
            $response['posts_launched'] = $likes->where('post.expire_date', '<', $dt)->pluck('post');
            $response['message'] = "My Likes Render";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "No Post Found";
            return $this->failureApiResponse($response);
        }
    }
}
