<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\ConversationMember;
use App\Traits\ApiStatusTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    use ApiStatusTrait;

    public $successStatus = 200;
    public $failureStatus = 100;

    public function saveChatRoom(Request $request)
    {
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
        if ($conversation->save()) {
            $user_ids = rtrim($request->user_ids, ',');
            $users = explode(',', $user_ids);
            foreach ($users as $user_id) {
                $member = new ConversationMember();
                $member->conversation_id = $conversation->id;
                $member->user_id = $user_id;
                $member->save();
            }
            $response['conversation'] = $conversation;
            $response['message'] = "Conversation Created Successfully";
            return $this->successApiResponse($response);
        } else {
            $response['message'] = "Conversation Can not Created";
            return $this->failureApiResponse($response);
        }
    }

    public function conversationList()
    {
        $conversations = Conversation::orderBy('id', 'desc')
            ->where(function ($q) {
                $q->whereHas('user', function ($query) {
                    $query->where('id', Auth::id());
                })
                    ->orWhereHas('members', function ($z) {
                        $z->where('user_id', Auth::id());
                    });
            })->get();
        if ($conversations->count() > 0) {
            $response['conversation_list'] = $conversations;
            return $this->successApiResponse($response);
        } else {
            $response['message'] = 'There is no conversation for you';
            return $this->failureApiResponse($response);
        }
    }

}
