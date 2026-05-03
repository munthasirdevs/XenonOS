<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use App\Console\Commands\DeleteOldNotificationsCommand;
use App\Console\Commands\GenerateSecurityReportCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            DeleteOldNotificationsCommand::class,
            GenerateSecurityReportCommand::class,
        ]);
    }

    public function boot(Schedule $schedule): void
    {
        // Delete old notifications daily
        $schedule->command('notifications:delete-old')->daily();
        
        // Security report every 8 hours
        $schedule->command('report:security --hours=8')->cron('0 */8 * * *');
    }
}