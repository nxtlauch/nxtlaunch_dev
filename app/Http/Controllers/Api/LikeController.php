<?php

namespace App\Http\Controllers\Api;

use App\Like;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
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
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $like_exist = Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($like_exist) {
            $like_exist->delete();
            $response['message'] = "Post Unlike Successfully";
            $response['liked'] = 0;
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id = $request->post_id;
            if ($like->save()) {
                $response['like_id'] = $like->id;
                $response['liked'] = 1;
                $response['message'] = "Post Liked Successfully";
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
    /*public function myLiked(){
        $dt = Carbon::now()->toDateTimeString();
        $data['posts'] = Like::where('user_id', Auth::id())->with('')->orderBy('id', 'desc')->get()->where('post.expire_date', '>', $dt);
        $posts = Post::where('status', 1)
            ->with('user', 'comments.user:id,name', 'likes.user:id,name')
            ->where('expire_date', '>', $dt)
            ->whereHas('likes', function ($q){
                $q->where('user_id',Auth::id() );
            })
            ->get()->sortByDesc('likes.id');
        foreach ($posts as $post) {
            $user = clone $post->user;
            if ($user->userDetails->profile_picture) {
                $post->user->profile_picture = $user->userDetails->profile_picture;
            } else {
                $post->user->profile_picture = "avatar.png";
            }
            if ($post->likes->contains('user_id',Auth::id())){
                $post->liked_by_me=1;
            }else{
                $post->liked_by_me=0;
            }
            if ($post->comments->contains('user_id',Auth::id())){
                $post->commented_by_me=1;
            }else{
                $post->commented_by_me=0;
            }
            if ($post->follows->contains('user_id',Auth::id())){
                $post->followed_by_me=1;
            }else{
                $post->followed_by_me=0;
            }
        }
        if (!empty($posts)) {
            $response['posts'] = $posts;
            $response['message'] = "My Likes Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No Post Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }*/
}
