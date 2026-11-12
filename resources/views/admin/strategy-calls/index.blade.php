@extends('admin.layouts.app')

@section('title', 'Strategy Inquiries')
@section('header_title', 'Inbound Strategy Calls')

@section('content')
<div class="space-y-6">

  <!-- Header & Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-[#D4F54F] mb-1">Commercial Inbound</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Strategy Briefs</h2>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.strategy-calls.export') }}"
        class="glass px-4 py-2.5 rounded-xl text-xs font-mono text-[#F2F5EC] hover:text-[#D4F54F] border border-white/10 flex items-center gap-2 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        <span>Export CSV</span>
      </a>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="glass p-4 rounded-2xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    
    <!-- Status Filter Pills -->
    <div class="flex flex-wrap items-center gap-2">
      <a href="{{ route('admin.strategy-calls.index', array_merge(request()->except('status'), ['status' => 'all'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ (!request('status') || request('status') === 'all') ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-[#F2F5EC] bg-white/[0.04]' }}">
        All ({{ $counts['all'] }})
      </a>
      <a href="{{ route('admin.strategy-calls.index', array_merge(request()->except('status'), ['status' => 'pending'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'pending' ? 'bg-amber-500 text-[#101210] font-bold' : 'text-amber-400 bg-amber-500/10 border border-amber-500/20' }}">
        Pending ({{ $counts['pending'] }})
      </a>
      <a href="{{ route('admin.strategy-calls.index', array_merge(request()->except('status'), ['status' => 'reviewed'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'reviewed' ? 'bg-cyan-500 text-[#101210] font-bold' : 'text-cyan-400 bg-cyan-500/10 border border-cyan-500/20' }}">
        Reviewed ({{ $counts['reviewed'] }})
      </a>
      <a href="{{ route('admin.strategy-calls.index', array_merge(request()->except('status'), ['status' => 'contacted'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'contacted' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#D4F54F] bg-[#D4F54F]/10 border border-[#D4F54F]/20' }}">
        Contacted ({{ $counts['contacted'] }})
      </a>
      <a href="{{ route('admin.strategy-calls.index', array_merge(request()->except('status'), ['status' => 'closed'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'closed' ? 'bg-white/30 text-white font-bold' : 'text-[#9AA391] bg-white/[0.04]' }}">
        Closed ({{ $counts['closed'] }})
      </a>
    </div>

    <!-- Search input -->
    <form action="{{ route('admin.strategy-calls.index') }}" method="GET" class="flex items-center gap-2">
      @if(request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
      @endif
      <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search company, name..."
          class="px-3.5 py-1.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none placeholder:text-white/20 w-48 sm:w-64">
      </div>
      <button type="submit" class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-mono text-[#F2F5EC] transition-colors">
        Filter
      </button>
      @if(request('search'))
      <a href="{{ route('admin.strategy-calls.index', request()->except('search')) }}" class="text-xs text-[#9AA391] hover:text-white font-mono">✕ Clear</a>
      @endif
    </form>
  </div>

  <!-- Table -->
  <div class="glass rounded-3xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="border-b border-white/[0.08] bg-white/[0.02] text-[#9AA391] font-mono uppercase tracking-wider">
            <th class="py-4 px-6">Company & Client</th>
            <th class="py-4 px-6">Email / Phone</th>
            <th class="py-4 px-6">Goal</th>
            <th class="py-4 px-6">Budget Tier</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6">Received</th>
            <th class="py-4 px-6 text-right">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          @forelse($calls as $call)
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-4 px-6">
              <div class="font-head font-bold text-sm text-[#F2F5EC]">{{ $call->company_name }}</div>
              <div class="text-[#9AA391] mt-0.5">{{ $call->name }}</div>
            </td>
            <td class="py-4 px-6 font-mono">
              <div class="text-[#F2F5EC]">{{ $call->email }}</div>
              <div class="text-[#9AA391] mt-0.5">{{ $call->phone }}</div>
            </td>
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-md bg-white/[0.04] border border-white/5 font-mono text-[11px] text-[#F2F5EC]">
                {{ $call->goal }}
              </span>
            </td>
            <td class="py-4 px-6 font-mono font-semibold text-[#D4F54F]">
              {{ $call->budget }}
            </td>
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $call->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : ($call->status === 'reviewed' ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : ($call->status === 'contacted' ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-white/10 text-[#9AA391]')) }}">
                {{ $call->status }}
              </span>
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              {{ $call->created_at->format('M d, Y') }}<br>
              <span class="text-[10px]">{{ $call->created_at->format('h:i A') }}</span>
            </td>
            <td class="py-4 px-6 text-right">
              <a href="{{ route('admin.strategy-calls.show', $call->id) }}"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-[#D4F54F] hover:text-[#101210] text-[#F2F5EC] font-mono text-xs font-semibold transition-all">
                <span>Review</span>
                <span>→</span>
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="py-12 text-center text-xs font-mono text-[#9AA391]">
              No strategy inquiries found matching your filters.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($calls->hasPages())
    <div class="p-4 border-t border-white/[0.08]">
      {{ $calls->links() }}
    </div>
    @endif
  </div>

</div>
@endsection
