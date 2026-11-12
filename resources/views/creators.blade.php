@extends('layouts.app')

@section('title', 'Creator Network & Talent Roster — Famewoven')
@section('description', 'Join our curated roster of 500+ vetted creators, or partner with authentic voices delivering high-converting campaign sprints.')

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
      "@@type": "CollectionPage",
      "@@id": "https://famewoven.com/creators#webpage",
      "url": "{{ route('creators') }}",
      "name": "Creator Network & Talent Roster — Famewoven",
      "isPartOf": {
        "@@type": "WebSite",
        "@@id": "https://famewoven.com/#website"
      },
      "description": "Access 500+ vetted creators on X for high-converting brand campaigns, or apply to join our creator network."
    }
  ]
}
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
  
  <!-- Audience Toggle Switch -->
  <div class="flex justify-center mb-16">
    <div class="glass glass--pill p-1.5 flex items-center relative border border-white/10 w-full max-w-xs">
      <!-- Sliding Thumb -->
      <div id="audience-toggle-thumb" class="absolute left-1.5 top-1.5 bottom-1.5 w-[calc(50%-6px)] bg-[#D4F54F] rounded-full transition-transform duration-300 pointer-events-none"></div>

      <button id="toggle-brands" type="button" class="w-1/2 py-2 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] relative z-10 transition-colors text-center focus:outline-none">
        For Brands
      </button>
      <button id="toggle-creators" type="button" class="w-1/2 py-2 text-xs font-mono font-bold uppercase tracking-wider text-[#9AA391] relative z-10 transition-colors text-center focus:outline-none">
        For Creators
      </button>
    </div>
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

  <!-- VIEW A: FOR BRANDS -->
  <div id="audience-brands-view" class="transition-opacity duration-300">
    <div class="max-w-3xl mb-16">
      <div class="label-caps text-[#D4F54F] mb-3">Vetted Network Architecture</div>
      <h1 class="font-head text-4xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">
        Access 500+ creators vetted for real buying power.
      </h1>
      <p class="text-xl text-[#9AA391] leading-relaxed">
        We filter out bot rings, engagement pods, and fake impressions so your brand partners exclusively with trusted community voices.
      </p>
    </div>

    <!-- Categories Breakdown -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
      <div class="glass glass--lift p-7">
        <div class="font-mono text-xs text-[#D4F54F] mb-2">95+ Creators</div>
        <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Fashion & Apparel</h3>
        <p class="text-xs text-[#9AA391]">OOTD stylists, streetwear curators, and modest wear influencers driving proven e-commerce checkouts.</p>
      </div>

      <div class="glass glass--lift p-7">
        <div class="font-mono text-xs text-[#D4F54F] mb-2">60+ Creators</div>
        <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Food & Beverage</h3>
        <p class="text-xs text-[#9AA391]">Culinary explorers, cloud kitchen reviewers, and recipe creators with high localized save rates.</p>
      </div>

      <div class="glass glass--lift p-7">
        <div class="font-mono text-xs text-[#D4F54F] mb-2">45+ Creators</div>
        <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Tech & Productivity</h3>
        <p class="text-xs text-[#9AA391]">Gadget reviewers, desk setup builders, and software educators testing apps and consumer hardware.</p>
      </div>

      <div class="glass glass--lift p-7">
        <div class="font-mono text-xs text-[#D4F54F] mb-2">80+ Creators</div>
        <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Lifestyle & Beauty</h3>
        <p class="text-xs text-[#9AA391]">Skincare enthusiasts, vloggers, and home decor creators with highly loyal female-majority audiences.</p>
      </div>

      <div class="glass glass--lift p-7">
        <div class="font-mono text-xs text-[#D4F54F] mb-2">40+ Creators</div>
        <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Founders & Business</h3>
        <p class="text-xs text-[#9AA391]">Fintech creators, career mentors, and startup builders driving B2B leads and financial app installs.</p>
      </div>

      <div class="glass glass--sub p-7 flex flex-col justify-between border-dashed border-white/20">
        <div>
          <div class="label-caps text-[#D4F54F] mb-2">Custom Sourcing</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Need a specific niche?</h3>
          <p class="text-xs text-[#9AA391]">Our talent intelligence team sources and vets custom creators matching your exact buyer persona.</p>
        </div>
        <a href="{{ route('contact') }}" class="mt-6 text-xs font-mono font-semibold text-[#D4F54F] hover:underline">Request Custom Cohort →</a>
      </div>
    </div>

    <!-- Brand Network Banner CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Book a curated creator shortlist.</h2>
      <p class="text-xs sm:text-sm text-[#101210]/80 mb-6 max-w-xl mx-auto">Tell us your product and target demographic. We deliver 10 pre-vetted creators in 48 hours.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Request creator shortlist</span><span class="btn-text-clone">Request creator shortlist</span></span>
      </a>
    </div>
  </div>

  <!-- VIEW B: FOR CREATORS -->
  <div id="audience-creators-view" class="hidden transition-opacity duration-300">
    <div class="max-w-3xl mb-16">
      <div class="label-caps text-[#D4F54F] mb-3">Creator Onboarding</div>
      <h1 class="font-head text-5xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">
        Get paid to be you.
      </h1>
      <p class="text-xl text-[#9AA391] leading-relaxed">
        No ghosting brands. No delayed payments. Join Famewoven to work with top-tier brands on professional, high-paying campaign sprints.
      </p>
    </div>

    <!-- 3 Creator Perks -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
      <div class="glass p-7">
        <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Prompt Payouts</span>
        <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Guaranteed Escrow</h3>
        <p class="text-xs text-[#9AA391] leading-relaxed">Brand funds are secured in escrow before you shoot. You get paid immediately upon brief completion.</p>
      </div>

      <div class="glass p-7">
        <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Clean Briefs</span>
        <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Clear Expectations</h3>
        <p class="text-xs text-[#9AA391] leading-relaxed">No 15-page vague guidelines. You get sharp direct response talking points while retaining creative authenticity.</p>
      </div>

      <div class="glass p-7">
        <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Long-Term Retainers</span>
        <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Ambassador Contracts</h3>
        <p class="text-xs text-[#9AA391] leading-relaxed">High-converting creators graduate into lucrative 6-month brand ambassadorships and whitelisted ad royalties.</p>
      </div>
    </div>

    <!-- Interactive Creator Application Form -->
    <div class="glass p-8 sm:p-12 max-w-2xl mx-auto">
      <h2 class="font-head text-2xl sm:text-3xl font-bold text-[#F2F5EC] mb-2">Join the creator network</h2>
      <p class="text-xs text-[#9AA391] mb-8">We review applications within 4 business days. Creators must have >3,000 real followers.</p>

      <form id="creator-apply-form" action="{{ route('creators.store') }}" method="POST" class="space-y-5">
        @csrf
        <div id="creator-form-inner" class="space-y-5">
          <div>
            <label class="block label-caps text-[#9AA391] mb-2">Full Name</label>
            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Safwan Ahmed" 
                   class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Primary Platform</label>
              <select name="platform" required class="w-full px-4 py-3 bg-[#0E120C] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="tiktok" {{ old('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook Video</option>
              </select>
            </div>

            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Handle / Profile URL</label>
              <input type="text" name="handle" required value="{{ old('handle') }}" placeholder="@yourhandle" 
                     class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Content Niche</label>
              <select name="niche" required class="w-full px-4 py-3 bg-[#0E120C] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                <option value="fashion" {{ old('niche') == 'fashion' ? 'selected' : '' }}>Fashion & Apparel</option>
                <option value="food" {{ old('niche') == 'food' ? 'selected' : '' }}>Food & Beverage</option>
                <option value="tech" {{ old('niche') == 'tech' ? 'selected' : '' }}>Tech & Gaming</option>
                <option value="beauty" {{ old('niche') == 'beauty' ? 'selected' : '' }}>Lifestyle & Beauty</option>
                <option value="business" {{ old('niche') == 'business' ? 'selected' : '' }}>Business & Tech</option>
              </select>
            </div>

            <div>
              <label class="block label-caps text-[#9AA391] mb-2">Audience Size</label>
              <select name="audience_size" required class="w-full px-4 py-3 bg-[#0E120C] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                <option value="3k-15k" {{ old('audience_size') == '3k-15k' ? 'selected' : '' }}>3,000 - 15,000 (Micro)</option>
                <option value="15k-75k" {{ old('audience_size') == '15k-75k' ? 'selected' : '' }}>15,000 - 75,000 (Mid-Tier)</option>
                <option value="75k-250k" {{ old('audience_size') == '75k-250k' ? 'selected' : '' }}>75,000 - 250,000 (Macro)</option>
                <option value="250k+" {{ old('audience_size') == '250k+' ? 'selected' : '' }}>250,000+ (Headliner)</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block label-caps text-[#9AA391] mb-2">Email Address</label>
            <input type="email" name="email" required value="{{ old('email') }}" placeholder="safwan@creators.com" 
                   class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
          </div>

          <button type="submit" id="creator-submit-btn" class="btn-swap glass glass--lime w-full py-4 rounded-xl text-center text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Submit creator application</span><span class="btn-text-clone">Submit creator application</span></span>
          </button>
        </div>

        <div id="creator-form-success" class="hidden text-center py-10">
          <div class="w-14 h-14 rounded-full bg-[#D4F54F]/20 text-[#D4F54F] flex items-center justify-center mx-auto mb-4 text-2xl font-bold">✓</div>
          <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Application Received</h3>
          <p class="text-xs text-[#9AA391] max-w-sm mx-auto">Our talent audit team will review your profile metrics and reach out via email within 4 business days.</p>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleBrands = document.getElementById('toggle-brands');
  const toggleCreators = document.getElementById('toggle-creators');
  const thumb = document.getElementById('audience-toggle-thumb');
  const brandsView = document.getElementById('audience-brands-view');
  const creatorsView = document.getElementById('audience-creators-view');

  if (toggleBrands && toggleCreators) {
    toggleBrands.addEventListener('click', () => {
      thumb.style.transform = 'translateX(0)';
      toggleBrands.classList.remove('text-[#9AA391]');
      toggleBrands.classList.add('text-[#101210]');
      toggleCreators.classList.remove('text-[#101210]');
      toggleCreators.classList.add('text-[#9AA391]');

      brandsView.classList.remove('hidden');
      creatorsView.classList.add('hidden');
    });

    toggleCreators.addEventListener('click', () => {
      thumb.style.transform = 'translateX(100%)';
      toggleCreators.classList.remove('text-[#9AA391]');
      toggleCreators.classList.add('text-[#101210]');
      toggleBrands.classList.remove('text-[#101210]');
      toggleBrands.classList.add('text-[#9AA391]');

      creatorsView.classList.remove('hidden');
      brandsView.classList.add('hidden');
    });
  }

  // Creator Form Submission
  const form = document.getElementById('creator-apply-form');
  const inner = document.getElementById('creator-form-inner');
  const successBox = document.getElementById('creator-form-success');

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const submitBtn = document.getElementById('creator-submit-btn');
      if (submitBtn) submitBtn.disabled = true;

      const formData = new FormData(form);

      try {
        const response = await fetch("{{ route('creators.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        if (response.ok) {
          inner.classList.add('hidden');
          successBox.classList.remove('hidden');
        } else {
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
