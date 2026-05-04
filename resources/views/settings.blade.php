@extends('layouts.app')

@section('title', 'Settings - XenonOS')

@section('content')
@php
$user = Auth::user();
$sessions = $sessions ?? collect();
$securityLogs = $securityLogs ?? collect();
$timezone = $user->timezone ?? 'UTC';
$dateFormat = $user->date_format ?? 'dd-mm-yyyy';
$emailNotifications = $user->email_notifications ?? true;
$pushNotifications = $user->push_notifications ?? true;
$marketingEmails = $user->marketing_emails ?? true;
$surveyInvites = $user->survey_invites ?? false;
$quietHoursStart = $user->quiet_hours_start ?? '22:00';
$quietHoursEnd = $user->quiet_hours_end ?? '08:00';
@endphp
<div class="space-y-8 md:space-y-10 lg:space-y-12">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-6">
        <div>
            <p class="text-primary font-bold tracking-[0.2em] text-[11px] uppercase mb-2">System Configuration</p>
            <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-light tracking-tight text-on-surface">Settings</h2>
        </div>
        <p class="text-on-surface-variant text-xs sm:text-sm max-w-xs text-right md:text-left italic font-light opacity-60">Manage your account, security, and system preferences.</p>
    </section>

    <nav class="flex flex-wrap gap-2 sm:gap-3 border-b border-white/5 pb-1" role="tablist" aria-label="Settings navigation">
        <button onclick="switchTab('security')" id="tab-security" class="settings-tab-btn active px-4 sm:px-5 py-2.5 text-xs sm:text-[10px] font-bold uppercase tracking-[0.2em] rounded-t-xl transition-all text-on-surface-variant hover:text-on-surface" role="tab" aria-selected="true" aria-controls="panel-security">Security</button>
        <button onclick="switchTab('notifications')" id="tab-notifications" class="settings-tab-btn px-4 sm:px-5 py-2.5 text-xs sm:text-[10px] font-bold uppercase tracking-[0.2em] rounded-t-xl transition-all text-on-surface-variant hover:text-on-surface" role="tab" aria-selected="false" aria-controls="panel-notifications">Notifications</button>
        <button onclick="switchTab('preferences')" id="tab-preferences" class="settings-tab-btn px-4 sm:px-5 py-2.5 text-xs sm:text-[10px] font-bold uppercase tracking-[0.2em] rounded-t-xl transition-all text-on-surface-variant hover:text-on-surface" role="tab" aria-selected="false" aria-controls="panel-preferences">Preferences</button>
        <button onclick="switchTab('privacy')" id="tab-privacy" class="settings-tab-btn px-4 sm:px-5 py-2.5 text-xs sm:text-[10px] font-bold uppercase tracking-[0.2em] rounded-t-xl transition-all text-on-surface-variant hover:text-on-surface" role="tab" aria-selected="false" aria-controls="panel-privacy">Privacy & Data</button>
        <button onclick="switchTab('advanced')" id="tab-advanced" class="settings-tab-btn px-4 sm:px-5 py-2.5 text-xs sm:text-[10px] font-bold uppercase tracking-[0.2em] rounded-t-xl transition-all text-on-surface-variant hover:text-on-surface" role="tab" aria-selected="false" aria-controls="panel-advanced">Advanced</button>
    </nav>

    <div id="panel-security" class="settings-content" role="tabpanel" aria-labelledby="tab-security">
        <div class="space-y-6 sm:space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-surface-container/50 border border-white/5 rounded-2xl p-5 sm:p-6 flex items-center gap-4 sm:gap-5">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-surface-container-high text-on-surface flex items-center justify-center shadow-xl border border-white/5">
                        <span class="material-symbols-outlined">devices</span>
                    </div>
                    <div>
                        <p class="text-lg sm:text-xl font-bold text-on-surface font-headline">{{ $sessions->count() }} Devices</p>
                        <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">Active sessions</p>
                    </div>
                </div>
                <div class="bg-surface-container/50 border border-white/5 rounded-2xl p-5 sm:p-6 flex items-center gap-4 sm:gap-5">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-surface-container-high text-emerald-400 flex items-center justify-center shadow-xl border border-white/5">
                        <span class="material-symbols-outlined">shield</span>
                    </div>
                    <div>
                        <p class="text-lg sm:text-xl font-bold text-on-surface font-headline">{{ $user->two_factor_secret ? '2FA Enabled' : '2FA Disabled' }}</p>
                        <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">Authenticator app</p>
                    </div>
                </div>
                <div class="bg-surface-container/50 border border-white/5 rounded-2xl p-5 sm:p-6 flex items-center gap-4 sm:gap-5 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/[0.05] to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-surface-container-high text-emerald-400 flex items-center justify-center shadow-xl border border-emerald-400/20 z-10">
                        <span class="material-symbols-outlined">lock</span>
                    </div>
                    <div class="z-10">
                        <p class="text-lg sm:text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400 font-headline">Score: {{ $user->security_score ?? 98 }}%</p>
                        <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">Top protection</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
                <section class="col-span-1 lg:col-span-5 bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                        <span class="material-symbols-outlined text-primary">key</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Change Password</h3>
                    </div>
                    <form action="{{ route('settings.password') }}" method="POST" class="space-y-4 sm:space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="space-y-2">
                            <label for="current_password" class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">Current Password</label>
                            <input id="current_password" name="current_password" type="password" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/40 transition-all min-h-[44px]" placeholder="••••••••" required minlength="8" />
                        </div>
                        <div class="space-y-2">
                            <label for="new_password" class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">New Password</label>
                            <input id="new_password" name="new_password" type="password" onkeyup="checkPasswordStrength(this.value)" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/40 transition-all min-h-[44px]" placeholder="••••••••" required minlength="8" />
                            <div class="pt-2" id="password-strength-container" style="display: none;">
                                <div class="h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                    <div id="password-strength-bar" class="h-full bg-gradient-to-r from-primary to-primary-container transition-all duration-300 shadow-[0_0_8px_rgba(192,193,255,0.4)]" style="width: 0%"></div>
                                </div>
                                <p class="text-[11px] mt-1.5 flex justify-between">
                                    <span id="password-strength-text">Password Strength</span>
                                    <span id="password-strength-percent">0%</span>
                                </p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="new_password_confirmation" class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">Confirm New Password</label>
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm focus:ring-1 focus:ring-primary/40 transition-all min-h-[44px]" placeholder="••••••••" required minlength="8" />
                        </div>
                        <button type="submit" class="w-full p-3 bg-primary text-on-primary rounded-xl font-bold text-sm tracking-wide hover:opacity-90 transition-opacity active:scale-[0.98] mt-4 min-h-[44px]">Update Password</button>
                    </form>
                </section>

                <div class="col-span-1 lg:col-span-7 space-y-4 sm:space-y-6">
                    <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                        <div class="flex items-center gap-2 sm:gap-3 mb-6">
                            <span class="material-symbols-outlined text-primary">verified_user</span>
                            <h3 class="font-headline text-lg sm:text-xl font-semibold">Two-Factor Authentication</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="p-4 sm:p-5 bg-surface-container-low rounded-xl sm:rounded-2xl flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined">smartphone</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm">Authenticator App</p>
                                        <p class="text-[9px] text-primary font-bold uppercase tracking-widest mt-0.5">Recommended</p>
                                    </div>
                                </div>
                                <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active" aria-label="Enable Authenticator App"></div>
                            </div>
                            <div class="p-4 sm:p-5 bg-surface-container-low rounded-xl sm:rounded-2xl flex items-center justify-between gap-3 opacity-70">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                                        <span class="material-symbols-outlined">sms</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm">SMS Authentication</p>
                                        <p class="text-[9px] text-on-surface-variant font-bold uppercase tracking-widest mt-0.5">+1 (555) ••• 42</p>
                                    </div>
                                </div>
                                <div role="switch" aria-checked="false" tabindex="0" class="toggle-switch inactive" aria-label="Enable SMS Authentication"></div>
                            </div>
                        </div>
                    </section>

                    <section class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                        <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                            <span class="material-symbols-outlined text-tertiary">policy</span>
                            <h3 class="font-headline text-lg sm:text-xl font-semibold">Authentication Rules</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                            <div class="p-4 sm:p-5 bg-surface-container rounded-xl sm:rounded-2xl flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-sm mb-1">Complex Passwords</p>
                                    <p class="text-xs text-on-surface-variant leading-relaxed">Require symbols and numbers.</p>
                                </div>
                                <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active" aria-label="Enable complex password requirement"></div>
                            </div>
                            <div class="p-4 sm:p-5 bg-surface-container rounded-xl sm:rounded-2xl flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-sm mb-1">2FA Enforcement</p>
                                    <p class="text-xs text-on-surface-variant leading-relaxed">Required for all team members.</p>
                                </div>
                                <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active" aria-label="Enable 2FA enforcement"></div>
                            </div>
                            <div class="p-4 sm:p-5 bg-surface-container rounded-xl sm:rounded-2xl flex items-start justify-between gap-3 md:col-span-2">
                                <div>
                                    <p class="font-semibold text-sm mb-1">Sensitive Action Re-Auth</p>
                                    <p class="text-xs text-on-surface-variant leading-relaxed">Request password before critical actions.</p>
                                </div>
                                <div role="switch" aria-checked="false" tabindex="0" class="toggle-switch inactive" aria-label="Enable sensitive action re-authentication"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-0 mb-4 sm:mb-6">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <span class="material-symbols-outlined text-primary">devices</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Active Sessions</h3>
                    </div>
                    <span class="px-2 sm:px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-tighter whitespace-nowrap text-center">{{ $sessions->count() }} Active</span>
                </div>
                <div class="space-y-2 sm:space-y-3">
                    @forelse($sessions as $session)
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-3 sm:p-4 hover:bg-surface-bright/30 rounded-xl sm:rounded-2xl transition-all group">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary group-hover:scale-110 transition-transform shrink-0">
                                <span class="material-symbols-outlined">{{ str_contains($session->user_agent ?? '', 'Mobile') ? 'phone_iphone' : 'computer' }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ str_contains($session->user_agent ?? '', 'Mobile') ? 'Mobile Device' : 'Desktop' }}</p>
                                <p class="text-[11px] text-on-surface-variant">{{ $session->ip_address ?? 'Unknown' }} • {{ $session->last_activity ? \Carbon\Carbon::parse($session->last_activity)->diffForHumans() : 'Active now' }}</p>
                            </div>
                        </div>
                        <form action="{{ route('settings.logoutSession', $session->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-[11px] font-bold text-rose-400 uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity min-h-[44px] min-w-[44px] flex items-center justify-center">Force Logout</button>
                        </form>
                    </div>
                    @empty
                    <p class="text-on-surface-variant text-sm">No active sessions</p>
                    @endforelse
                </div>
            </section>

            <section class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 sm:p-5 md:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4 mb-4 sm:mb-5">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-2xl">history</span>
                        <h3 class="font-headline text-base sm:text-lg font-semibold">Audit Activity Logs</h3>
                    </div>
                </div>
                <div class="overflow-x-auto no-scrollbar">
                    <table class="w-full text-left border-separate border-spacing-y-1.5 min-w-[600px]" role="table">
                        <thead>
                            <tr class="text-[9px] text-on-surface-variant font-bold uppercase tracking-widest px-3">
                                <th scope="col" class="pb-3 pl-3 whitespace-nowrap">Timestamp</th>
                                <th scope="col" class="pb-3 whitespace-nowrap">Action</th>
                                <th scope="col" class="pb-3 whitespace-nowrap">Details</th>
                                <th scope="col" class="pb-3 text-right pr-3 whitespace-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            @forelse($securityLogs as $log)
                            <tr class="group">
                                <td scope="row" class="bg-surface-container first:rounded-l-xl py-2.5 sm:py-3 pl-3 text-on-surface-variant font-mono text-[10px] whitespace-nowrap">
                                    {{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('M d, H:i') : 'N/A' }}
                                </td>
                                <td class="bg-surface-container font-medium whitespace-nowrap">
                                    <span class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-primary text-base">{{ $log->action ?? 'info' }}</span>
                                        <span class="hidden sm:inline">{{ ucfirst($log->action ?? 'Unknown') }}</span>
                                    </span>
                                </td>
                                <td class="bg-surface-container text-on-surface-variant truncate max-w-[120px] sm:max-w-none">{{ $log->details ?? 'N/A' }}</td>
                                <td class="bg-surface-container last:rounded-r-xl text-right pr-3 whitespace-nowrap">
                                    <span class="px-1.5 py-0.5 rounded bg-emerald-400/10 text-emerald-400 text-[9px] font-bold">{{ $log->status ?? 'SUCCESS' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="bg-surface-container first:rounded-l-xl last:rounded-r-xl py-4 text-center text-on-surface-variant">No activity logs</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <div id="panel-notifications" class="settings-content hidden" role="tabpanel" aria-labelledby="tab-notifications">
        <div class="space-y-6 sm:space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                        <span class="material-symbols-outlined text-primary">notifications</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Global Activities</h3>
                    </div>
                    <form action="{{ route('settings.preferences') }}" method="POST" class="space-y-4 sm:space-y-6">
                        @csrf
                        <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low hover:bg-surface-bright/30 transition-all">
                            <div class="space-y-1">
                                <p class="text-sm font-bold font-headline">Project Updates</p>
                                <p class="text-xs text-on-surface-variant">Receive alerts for new milestones and tasks.</p>
                            </div>
                            <input type="checkbox" name="email_notifications" {{ $emailNotifications ? 'checked' : '' }} class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low hover:bg-surface-bright/30 transition-all">
                            <div class="space-y-1">
                                <p class="text-sm font-bold font-headline">File Uploads</p>
                                <p class="text-xs text-on-surface-variant">Notify when a client uploads new assets.</p>
                            </div>
                            <input type="checkbox" name="push_notifications" {{ $pushNotifications ? 'checked' : '' }} class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low hover:bg-surface-bright/30 transition-all opacity-70">
                            <div class="space-y-1">
                                <p class="text-sm font-bold font-headline">Billing Alerts</p>
                                <p class="text-xs text-on-surface-variant">Status of invoices and payment confirmations.</p>
                            </div>
                            <input type="checkbox" name="billing_alerts" checked class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                        </div>
                        <button type="submit" class="w-full p-3 bg-primary text-on-primary rounded-xl font-bold text-sm tracking-wide hover:opacity-90 transition-opacity mt-4 min-h-[44px]">Save Preferences</button>
                    </form>
                </section>

                <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                        <span class="material-symbols-outlined text-primary">chat</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Chat Channels</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach(['#general', '#design', '#dev'] as $channel)
                        <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low border border-primary/20">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-primary shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                                <span class="text-sm font-bold">{{ $channel }}</span>
                            </div>
                            <input type="checkbox" checked class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden group hover:border-primary/30 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/[0.02] to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8 relative z-10">
                    <span class="material-symbols-outlined text-primary">nightlight</span>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold">Quiet Hours / DND</h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 relative z-10">
                    <div class="lg:col-span-1">
                        <p class="text-sm text-on-surface leading-relaxed font-medium">Mute all push notifications during your focus time. System alerts will still be archived in your activity feed.</p>
                    </div>
                    <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">Start Time</label>
                            <div class="flex items-center gap-4 p-4 sm:p-5 rounded-xl sm:rounded-2xl bg-surface-container-low shadow-inner">
                                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-primary shadow-xl">
                                    <span class="material-symbols-outlined">schedule</span>
                                </div>
                                <span class="text-lg sm:text-xl font-bold font-headline">{{ $quietHoursStart }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">End Time</label>
                            <div class="flex items-center gap-4 p-4 sm:p-5 rounded-xl sm:rounded-2xl bg-surface-container-low shadow-inner">
                                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-tertiary shadow-xl">
                                    <span class="material-symbols-outlined">light_mode</span>
                                </div>
                                <span class="text-lg sm:text-xl font-bold font-headline">{{ $quietHoursEnd }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                    <span class="material-symbols-outlined text-primary">grid_view</span>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold">Notification Matrix</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[500px]">
                        <thead>
                            <tr class="text-[9px] text-on-surface-variant font-bold uppercase tracking-widest">
                                <th class="pb-3 pl-3">Event Type</th>
                                <th class="pb-3 text-center">In-App</th>
                                <th class="pb-3 text-center">Email</th>
                                <th class="pb-3 text-center pr-3">Push</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs space-y-2">
                            <tr class="group">
                                <td class="bg-surface-container-low first:rounded-l-xl py-3 pl-3 font-medium">Project Updates</td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="In-app project updates"></div>
                                </td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="Email project updates"></div>
                                </td>
                                <td class="bg-surface-container-low last:rounded-r-xl text-center pr-3">
                                    <div role="switch" aria-checked="false" tabindex="0" class="toggle-switch inactive inline-flex" aria-label="Push project updates"></div>
                                </td>
                            </tr>
                            <tr class="group">
                                <td class="bg-surface-container-low first:rounded-l-xl py-3 pl-3 font-medium">File Uploads</td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="In-app file uploads"></div>
                                </td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="false" tabindex="0" class="toggle-switch inactive inline-flex" aria-label="Email file uploads"></div>
                                </td>
                                <td class="bg-surface-container-low last:rounded-r-xl text-center pr-3">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="Push file uploads"></div>
                                </td>
                            </tr>
                            <tr class="group">
                                <td class="bg-surface-container-low first:rounded-l-xl py-3 pl-3 font-medium">Billing Alerts</td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="In-app billing alerts"></div>
                                </td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="Email billing alerts"></div>
                                </td>
                                <td class="bg-surface-container-low last:rounded-r-xl text-center pr-3">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="Push billing alerts"></div>
                                </td>
                            </tr>
                            <tr class="group">
                                <td class="bg-surface-container-low first:rounded-l-xl py-3 pl-3 font-medium">Team Mentions</td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="In-app team mentions"></div>
                                </td>
                                <td class="bg-surface-container-low text-center">
                                    <div role="switch" aria-checked="false" tabindex="0" class="toggle-switch inactive inline-flex" aria-label="Email team mentions"></div>
                                </td>
                                <td class="bg-surface-container-low last:rounded-r-xl text-center pr-3">
                                    <div role="switch" aria-checked="true" tabindex="0" class="toggle-switch active inline-flex" aria-label="Push team mentions"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <div id="panel-preferences" class="settings-content hidden" role="tabpanel" aria-labelledby="tab-preferences">
        <div class="space-y-6 sm:space-y-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <section class="col-span-1 lg:col-span-2 bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                        <span class="material-symbols-outlined text-primary">language</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Localization</h3>
                    </div>
                    <form action="{{ route('settings.preferences') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                        @csrf
                        <div class="space-y-2">
                            <label for="timezone" class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">Time Zone</label>
                            <div class="relative group">
                                <select id="timezone" name="timezone" class="w-full bg-surface-container-low border border-white/5 rounded-xl px-4 py-3 text-sm appearance-none focus:outline-none focus:ring-1 focus:ring-primary/40 transition-all cursor-pointer min-h-[44px]">
                                    <option value="London" {{ $timezone == 'London' ? 'selected' : '' }}>London (UTC+00:00)</option>
                                    <option value="NewYork" {{ $timezone == 'NewYork' ? 'selected' : '' }}>New York (UTC-5)</option>
                                    <option value="Paris" {{ $timezone == 'Paris' ? 'selected' : '' }}>Paris (UTC+01:00)</option>
                                    <option value="Japan" {{ $timezone == 'Japan' ? 'selected' : '' }}>Japan (UTC+09:00)</option>
                                    <option value="Beijing" {{ $timezone == 'Beijing' ? 'selected' : '' }}>Beijing (UTC+08:00)</option>
                                    <option value="India" {{ $timezone == 'India' ? 'selected' : '' }}>India (UTC+05:30)</option>
                                    <option value="Bangladesh" {{ $timezone == 'Bangladesh' ? 'selected' : '' }}>Bangladesh (UTC+06:00)</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest pl-1 block">Date Format</label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low border {{ $dateFormat == 'dd-mm-yyyy' ? 'border-primary/30' : 'border-white/5' }} cursor-pointer hover:border-primary/50 transition-all group shadow-inner">
                                    <input type="radio" name="date_format" value="dd-mm-yyyy" {{ $dateFormat == 'dd-mm-yyyy' ? 'checked' : '' }} class="custom-radio appearance-none w-5 h-5 border-2 border-primary rounded-full flex items-center justify-center shrink-0" />
                                    <div class="flex flex-col sm:flex-row sm:items-center w-full justify-between">
                                        <span class="text-sm font-bold tracking-wide">DD/MM/YYYY</span>
                                        <span class="text-[9px] text-primary uppercase tracking-widest font-bold">(International)</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-4 p-4 rounded-xl bg-surface-container-low border border-white/5 cursor-pointer hover:border-on-surface-variant/30 transition-all group opacity-70 hover:opacity-100">
                                    <input type="radio" name="date_format" value="mm-dd-yyyy" {{ $dateFormat == 'mm-dd-yyyy' ? 'checked' : '' }} class="custom-radio appearance-none w-5 h-5 border-2 border-on-surface-variant rounded-full flex items-center justify-center shrink-0" />
                                    <div class="flex flex-col sm:flex-row sm:items-center w-full justify-between">
                                        <span class="text-sm font-bold tracking-wide">MM/DD/YYYY</span>
                                        <span class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold">(US Standard)</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="col-span-1 md:col-span-2 w-full p-3 bg-primary text-on-primary rounded-xl font-bold text-sm tracking-wide hover:opacity-90 transition-opacity mt-4 min-h-[44px]">Save Preferences</button>
                    </form>
                </section>

                <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary/[0.05] to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="flex items-center gap-2 sm:gap-3 mb-4 relative z-10">
                        <span class="material-symbols-outlined text-primary">bolt</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Account Metadata</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-6 relative z-10">System-generated audit data for this workspace identity node.</p>
                    <div class="p-5 sm:p-6 rounded-xl sm:rounded-2xl bg-surface-container-low border border-white/5 space-y-4 relative z-10 shadow-inner">
                        <div class="flex flex-col gap-1">
                            <p class="text-[9px] uppercase tracking-widest text-primary font-bold">Account Created</p>
                            <p class="text-sm font-bold tracking-wide">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-[9px] uppercase tracking-widest text-primary font-bold">User ID</p>
                            <p class="text-sm font-bold font-mono tracking-widest">{{ $user->id }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-[9px] uppercase tracking-widest text-primary font-bold">Email</p>
                            <p class="text-sm font-bold tracking-wide">{{ $user->email }}</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <section class="col-span-1 lg:col-span-2 bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-64 h-64 bg-primary/5 rounded-full blur-[80px] group-hover:bg-primary/10 transition-colors duration-700 pointer-events-none"></div>
                    <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8 relative z-10">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">System Info</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 relative z-10">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <p class="text-[9px] uppercase tracking-widest text-on-surface-variant font-bold">App Version</p>
                                <p class="text-2xl font-bold font-mono tracking-wider">v{{ config('app.version', '2.4.12') }}-stable</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[9px] uppercase tracking-widest text-on-surface-variant font-bold">Build ID</p>
                                <p class="text-2xl font-bold text-emerald-400 font-mono tracking-wider">0x{{ substr(config('app.key'), 0, 8) }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold">Communication Options</h3>
                </div>
                <form action="{{ route('settings.preferences') }}" method="POST" class="space-y-4 sm:space-y-6">
                    @csrf
                    <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low hover:bg-surface-bright/30 transition-all">
                        <div class="space-y-1">
                            <p class="text-sm font-bold font-headline">Email Marketing</p>
                            <p class="text-xs text-on-surface-variant">Receive updates about new features and ecosystem news.</p>
                        </div>
                        <input type="checkbox" name="marketing_emails" {{ $marketingEmails ? 'checked' : '' }} class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                    </div>
                    <div class="flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low hover:bg-surface-bright/30 transition-all opacity-70">
                        <div class="space-y-1">
                            <p class="text-sm font-bold font-headline">Product Surveys</p>
                            <p class="text-xs text-on-surface-variant">Invites to help us shape the future of the platform.</p>
                        </div>
                        <input type="checkbox" name="survey_invites" {{ $surveyInvites ? 'checked' : '' }} class="toggle-switch active w-11 h-6 rounded-full cursor-pointer" />
                    </div>
                    <button type="submit" class="w-full p-3 bg-primary text-on-primary rounded-xl font-bold text-sm tracking-wide hover:opacity-90 transition-opacity mt-4 min-h-[44px]">Save Preferences</button>
                </form>
            </section>
        </div>
    </div>

    <div id="panel-privacy" class="settings-content hidden" role="tabpanel" aria-labelledby="tab-privacy">
        <div class="space-y-6 sm:space-y-8">
            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/[0.03] to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6 relative z-10">
                    <span class="material-symbols-outlined text-primary">security</span>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold">GDPR & Regulatory Compliance</h3>
                </div>
                <p class="text-sm text-on-surface leading-relaxed relative z-10 mb-6">Our platform is fully compliant with the General Data Protection Regulation (GDPR). Your data is strictly encrypted at rest and in transit. You have the right to access, rectify, or erase your personal data footprint at any time. We do not sell your data to any third parties whatsoever.</p>
                <button class="text-xs font-bold text-primary uppercase tracking-widest flex items-center gap-2 transition-colors relative z-10 bg-surface-container-high/50 hover:bg-surface-container-high px-6 py-3 rounded-xl border border-white/5 shadow-inner">
                    Read Complete Privacy Policy
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </button>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">download</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Data Export</h3>
                    </div>
                    <p class="text-xs text-on-surface-variant mb-6 leading-relaxed">Download a compiled local copy of your account activity, project history, and billing records for your personal archives.</p>
                    <div class="space-y-3 sm:space-y-4 mb-6">
                        <button class="w-full flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low border border-white/5 hover:border-primary/50 hover:bg-surface-container transition-all group shadow-inner">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant group-hover:text-primary shadow-xl transition-colors">
                                    <span class="material-symbols-outlined">description</span>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold font-headline">Export as PDF</p>
                                    <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">Optimized for reading</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">download</span>
                        </button>
                        <button class="w-full flex items-center justify-between p-4 rounded-xl sm:rounded-2xl bg-surface-container-low border border-white/5 hover:border-primary/50 hover:bg-surface-container transition-all group shadow-inner">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant group-hover:text-tertiary shadow-xl transition-colors">
                                    <span class="font-mono text-base font-bold">{'{ }'}</span>
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-bold font-headline">Export as JSON</p>
                                    <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">Optimized for dev teams</p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-tertiary transition-colors">download</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <p class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold w-full text-center">Last Export: <span class="font-mono">14 days ago</span></p>
                    </div>
                </section>

                <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8">
                    <div class="flex items-center gap-2 sm:gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">devices</span>
                        <h3 class="font-headline text-lg sm:text-xl font-semibold">Connected Devices</h3>
                    </div>
                    <div class="space-y-3">
                        @forelse($sessions as $index => $session)
                        <div class="flex items-center justify-between p-4 rounded-xl bg-surface-container-low {{ $index === 0 ? 'border border-primary/20' : 'border border-white/5' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center {{ $index === 0 ? 'text-primary' : 'text-on-surface-variant' }}">
                                    <span class="material-symbols-outlined">{{ str_contains($session->user_agent ?? '', 'Mobile') ? 'phone_iphone' : 'laptop_mac' }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold">{{ str_contains($session->user_agent ?? '', 'Mobile') ? 'Mobile Device' : 'Desktop' }}</p>
                                    <p class="text-[10px] text-on-surface-variant">{{ $session->ip_address ?? 'Unknown' }} • {{ $session->last_activity ? \Carbon\Carbon::parse($session->last_activity)->diffForHumans() : 'Active now' }}</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 rounded {{ $index === 0 ? 'bg-primary/10 text-primary' : 'bg-surface-container text-on-surface-variant' }} text-[9px] font-bold uppercase tracking-widest">{{ $index === 0 ? 'Active' : 'Inactive' }}</span>
                        </div>
                        @empty
                        <p class="text-on-surface-variant text-sm">No connected devices</p>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div id="panel-advanced" class="settings-content hidden" role="tabpanel" aria-labelledby="tab-advanced">
        <div class="space-y-6 sm:space-y-8">
            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 border border-amber-400/20 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-amber-400/[0.03] pointer-events-none"></div>
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 sm:gap-6 relative z-10">
                    <div class="space-y-2">
                        <h3 class="text-xl sm:text-2xl font-bold text-amber-400 font-headline">Advanced Cache Management</h3>
                        <p class="text-sm text-on-surface leading-relaxed max-w-2xl">Purge all locally cached data, temporary files, and stale workspace states. This action will force a complete re-sync on next reload and may temporarily impact performance.</p>
                    </div>
                    <button class="px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl bg-amber-400/10 border border-amber-400/20 text-amber-400 hover:bg-amber-400 hover:text-surface transition-all font-bold text-[10px] uppercase tracking-widest whitespace-nowrap shrink-0">Purge Cache</button>
                </div>
            </section>

            <section class="bg-surface-container rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 border border-rose-400/20 shadow-[0_0_20px_rgba(239,68,68,0.05)] relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-rose-400/[0.03] pointer-events-none"></div>
                <div class="flex items-center gap-2 sm:gap-3 mb-6 relative z-10">
                    <div class="p-2 rounded-lg bg-rose-400/10 border border-rose-400/20">
                        <span class="material-symbols-outlined text-rose-400">warning</span>
                    </div>
                    <h3 class="font-headline text-lg sm:text-xl font-semibold text-rose-400">Danger Zone</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 relative z-10">
                    <div class="space-y-4">
                        <p class="text-xs text-on-surface leading-relaxed">Permanently delete all workspace data, projects, files, and user accounts. This action is irreversible and will destroy all associated metadata.</p>
                        <button class="w-full px-6 py-3 rounded-xl bg-rose-400/10 border border-rose-400/20 text-rose-400 hover:bg-rose-400 hover:text-white transition-all font-bold text-[10px] uppercase tracking-widest">Delete Workspace</button>
                    </div>
                    <div class="space-y-4">
                        <p class="text-xs text-on-surface leading-relaxed">Permanently delete your account and all associated data across all workspaces. This action cannot be undone.</p>
                        <button class="w-full px-6 py-3 rounded-xl bg-rose-400/10 border border-rose-400/20 text-rose-400 hover:bg-rose-400 hover:text-white transition-all font-bold text-[10px] uppercase tracking-widest">Delete Account</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<style>
.settings-tab-btn.active { @apply bg-surface-container text-on-surface; }
.toggle-switch { @apply w-11 h-6 rounded-full cursor-pointer transition-all duration-200 relative; }
.toggle-switch.active { @apply bg-emerald-400; }
.toggle-switch.inactive { @apply bg-surface-container-high; }
.toggle-switch::after { content: ''; @apply absolute w-5 h-5 bg-white rounded-full top-0.5 left-0.5 transition-transform duration-200; }
.toggle-switch.active::after { @apply translate-x-5; }
.toggle-switch.inactive::after { @apply translate-x-0; }
</style>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.settings-content').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.settings-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + tabId).classList.remove('hidden');
    document.getElementById('panel-' + tabId).setAttribute('aria-selected', 'true');
    document.getElementById('tab-' + tabId).classList.add('active');
    document.getElementById('tab-' + tabId).setAttribute('aria-selected', 'true');
}

function checkPasswordStrength(password) {
    let strength = 0;
    let text = 'Weak';
    let colorClass = 'text-rose-400';
    let barColor = 'bg-rose-400';
    
    if (password.length >= 8) strength += 25;
    if (password.length >= 12) strength += 10;
    if (/[a-z]/.test(password)) strength += 15;
    if (/[A-Z]/.test(password)) strength += 15;
    if (/[0-9]/.test(password)) strength += 15;
    if (/[^a-zA-Z0-9]/.test(password)) strength += 20;
    
    if (strength >= 80) { text = 'Very Strong'; colorClass = 'text-emerald-400'; barColor = 'bg-emerald-400'; }
    else if (strength >= 60) { text = 'Strong'; colorClass = 'text-emerald-400'; barColor = 'bg-emerald-400'; }
    else if (strength >= 40) { text = 'Medium'; colorClass = 'text-amber-400'; barColor = 'bg-amber-400'; }
    else if (strength >= 20) { text = 'Weak'; colorClass = 'text-rose-400'; barColor = 'bg-rose-400'; }
    
    const container = document.getElementById('password-strength-container');
    const bar = document.getElementById('password-strength-bar');
    const textEl = document.getElementById('password-strength-text');
    const percentEl = document.getElementById('password-strength-percent');
    
    if (password.length > 0) {
        container.style.display = 'block';
        bar.style.width = strength + '%';
        bar.className = 'h-full transition-all duration-300 shadow-[0_0_8px_rgba(192,193,255,0.4)] ' + barColor;
        textEl.className = colorClass + ' text-[11px]';
        textEl.textContent = text;
        percentEl.textContent = strength + '%';
    } else {
        container.style.display = 'none';
    }
}
</script>
@endsection