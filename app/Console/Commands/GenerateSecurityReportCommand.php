<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SecurityLog;
use App\Models\Session;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;
use Carbon\Carbon;

class GenerateSecurityReportCommand extends Command
{
    protected $signature = 'report:security {--hours=8}';
    protected $description = 'Generate security report for the specified hours';

    public function handle()
    {
        $hours = $this->option('hours');
        $from = Carbon::now()->subHours($hours);
        
        $this->info("Generating security report for last {$hours} hours...");
        
        // Get successful logins
        $logins = SecurityLog::where('event', 'login_success')
            ->where('created_at', '>=', $from)
            ->count();
        
        // Get failed logins
        $failedLogins = SecurityLog::where('event', 'failed_login')
            ->where('created_at', '>=', $from)
            ->count();
        
        // Get anonymous attempts (no user_id)
        $anonymousAttempts = SecurityLog::where('event', 'failed_login')
            ->where('created_at', '>=', $from)
            ->whereNull('user_id')
            ->count();
        
        // Get unique users who logged in
        $uniqueLogins = SecurityLog::where('event', 'login_success')
            ->where('created_at', '>=', $from)
            ->distinct()
            ->count('user_id');
        
        // Get suspicious activities
        $suspicious = SecurityLog::where('event', 'suspicious_activity')
            ->where('created_at', '>=', $from)
            ->count();
        
        // Create report notification
        $reportTitle = "Security Report - Last {$hours} Hours";
        $reportMessage = "Logins: {$logins} | Failed: {$failedLogins} | Anonymous: {$anonymousAttempts} | Unique Users: {$uniqueLogins}";
        
        if ($suspicious > 0) {
            $reportMessage .= " | SUSPICIOUS: {$suspicious}";
        }
        
        // Create system notification
        $notification = Notification::create([
            'title' => $reportTitle,
            'message' => $reportMessage,
            'type' => 'security',
            'created_by' => 1,
        ]);
        
        // Send to admin (user_id 1)
        UserNotification::create([
            'user_id' => 1,
            'notification_id' => $notification->id,
        ]);
        
        $this->info("Security report generated:");
        $this->info("- Successful logins: {$logins}");
        $this->info("- Failed logins: {$failedLogins}");
        $this->info("- Anonymous attempts: {$anonymousAttempts}");
        $this->info("- Unique users: {$uniqueLogins}");
        $this->info("- Suspicious activities: {$suspicious}");
        
        return Command::SUCCESS;
    }
}