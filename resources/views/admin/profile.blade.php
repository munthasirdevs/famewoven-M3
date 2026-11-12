@extends('admin.layouts.app')

@section('title', 'Admin Profile — Famewoven Command')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <p class="text-xs uppercase tracking-widest text-[#D4F54F] font-mono mb-1">Account & Security</p>
        <h1 class="text-2xl font-bold font-['Space_Grotesk'] text-white">Staff Profile</h1>
    </div>
    <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-medium border
            @if(auth()->user()->role === 'super_admin') bg-purple-500/10 text-purple-300 border-purple-500/20
            @elseif(auth()->user()->role === 'admin') bg-lime-500/10 text-[#D4F54F] border-lime-500/20
            @elseif(auth()->user()->role === 'editor') bg-blue-500/10 text-blue-300 border-blue-500/20
            @else bg-zinc-500/10 text-zinc-300 border-zinc-500/20 @endif">
            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
            {{ strtoupper(str_replace('_', ' ', auth()->user()->role)) }}
        </span>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details & Password Form -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Profile Info Form -->
        <div class="bg-[#0E120C]/80 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/5">
                <div class="w-10 h-10 rounded-xl bg-[#D4F54F]/10 border border-[#D4F54F]/20 flex items-center justify-center text-[#D4F54F] font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-base font-semibold text-white font-['Space_Grotesk']">Personal Details</h2>
                    <p class="text-xs text-white/50">Update your public staff identity and communications address</p>
                </div>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-white/60 mb-2">Display Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-[#080A07] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#D4F54F] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-white/60 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-[#080A07] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#D4F54F] transition-colors">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="px-5 py-2.5 bg-[#D4F54F] text-[#080A07] font-semibold text-xs rounded-xl hover:bg-[#bce336] transition-colors font-['Space_Grotesk']">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Change Form -->
        <div class="bg-[#0E120C]/80 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-white/5">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-white font-['Space_Grotesk']">Security & Password</h2>
                    <p class="text-xs text-white/50">Ensure your account uses a strong passphrase minimum 8 characters</p>
                </div>
            </div>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-white/60 mb-2">Current Password</label>
                    <input type="password" name="current_password" required
                           class="w-full bg-[#080A07] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#D4F54F] transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-white/60 mb-2">New Password</label>
                        <input type="password" name="password" required minlength="8"
                               class="w-full bg-[#080A07] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#D4F54F] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono uppercase tracking-wider text-white/60 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required minlength="8"
                               class="w-full bg-[#080A07] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#D4F54F] transition-colors">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="px-5 py-2.5 bg-white/10 hover:bg-white/15 text-white font-semibold text-xs rounded-xl border border-white/10 transition-colors font-['Space_Grotesk']">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Column: Account Metadata & Role Permissions -->
    <div class="space-y-6">
        <!-- Account Telemetry -->
        <div class="bg-[#0E120C]/80 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <h3 class="text-xs font-mono uppercase tracking-wider text-white/60 mb-4 pb-2 border-b border-white/5">Session & Audit Info</h3>
            
            <dl class="space-y-3 text-xs">
                <div>
                    <dt class="text-white/40 mb-1">Account Role</dt>
                    <dd class="text-white font-mono uppercase tracking-wider text-xs">{{ $user->role }}</dd>
                </div>
                <div>
                    <dt class="text-white/40 mb-1">Status</dt>
                    <dd class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-xs font-mono {{ $user->status === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                        {{ ucfirst($user->status) }}
                    </dd>
                </div>
                <div>
                    <dt class="text-white/40 mb-1">Member Since</dt>
                    <dd class="text-white font-mono">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</dd>
                </div>
                <div>
                    <dt class="text-white/40 mb-1">Last Authentication</dt>
                    <dd class="text-white font-mono">
                        {{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'First session' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-white/40 mb-1">Last Known IP</dt>
                    <dd class="text-white font-mono text-xs">{{ $user->last_login_ip ?? '127.0.0.1' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Role Permissions Matrix Card -->
        <div class="bg-[#0E120C]/80 border border-white/5 rounded-2xl p-6 backdrop-blur-sm">
            <h3 class="text-xs font-mono uppercase tracking-wider text-white/60 mb-3 pb-2 border-b border-white/5">Your Privileges</h3>
            <ul class="space-y-2 text-xs">
                <li class="flex items-center gap-2 {{ in_array($user->role, ['super_admin', 'admin', 'editor', 'viewer']) ? 'text-emerald-400' : 'text-white/30 line-through' }}">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>View Dashboard & Inquiries</span>
                </li>
                <li class="flex items-center gap-2 {{ in_array($user->role, ['super_admin', 'admin', 'editor']) ? 'text-emerald-400' : 'text-white/30 line-through' }}">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update Lead & Creator Statuses</span>
                </li>
                <li class="flex items-center gap-2 {{ in_array($user->role, ['super_admin', 'admin']) ? 'text-emerald-400' : 'text-white/30 line-through' }}">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Export CSV Dossiers</span>
                </li>
                <li class="flex items-center gap-2 {{ in_array($user->role, ['super_admin', 'admin']) ? 'text-emerald-400' : 'text-white/30 line-through' }}">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>View & Clear System Logs</span>
                </li>
                <li class="flex items-center gap-2 {{ in_array($user->role, ['super_admin', 'admin']) ? 'text-emerald-400' : 'text-white/30 line-through' }}">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Staff & User Administration</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
