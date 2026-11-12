@extends('layouts.app')

@section('title', 'Multi-Creator Campaigns — Famewoven')
@section('description', '10 to 100+ creators working under one campaign. Orchestrated wave of posts that builds undeniable social proof across tech X.')

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
            "name": "Multi-Creator Campaigns",
            "item": "https://famewoven.com/services/multi-creator-campaigns.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/multi-creator-campaigns.html#service",
        "name": "Multi-Creator Campaigns",
        "serviceType": "Creator Marketing",
        "description": "10 to 100+ creators working under one campaign. Orchestrated wave of posts that builds undeniable social proof across tech X.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/multi-creator-campaigns.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/multi-creator-campaigns.html#webpage",
        "url": "https://famewoven.com/services/multi-creator-campaigns.html",
        "name": "Multi-Creator Campaigns — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/multi-creator-campaigns.html#service"
        },
        "description": "10 to 100+ creators working under one campaign. Orchestrated wave of posts that builds undeniable social proof across tech X."
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
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Multi-Creator Campaigns</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        10 to 100+ creators working under one campaign. Create an overwhelming sense of omnipresence where your ideal customers see your product recommended across multiple respected accounts simultaneously.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=multi-creator-campaigns" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Growth-stage brands ready to dominate mindshare in their vertical.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Teams who want the scale of 50 creators without the nightmare of 50 separate contracts and DM chats.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Layering micro, mid, and key-opinion-leader (KOL) voices for complete ecosystem reach.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Early experiments with undefined ICP and unclear value statements.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Micro-budgets unable to support a minimum 10-creator cohort.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Cohort Command</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What Multi-Creator Orchestration Includes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Turnkey Ops</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Single Point of Contact</h3>
          <p class="text-xs text-[#9AA391]">You manage one contract with Famewoven. We manage the outreach, briefing, and payments for 100+ creators.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Quality Assurance</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Strict Creative Review</h3>
          <p class="text-xs text-[#9AA391]">Every draft is checked for message fidelity, product accuracy, and natural voice before publishing.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Analytics</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Unified Dashboard</h3>
          <p class="text-xs text-[#9AA391]">Live aggregate metrics tracking total reach, link clicks, top-performing creators, and ROI economics.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How do you prevent fatigue or repetitive copy?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          We assign distinct creative angles to different creator sub-cohorts: some focus on speed, others on cost savings, UI design, or API ease.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>What sizes are common?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Cohorts range from 10 to 25 creators for focused sprints, and 50 to 100+ creators for major industry category takeovers.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Mobilize a creator cohort</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Build ubiquitous category presence with an orchestrated multi-creator campaign.</p>
      <a href="../contact.html?service=multi-creator-campaigns" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
