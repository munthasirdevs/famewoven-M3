@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')
@section('header_title', 'Insights Audience')

@section('content')
<div class="space-y-6">

  <!-- Header & Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-purple-400 mb-1">Audience Distribution</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Newsletter Subscribers</h2>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.subscribers.export') }}"
        class="glass px-4 py-2.5 rounded-xl text-xs font-mono text-[#F2F5EC] hover:text-purple-400 border border-white/10 flex items-center gap-2 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        <span>Export CSV</span>
      </a>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="glass p-4 rounded-2xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    
    <!-- Filter pills -->
    <div class="flex items-center gap-2">
      <a href="{{ route('admin.subscribers.index', array_merge(request()->except('status'), ['status' => 'all'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ (!request('status') || request('status') === 'all') ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-[#F2F5EC] bg-white/[0.04]' }}">
        All ({{ $counts['all'] }})
      </a>
      <a href="{{ route('admin.subscribers.index', array_merge(request()->except('status'), ['status' => 'subscribed'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'subscribed' ? 'bg-purple-500 text-white font-bold' : 'text-purple-400 bg-purple-500/10 border border-purple-500/20' }}">
        Active ({{ $counts['subscribed'] }})
      </a>
      <a href="{{ route('admin.subscribers.index', array_merge(request()->except('status'), ['status' => 'unsubscribed'])) }}"
        class="px-3.5 py-1.5 rounded-full text-xs font-mono transition-colors {{ request('status') === 'unsubscribed' ? 'bg-white/30 text-white font-bold' : 'text-[#9AA391] bg-white/[0.04]' }}">
        Unsubscribed ({{ $counts['unsubscribed'] }})
      </a>
    </div>

    <!-- Search input -->
    <form action="{{ route('admin.subscribers.index') }}" method="GET" class="flex items-center gap-2">
      @if(request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
      @endif
      <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search email..."
          class="px-3.5 py-1.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none placeholder:text-white/20 w-48 sm:w-64">
      </div>
      <button type="submit" class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-mono text-[#F2F5EC] transition-colors">
        Filter
      </button>
      @if(request('search'))
      <a href="{{ route('admin.subscribers.index', request()->except('search')) }}" class="text-xs text-[#9AA391] hover:text-white font-mono">✕ Clear</a>
      @endif
    </form>
  </div>

  <!-- Table -->
  <div class="glass rounded-3xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="border-b border-white/[0.08] bg-white/[0.02] text-[#9AA391] font-mono uppercase tracking-wider">
            <th class="py-4 px-6">Email Address</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6">Signup IP</th>
            <th class="py-4 px-6">Subscribed At</th>
            <th class="py-4 px-6 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          @forelse($subscribers as $sub)
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-4 px-6 font-mono text-sm text-[#F2F5EC]">
              {{ $sub->email }}
            </td>
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $sub->status === 'subscribed' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/30' : 'bg-white/10 text-[#9AA391]' }}">
                {{ $sub->status }}
              </span>
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              {{ $sub->ip_address ?? '—' }}
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              {{ $sub->created_at->format('M d, Y · h:i A') }}
            </td>
            <td class="py-4 px-6 text-right">
              <div class="flex items-center justify-end gap-2">
                <!-- Toggle Status -->
                <form action="{{ route('admin.subscribers.toggle', $sub->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/10 text-[11px] font-mono text-[#9AA391] hover:text-[#F2F5EC] transition-colors">
                    {{ $sub->status === 'subscribed' ? 'Unsubscribe' : 'Reactivate' }}
                  </button>
                </form>

                <!-- Delete -->
                <form action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Remove {{ $sub->email }} from subscribers?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-1 rounded-lg text-red-400/80 hover:text-red-400 hover:bg-red-500/10 transition-colors" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="py-12 text-center text-xs font-mono text-[#9AA391]">
              No newsletter subscribers found.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($subscribers->hasPages())
    <div class="p-4 border-t border-white/[0.08]">
      {{ $subscribers->links() }}
    </div>
    @endif
  </div>

</div>
@endsection
