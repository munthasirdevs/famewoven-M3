@extends('admin.layouts.app')

@section('title', 'Traffic Intelligence — Famewoven Command')
@section('header_title', 'Traffic Analytics & Visitor Intelligence')

@section('content')
<div class="space-y-8">

  <!-- Header Controls: Time Period, Bot Toggle, CSV Export -->
  <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-[#D4F54F] mb-1">Audience & Reach Telemetry</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Platform Traffic Intelligence</h2>
      <p class="text-xs text-[#9AA391] mt-1">Real-time GDPR-compliant telemetry tracking visitor volume, page engagement, and audience composition.</p>
    </div>

    <!-- Actions & Filter Controls -->
    <div class="flex flex-wrap items-center gap-3">
      <!-- Period Selector -->
      <div class="flex items-center rounded-xl bg-white/[0.03] border border-white/10 p-1 text-xs font-mono">
        <a href="{{ route('admin.traffic.index', ['period' => 'today', 'filter_bot' => $filterBot ? '1' : '0']) }}"
           class="px-3 py-1.5 rounded-lg transition-colors {{ $period === 'today' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-white' }}">
          Today
        </a>
        <a href="{{ route('admin.traffic.index', ['period' => '7d', 'filter_bot' => $filterBot ? '1' : '0']) }}"
           class="px-3 py-1.5 rounded-lg transition-colors {{ $period === '7d' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-white' }}">
          7 Days
        </a>
        <a href="{{ route('admin.traffic.index', ['period' => '30d', 'filter_bot' => $filterBot ? '1' : '0']) }}"
           class="px-3 py-1.5 rounded-lg transition-colors {{ $period === '30d' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-white' }}">
          30 Days
        </a>
        <a href="{{ route('admin.traffic.index', ['period' => 'all', 'filter_bot' => $filterBot ? '1' : '0']) }}"
           class="px-3 py-1.5 rounded-lg transition-colors {{ $period === 'all' ? 'bg-[#D4F54F] text-[#101210] font-bold' : 'text-[#9AA391] hover:text-white' }}">
          All Time
        </a>
      </div>

      <!-- Bot Filter Toggle -->
      <a href="{{ route('admin.traffic.index', ['period' => $period, 'filter_bot' => $filterBot ? '0' : '1']) }}"
         class="px-3.5 py-2 rounded-xl border text-xs font-mono flex items-center gap-2 transition-colors {{ $filterBot ? 'bg-amber-500/10 border-amber-500/30 text-amber-300' : 'bg-white/[0.03] border-white/10 text-[#9AA391] hover:text-white' }}">
        <span class="w-1.5 h-1.5 rounded-full {{ $filterBot ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
        <span>{{ $filterBot ? 'Including Bots' : 'Humans Only' }}</span>
      </a>

      <!-- Full Visitor Logs Link -->
      <a href="{{ route('admin.traffic.visitors') }}"
         class="px-3.5 py-2 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-[#F2F5EC] border border-white/10 text-xs font-mono flex items-center gap-1.5 transition-colors">
        <svg class="w-4 h-4 text-[#D4F54F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
        <span>All Visitor Logs →</span>
      </a>

      <!-- Export CSV -->
      <a href="{{ route('admin.traffic.export', ['period' => $period, 'filter_bot' => $filterBot ? '1' : '0']) }}"
         class="px-3.5 py-2 rounded-xl bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-1.5 shadow-lg shadow-[#D4F54F]/10">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <span>Export CSV</span>
      </a>
    </div>
  </div>

  <!-- Primary KPI Cards Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Total Pageviews -->
    <div class="glass p-5 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-[#D4F54F]/30 transition-colors">
      <div class="text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-2 flex items-center justify-between">
        <span>Total Pageviews</span>
        <span class="w-2 h-2 rounded-full bg-[#D4F54F]"></span>
      </div>
      <div class="font-head text-3xl font-bold text-[#F2F5EC] tracking-tight">
        {{ number_format($totalPageviews) }}
      </div>
      <div class="mt-2 text-xs font-mono text-[#D4F54F] flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-[#D4F54F] animate-pulse"></span>
        <span>{{ number_format($todayPageviews) }} recorded today</span>
      </div>
    </div>

    <!-- Unique Visitors -->
    <div class="glass p-5 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-cyan-500/30 transition-colors">
      <div class="text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-2 flex items-center justify-between">
        <span>Unique Visitors</span>
        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
      </div>
      <div class="font-head text-3xl font-bold text-[#F2F5EC] tracking-tight">
        {{ number_format($uniqueVisitors) }}
      </div>
      <div class="mt-2 text-xs font-mono text-cyan-400 flex items-center gap-1.5">
        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
        <span>{{ number_format($todayUniques) }} unique devices today</span>
      </div>
    </div>

    <!-- Total Sessions -->
    <div class="glass p-5 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-purple-500/30 transition-colors">
      <div class="text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-2 flex items-center justify-between">
        <span>Distinct Sessions</span>
        <span class="w-2 h-2 rounded-full bg-purple-400"></span>
      </div>
      <div class="font-head text-3xl font-bold text-[#F2F5EC] tracking-tight">
        {{ number_format($totalSessions) }}
      </div>
      <div class="mt-2 text-xs font-mono text-purple-300">
        {{ $avgViewsPerSession }} avg pages / session
      </div>
    </div>

    <!-- Compliance / Telemetry Status -->
    <div class="glass p-5 rounded-2xl border border-white/10 relative overflow-hidden group hover:border-emerald-500/30 transition-colors">
      <div class="text-[10px] font-mono uppercase tracking-wider text-[#9AA391] mb-2 flex items-center justify-between">
        <span>Privacy & Legal Protection</span>
        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
      </div>
      <div class="font-head text-xl font-bold text-emerald-400 tracking-tight flex items-center gap-2">
        <span>GDPR Compliant</span>
        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
      </div>
      <div class="mt-2 text-xs font-mono text-[#9AA391]">
        IP Masked · Zero Invasive PII
      </div>
    </div>
  </div>

  <!-- Interactive Daily Traffic Chart (Pure Responsive Tailwind/CSS) -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-white/[0.08]">
      <div>
        <div class="label-caps text-[#D4F54F] mb-1">Volume Velocity</div>
        <h3 class="font-head text-lg font-bold text-[#F2F5EC]">Traffic Timeline & Daily Velocity</h3>
      </div>
      <div class="flex items-center gap-4 text-xs font-mono">
        <div class="flex items-center gap-2">
          <span class="w-3 h-3 rounded bg-[#D4F54F]"></span>
          <span class="text-[#F2F5EC]">Pageviews</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="w-3 h-3 rounded bg-cyan-400"></span>
          <span class="text-[#F2F5EC]">Unique Visitors</span>
        </div>
      </div>
    </div>

    <!-- Bars Container -->
    @if(count($chartData) > 0)
    <div class="h-56 flex items-end gap-2 sm:gap-3 pt-6 pb-2 px-2 border-b border-white/10 overflow-x-auto">
      @foreach($chartData as $bar)
        @php
          $viewHeight = $maxDailyViews > 0 ? max(8, round(($bar['views'] / $maxDailyViews) * 100)) : 8;
          $uniqueHeight = $maxDailyViews > 0 ? max(6, round(($bar['uniques'] / $maxDailyViews) * 100)) : 6;
        @endphp
        <div class="flex-1 min-w-[28px] max-w-[64px] h-full flex flex-col justify-end items-center group relative cursor-pointer">
          <!-- Tooltip on hover -->
          <div class="absolute -top-14 bg-[#101210] border border-white/20 px-2.5 py-1.5 rounded-lg text-[10px] font-mono text-white opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none shadow-xl z-20 whitespace-nowrap">
            <div class="font-bold text-[#D4F54F]">{{ $bar['label'] }}</div>
            <div>{{ number_format($bar['views']) }} views · {{ number_format($bar['uniques']) }} uniques</div>
          </div>

          <!-- Dual bars -->
          <div class="w-full flex items-end justify-center gap-1 h-full">
            <!-- Pageviews bar -->
            <div style="height: {{ $viewHeight }}%;"
                 class="w-1/2 bg-[#D4F54F] rounded-t transition-all duration-300 group-hover:bg-[#F0FFB0]"></div>
            <!-- Unique visitors bar -->
            <div style="height: {{ $uniqueHeight }}%;"
                 class="w-1/2 bg-cyan-400 rounded-t transition-all duration-300 group-hover:bg-cyan-300"></div>
          </div>

          <!-- Day label -->
          <span class="text-[9px] font-mono text-[#9AA391] mt-2 group-hover:text-white transition-colors truncate w-full text-center">
            {{ $bar['label'] }}
          </span>
        </div>
      @endforeach
    </div>
    @else
    <div class="h-32 grid place-items-center text-xs font-mono text-[#9AA391]">
      No traffic data points recorded for this timeframe yet.
    </div>
    @endif
  </div>

  <!-- Dual Split: Top Visited Pages & Top Referrers -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Top Visited Pages -->
    <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
      <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/[0.08]">
        <div>
          <div class="label-caps text-[#D4F54F] mb-1">Engagement Heatmap</div>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC]">Top Visited URLs</h3>
        </div>
        <span class="text-xs font-mono text-[#9AA391]">{{ count($topPages) }} routes</span>
      </div>

      <div class="space-y-4">
        @forelse($topPages as $page)
          @php
            $percentage = $totalPageviews > 0 ? round(($page->views / $totalPageviews) * 100, 1) : 0;
          @endphp
          <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs font-mono">
              <a href="{{ $page->path }}" target="_blank" class="text-[#F2F5EC] hover:text-[#D4F54F] font-medium truncate max-w-[280px]">
                {{ $page->path === '/' ? '/ (Home)' : $page->path }}
              </a>
              <div class="flex items-center gap-3 text-right">
                <span class="text-[#9AA391]">{{ number_format($page->uniques) }} uniq</span>
                <span class="text-white font-bold">{{ number_format($page->views) }}</span>
                <span class="text-[10px] text-[#D4F54F] w-10 text-right">{{ $percentage }}%</span>
              </div>
            </div>
            <!-- Progress bar -->
            <div class="w-full h-1.5 bg-white/[0.04] rounded-full overflow-hidden">
              <div class="h-full bg-gradient-to-r from-[#D4F54F] to-[#7CB83A] rounded-full" style="width: {{ $percentage }}%;"></div>
            </div>
          </div>
        @empty
          <div class="text-xs font-mono text-[#9AA391] py-8 text-center">
            No route traffic logged yet.
          </div>
        @endforelse
      </div>
    </div>

    <!-- Top Traffic Sources / Referrers -->
    <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
      <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/[0.08]">
        <div>
          <div class="label-caps text-cyan-400 mb-1">Inbound Attribution</div>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC]">Acquisition Channels & Referrers</h3>
        </div>
        <span class="text-xs font-mono text-[#9AA391]">{{ count($topReferrers) }} sources</span>
      </div>

      <div class="space-y-4">
        @forelse($topReferrers as $ref)
          @php
            $share = $totalPageviews > 0 ? round(($ref->count / $totalPageviews) * 100, 1) : 0;
          @endphp
          <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs font-mono">
              <span class="text-[#F2F5EC] font-medium flex items-center gap-2">
                @if(str_contains($ref->referer_domain, 'Direct'))
                  <span class="w-2 h-2 rounded-full bg-[#D4F54F]"></span>
                @elseif(str_contains($ref->referer_domain, 'Search') || str_contains($ref->referer_domain, 'Google'))
                  <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                @elseif(str_contains($ref->referer_domain, 'Twitter') || str_contains($ref->referer_domain, 'X'))
                  <span class="w-2 h-2 rounded-full bg-white"></span>
                @else
                  <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                @endif
                {{ $ref->referer_domain }}
              </span>
              <div class="flex items-center gap-3">
                <span class="text-white font-bold">{{ number_format($ref->count) }}</span>
                <span class="text-[10px] text-cyan-400 w-10 text-right">{{ $share }}%</span>
              </div>
            </div>
            <!-- Progress bar -->
            <div class="w-full h-1.5 bg-white/[0.04] rounded-full overflow-hidden">
              <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full" style="width: {{ $share }}%;"></div>
            </div>
          </div>
        @empty
          <div class="text-xs font-mono text-[#9AA391] py-8 text-center">
            No referrer sources captured yet.
          </div>
        @endforelse
      </div>
    </div>

  </div>

  <!-- Triple Audience Technology Breakdown -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Device Categories -->
    <div class="glass p-6 rounded-3xl border border-white/10">
      <div class="label-caps text-[#D4F54F] mb-1">Hardware Matrix</div>
      <h4 class="font-head text-base font-bold text-[#F2F5EC] mb-4">Device Categories</h4>
      <div class="space-y-3">
        @forelse($devices as $dev)
          @php
            $devShare = $totalPageviews > 0 ? round(($dev->count / $totalPageviews) * 100, 1) : 0;
          @endphp
          <div>
            <div class="flex items-center justify-between text-xs font-mono mb-1">
              <span class="text-[#F2F5EC] capitalize">{{ $dev->device_type }}</span>
              <span class="text-[#9AA391]">{{ number_format($dev->count) }} ({{ $devShare }}%)</span>
            </div>
            <div class="w-full h-1.5 bg-white/[0.04] rounded-full overflow-hidden">
              <div class="h-full bg-[#D4F54F] rounded-full" style="width: {{ $devShare }}%;"></div>
            </div>
          </div>
        @empty
          <div class="text-xs font-mono text-[#9AA391]">No device data</div>
        @endforelse
      </div>
    </div>

    <!-- Browsers -->
    <div class="glass p-6 rounded-3xl border border-white/10">
      <div class="label-caps text-cyan-400 mb-1">User Agents</div>
      <h4 class="font-head text-base font-bold text-[#F2F5EC] mb-4">Browsers</h4>
      <div class="space-y-3">
        @forelse($browsers as $browser)
          @php
            $bShare = $totalPageviews > 0 ? round(($browser->count / $totalPageviews) * 100, 1) : 0;
          @endphp
          <div>
            <div class="flex items-center justify-between text-xs font-mono mb-1">
              <span class="text-[#F2F5EC]">{{ $browser->browser ?? 'Other' }}</span>
              <span class="text-[#9AA391]">{{ number_format($browser->count) }} ({{ $bShare }}%)</span>
            </div>
            <div class="w-full h-1.5 bg-white/[0.04] rounded-full overflow-hidden">
              <div class="h-full bg-cyan-400 rounded-full" style="width: {{ $bShare }}%;"></div>
            </div>
          </div>
        @empty
          <div class="text-xs font-mono text-[#9AA391]">No browser data</div>
        @endforelse
      </div>
    </div>

    <!-- Operating Systems -->
    <div class="glass p-6 rounded-3xl border border-white/10">
      <div class="label-caps text-purple-400 mb-1">Platform OS</div>
      <h4 class="font-head text-base font-bold text-[#F2F5EC] mb-4">Operating Systems</h4>
      <div class="space-y-3">
        @forelse($operatingSystems as $os)
          @php
            $osShare = $totalPageviews > 0 ? round(($os->count / $totalPageviews) * 100, 1) : 0;
          @endphp
          <div>
            <div class="flex items-center justify-between text-xs font-mono mb-1">
              <span class="text-[#F2F5EC]">{{ $os->os ?? 'Other' }}</span>
              <span class="text-[#9AA391]">{{ number_format($os->count) }} ({{ $osShare }}%)</span>
            </div>
            <div class="w-full h-1.5 bg-white/[0.04] rounded-full overflow-hidden">
              <div class="h-full bg-purple-400 rounded-full" style="width: {{ $osShare }}%;"></div>
            </div>
          </div>
        @empty
          <div class="text-xs font-mono text-[#9AA391]">No OS data</div>
        @endforelse
      </div>
    </div>

  </div>

  <!-- Real-Time Recent Hits Preview -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/[0.08]">
      <div class="flex items-center gap-3">
        <span class="w-2.5 h-2.5 rounded-full bg-[#D4F54F] animate-ping"></span>
        <div>
          <div class="label-caps text-[#D4F54F] mb-0.5">Live Stream</div>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC]">Recent Inbound Hits</h3>
        </div>
      </div>
      <a href="{{ route('admin.traffic.visitors') }}" class="text-xs font-mono text-[#D4F54F] hover:underline flex items-center gap-1">
        <span>View Full Stream (All Details)</span>
        <span>→</span>
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs font-mono">
        <thead class="text-[#9AA391] uppercase tracking-wider border-b border-white/[0.08]">
          <tr>
            <th class="py-3 px-3">Path</th>
            <th class="py-3 px-3">Visitor ID</th>
            <th class="py-3 px-3">Device / Browser</th>
            <th class="py-3 px-3">Referrer</th>
            <th class="py-3 px-3">IP (Anonymized)</th>
            <th class="py-3 px-3 text-right">Time</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.04] text-[#F2F5EC]">
          @forelse($recentHits as $hit)
            <tr class="hover:bg-white/[0.02] transition-colors">
              <td class="py-3 px-3 font-medium text-white max-w-[200px] truncate">
                <span class="px-1.5 py-0.5 rounded text-[10px] {{ $hit->status_code === 200 ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }} mr-1">
                  {{ $hit->status_code }}
                </span>
                {{ $hit->path }}
              </td>
              <td class="py-3 px-3 text-[#9AA391]">
                <span class="px-2 py-0.5 rounded bg-white/[0.04] border border-white/10 text-[10px]">
                  {{ substr($hit->visitor_id, 0, 10) }}...
                </span>
              </td>
              <td class="py-3 px-3 text-[#9AA391]">
                {{ ucfirst($hit->device_type) }} · {{ $hit->browser }}
              </td>
              <td class="py-3 px-3 text-[#9AA391] max-w-[150px] truncate">
                {{ $hit->referer_domain }}
              </td>
              <td class="py-3 px-3 text-[#9AA391]">
                {{ $hit->ip_address }}
              </td>
              <td class="py-3 px-3 text-right text-[#9AA391]">
                {{ $hit->created_at->diffForHumans() }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-8 text-center text-[#9AA391]">
                No live hits logged yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
