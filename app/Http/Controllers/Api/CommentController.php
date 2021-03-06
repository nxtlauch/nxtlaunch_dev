<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Traits\ApiStatusTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
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
        //
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
            'post_id' => 'required',
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return $this->failureApiResponse($response);
        }

        $post = new Comment();
        $post->user_id = Auth::id();
        $post->post_id = $request->post_id;
        $post->comment = $request->comment;

        if ($post->save()) {
            $response['comment'] = $post;
            $response['message'] = "Commented Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Can not Comment";
            return $this->failureApiResponse($response);
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
        $comment = Comment::find($id);
        if ($comment) {
            $response['comment'] = $comment;
            $response['message'] = "Comment Render";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Comment info not Found";
            return $this->failureApiResponse($response);
        }
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
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        if ($comment->save()) {
            $response['comment_id'] = $comment->id;
            $response['message'] = "Comment Updated Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Comment can't Update";
            return $this->failureApiResponse($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment->delete()) {
            $response['message'] = "Comment Deleted Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Comment can't Delete";
            return $this->failureApiResponse($response);
        }
    }
}
