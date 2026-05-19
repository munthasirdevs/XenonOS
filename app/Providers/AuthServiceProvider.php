<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\File;
use App\Models\Chat;
use App\Models\Note;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Announcement;
use App\Models\ApiKey;
use App\Models\Subscription;
use App\Models\AlertRule;
use App\Policies\ClientPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\FilePolicy;
use App\Policies\ChatPolicy;
use App\Policies\NotePolicy;
use App\Policies\InvoicePolicy;
use App\Policies\PaymentPolicy;
use App\Policies\SettingPolicy;
use App\Policies\AnnouncementPolicy;
use App\Policies\ApiKeyPolicy;
use App\Policies\SubscriptionPolicy;
use App\Policies\AlertRulePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Client::class => ClientPolicy::class,
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        File::class => FilePolicy::class,
        Chat::class => ChatPolicy::class,
        Note::class => NotePolicy::class,
        Invoice::class => InvoicePolicy::class,
        Payment::class => PaymentPolicy::class,
        Setting::class => SettingPolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        ApiKey::class => ApiKeyPolicy::class,
        Subscription::class => SubscriptionPolicy::class,
        AlertRule::class => AlertRulePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}