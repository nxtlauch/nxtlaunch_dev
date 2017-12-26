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
        Log::info('Inserting Notification: '.time());
        $now = Carbon::now();
        $posts = Post::where('status', 1)->where('expire_date', '>', $now->toDateTimeString())->get();
        if (isset($posts)){
            foreach ($posts as $post) {
                $expired_date = new Carbon($post->expire_date);
                $diffInDays = $expired_date->diffInDays($now);
                if ($diffInDays <= 7) {
                    foreach ($post->follows as $follow) {
                        $notification = Notification::where('noti_to', $follow->user_id)->where('noti_activity', 6)->where('noti_for', 2)->where('purpose_id', $post->id)->first();
                        if (!$notification) {
                            $followNotification = new Notification();
                            $followNotification->user_id = $post->user->id;
                            $followNotification->noti_for = 2;
                            $followNotification->noti_activity = 6;
                            $followNotification->purpose_id = $post->id;
                            $followNotification->noti_to = $follow->user_id;
                            $followNotification->save();

                        }
                    }
                }
            }
        }

    }
}
