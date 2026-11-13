@extends('layouts.app')

@section('title', 'Book a Strategy Call — Famewoven | Creator Marketing Agency')
@section('description', 'Book a strategy call with Famewoven for custom creator marketing campaigns on X.')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "Organization",
      "@@id": "https://famewoven.com/#organization",
      "name": "Famewoven",
      "url": "https://famewoven.com/",
      "logo": {
        "@@type": "ImageObject",
        "@@id": "https://famewoven.com/#logo",
        "url": "{{ asset('css/namelogo.png') }}",
        "contentUrl": "{{ asset('css/namelogo.png') }}",
        "caption": "Famewoven Logo"
      },
      "description": "Famewoven is an elite creator marketing infrastructure agency that weaves AI, SaaS, and tech brands into creator culture with verifiable balance-sheet proof."
    },
    {
      "@@type": "ContactPage",
      "@@id": "https://famewoven.com/contact#webpage",
      "url": "{{ route('contact') }}",
      "name": "Book a Strategy Call — Famewoven",
      "isPartOf": {
        "@@type": "WebSite",
        "@@id": "https://famewoven.com/#website"
      },
      "description": "Book a strategy call with Famewoven for custom creator marketing campaigns on X."
    }
  ]
}
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
  
  <!-- Title -->
  <div class="max-w-3xl mb-16">
    <div class="label-caps text-[#D4F54F] mb-3">Initiate Partnership</div>
    <h1 class="font-head text-4xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">
      Tell us what you want to move.
    </h1>
    <p class="text-xl text-[#9AA391]">
      Tell us your goal. You get a custom creator strategy and talent architecture within 48 hours.
    </p>
  </div>

  @if ($errors->any())
  <div class="mb-8 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
    <ul class="list-disc list-inside space-y-1">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if (session('success'))
  <div class="mb-8 p-4 rounded-xl bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-sm">
    {{ session('success') }}
  </div>
  @endif

  <!-- Split Layout -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
    
    <!-- Left Column: Strategy Intake Form -->
    <div class="lg:col-span-7">
      <div class="glass p-8 sm:p-12">
        
        <form id="strategy-call-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
          @csrf
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Your Name</label>
              <input type="text" name="name" required value="{{ old('name') }}" placeholder="Safwan Ahmed"
                     class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            </div>

            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Company / Brand Name</label>
              <input type="text" name="company_name" required value="{{ old('company_name') }}" placeholder="Aura Goods Ltd"
                     class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Work Email</label>
              <input type="email" name="email" required value="{{ old('email') }}" placeholder="safwan@auragoods.com"
                     class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            </div>

            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Phone / WhatsApp</label>
              <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="+880 1700 000000"
                     class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            </div>
          </div>

          <!-- Goal Select -->
          <div>
            <label class="block label-caps text-[#9AA391] mb-2">Primary Campaign Goal</label>
            <select name="goal" required class="w-full px-4 py-3 bg-[#0E120C] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
              <option value="ecommerce-sales" {{ old('goal') == 'ecommerce-sales' ? 'selected' : '' }}>Drive Direct E-Commerce Revenue & Orders</option>
              <option value="new-launch" {{ old('goal') == 'new-launch' ? 'selected' : '' }}>Launch a New Collection, Product, or Menu</option>
              <option value="ugc-ads" {{ old('goal') == 'ugc-ads' ? 'selected' : '' }}>Produce UGC Video Assets for Paid Ad Testing</option>
              <option value="brand-awareness" {{ old('goal') == 'brand-awareness' ? 'selected' : '' }}>Saturate Market with Creator Social Proof</option>
              <option value="app-installs" {{ old('goal') == 'app-installs' ? 'selected' : '' }}>Acquire App Users / Qualified Signups</option>
            </select>
          </div>

          <!-- Budget Qualifier -->
          <div>
            <label class="block label-caps text-[#9AA391] mb-2">Estimated Campaign Budget</label>
            <select name="budget" required class="w-full px-4 py-3 bg-[#0E120C] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
              <option value="50k-150k" {{ old('budget') == '50k-150k' ? 'selected' : '' }}>$50,000 - $150,000 (Targeted Pilot Sprint)</option>
              <option value="150k-350k" {{ old('budget') == '150k-350k' ? 'selected' : '' }}>$150,000 - $350,000 (Full Multi-Creator Launch)</option>
              <option value="350k-750k" {{ old('budget') == '350k-750k' ? 'selected' : '' }}>$350,000 - $750,000 (Omnichannel Scale & Ads)</option>
              <option value="750k+" {{ old('budget') == '750k+' ? 'selected' : '' }}>$750,000+ (Enterprise Quarterly Retainer)</option>
              <option value="not-sure" {{ old('budget') == 'not-sure' ? 'selected' : '' }}>Not sure yet (Help us recommend a tier)</option>
            </select>
          </div>

          <div>
            <label class="block label-caps text-[#9AA391] mb-2">Tell us about your product & target customer</label>
            <textarea name="details" rows="4" required placeholder="What are you selling, what is your current monthly revenue, and what would make this campaign a massive win?"
                      class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-base sm:text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">{{ old('details') }}</textarea>
          </div>

          <button type="submit" id="strategy-submit-btn" class="btn-swap glass glass--lime w-full py-4 rounded-xl text-center text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap">
              <span class="btn-text-primary">Book a strategy call</span>
              <span class="btn-text-clone">Book a strategy call</span>
            </span>
          </button>
        </form>

        <!-- Success State -->
        <div id="strategy-call-success" class="hidden text-center py-12">
          <div class="w-20 h-20 rounded-full bg-[#D4F54F]/10 border border-[#D4F54F]/30 mx-auto flex items-center justify-center mb-6">
            <svg class="w-10 h-10" viewBox="0 0 48 48" fill="none">
              <path id="success-check-path" d="M 12 24 L 21 33 L 36 15" stroke="#D4F54F" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-3">Brief Received.</h2>
          <p class="text-sm text-[#9AA391] max-w-md mx-auto leading-relaxed mb-6">
            Our partners will review your product economics and reach out via WhatsApp and email within <span class="text-[#D4F54F] font-semibold">24 to 48 hours</span> with a customized campaign proposal.
          </p>
          <div id="strategy-call-ticket" class="label-caps text-xs text-[#9AA391]">Ticket: FW-STRATEGY-2026</div>
        </div>

      </div>
    </div>

    <!-- Right Column: What Happens Next & Direct Contacts -->
    <div class="lg:col-span-5 space-y-6">
      
      <!-- What Happens Next Glass Card -->
      <div class="glass p-8">
        <div class="label-caps text-[#D4F54F] mb-4">What happens next</div>
        
        <div class="space-y-6">
          <div class="flex items-start gap-4">
            <div class="w-8 h-8 rounded-full bg-white/[0.05] border border-white/10 text-[#D4F54F] flex items-center justify-center font-mono font-bold text-xs flex-shrink-0">
              1
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#F2F5EC]">48-Hour Review</h3>
              <p class="text-xs text-[#9AA391] mt-1">We evaluate your customer acquisition targets, competitor landscape, and category dynamics.</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <div class="w-8 h-8 rounded-full bg-white/[0.05] border border-white/10 text-[#D4F54F] flex items-center justify-center font-mono font-bold text-xs flex-shrink-0">
              2
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#F2F5EC]">30-Min Strategy Call</h3>
              <p class="text-xs text-[#9AA391] mt-1">We present initial creative hook angles, talent tier recommendations, and attribution mechanics.</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <div class="w-8 h-8 rounded-full bg-white/[0.05] border border-white/10 text-[#D4F54F] flex items-center justify-center font-mono font-bold text-xs flex-shrink-0">
              3
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#F2F5EC]">10-Day Execution Sprint</h3>
              <p class="text-xs text-[#9AA391] mt-1">Upon sign-off, we onboard vetted creators, shoot drafts, and launch with live dashboard tracking.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Direct Contact Glass Card -->
      <div class="glass p-8">
        <div class="label-caps text-[#D4F54F] mb-3">Direct Reach</div>
        <p class="text-xs text-[#9AA391] mb-6">Prefer direct founder communication? Reach out directly via WhatsApp or email.</p>

        <div class="space-y-3 font-mono text-xs">
          <a href="mailto:hello@famewoven.com" class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.06] text-[#F2F5EC] hover:text-[#D4F54F] transition-colors">
            <span>Email: hello@famewoven.com</span>
            <span>↗</span>
          </a>

          <a href="https://wa.me/8801700000000" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-3.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.06] text-[#F2F5EC] hover:text-[#D4F54F] transition-colors">
            <span>WhatsApp: +880 1700 000000</span>
            <span>↗</span>
          </a>

          <div class="p-3.5 rounded-xl bg-white/[0.02] text-[#9AA391] flex items-center justify-between">
            <span>Response Time</span>
            <span class="text-[#D4F54F]">&lt; 4 Hours</span>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('strategy-call-form');
  const successBox = document.getElementById('strategy-call-success');
  const ticketEl = document.getElementById('strategy-call-ticket');

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const submitBtn = document.getElementById('strategy-submit-btn');
      if (submitBtn) submitBtn.disabled = true;

      const formData = new FormData(form);

      try {
        const response = await fetch("{{ route('contact.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        if (response.ok) {
          const data = await response.json();
          if (ticketEl && data.ticket) {
            ticketEl.textContent = 'Ticket: ' + data.ticket;
          }
          form.classList.add('hidden');
          successBox.classList.remove('hidden');
        } else {
          // Fallback to standard submit if validation failed
          form.submit();
        }
      } catch (err) {
        form.submit();
      }
    });
  }
});
</script>
@endpush

