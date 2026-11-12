@extends('admin.layouts.app')

@section('title', 'Review Strategy Call #' . $strategyCall->id)
@section('header_title', 'Inquiry Dossier #' . $strategyCall->id)

@section('content')
<div class="space-y-6">

  <!-- Back button -->
  <div>
    <a href="{{ route('admin.strategy-calls.index') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors inline-flex items-center gap-1.5">
      <span>← Back to Strategy Inquiries</span>
    </a>
  </div>

  <!-- Header Card -->
  <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
      <div class="flex items-center gap-3 mb-2">
        <span class="px-3 py-1 rounded-full bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-xs font-mono font-bold">
          FW-STRATEGY-{{ $strategyCall->created_at->year }}-{{ str_pad((string)$strategyCall->id, 4, '0', STR_PAD_LEFT) }}
        </span>
        <span class="px-3 py-1 rounded-full text-xs font-mono uppercase font-bold tracking-wider {{ $strategyCall->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/30' : ($strategyCall->status === 'reviewed' ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : ($strategyCall->status === 'contacted' ? 'bg-[#D4F54F]/10 text-[#D4F54F] border border-[#D4F54F]/30' : 'bg-white/10 text-[#9AA391]')) }}">
          {{ $strategyCall->status }}
        </span>
      </div>
      <h1 class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC]">{{ $strategyCall->company_name }}</h1>
      <p class="text-sm text-[#9AA391] mt-1">Submitted by <span class="text-[#F2F5EC] font-semibold">{{ $strategyCall->name }}</span> · {{ $strategyCall->created_at->format('F d, Y \a\t h:i A') }} ({{ $strategyCall->created_at->diffForHumans() }})</p>
    </div>

    <div class="flex items-center gap-3">
      <a href="mailto:{{ $strategyCall->email }}?subject=Famewoven%20Creator%20Strategy%20Follow-up%20%E2%80%94%20{{ urlencode($strategyCall->company_name) }}"
        class="px-5 py-3 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-2">
        <span>Compose Email</span>
        <span>↗</span>
      </a>
    </div>
  </div>

  <!-- Two Columns: Dossier Left & Management Right -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Left Column: Inquiry Specification -->
    <div class="lg:col-span-8 space-y-6">

      <!-- Parameters Card -->
      <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10 space-y-6">
        <h3 class="label-caps text-[#D4F54F]">Brief Parameters</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Target Budget Tier</div>
            <div class="text-lg font-head font-bold text-[#D4F54F]">{{ $strategyCall->budget }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Commercial Growth Goal</div>
            <div class="text-base font-semibold text-[#F2F5EC]">{{ $strategyCall->goal }}</div>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Contact Email</div>
            <a href="mailto:{{ $strategyCall->email }}" class="text-sm font-mono text-[#F2F5EC] hover:text-[#D4F54F] underline">
              {{ $strategyCall->email }}
            </a>
          </div>

          <div class="p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <div class="text-[#9AA391] font-mono mb-1">Direct Phone / Telegram</div>
            <div class="text-sm font-mono text-[#F2F5EC]">{{ $strategyCall->phone }}</div>
          </div>
        </div>

        <!-- Project Details Box -->
        <div class="pt-4 border-t border-white/[0.08]">
          <div class="text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-3">Project Narrative & Objective</div>
          <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/10 text-sm leading-relaxed text-[#F2F5EC] whitespace-pre-wrap font-body">
{{ $strategyCall->details }}
          </div>
        </div>

      </div>

    </div>

    <!-- Right Column: Status & Notes Management -->
    <div class="lg:col-span-4 space-y-6">
      
      <div class="glass p-6 sm:p-8 rounded-3xl border border-white/10">
        <h3 class="label-caps text-[#F2F5EC] mb-4">Pipeline Status & Notes</h3>
        
        <form action="{{ route('admin.strategy-calls.update', $strategyCall->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PATCH')

          <!-- Status Dropdown -->
          <div>
            <label for="status" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Lead Stage</label>
            <select name="status" id="status" class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
              <option value="pending" {{ $strategyCall->status === 'pending' ? 'selected' : '' }} class="bg-[#101210]">Pending Review</option>
              <option value="reviewed" {{ $strategyCall->status === 'reviewed' ? 'selected' : '' }} class="bg-[#101210]">Reviewed & Qualified</option>
              <option value="contacted" {{ $strategyCall->status === 'contacted' ? 'selected' : '' }} class="bg-[#101210]">Contacted / Call Scheduled</option>
              <option value="closed" {{ $strategyCall->status === 'closed' ? 'selected' : '' }} class="bg-[#101210]">Closed / Retainer Signed</option>
            </select>
          </div>

          <!-- Internal Notes -->
          <div>
            <label for="notes" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Internal Staff Notes</label>
            <textarea name="notes" id="notes" rows="6" placeholder="Add confidential notes on this prospect, shortlist matches, call outcome..."
              class="w-full p-4 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none leading-relaxed placeholder:text-white/20">{{ old('notes', $strategyCall->notes) }}</textarea>
          </div>

          <!-- Submit -->
          <button type="submit"
            class="w-full py-3 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors shadow-lg shadow-[#D4F54F]/20">
            Save Status & Notes
          </button>
        </form>

      </div>

    </div>

  </div>

</div>
@endsection
