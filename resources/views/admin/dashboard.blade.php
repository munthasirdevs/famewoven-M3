@extends('admin.layouts.app')

@section('title', 'Executive Overview')
@section('header_title', 'Operational Overview')

@section('content')
<div class="space-y-8">

  <!-- 1. Top KPI Metric Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Card 1: Strategy Inquiries -->
    <div class="glass p-6 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-[#D4F54F]/30 transition-all">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-mono uppercase tracking-wider text-[#9AA391]">Strategy Calls</span>
        <div class="w-8 h-8 rounded-lg bg-[#D4F54F]/10 text-[#D4F54F] grid place-items-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        </div>
      </div>
      <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC] mb-2">{{ $metrics['strategy_calls']['total'] }}</div>
      <div class="flex items-center gap-2 text-xs font-mono">
        <span class="px-2 py-0.5 rounded-full bg-[#D4F54F]/10 text-[#D4F54F] font-semibold">{{ $metrics['strategy_calls']['pending'] }} pending</span>
        <span class="text-[#9AA391]">· {{ $metrics['strategy_calls']['contacted'] }} contacted</span>
      </div>
    </div>

    <!-- Card 2: Creator Applications -->
    <div class="glass p-6 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-[#D4F54F]/30 transition-all">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-mono uppercase tracking-wider text-[#9AA391]">Creator Network</span>
        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 text-cyan-400 grid place-items-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
      </div>
      <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC] mb-2">{{ $metrics['creators']['total'] }}</div>
      <div class="flex items-center gap-2 text-xs font-mono">
        <span class="px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-400 font-semibold">{{ $metrics['creators']['pending'] }} to vet</span>
        <span class="text-[#9AA391]">· {{ $metrics['creators']['accepted'] }} accepted</span>
      </div>
    </div>

    <!-- Card 3: Newsletter Subscribers -->
    <div class="glass p-6 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-[#D4F54F]/30 transition-all">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-mono uppercase tracking-wider text-[#9AA391]">Newsletter Audience</span>
        <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-400 grid place-items-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
      </div>
      <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC] mb-2">{{ $metrics['subscribers']['total'] }}</div>
      <div class="flex items-center gap-2 text-xs font-mono">
        <span class="px-2 py-0.5 rounded-full bg-purple-500/10 text-purple-400 font-semibold">{{ $metrics['subscribers']['active'] }} active</span>
        <span class="text-[#9AA391]">Insights readers</span>
      </div>
    </div>

    <!-- Card 4: Activity Telemetry -->
    <div class="glass p-6 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-[#D4F54F]/30 transition-all">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-mono uppercase tracking-wider text-[#9AA391]">Telemetry & Logs</span>
        <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 grid place-items-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
      </div>
      <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC] mb-2">{{ $metrics['logs']['total'] }}</div>
      <div class="flex items-center gap-2 text-xs font-mono">
        <span class="px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 font-semibold">+{{ $metrics['logs']['today'] }} today</span>
        <span class="text-[#9AA391]">Audit events</span>
      </div>
    </div>

  </div>

  <!-- Live Traffic Velocity Quickstrip -->
  <div class="glass p-5 rounded-2xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-white/[0.02] via-[#D4F54F]/[0.03] to-white/[0.02]">
    <div class="flex items-center gap-4">
      <div class="w-10 h-10 rounded-xl bg-[#D4F54F]/10 border border-[#D4F54F]/20 grid place-items-center text-[#D4F54F]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
      </div>
      <div>
        <div class="flex items-center gap-2">
          <h3 class="font-head text-base font-bold text-white">Live Traffic Velocity</h3>
          <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/20">
            <span class="w-1.5 h-1.5 rounded-full bg-[#D4F54F] animate-pulse"></span>
            Real-time Telemetry
          </span>
        </div>
        <p class="text-xs text-[#9AA391] mt-0.5 font-mono">
          {{ number_format($metrics['traffic']['total']) }} total pageviews · {{ number_format($metrics['traffic']['uniques']) }} unique visitor devices · {{ number_format($metrics['traffic']['today']) }} hits logged today
        </p>
      </div>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.traffic.index') }}"
         class="px-4 py-2 rounded-xl bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-1.5 shadow-lg shadow-[#D4F54F]/10">
        <span>Open Line Chart Dashboard</span>
        <span>→</span>
      </a>
    </div>
  </div>

  <!-- 2. Dual Submissions Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Left: Recent Strategy Inquiries -->
    <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 flex flex-col justify-between">
      <div>
        <div class="flex items-center justify-between mb-6">
          <div>
            <div class="label-caps text-[#D4F54F] mb-1">Inbound Demand</div>
            <h2 class="font-head text-xl font-bold text-[#F2F5EC]">Recent Strategy Inquiries</h2>
          </div>
          <a href="{{ route('admin.strategy-calls.index') }}" class="text-xs font-mono text-[#D4F54F] hover:underline flex items-center gap-1">
            <span>View All</span>
            <span>→</span>
          </a>
        </div>

        @if($recentStrategyCalls->isEmpty())
        <div class="py-12 text-center text-xs font-mono text-[#9AA391]">
          No strategy call briefs submitted yet.
        </div>
        @else
        <div class="space-y-3">
          @foreach($recentStrategyCalls as $call)
          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-white/15 transition-all flex items-center justify-between gap-4">
            <div class="min-w-0">
              <div class="flex items-center gap-2">
                <span class="font-semibold text-sm text-[#F2F5EC] truncate">{{ $call->company_name }}</span>
                <span class="text-xs text-[#9AA391]">({{ $call->name }})</span>
              </div>
              <div class="flex items-center gap-3 text-xs font-mono text-[#9AA391] mt-1">
                <span>Budget: {{ $call->budget }}</span>
                <span>·</span>
                <span>{{ $call->created_at->diffForHumans() }}</span>
              </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $call->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : ($call->status === 'contacted' ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-white/10 text-[#9AA391]') }}">
                {{ $call->status }}
              </span>
              <a href="{{ route('admin.strategy-calls.show', $call->id) }}" class="p-1.5 rounded-lg text-[#9AA391] hover:text-[#D4F54F] hover:bg-white/5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

    <!-- Right: Recent Creator Applications -->
    <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 flex flex-col justify-between">
      <div>
        <div class="flex items-center justify-between mb-6">
          <div>
            <div class="label-caps text-cyan-400 mb-1">Talent Pipeline</div>
            <h2 class="font-head text-xl font-bold text-[#F2F5EC]">Recent Creator Applicants</h2>
          </div>
          <a href="{{ route('admin.creators.index') }}" class="text-xs font-mono text-cyan-400 hover:underline flex items-center gap-1">
            <span>View All</span>
            <span>→</span>
          </a>
        </div>

        @if($recentCreators->isEmpty())
        <div class="py-12 text-center text-xs font-mono text-[#9AA391]">
          No creator applications submitted yet.
        </div>
        @else
        <div class="space-y-3">
          @foreach($recentCreators as $creator)
          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:border-white/15 transition-all flex items-center justify-between gap-4">
            <div class="min-w-0">
              <div class="flex items-center gap-2">
                <span class="font-semibold text-sm text-[#F2F5EC] truncate">{{ $creator->name }}</span>
                <span class="text-xs font-mono text-cyan-400 font-semibold">{{ $creator->handle }}</span>
              </div>
              <div class="flex items-center gap-3 text-xs font-mono text-[#9AA391] mt-1">
                <span>{{ ucfirst($creator->platform) }} · {{ ucfirst($creator->niche) }}</span>
                <span>·</span>
                <span>{{ $creator->audience_size }}</span>
              </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $creator->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : ($creator->status === 'accepted' ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-red-500/10 text-red-400 border border-red-500/30') }}">
                {{ $creator->status }}
              </span>
              <a href="{{ route('admin.creators.show', $creator->id) }}" class="p-1.5 rounded-lg text-[#9AA391] hover:text-cyan-400 hover:bg-white/5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

  </div>

  <!-- 3. Everything Logs & Activity Stream -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
    <div class="flex items-center justify-between mb-6">
      <div>
        <div class="label-caps text-[#D4F54F] mb-1">Audit Trail</div>
        <h2 class="font-head text-xl font-bold text-[#F2F5EC]">Website & Event Logs</h2>
      </div>
      <div class="flex items-center gap-3">
        <a href="{{ route('admin.logs.system') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 px-3 py-1.5 rounded-lg transition-colors">
          System Log File
        </a>
        <a href="{{ route('admin.logs.activity') }}" class="text-xs font-mono text-[#D4F54F] hover:underline flex items-center gap-1">
          <span>All Audit Logs</span>
          <span>→</span>
        </a>
      </div>
    </div>

    @if($recentActivities->isEmpty())
    <div class="py-12 text-center text-xs font-mono text-[#9AA391]">
      No activity telemetry captured yet.
    </div>
    @else
    <div class="divide-y divide-white/[0.06]">
      @foreach($recentActivities as $act)
      <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
        <div class="flex items-start sm:items-center gap-3 min-w-0">
          <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider {{ str_starts_with($act->event, 'auth') ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : (str_starts_with($act->event, 'inquiry') ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30') }}">
            {{ $act->event }}
          </span>
          <span class="text-[#F2F5EC] font-medium truncate">{{ $act->description }}</span>
        </div>
        <div class="flex items-center gap-4 text-xs font-mono text-[#9AA391] flex-shrink-0">
          <span>IP: {{ $act->ip_address }}</span>
          <span>·</span>
          <span>{{ $act->created_at->diffForHumans() }}</span>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  <!-- 4. System & Host Architecture -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
    <div class="label-caps text-[#9AA391] mb-2">Host Environment</div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 text-xs font-mono">
      <div>
        <div class="text-[#9AA391] mb-1">PHP Version</div>
        <div class="font-bold text-[#F2F5EC]">{{ $systemInfo['php_version'] }}</div>
      </div>
      <div>
        <div class="text-[#9AA391] mb-1">Laravel Core</div>
        <div class="font-bold text-[#F2F5EC]">v{{ $systemInfo['laravel_version'] }}</div>
      </div>
      <div>
        <div class="text-[#9AA391] mb-1">Database Engine</div>
        <div class="font-bold text-[#D4F54F]">{{ $systemInfo['database'] }}</div>
      </div>
      <div>
        <div class="text-[#9AA391] mb-1">Environment</div>
        <div class="font-bold text-[#F2F5EC] uppercase">{{ $systemInfo['env'] }}</div>
      </div>
      <div>
        <div class="text-[#9AA391] mb-1">Server Clock</div>
        <div class="font-bold text-[#F2F5EC]">{{ $systemInfo['server_time'] }}</div>
      </div>
    </div>
  </div>

</div>
@endsection
