<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public $successStatus = 200;
    public $failureStatus = 100;

    public function notifications()
    {
        $notifications = Notification::where('noti_to', Auth::id())->orderBy('created_at', 'desc')->get();
        foreach ($notifications as $notification) {
            if ($notification->noti_for == 2 && $notification->noti_activity == 1) {
                $text=$notification->noti_text > 0 ? " and $notification->noti_text others" : "" ;
                    $notification->text = $notification->user->name . "$text liked your post " . $notification->post->post_details;
            }elseif($notification->noti_for == 2 && $notification->noti_activity == 2){
                $notification->text = $notification->user->name . " commented in you post " . $notification->post->post_details;
            }elseif($notification->noti_for == 2 && $notification->noti_activity == 4){
                $notification->text = $notification->user->name . " following your post " . $notification->post->post_details;
            }elseif($notification->noti_for == 2 && $notification->noti_activity == 5){
                $notification->text = $notification->user->name . " Launched a new Event " . $notification->post->post_details;
            }elseif($notification->noti_for == 2 && $notification->noti_activity == 6){
                $now = Carbon::now();
                $expired_date = new Carbon($notification->post->expire_date);
                $diffInDays = $expired_date->diffInDays($now);
//                $diffInHuman = $expired_date->diffForHumans($now);
                $notification->text = $notification->user->name . "will launch his event after $diffInDays days" . $notification->post->post_details;
            }elseif($notification->noti_for == 3 && $notification->noti_activity == 3){
                $notification->text = $notification->user->name . "Followed you";
            }
        }
        if ($notifications->count()>0) {
            $response['notifications'] = $notifications;
            $response['message'] = "My Notification Render";
            return response()->json(['meta' => array('status' => $this->successStatus), 'response' => $response]);
        } else {
            $response['message'] = "You have no notification";
            return response()->json(['meta' => array('status' => $this->failureStatus), 'response' => $response]);
        }

    }
}
