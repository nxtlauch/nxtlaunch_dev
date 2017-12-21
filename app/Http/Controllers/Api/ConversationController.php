<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\ConversationMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{

    public $successStatus = 200;
    public $failureStatus = 100;
    public function saveChatRoom(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'user_ids' => 'required'
        ]);
        if ($validator->fails()) {
            $response['message'] = $validator->errors()->first();
            return response()->json(array('meta' => array('status' => $this->failureStatus), 'response' => $response));
        }
        $conversation = new Conversation();
        $conversation->name = $request->name;
        $conversation->user_id = Auth::id();
        if ($conversation->save()){
            $user_ids=rtrim($request->user_ids,',');
            $users=explode(',',$user_ids);
            foreach ($users as $user_id) {
                $member = new ConversationMember();
                $member->conversation_id = $conversation->id;
                $member->user_id = $user_id;
                $member->save();
            }
            $response['conversation'] = $conversation;
            $response['message'] = "Conversation Created Successfully";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        }else{
            $response['message'] = "Conversation Can not Created";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }
    }
}
