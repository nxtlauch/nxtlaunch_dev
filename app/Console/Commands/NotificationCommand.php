<?php

namespace App\Console\Commands;

use App\Notification;
use App\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        $now = Carbon::now();
        $posts = Post::where('status', 1)
            ->whereHas('follows')
            ->with('follows')
            ->whereBetween('expire_date', [$now->toDateTimeString(),$now->addDays(7)
                ->toDateTimeString()])
            ->orderBy('expire_date','asc')
            ->get();
        if ($posts->count() > 0) {
            foreach ($posts as $post) {
                $customNotification = $post->customPostNotification->pluck('user_id');
                $expired_date = new Carbon($post->expire_date);
                $diffInDays = $expired_date->diffInDays($now);
                if ($diffInDays > 7) {
                    continue;
                }
                $diffInHours = $expired_date->diffInHours($now);
                $diffInmin = $expired_date->diffInMinutes($now);
                foreach ($post->customPostNotification as $notification) {
                    if ($notification->reminder_before == 1) {
                        if ($diffInDays <= 7) {
                            $this->notificationCheck($notification->user_id, 6, $post->id, $post->user->id);
                        }
                    } elseif ($notification->reminder_before == 2) {
                        if ($diffInDays <= 1) {
                            $this->notificationCheck($notification->user_id, 7, $post->id, $post->user->id);
                        }
                    } elseif ($notification->reminder_before == 3) {
                        if ($diffInHours <= 1) {
                            $this->notificationCheck($notification->user_id, 8, $post->id, $post->user->id);
                        }
                    } elseif ($notification->reminder_before == 4) {
                        if ($diffInmin <= 20) {
                            $this->notificationCheck($notification->user_id, 9, $post->id, $post->user->id);
                        }
                    }
                }
                $allFollows = $post->follows->pluck('user_id');
                $follows = $allFollows->diff($customNotification);
                foreach ($follows as $user_id) {
                    $this->notificationCheck($user_id, 6, $post->id, $post->user->id);
                }
            }
        }
    }


//    public function handle()
//    {
//        Log::info('Inserting Notification: ' . time());
//        $now = Carbon::now();
//        $posts = Post::where('status', 1)->where('expire_date', '>', $now->toDateTimeString())->get();
//        if (isset($posts)) {
//            foreach ($posts as $post) {
//                $expired_date = new Carbon($post->expire_date);
//                $diffInDays = $expired_date->diffInDays($now);
//                $diffInHours = $expired_date->diffInHours($now);
//                $diffInmin = $expired_date->diffInMinutes($now);
//
//                foreach ($post->follows as $follow) {
//                    if ($diffInDays <= 7) {
//                        $this->notificationCheck($follow->user_id, 6, $post->id, $post->user->id);
//                        /*$notification = Notification::where('noti_to', $follow->user_id)->where('noti_activity', 6)->where('noti_for', 2)->where('purpose_id', $post->id)->first();
//                        if (!$notification) {
//                            $followNotification = new Notification();
//                            $followNotification->user_id = $post->user->id;
//                            $followNotification->noti_for = 2;
//                            $followNotification->noti_activity = 6;
//                            $followNotification->purpose_id = $post->id;
//                            $followNotification->noti_to = $follow->user_id;
//                            $followNotification->save();
//
//                        }*/
//                    } elseif ($diffInDays <= 1) {
//                        $this->notificationCheck($follow->user_id, 7, $post->id, $post->user->id);
//                    } elseif ($diffInHours <= 1) {
//                        $this->notificationCheck($follow->user_id, 8, $post->id, $post->user->id);
//                    } elseif ($diffInmin <= 5) {
//                        $this->notificationCheck($follow->user_id, 9, $post->id, $post->user->id);
//                    }
//                }
//            }
//        }
//
//    }

    private function notificationCheck($user_id, $noti_activity, $post_id, $post_user_id)
    {
        $notification = Notification::where('noti_to', $user_id)->where('noti_activity', $noti_activity)->where('noti_for', 2)->where('purpose_id', $post_id)->first();
        if (!$notification) {
            $followNotification = new Notification();
            $followNotification->user_id = $post_user_id;
            $followNotification->noti_for = 2;
            $followNotification->noti_activity = $noti_activity;
            $followNotification->purpose_id = $post_id;
            $followNotification->noti_to = $user_id;
            $followNotification->save();
        }
    }
}
