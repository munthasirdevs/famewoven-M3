@extends('admin.layouts.app')

@section('title', 'Activity Audit Trail')
@section('header_title', 'Activity & Everything Logs')

@section('content')
<div class="space-y-6">

  <!-- Header & Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-[#D4F54F] mb-1">Audit Trail & Security</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Activity & Telemetry Logs</h2>
      <p class="text-xs text-[#9AA391] mt-1">Immutable trail of logins, inquiries, status modifications, and system events.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.logs.activity.export') }}"
        class="glass px-4 py-2.5 rounded-xl text-xs font-mono text-[#F2F5EC] hover:text-[#D4F54F] border border-white/10 flex items-center gap-2 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        <span>Export Audit CSV</span>
      </a>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="glass p-4 rounded-2xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    
    <!-- Category Pills -->
    <div class="flex flex-wrap items-center gap-2">
      <a href="{{ route('admin.logs.activity', array_merge(request()->except('category'), ['category' => 'all'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ (!request('category') || request('category') === 'all') ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-[#F2F5EC] bg-white/[0.04]' }}">
        All Events
      </a>
      <a href="{{ route('admin.logs.activity', array_merge(request()->except('category'), ['category' => 'auth'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('category') === 'auth' ? 'bg-amber-500 text-[#101210] font-bold' : 'text-amber-400 bg-amber-500/10 border border-amber-500/20' }}">
        Auth (Logins)
      </a>
      <a href="{{ route('admin.logs.activity', array_merge(request()->except('category'), ['category' => 'inquiry'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('category') === 'inquiry' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#D4F54F] bg-[#D4F54F]/10 border border-[#D4F54F]/20' }}">
        Form Inquiries
      </a>
      <a href="{{ route('admin.logs.activity', array_merge(request()->except('category'), ['category' => 'admin'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('category') === 'admin' ? 'bg-cyan-500 text-[#101210] font-bold' : 'text-cyan-400 bg-cyan-500/10 border border-cyan-500/20' }}">
        Admin Ops
      </a>
    </div>

    <!-- Specific event dropdown & Search -->
    <form action="{{ route('admin.logs.activity') }}" method="GET" class="flex flex-wrap items-center gap-2">
      @if(request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}">
      @endif

      <select name="event" onchange="this.form.submit()" class="px-3 py-1.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
        <option value="all" class="bg-[#101210]">All Event Types</option>
        @foreach($eventTypes as $evt)
        <option value="{{ $evt }}" {{ request('event') === $evt ? 'selected' : '' }} class="bg-[#101210]">{{ $evt }}</option>
        @endforeach
      </select>

      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search description, IP, user..."
        class="px-3.5 py-1.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none placeholder:text-white/20 w-44 sm:w-56">

      <button type="submit" class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-mono text-[#F2F5EC] transition-colors">
        Filter
      </button>

      @if(request('search') || request('event'))
      <a href="{{ route('admin.logs.activity', request()->except(['search', 'event'])) }}" class="text-xs text-[#9AA391] hover:text-white font-mono">✕ Clear</a>
      @endif
    </form>
  </div>

  <!-- Table -->
  <div class="glass rounded-3xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="border-b border-white/[0.08] bg-white/[0.02] text-[#9AA391] font-mono uppercase tracking-wider">
            <th class="py-4 px-6">Event</th>
            <th class="py-4 px-6">Description</th>
            <th class="py-4 px-6">Actor / User</th>
            <th class="py-4 px-6">IP Address</th>
            <th class="py-4 px-6">Payload</th>
            <th class="py-4 px-6 text-right">Timestamp</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          @forelse($logs as $log)
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider {{ str_starts_with($log->event, 'auth') ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : (str_starts_with($log->event, 'inquiry') ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30') }}">
                {{ $log->event }}
              </span>
            </td>
            <td class="py-4 px-6 font-medium text-[#F2F5EC] max-w-sm truncate" title="{{ $log->description }}">
              {{ $log->description }}
            </td>
            <td class="py-4 px-6 font-mono">
              @if($log->user)
              <div class="text-[#F2F5EC] font-semibold">{{ $log->user->name }}</div>
              <div class="text-[10px] text-[#D4F54F] uppercase">{{ str_replace('_', ' ', $log->user->role) }}</div>
              @else
              <span class="text-[#9AA391]">Visitor / System</span>
              @endif
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              {{ $log->ip_address }}
            </td>
            <td class="py-4 px-6">
              @if(!empty($log->properties))
              <button onclick="document.getElementById('payload-{{ $log->id }}').classList.toggle('hidden')"
                class="px-2 py-1 rounded bg-white/5 hover:bg-white/10 text-[10px] font-mono text-cyan-400 transition-colors">
                View JSON ({ count($log->properties) })
              </button>
              <div id="payload-{{ $log->id }}" class="hidden fixed inset-0 z-50 bg-black/80 grid place-items-center p-4">
                <div class="glass p-6 rounded-2xl max-w-lg w-full border border-white/10 relative">
                  <div class="flex items-center justify-between mb-3 border-b border-white/10 pb-2">
                    <span class="text-xs font-mono font-bold text-[#D4F54F]">{{ $log->event }} Payload</span>
                    <button onclick="document.getElementById('payload-{{ $log->id }}').classList.add('hidden')" class="text-[#9AA391] hover:text-white">✕</button>
                  </div>
                  <pre class="bg-black/60 p-4 rounded-xl text-[11px] font-mono text-[#F2F5EC] overflow-x-auto max-h-96 whitespace-pre-wrap">{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                  @if($log->user_agent)
                  <div class="mt-3 text-[10px] font-mono text-[#9AA391] truncate">UA: {{ $log->user_agent }}</div>
                  @endif
                </div>
              </div>
              @else
              <span class="text-[10px] font-mono text-white/20">—</span>
              @endif
            </td>
            <td class="py-4 px-6 font-mono text-right text-[#9AA391]">
              <div>{{ $log->created_at->format('M d, Y') }}</div>
              <div class="text-[10px]">{{ $log->created_at->format('h:i:s A') }}</div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="py-12 text-center text-xs font-mono text-[#9AA391]">
              No activity logs found matching your filters.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($logs->hasPages())
    <div class="p-4 border-t border-white/[0.08]">
      {{ $logs->links() }}
    </div>
    @endif
  </div>

</div>
@endsection
