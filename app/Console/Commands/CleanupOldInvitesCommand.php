<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CleanupOldInvitesCommand extends Command
{
    protected $signature = 'app:cleanup-invites';

    protected $description = 'Clean up client invites older than 90 days';

    public function handle()
    {
        $this->info('Cleaning up old client invites...');

        $deleted = DB::table('client_invites')
            ->where('created_at', '<', now()->subDays(90))
            ->delete();

        $this->info("Deleted {$deleted} old invite(s).");

        Log::info("CleanupOldInvites: Deleted {$deleted} invite(s)");

        return 0;
    }
}