<?php

namespace App\Console;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Update 'character_task' rows where the associated task is of type 'Daily Quest' or 'Daily Boss'
            DB::table('character_task')
                ->join('task', 'character_task.task_id', '=', 'task.id')
                ->whereIn('task.type', ['Daily Quest', 'Daily Boss'])
                ->update(['character_task.task_status' => false]);
    
            // Log a message to the console
            info('Scheduled task completed successfully!');
        })->everyFiveMinutes();

        $schedule->call(function () {
            // Update 'character_task' rows where the associated task is of type 'Daily Quest' or 'Daily Boss'
            DB::table('character_task')
                ->join('task', 'character_task.task_id', '=', 'task.id')
                ->whereIn('task.type', ['Weekly Quest', 'Weekly Boss'])
                ->update(['character_task.task_status' => false]);
    
            // Log a message to the console
            info('Scheduled task completed successfully!');
        })->weeklyOn(3);
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
