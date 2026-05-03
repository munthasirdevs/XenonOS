@extends('layouts.app')

@section('title', 'Profile - XenonOS')

@section('content')
<form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<!-- Profile Header -->
<div class="relative rounded-[2rem] overflow-hidden mb-8 bg-surface-container-low p-8 flex flex-col md:flex-row items-end gap-8">
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-primary/10 to-transparent"></div>
    <div class="relative group">
        <img alt="{{ auth()->user()->name }}" 
             class="w-32 h-32 rounded-3xl object-cover border-4 border-surface shadow-2xl relative z-10" 
             src="{{ auth()->user()?->profile?->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6366F1&color=fff&size=256' }}" />
        <label for="avatar" class="absolute -bottom-2 -right-2 z-20 w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-on-primary shadow-lg border-2 border-surface cursor-pointer">
            <span class="material-symbols-outlined text-lg">edit</span>
        </label>
        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
    </div>
    <div class="flex-1 pb-2">
        <div class="flex items-center gap-3 mb-1">
            <h2 class="syne text-4xl font-extrabold tracking-tighter text-white">{{ auth()->user()->name }}</h2>
            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest rounded-full border border-primary/20 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                {{ auth()->user()?->status ?: 'Active' }}
            </span>
        </div>
        <p class="outfit text-on-surface-variant text-lg">{{ auth()->user()->role }}</p>
    </div>
    <div class="flex gap-3 pb-2">
        <button type="button" class="px-6 py-2.5 rounded-xl bg-surface-container-highest border border-outline-variant/10 font-bold text-sm hover:bg-surface-variant transition-all">View Public Profile</button>
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-on-primary font-bold shadow-[0_0_20px_rgba(99,102,241,0.3)]">Save Changes</button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">

    <!-- Personal Info -->
    <div class="lg:col-span-7 bg-[#111827]/50 border border-white/5 rounded-3xl p-8 md:p-10 space-y-8 shadow-xl">
        <div class="flex items-center gap-3 text-[#6366F1] mb-2">
            <div class="w-12 h-12 rounded-2xl bg-[#6366F1]/10 flex items-center justify-center border border-[#6366F1]/20">
                <span class="material-symbols-outlined text-2xl">person</span>
            </div>
            <h3 class="text-2xl font-bold text-white tracking-tight font-headline">Personal Info</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">First Name</label>
                <input type="text" name="first_name" value="{{ explode(' ', auth()->user()->name)[0] }}" 
                       class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
            </div>
            <div class="space-y-2">
                <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Last Name</label>
                <input type="text" name="last_name" value="{{ implode(' ', array_slice(explode(' ', auth()->user()->name), 1)) }}" 
                       class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Email Address</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" 
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>

        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Phone Number</label>
            <input type="tel" name="phone" value="{{ auth()->user()?->profile?->phone ?: '' }}" placeholder="+1 (555) 123-4567"
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
    </div>

    <!-- Account Details -->
    <div class="lg:col-span-5 bg-[#111827]/50 border border-white/5 rounded-3xl p-8 md:p-10 space-y-8 shadow-xl flex flex-col">
        <div class="flex items-center gap-3 text-[#6366F1] mb-2">
            <div class="w-12 h-12 rounded-2xl bg-[#6366F1]/10 flex items-center justify-center border border-[#6366F1]/20">
                <span class="material-symbols-outlined text-2xl">info</span>
            </div>
            <h3 class="text-2xl font-bold text-white tracking-tight font-headline">Account Details</h3>
        </div>

        <div class="space-y-8 flex-grow">
            <div class="space-y-2">
                <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Username</label>
                <div class="bg-[#0B0F19] border border-white/5 rounded-xl px-5 py-4 text-white text-sm font-medium shadow-inner">
                    {{ str_replace('@', '', auth()->user()->email) }}
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">User ID</label>
                <div class="flex items-center justify-between bg-[#0B0F19] border border-white/5 rounded-xl px-5 py-4 text-white text-sm font-bold shadow-inner">
                    <span class="text-[#6366F1]">#XEN-{{ str_pad(auth()->user()->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <button type="button" class="text-slate-500 hover:text-white transition-colors p-1" title="Copy ID">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                    </button>
                </div>
            </div>

            <div class="space-y-4 pt-4 mt-auto">
                <div class="flex justify-between items-end">
                    <p class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Profile Completion</p>
                    <p class="text-xs font-bold text-[#6366F1]">{{ $completion }}%</p>
                </div>
                <div class="h-2.5 w-full bg-[#0B0F19] rounded-full overflow-hidden p-[1px] border border-white/5 shadow-inner">
                    <div class="h-full bg-gradient-to-r from-[#6366F1] to-[#818cf8] rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)] relative overflow-hidden" 
                         style="width: {{ $completion }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Professional Summary -->
