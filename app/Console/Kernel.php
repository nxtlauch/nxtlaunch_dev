<?php

namespace App\Console;

use App\Notification;
use App\Post;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
//         $schedule->command('reminder:create')
//                  ->everyMinute();
        $schedule->call(function () {
            Log::info('Showing Test : '.time());
            $now = Carbon::now();
            $posts = Post::where('status', 1)->where('expire_date', '>', $now->toDateTimeString())->get();
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
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
