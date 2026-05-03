<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserNotification;
use Carbon\Carbon;

class DeleteOldNotificationsCommand extends Command
{
    protected $signature = 'notifications:delete-old {--days=30}';
    protected $description = 'Delete notifications older than specified days';

    public function handle()
    {
        $days = $this->option('days');
        $cutoff = Carbon::now()->subDays($days);

        $deleted = UserNotification::where('created_at', '<', $cutoff)->delete();

        $this->info("Deleted {$deleted} notifications older than {$days} days.");
        return Command::SUCCESS;
    }
}