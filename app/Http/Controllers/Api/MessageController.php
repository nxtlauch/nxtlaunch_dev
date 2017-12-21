<?php

namespace App\Http\Controllers\Api;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public $successStatus = 200;
    public $failureStatus = 100;

    public function chatHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }

        $messages = Message::where('to_id', $request->conversation_id)->get();
        if ($messages->count() > 0) {
            $response['msg_history'] = $messages;
            $response['message'] = "Chat History Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "No chat History available";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }

    public function saveMessage(Request $request){
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|integer',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $message = new Message();
        $message->from_id = Auth::id();
        $message->to_id = $request->conversation_id;
        $message->message = $request->message;
        if ($message->save()) {
            $response['new_msg'] = $message;
            $response['message'] = "Message send successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "Message is not saved successfully";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
