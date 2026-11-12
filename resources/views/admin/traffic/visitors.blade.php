@extends('admin.layouts.app')

@section('title', 'Visitor Telemetry Stream — Famewoven Command')
@section('header_title', 'All Visitor Logs & Request Dossiers')

@section('content')
<div class="space-y-8">

  <!-- Header & Navigation -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-[#D4F54F] mb-1">Raw Inbound Telemetry</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Visitor Request Dossiers</h2>
      <p class="text-xs text-[#9AA391] mt-1">Granular inspection of every inbound connection, route path, hardware fingerprint, and acquisition origin.</p>
    </div>

    <div class="flex items-center gap-3">
      <a href="{{ route('admin.traffic.index') }}"
         class="px-4 py-2 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-[#F2F5EC] border border-white/10 text-xs font-mono flex items-center gap-1.5 transition-colors">
        <span>← Overview Dashboard</span>
      </a>

      <a href="{{ route('admin.traffic.export', request()->all()) }}"
         class="px-4 py-2 rounded-xl bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-1.5 shadow-lg shadow-[#D4F54F]/10">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <span>Export Stream CSV</span>
      </a>
    </div>
  </div>

  <!-- Telemetry Counts Summary Bar -->
  <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
    <div class="glass p-3.5 rounded-2xl border border-white/10">
      <div class="text-[10px] font-mono text-[#9AA391] uppercase">Total Recorded Hits</div>
      <div class="font-head text-xl font-bold text-white mt-1">{{ number_format($counts['total_hits']) }}</div>
    </div>
    <div class="glass p-3.5 rounded-2xl border border-white/10">
      <div class="text-[10px] font-mono text-[#9AA391] uppercase">Unique Visitors</div>
      <div class="font-head text-xl font-bold text-cyan-400 mt-1">{{ number_format($counts['unique_visitors']) }}</div>
    </div>
    <div class="glass p-3.5 rounded-2xl border border-white/10">
      <div class="text-[10px] font-mono text-[#9AA391] uppercase">Human Traffic</div>
      <div class="font-head text-xl font-bold text-emerald-400 mt-1">{{ number_format($counts['human_hits']) }}</div>
    </div>
    <div class="glass p-3.5 rounded-2xl border border-white/10">
      <div class="text-[10px] font-mono text-[#9AA391] uppercase">Crawler / Bots</div>
      <div class="font-head text-xl font-bold text-amber-400 mt-1">{{ number_format($counts['bot_hits']) }}</div>
    </div>
    <div class="glass p-3.5 rounded-2xl border border-white/10">
      <div class="text-[10px] font-mono text-[#9AA391] uppercase">Hits Today</div>
      <div class="font-head text-xl font-bold text-[#D4F54F] mt-1">{{ number_format($counts['today_hits']) }}</div>
    </div>
  </div>

  <!-- Search & Filter Controls -->
  <div class="glass p-5 rounded-2xl border border-white/10">
    <form action="{{ route('admin.traffic.visitors') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
      <!-- Search Input -->
      <div class="lg:col-span-2">
        <label class="block text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-1">Search Keywords</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search path, visitor ID, IP, or referrer..."
               class="w-full px-3.5 py-2 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
      </div>

      <!-- Device Category -->
      <div>
        <label class="block text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-1">Device</label>
        <select name="device" class="w-full px-3 py-2 bg-[#101210] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
          <option value="all" {{ request('device') === 'all' || !request('device') ? 'selected' : '' }}>All Devices</option>
          <option value="desktop" {{ request('device') === 'desktop' ? 'selected' : '' }}>Desktop</option>
          <option value="mobile" {{ request('device') === 'mobile' ? 'selected' : '' }}>Mobile</option>
          <option value="tablet" {{ request('device') === 'tablet' ? 'selected' : '' }}>Tablet</option>
          <option value="bot" {{ request('device') === 'bot' ? 'selected' : '' }}>Bot</option>
        </select>
      </div>

      <!-- Bot Filter -->
      <div>
        <label class="block text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-1">Audience Type</label>
        <select name="bot_filter" class="w-full px-3 py-2 bg-[#101210] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
          <option value="" {{ !request('bot_filter') ? 'selected' : '' }}>All Traffic</option>
          <option value="humans" {{ request('bot_filter') === 'humans' ? 'selected' : '' }}>Humans Only</option>
          <option value="bots" {{ request('bot_filter') === 'bots' ? 'selected' : '' }}>Bots Only</option>
        </select>
      </div>

      <!-- Submit / Reset -->
      <div class="flex items-end gap-2">
        <button type="submit"
                class="flex-1 py-2 bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-[#F0FFB0] transition-colors">
          Filter
        </button>
        <a href="{{ route('admin.traffic.visitors') }}"
           class="px-3 py-2 bg-white/[0.04] text-[#9AA391] hover:text-white rounded-xl text-xs font-mono border border-white/10 transition-colors">
          Reset
        </a>
      </div>
    </form>
  </div>

  <!-- Visitors Stream Table -->
  <div class="glass rounded-3xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs font-mono">
        <thead class="bg-white/[0.02] text-[#9AA391] uppercase tracking-wider border-b border-white/[0.08]">
          <tr>
            <th class="py-3.5 px-4">Visitor Token</th>
            <th class="py-3.5 px-4">Route Path</th>
            <th class="py-3.5 px-4">Device &amp; OS</th>
            <th class="py-3.5 px-4">Browser</th>
            <th class="py-3.5 px-4">Referrer Origin</th>
            <th class="py-3.5 px-4">IP (Masked)</th>
            <th class="py-3.5 px-4">Timestamp</th>
            <th class="py-3.5 px-4 text-right">Inspect</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.04] text-[#F2F5EC]">
          @forelse($visitors as $hit)
            <tr class="hover:bg-white/[0.02] transition-colors">
              <!-- Visitor Token -->
              <td class="py-3.5 px-4">
                <div class="flex items-center gap-1.5">
                  <span class="w-1.5 h-1.5 rounded-full {{ $hit->is_bot ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
                  <span class="font-mono text-white text-[11px] bg-white/[0.04] px-2 py-0.5 rounded border border-white/10">
                    {{ substr($hit->visitor_id, 0, 12) }}...
                  </span>
                </div>
              </td>

              <!-- Path with status badge -->
              <td class="py-3.5 px-4 max-w-[220px]">
                <div class="flex items-center gap-1.5 truncate">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $hit->status_code === 200 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                    {{ $hit->method }} {{ $hit->status_code }}
                  </span>
                  <span class="font-medium truncate text-white" title="{{ $hit->path }}">{{ $hit->path }}</span>
                </div>
              </td>

              <!-- Device & OS -->
              <td class="py-3.5 px-4 text-[#9AA391] whitespace-nowrap">
                <span class="text-white capitalize">{{ $hit->device_type }}</span>
                <span class="text-white/40">/</span>
                <span>{{ $hit->os }}</span>
              </td>

              <!-- Browser -->
              <td class="py-3.5 px-4 text-[#9AA391] whitespace-nowrap">
                {{ $hit->browser }}
              </td>

              <!-- Referrer -->
              <td class="py-3.5 px-4 text-[#9AA391] max-w-[160px] truncate" title="{{ $hit->referer ?? 'Direct' }}">
                {{ $hit->referer_domain }}
              </td>

              <!-- Masked IP -->
              <td class="py-3.5 px-4 text-[#9AA391] whitespace-nowrap">
                <span class="inline-flex items-center gap-1">
                  <span class="text-[10px] text-emerald-400">🛡️</span>
                  <span>{{ $hit->ip_address }}</span>
                </span>
              </td>

              <!-- Timestamp -->
              <td class="py-3.5 px-4 text-[#9AA391] whitespace-nowrap">
                <div title="{{ $hit->created_at->format('Y-m-d H:i:s T') }}">
                  {{ $hit->created_at->diffForHumans() }}
                </div>
              </td>

              <!-- Inspect Action -->
              <td class="py-3.5 px-4 text-right">
                <button type="button"
                        onclick="document.getElementById('hit-modal-{{ $hit->id }}').classList.remove('hidden')"
                        class="px-2.5 py-1 rounded-lg bg-white/[0.04] hover:bg-white/[0.1] text-xs font-mono text-[#D4F54F] border border-white/10 transition-colors">
                  Dossier
                </button>

                <!-- Dossier Modal for Individual Hit -->
                <div id="hit-modal-{{ $hit->id }}" class="hidden fixed inset-0 z-50 bg-black/80 grid place-items-center p-4 text-left">
                  <div class="glass p-6 sm:p-8 rounded-3xl max-w-xl w-full border border-white/10 relative">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10">
                      <div>
                        <div class="label-caps text-[#D4F54F] mb-1">Inbound Hit #{{ $hit->id }}</div>
                        <h4 class="font-head text-lg font-bold text-white">Visitor Request Dossier</h4>
                      </div>
                      <button onclick="document.getElementById('hit-modal-{{ $hit->id }}').classList.add('hidden')" class="text-[#9AA391] hover:text-white">✕</button>
                    </div>

                    <dl class="space-y-3 text-xs font-mono">
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Visitor Token</dt>
                        <dd class="text-white select-all">{{ $hit->visitor_id }}</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Session Token</dt>
                        <dd class="text-white select-all">{{ $hit->session_id ?? 'N/A' }}</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Path &amp; Status</dt>
                        <dd class="text-[#D4F54F]">{{ $hit->method }} {{ $hit->path }} ({{ $hit->status_code }})</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Full Target URL</dt>
                        <dd class="text-white truncate max-w-[320px]" title="{{ $hit->url }}">{{ $hit->url }}</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Referrer URL</dt>
                        <dd class="text-white truncate max-w-[320px]" title="{{ $hit->referer ?? 'Direct / None' }}">{{ $hit->referer ?? 'Direct / None' }}</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">IP Address</dt>
                        <dd class="text-emerald-400">{{ $hit->ip_address }} (Masked for GDPR)</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Hardware &amp; Engine</dt>
                        <dd class="text-white">{{ ucfirst($hit->device_type) }} · {{ $hit->os }} · {{ $hit->browser }}</dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Traffic Classification</dt>
                        <dd class="{{ $hit->is_bot ? 'text-amber-400' : 'text-emerald-400' }}">
                          {{ $hit->is_bot ? 'Automated Crawler / Search Bot' : 'Human Web Visitor' }}
                        </dd>
                      </div>
                      <div class="flex justify-between py-1 border-b border-white/[0.04]">
                        <dt class="text-[#9AA391]">Exact Timestamp</dt>
                        <dd class="text-white">{{ $hit->created_at->format('Y-m-d H:i:s T') }}</dd>
                      </div>
                      <div class="pt-2">
                        <dt class="text-[#9AA391] mb-1">User Agent String</dt>
                        <dd class="p-2.5 rounded-xl bg-white/[0.02] border border-white/5 text-[10px] text-white/70 break-all select-all font-mono">
                          {{ $hit->user_agent ?? 'None provided' }}
                        </dd>
                      </div>
                    </dl>

                    <div class="mt-6 flex justify-end">
                      <button type="button"
                              onclick="document.getElementById('hit-modal-{{ $hit->id }}').classList.add('hidden')"
                              class="px-4 py-2 bg-white/[0.05] hover:bg-white/[0.1] text-xs font-mono rounded-xl text-white">
                        Close Dossier
                      </button>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="py-12 text-center text-[#9AA391]">
                No visitor traffic logs found matching the filter criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($visitors->hasPages())
      <div class="p-4 border-t border-white/[0.08] flex items-center justify-between text-xs font-mono">
        {{ $visitors->links() }}
      </div>
    @endif
  </div>

  <!-- Retention & Purge Policy Card (Super Admin / Admin) -->
  @if(auth()->user()->isAdmin())
    <div class="glass p-6 rounded-3xl border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <div class="label-caps text-[#D4F54F] mb-1">Data Minimization Compliance</div>
        <h4 class="font-head text-base font-bold text-white">Telemetry Retention Lifecycle</h4>
        <p class="text-xs text-[#9AA391] mt-0.5">Under GDPR Article 5(1)(e), visitor logs are anonymized and should be pruned periodically.</p>
      </div>
      <form action="{{ route('admin.traffic.purge') }}" method="POST" onsubmit="return confirm('Purge visitor traffic logs older than 90 days?');">
        @csrf
        <input type="hidden" name="days" value="90">
        <button type="submit"
                class="px-4 py-2 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 text-xs font-mono font-medium transition-colors">
          Purge Logs Older Than 90 Days
        </button>
      </form>
    </div>
  @endif

</div>

<!-- Modal Esc & Backdrop handler -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        document.querySelectorAll('[id^="hit-modal-"]').forEach(function (modal) {
          modal.classList.add('hidden');
        });
      }
    });
    document.querySelectorAll('[id^="hit-modal-"]').forEach(function (modal) {
      modal.addEventListener('click', function (e) {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });
    });
  });
</script>
@endsection

