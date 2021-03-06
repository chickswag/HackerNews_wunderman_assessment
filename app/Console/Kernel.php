<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //fetch posts
        $schedule->call('App\Http\Controllers\PostsController@fetchPosts')->everyMinute()->name('create posts')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\PostsController@saveCommentsForStories')->everyMinute()->name('create comments')->withoutOverlapping();
        $schedule->call('App\Http\Controllers\PostsController@saveCommentBelongingToAComment')->everyMinute()->name('create replies')->withoutOverlapping();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
