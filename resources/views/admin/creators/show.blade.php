@extends('admin.layouts.app')

@section('title', 'Review Creator — ' . $creator->name)
@section('header_title', 'Creator Vetting Dossier')

@section('content')
<div class="space-y-6">

  <!-- Back button -->
  <div>
    <a href="{{ route('admin.creators.index') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors inline-flex items-center gap-1.5">
      <span>← Back to Creator Network</span>
    </a>
  </div>

  <!-- Header Card -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
      <div class="flex items-center gap-3 mb-2">
        <span class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-xs font-mono font-bold uppercase">
          {{ $creator->platform }}
        </span>
        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase font-bold tracking-wider {{ $creator->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : ($creator->status === 'accepted' ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : ($creator->status === 'active' ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'bg-red-500/10 text-red-400 border border-red-500/30')) }}">
          {{ $creator->status }}
        </span>
      </div>
      <h1 class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC]">{{ $creator->name }}</h1>
      <p class="text-sm font-mono text-cyan-400 mt-1">{{ $creator->handle }} · Applied {{ $creator->created_at->format('F d, Y') }} ({{ $creator->created_at->diffForHumans() }})</p>
    </div>

    <div class="flex items-center gap-3">
      @php
        $platformUrl = '#';
        $h = ltrim($creator->handle, '@');
        if (strtolower($creator->platform) === 'x' || strtolower($creator->platform) === 'twitter') {
          $platformUrl = 'https://x.com/' . $h;
        } elseif (strtolower($creator->platform) === 'youtube') {
          $platformUrl = 'https://youtube.com/@' . $h;
        } elseif (strtolower($creator->platform) === 'tiktok') {
          $platformUrl = 'https://tiktok.com/@' . $h;
        } elseif (strtolower($creator->platform) === 'instagram') {
          $platformUrl = 'https://instagram.com/' . $h;
        }
      @endphp
      @if($platformUrl !== '#')
      <a href="{{ $platformUrl }}" target="_blank"
        class="px-5 py-3 rounded-full bg-white/10 text-[#F2F5EC] font-mono text-xs font-bold uppercase tracking-wider hover:bg-white/20 transition-colors flex items-center gap-2">
        <span>View Social Profile</span>
        <span>↗</span>
      </a>
      @endif

      <a href="mailto:{{ $creator->email }}?subject=Famewoven%20Creator%20Network%20Application%20%E2%80%94%20{{ urlencode($creator->handle) }}"
        class="px-5 py-3 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-2">
        <span>Contact Creator</span>
        <span>↗</span>
      </a>
    </div>
  </div>

  <!-- Two Columns -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Left Column: Metrics & Niche -->
    <div class="lg:col-span-8 space-y-6">

      <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 space-y-6">
        <h3 class="label-caps text-cyan-400">Creator Attributes</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Audience Size Tier</div>
            <div class="text-xl font-head font-bold text-[#D4F54F]">{{ $creator->audience_size }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Primary Niche</div>
            <div class="text-base font-semibold text-[#F2F5EC]">{{ ucfirst($creator->niche) }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Primary Platform</div>
            <div class="text-sm font-mono text-[#F2F5EC] uppercase">{{ $creator->platform }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Handle / Channel</div>
            <div class="text-sm font-mono text-cyan-400">{{ $creator->handle }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5 sm:col-span-2">
            <div class="text-[#9AA391] font-mono mb-1">Direct Contact Email</div>
            <a href="mailto:{{ $creator->email }}" class="text-sm font-mono text-[#F2F5EC] hover:text-[#D4F54F] underline">
              {{ $creator->email }}
            </a>
          </div>
        </div>

      </div>

    </div>

    <!-- Right Column: Vetting & Status -->
    <div class="lg:col-span-4 space-y-6">
      
      <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
        <h3 class="label-caps text-[#F2F5EC] mb-4">Vetting Status & Evaluation</h3>
        
        <form action="{{ route('admin.creators.update', $creator->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PATCH')

          <!-- Status Dropdown -->
          <div>
            <label for="status" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Vetting Stage</label>
            <select name="status" id="status" class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
              <option value="pending" {{ $creator->status === 'pending' ? 'selected' : '' }} class="bg-[#101210]">Pending Vetting</option>
              <option value="accepted" {{ $creator->status === 'accepted' ? 'selected' : '' }} class="bg-[#101210]">Accepted into Pool</option>
              <option value="active" {{ $creator->status === 'active' ? 'selected' : '' }} class="bg-[#101210]">Active on Campaigns</option>
              <option value="rejected" {{ $creator->status === 'rejected' ? 'selected' : '' }} class="bg-[#101210]">Rejected / Unqualified</option>
            </select>
          </div>

          <!-- Internal Notes -->
          <div>
            <label for="notes" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Vetting Notes & Performance</label>
            <textarea name="notes" id="notes" rows="6" placeholder="Audience fraud check result, typical engagement rate, rate sheet quotes, brand fit..."
              class="w-full p-4 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none leading-relaxed placeholder:text-white/20">{{ old('notes', $creator->notes) }}</textarea>
          </div>

          <!-- Submit -->
          <button type="submit"
            class="w-full py-3 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors shadow-lg shadow-[#D4F54F]/20">
            Save Creator Status
          </button>
        </form>

      </div>

    </div>

  </div>

</div>
@endsection
