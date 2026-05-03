@extends('layouts.app')

@section('title', 'Settings - XenonOS')

@section('content')
<div class="space-y-8 max-w-2xl">
    <!-- Header -->
    <section>
        <h2 class="text-4xl font-light font-headline tracking-tight text-white">Settings</h2>
        <p class="text-sm text-on-surface-variant mt-2">Configure your preferences</p>
    </section>

    <!-- Appearance -->
    <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
        <h3 class="text-lg font-semibold text-white mb-4">Appearance</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Dark Mode</p>
                    <p class="text-xs text-on-surface-variant">Always on for Nocturnal Precision theme</p>
                </div>
                <div class="w-12 h-7 bg-primary rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-sm">check</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Settings -->
    <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
        <h3 class="text-lg font-semibold text-white mb-4">Notifications</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Email Notifications</p>
                    <p class="text-xs text-on-surface-variant">Receive updates via email</p>
                </div>
                <button class="w-12 h-7 bg-surface-container-high rounded-full flex items-center px-1 cursor-pointer" onclick="this.classList.toggle('bg-primary'); this.classList.toggle('bg-surface-container-high'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                    <span class="w-5 h-5 bg-white rounded-full shadow transform transition-transform translate-x-0"></span>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Push Notifications</p>
                    <p class="text-xs text-on-surface-variant">Receive browser notifications</p>
                </div>
                <button class="w-12 h-7 bg-surface-container-high rounded-full flex items-center px-1 cursor-pointer" onclick="this.classList.toggle('bg-primary'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                    <span class="w-5 h-5 bg-white rounded-full shadow transform transition-transform translate-x-0"></span>
                </button>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Task Reminders</p>
                    <p class="text-xs text-on-surface-variant">Get reminded about upcoming tasks</p>
                </div>
                <button class="w-12 h-7 bg-primary rounded-full flex items-center justify-end px-1 cursor-pointer" onclick="this.classList.toggle('bg-primary'); this.classList.toggle('bg-surface-container-high'); this.querySelector('span').classList.toggle('translate-x-5'); this.querySelector('span').classList.toggle('translate-x-0');">
                    <span class="w-5 h-5 bg-white rounded-full shadow transform transition-transform translate-x-5"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Session Settings -->
    <div class="bg-surface-container rounded-2xl p-6 border border-white/5">
        <h3 class="text-lg font-semibold text-white mb-4">Session & Security</h3>
        
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Remember Device</p>
                    <p class="text-xs text-on-surface-variant">Stay logged in for 30 days</p>
                </div>
                <div class="w-12 h-7 bg-primary rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-sm">check</span>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-on-surface">Two-Factor Auth</p>
                    <p class="text-xs text-on-surface-variant">Add an extra layer of security</p>
                </div>
                <button class="px-3 py-1.5 bg-surface-container-high hover:bg-surface-bright text-xs text-on-surface rounded-lg transition-all">
                    Setup
                </button>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="bg-surface-container rounded-2xl p-6 border border-rose-500/20">
        <h3 class="text-lg font-semibold text-rose-400 mb-4">Danger Zone</h3>
        
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-on-surface">Delete Account</p>
                <p class="text-xs text-on-surface-variant">Permanently delete your account and data</p>
            </div>
            <button class="px-4 py-2 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-sm rounded-lg transition-all">
                Delete
            </button>
        </div>
    </div>
</div>
@endsection