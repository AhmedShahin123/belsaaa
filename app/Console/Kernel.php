<?php

namespace App\Console;

use App\Console\Commands\AcceptTasks;
use App\Console\Commands\ExpireTasks;
use App\Console\Commands\FinishTasks;
use App\Console\Commands\SendToAdminEmployerNotAnswered;
use App\Console\Commands\RejectTaskerNotAnswered;
use App\Console\Commands\SendTasksToTaskers;
use App\Console\Commands\RejectPassedNotAcceptedTask;
use App\Console\Commands\StartTasks;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
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
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command(SendTasksToTaskers::class)->everyMinute();
         $schedule->command(RejectTaskerNotAnswered::class)->everyMinute();
         $schedule->command(SendToAdminEmployerNotAnswered::class)->everyMinute();
         $schedule->command(ExpireTasks::class)->everyMinute();
         $schedule->command(FinishTasks::class)->everyMinute();
         $schedule->command(StartTasks::class)->everyMinute();
         $schedule->command(AcceptTasks::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
