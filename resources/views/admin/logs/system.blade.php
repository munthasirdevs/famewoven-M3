@extends('admin.layouts.app')

@section('title', 'System & Error Logs')
@section('header_title', 'Server Storage Logs')

@section('content')
<div class="space-y-6">

  <!-- Header & Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-red-400 mb-1">Server Telemetry</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Laravel Log Stream</h2>
      <p class="text-xs font-mono text-[#9AA391] mt-1">storage/logs/laravel.log ({{ number_format($fileSize / 1024, 1) }} KB)</p>
    </div>
    <div class="flex items-center gap-3">
      <!-- Download Log -->
      <a href="{{ route('admin.logs.system.download') }}"
        class="glass px-4 py-2.5 rounded-xl text-xs font-mono text-[#F2F5EC] hover:text-[#D4F54F] border border-white/10 flex items-center gap-2 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        <span>Download File</span>
      </a>

      <!-- Clear Log -->
      @if(auth()->user()->isAdmin())
      <form action="{{ route('admin.logs.system.clear') }}" method="POST" onsubmit="return confirm('Clear all entries from storage/logs/laravel.log?');">
        @csrf
        <button type="submit"
          class="px-4 py-2.5 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 text-xs font-mono font-semibold transition-colors flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          <span>Clear Log</span>
        </button>
      </form>
      @endif
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="glass p-4 rounded-2xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    
    <!-- Level Pills -->
    <div class="flex flex-wrap items-center gap-2">
      <a href="{{ route('admin.logs.system', array_merge(request()->except('level'), ['level' => 'all'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ (!request('level') || request('level') === 'all') ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-[#F2F5EC] bg-white/[0.04]' }}">
        All Levels
      </a>
      <a href="{{ route('admin.logs.system', array_merge(request()->except('level'), ['level' => 'ERROR'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('level') === 'ERROR' ? 'bg-red-500 text-white font-bold' : 'text-red-400 bg-red-500/10 border border-red-500/20' }}">
        Errors
      </a>
      <a href="{{ route('admin.logs.system', array_merge(request()->except('level'), ['level' => 'WARNING'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('level') === 'WARNING' ? 'bg-amber-500 text-[#101210] font-bold' : 'text-amber-400 bg-amber-500/10 border border-amber-500/20' }}">
        Warnings
      </a>
      <a href="{{ route('admin.logs.system', array_merge(request()->except('level'), ['level' => 'INFO'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('level') === 'INFO' ? 'bg-cyan-500 text-[#101210] font-bold' : 'text-cyan-400 bg-cyan-500/10 border border-cyan-500/20' }}">
        Info
      </a>
      <a href="{{ route('admin.logs.system', array_merge(request()->except('level'), ['level' => 'DEBUG'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('level') === 'DEBUG' ? 'bg-purple-500 text-white font-bold' : 'text-purple-400 bg-purple-500/10 border border-purple-500/20' }}">
        Debug
      </a>
    </div>

    <!-- Search box -->
    <form action="{{ route('admin.logs.system') }}" method="GET" class="flex items-center gap-2">
      @if(request('level'))
      <input type="hidden" name="level" value="{{ request('level') }}">
      @endif
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search log text..."
        class="px-3.5 py-1.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none placeholder:text-white/20 w-48 sm:w-64">
      <button type="submit" class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-mono text-[#F2F5EC] transition-colors">
        Filter
      </button>
      @if(request('search'))
      <a href="{{ route('admin.logs.system', request()->except('search')) }}" class="text-xs text-[#9AA391] hover:text-white font-mono">✕ Clear</a>
      @endif
    </form>
  </div>

  <!-- Log Entries Stack -->
  <div class="space-y-3">
    @forelse($entries as $idx => $entry)
    <div class="glass p-5 rounded-2xl border border-white/10 space-y-3">
      
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
        <div class="flex items-center gap-3">
          <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider {{ in_array($entry['level'], ['ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY']) ? 'bg-red-500/20 text-red-400 border border-red-500/30' : ($entry['level'] === 'WARNING' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : ($entry['level'] === 'INFO' ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : 'bg-purple-500/20 text-purple-400 border border-purple-500/30')) }}">
            {{ $entry['level'] }}
          </span>
          <span class="text-xs font-mono text-[#9AA391]">{{ $entry['date'] }} [{{ $entry['env'] }}]</span>
        </div>

        @if(!empty($entry['stacktrace']))
        <button onclick="document.getElementById('stack-{{ $idx }}').classList.toggle('hidden')"
          class="text-xs font-mono text-cyan-400 hover:underline inline-flex items-center gap-1">
          <span>Toggle Stack Trace</span>
          <span>↓</span>
        </button>
        @endif
      </div>

      <!-- Message -->
      <div class="p-3.5 rounded-xl bg-black/40 border border-white/5 font-mono text-xs text-[#F2F5EC] leading-relaxed break-words whitespace-pre-wrap">
{{ $entry['message'] }}
      </div>

      <!-- Collapsible Stack Trace -->
      @if(!empty($entry['stacktrace']))
      <div id="stack-{{ $idx }}" class="hidden pt-2 border-t border-white/10">
        <div class="text-[11px] font-mono text-[#9AA391] mb-2 uppercase">Stack Trace Breakdown:</div>
        <pre class="p-4 rounded-xl bg-black/70 border border-white/10 font-mono text-[11px] text-red-300 overflow-x-auto max-h-96 whitespace-pre-wrap leading-relaxed">{{ $entry['stacktrace'] }}</pre>
      </div>
      @endif

    </div>
    @empty
    <div class="glass p-12 text-center rounded-3xl border border-white/10 text-xs font-mono text-[#9AA391]">
      No system log entries recorded or log file is clean.
    </div>
    @endforelse
  </div>

</div>
@endsection
