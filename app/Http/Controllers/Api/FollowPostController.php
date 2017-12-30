<?php

namespace App\Http\Controllers\Api;

use App\FollowPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowPostController extends Controller
{
    public $successStatus = 200;
    public $failureStatus = 100;

    public function index()
    {
        $dt = Carbon::now()->toDateTimeString();
        $follows = FollowPost::where('user_id',Auth::id())
            ->whereHas('post')
            ->with('post.user','post.likes.user:id,name','post.comments.user:id,name','post.follows')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($follows as $follow) {
            $user = clone $follow->post->user;
            if (@$user->userDetails->profile_picture) {
                $follow->post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $follow->post->user->profile_picture = "avatar.png";
            }
            if ($follow->post->likes->contains('user_id',Auth::id())){
                $follow->post->liked_by_me=1;
            }else{
                $follow->post->liked_by_me=0;
            }
            if ($follow->post->comments->contains('user_id',Auth::id())){
                $follow->post->commented_by_me=1;
            }else{
                $follow->post->commented_by_me=0;
            }
            if ($follow->post->follows->contains('user_id',Auth::id())){
                $follow->post->followed_by_me=1;
            }else{
                $follow->post->followed_by_me=0;
            }
        }
        if ($follows->count()>0) {
            $response['posts_launches'] = $follows->where('post.expire_date', '>', $dt)->pluck('post');
            $response['posts_launched'] = $follows->where('post.expire_date', '<', $dt)->pluck('post');
            $response['message'] = "My Followed post Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
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
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $followPostEsixt = FollowPost::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($followPostEsixt) {
            $followPostEsixt->delete();
            $response['followed'] = 0;
            $response['message'] = "You successfully unfollowed this post";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        } else {
            $like = new FollowPost();
            $like->user_id = Auth::id();
            $like->post_id = $request->post_id;
            if ($like->save()) {
                $response['follow_id'] = $like->id;
                $response['followed'] = 1;
                $response['message'] = "Post Followed Successfully";
                return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
            } else {
                $response['message'] = "Post Doesn't Liked";
                return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
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
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Post Doesn't Unliked";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
