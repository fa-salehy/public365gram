<?php

namespace App\Console;

use App\Console\Commands\Install;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\ReportController;
use App\Models\Tag;
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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

      
            $schedule->call(function(){
                $tags = Tag::where('checked','=',0)->get();
                // print_r($tags);
                foreach ($tags as $tag) {
                ReportController::check_tag($tag);
                $tag->update(['checked'=>1]);
                print('check shod');
                }
                // print('hello');
            })->dailyAt('18:22');
       
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
