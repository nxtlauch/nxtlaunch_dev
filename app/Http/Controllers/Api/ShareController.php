<?php

namespace App\Http\Controllers\Api;

use App\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShareController extends Controller
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
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $commentReply = new Share();
        $commentReply->user_id = Auth::id();
        $commentReply->post_id = $request->post_id;
        $commentReply->title = $request->comment_id;
        if ($commentReply->save()) {
            $response['share_id'] = $commentReply->id;
            $response['message'] = "Successfully Shared";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Can not Share";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
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
        $commentReply = Share::find($id);
        if ($commentReply) {
            $response['sharedDetails'] = $commentReply;
            $response['message'] = "Shared Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Shared details not Found";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
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
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $commentReply = Share::find($id);
        $commentReply->user_id = Auth::id();
        $commentReply->post_id = $request->post_id;
        $commentReply->comment_id = $request->comment_id;
        $commentReply->reply = $request->reply;
        if ($commentReply->save()) {
            $response['share_id'] = $commentReply->id;
            $response['message'] = "Shared Post Updated Successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Reply can't Update";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
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
        $commentReply = CommentReply::find($id);
        if ($commentReply->delete()) {
            $response['message'] = "Reply Deleted Successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Reply can't Delete";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
