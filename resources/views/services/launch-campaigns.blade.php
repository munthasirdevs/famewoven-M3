@extends('layouts.app')

@section('title', 'Launch Campaigns — Famewoven')
@section('description', 'Creator posts timed together around your product launch. Coordinated hype, signups, and immediate user traction across X for tech products.')

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
            "name": "Launch Campaigns",
            "item": "https://famewoven.com/services/launch-campaigns.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/launch-campaigns.html#service",
        "name": "Launch Campaigns",
        "serviceType": "Creator Marketing",
        "description": "Creator posts timed together around your product launch. Coordinated hype, signups, and immediate user traction across X for tech products.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/launch-campaigns.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/launch-campaigns.html#webpage",
        "url": "https://famewoven.com/services/launch-campaigns.html",
        "name": "Launch Campaigns — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/launch-campaigns.html#service"
        },
        "description": "Creator posts timed together around your product launch. Coordinated hype, signups, and immediate user traction across X for tech products."
      }
    ]
  }
  </script>
@endsection

@section('content')

    <div class="mb-6 flex items-center gap-2 text-xs font-mono text-[#9AA391]">
      <a href="{{ route('home') }}" class="hover:text-[#D4F54F] transition-colors">Services</a>
      <span>/</span>
      <span class="text-[#D4F54F]">Campaigns</span>
    </div>

    <!-- 1. Hero -->
    <div class="max-w-3xl mb-16">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-xs font-mono font-semibold text-[#D4F54F] mb-4">
        Campaigns Pillar
      </div>
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Launch Campaigns</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Creator posts timed together around your product launch. Synchronize dozens of creators across a tight launch window to capture category attention and spike conversion velocity.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=launch-campaigns" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Major v1/v2 product releases, Product Hunt launches, and public beta unveilings.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Tech brands that need the entire niche talking about one release on the exact same day.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Maximizing initial sign-up velocity to generate social proof loops.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Products with broken sign-up funnels or unvalidated server infrastructure.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Launches with no clear, differentiated value proposition to anchor the conversation.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Launch Orchestration</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What a Launch Campaign Includes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Timing</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Synchronized Drop Schedule</h3>
          <p class="text-xs text-[#9AA391]">Exact hour-by-hour posting cadence calculated to hold your category feed hostage all day.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Variety</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Multi-Angle Coverage</h3>
          <p class="text-xs text-[#9AA391]">Some creators test features, others breakdown speed, others quote-boost—avoiding repetitive messaging.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Analytics</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Live Launch War Room</h3>
          <p class="text-xs text-[#9AA391]">Real-time tracking of impressions, referral visits, and trial completions as posts fire.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How far in advance should we plan a launch campaign?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          We recommend 2 to 3 weeks of lead time to recruit top-tier creators, distribute early access accounts, and review drafts before launch day.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Can this integrate with a Product Hunt or press release launch?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes, we frequently align creator drop windows to support #1 Product of the Day runs and PR announcements.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Plan your launch blitz</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Get your product in front of thousands of active buyers on your big day.</p>
      <a href="../contact.html?service=launch-campaigns" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