<div class="bg-surface-container rounded-[1.5rem] p-8 mb-8">
    <h3 class="syne text-xl font-bold mb-6 flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">description</span>
        Professional Summary
    </h3>
    <textarea name="bio" aria-label="Write your professional summary"
        class="w-full bg-[#1F2937] border-none rounded-xl p-4 text-on-surface-variant leading-relaxed focus:ring-1 focus:ring-primary/40 h-32 resize-none"
        placeholder="Write a short bio...">{{ auth()->user()?->profile?->bio ?: '' }}</textarea>
</div>

<!-- Billing Address -->
<div class="bg-[#111827]/50 border border-white/5 rounded-3xl p-8 md:p-10 space-y-10 shadow-xl mb-8">
    <div class="flex items-center gap-3 text-[#6366F1] mb-2">
        <div class="w-12 h-12 rounded-2xl bg-[#6366F1]/10 flex items-center justify-center border border-[#6366F1]/20">
            <span class="material-symbols-outlined text-2xl">credit_card</span>
        </div>
        <h3 class="text-2xl font-bold text-white tracking-tight font-headline">Billing Address</h3>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Company Name</label>
            <input type="text" name="company" value="{{ auth()->user()?->profile?->company ?: '' }}" placeholder="Optional"
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Payment Method</label>
            <select name="payment_method"
                    class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all appearance-none cursor-pointer">
                <option value="">Select payment method</option>
                <option value="visa" {{ (auth()->user()?->profile?->payment_method ?? '') === 'visa' ? 'selected' : '' }}>Visa</option>
                <option value="mastercard" {{ (auth()->user()?->profile?->payment_method ?? '') === 'mastercard' ? 'selected' : '' }}>Mastercard</option>
                <option value="paypal" {{ (auth()->user()?->profile?->payment_method ?? '') === 'paypal' ? 'selected' : '' }}>PayPal</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Address 1</label>
            <input type="text" name="address1" value="{{ auth()->user()?->profile?->address1 ?: '' }}" placeholder="Street address"
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Address 2</label>
            <input type="text" name="address2" value="{{ auth()->user()?->profile?->address2 ?: '' }}" placeholder="Apt, Suite..."
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">City</label>
            <input type="text" name="city" value="{{ auth()->user()?->profile?->city ?: '' }}" 
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">State/Region</label>
            <input type="text" name="state" value="{{ auth()->user()?->profile?->state ?: '' }}" 
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Zip Code</label>
            <input type="text" name="zip" value="{{ auth()->user()?->profile?->zip ?: '' }}" 
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
        <div class="space-y-2">
            <label class="text-[10px] uppercase tracking-widest text-slate-500 font-bold ml-1">Country</label>
            <input type="text" name="country" value="{{ auth()->user()?->profile?->country ?: 'United States' }}" 
                   class="w-full bg-[#1F2937] border border-white/5 rounded-xl px-5 py-3.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#6366F1]/50 transition-all" />
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Projects -->
    <div class="bg-surface-container rounded-[1.5rem] p-6">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">folder</span>
            </div>
            <span class="text-[10px] font-bold text-primary px-2 py-1 bg-primary/10 rounded-md">MONTHLY</span>
        </div>
        <p class="text-on-surface-variant text-sm outfit font-medium">Projects Assigned</p>
        <h4 class="syne text-5xl font-extrabold tracking-tighter mt-1">{{ $stats['projects'] ?? 0 }}</h4>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-xs text-primary font-bold outfit">↑ {{ $stats['projects_growth'] ?? 0 }}%</span>
            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest">since last month</span>
        </div>
    </div>

    <!-- Tasks -->
    <div class="bg-surface-container rounded-[1.5rem] p-6">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-tertiary/10 rounded-2xl flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined">task_alt</span>
            </div>
            <span class="text-[10px] font-bold text-tertiary px-2 py-1 bg-tertiary/10 rounded-md">LIFETIME</span>
        </div>
        <p class="text-on-surface-variant text-sm outfit font-medium">Tasks Completed</p>
        <h4 class="syne text-5xl font-extrabold tracking-tighter mt-1">{{ $stats['tasks_completed'] ?? 0 }}</h4>
        <div class="mt-4 w-full h-1 bg-surface-container-lowest rounded-full overflow-hidden">
            <div class="h-full bg-tertiary rounded-full" style="width: {{ $stats['efficiency'] ?? 0 }}%"></div>
        </div>
        <p class="mt-2 text-[10px] text-on-surface-variant uppercase tracking-widest">{{ $stats['efficiency'] ?? 0 }}% Efficiency Rating</p>
    </div>

    <!-- Balance -->
    <div class="bg-surface-container rounded-[1.5rem] p-6">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined">account_balance_wallet</span>
            </div>
            <span class="text-[10px] font-bold text-secondary px-2 py-1 bg-secondary/10 rounded-md">CURRENT</span>
        </div>
        <p class="text-on-surface-variant text-sm outfit font-medium">Total Balance</p>
        <h4 class="syne text-5xl font-extrabold tracking-tighter mt-1">${{ number_format($stats['balance'] ?? 0) }}</h4>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-xs text-secondary font-bold outfit">↑ {{ $stats['balance_growth'] ?? 0 }}%</span>
            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest">Growth this month</span>
        </div>
    </div>
</div>
</form>
@endsection