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
       
      //  $schedule->call('App\Http\Controllers\HomeController@send_activity')->dailyAt('18:00')->timezone('Asia/Kolkata');
        $schedule->call('App\Http\Controllers\ReportController@creative_report_update')->dailyAt('02:00')->timezone('Asia/Kolkata');
       // $schedule->call('App\Http\Controllers\Project\TaskController@pending_task_notification')->dailyAt('9:00')->timezone('Asia/Kolkata');
        $schedule->call('App\Http\Controllers\LeadsController@import')->daily();

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
