<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->command('backup:clean')->daily()->at('02:05');
        $schedule->command('backup:run')->everyMinute()->then(function(){
            \Log::info('Backup creation task executed.');
        });
        //$schedule->call(function () {
          //  \Log::info('Log command executed every second.');
        //})->everySecond();

        /// $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
