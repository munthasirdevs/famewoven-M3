@extends('layouts.app')

@section('title', 'Long-Term Creator Partnerships — Famewoven')
@section('description', 'Ongoing work with creators, monthly or in batches. Turn top-performing creators into continuous growth engines for your AI brand.')

@section('schema')
<script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": "https://famewoven.com/#organization",
        "name": "Famewoven",
        "url": "https://famewoven.com/",
        "logo": {
          "@type": "ImageObject",
          "@id": "https://famewoven.com/#logo",
          "url": "https://famewoven.com/css/namelogo.png",
          "contentUrl": "https://famewoven.com/css/namelogo.png",
          "caption": "Famewoven Logo"
        },
        "image": "https://famewoven.com/css/namelogo.png",
        "description": "Famewoven is an elite creator marketing infrastructure agency that weaves AI, SaaS, and tech brands into creator culture with verifiable balance-sheet proof.",
        "founder": {
          "@id": "https://famewoven.com/#person"
        },
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Dhaka",
          "addressCountry": "BD"
        },
        "sameAs": [
          "https://x.com/famewoven",
          "https://www.linkedin.com/company/famewoven"
        ]
      },
      {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://famewoven.com/"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "Services",
            "item": "https://famewoven.com/services/index.html"
          },
          {
            "@type": "ListItem",
            "position": 3,
            "name": "Long-Term Creator Partnerships",
            "item": "https://famewoven.com/services/long-term-creator-partnerships.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/long-term-creator-partnerships.html#service",
        "name": "Long-Term Creator Partnerships",
        "serviceType": "Creator Marketing",
        "description": "Ongoing work with creators, monthly or in batches. Turn top-performing creators into continuous growth engines for your AI brand.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/long-term-creator-partnerships.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/long-term-creator-partnerships.html#webpage",
        "url": "https://famewoven.com/services/long-term-creator-partnerships.html",
        "name": "Long-Term Creator Partnerships — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/long-term-creator-partnerships.html#service"
        },
        "description": "Ongoing work with creators, monthly or in batches. Turn top-performing creators into continuous growth engines for your AI brand."
      }
    ]
  }
  </script>
@endsection

@section('content')

    <div class="mb-6 flex items-center gap-2 text-xs font-mono text-[#9AA391]">
      <a href="{{ route('home') }}" class="hover:text-[#D4F54F] transition-colors">Services</a>
      <span>/</span>
      <span class="text-[#D4F54F]">Partnerships & Growth</span>
    </div>

    <!-- 1. Hero -->
    <div class="max-w-3xl mb-16">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-xs font-mono font-semibold text-[#D4F54F] mb-4">
        Partnerships & Growth Pillar
      </div>
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Long-Term Creator Partnerships</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Ongoing work with creators, monthly or in batches. Secure category exclusivity, predictable content cadence, and compounding trust by making creators genuine fixtures of your brand.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=long-term-creator-partnerships" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
          <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
        </a>
        <a href="{{ route('home') }}" class="glass glass--pill px-6 py-4 text-xs font-mono uppercase tracking-wider text-[#F2F5EC] hover:text-[#D4F54F] transition-colors">
          ← All Services
        </a>
      </div>
    </div>

    <!-- 2. Two Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
      <div class="glass p-8 border-l-4 border-l-[#D4F54F]">
        <div class="label-caps text-[#D4F54F] mb-3">Who it's for</div>
        <ul class="space-y-3 text-sm text-[#F2F5EC]">
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Brands that have validated their initial creator-market fit and want ongoing retention loops.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Securing category exclusivity so key creators never promote your direct competitors.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Locking in discounted monthly retainer pricing (up to 30% savings vs single-post rates).</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> One-and-done product announcements where long-term customer education isn't required.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Brands that pivot positioning every month without a steady roadmap.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Ambassador Mechanics</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What Long-Term Partnerships Include</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Cadence</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Monthly Content Drops</h3>
          <p class="text-xs text-[#9AA391]">Pre-scheduled recurring posts, threads, feature updates, and quote boosts delivered like clockwork.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Moat</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Category Exclusivity</h3>
          <p class="text-xs text-[#9AA391]">Contractual lockouts preventing contracted creators from mentioning your direct rivals.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Compounding</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Organic Native Affinity</h3>
          <p class="text-xs text-[#9AA391]">Audiences recognize the creator as a real user, radically driving up second- and third-impression conversion.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>What commitment lengths are typical?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          We typically start with a 3-month ambassador sprint, with options to extend into 6-month or annual partnerships with top-converting creators.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Can we swap out creators if someone underperforms?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes, our monthly reviews evaluate cost-per-click and conversion volume, rotating underperforming creators out with vetted alternates.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Lock in your creator ambassadors</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Build steady, compounding awareness with monthly creator partnerships.</p>
      <a href="../contact.html?service=long-term-creator-partnerships" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
