@extends('layouts.app')

@section('title', 'Creator Seeding — Famewoven')
@section('description', 'Your product or early access, sent to the right AI and tech creators on X. Authentic product reviews, unfiltered feedback, and early adoption.')

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
            "name": "Creator Seeding",
            "item": "https://famewoven.com/services/creator-seeding.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/creator-seeding.html#service",
        "name": "Creator Seeding",
        "serviceType": "Creator Marketing",
        "description": "Your product or early access, sent to the right AI and tech creators on X. Authentic product reviews, unfiltered feedback, and early adoption.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/creator-seeding.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/creator-seeding.html#webpage",
        "url": "https://famewoven.com/services/creator-seeding.html",
        "name": "Creator Seeding — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/creator-seeding.html#service"
        },
        "description": "Your product or early access, sent to the right AI and tech creators on X. Authentic product reviews, unfiltered feedback, and early adoption."
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
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Creator Seeding</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Your product or early access, sent to the right AI and tech creators. Put your software directly into the hands of influential power users who can't help but tweet about what they discover.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=creator-seeding" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> AI tools with mind-blowing demos, private betas, or developer platforms launching early SDKs.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Collecting genuine product feedback from experienced practitioners before full commercial launch.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Seeding influential power-users who become organic, long-term brand evangelists.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Products requiring heavy onboarding manual intervention or enterprise sales calls to try.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Brands demanding rigid contractually-enforced reviews in exchange for just a free trial key.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Seeding Engine</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What Creator Seeding Delivers</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Roster</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">VIP Creator Matchlist</h3>
          <p class="text-xs text-[#9AA391]">Curated list of 25 to 50 active tech figures whose daily work directly touches your problem space.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Concierge</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">High-Touch Onboarding</h3>
          <p class="text-xs text-[#9AA391]">Personalized VIP access tokens, frictionless sign-in links, and dedicated fast-track support.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Monitoring</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Spontaneous Post Tracking</h3>
          <p class="text-xs text-[#9AA391]">Real-time alerting whenever seeded creators post organically, enabling instant brand interaction.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Are creators required to post?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Pure seeding is gift/access-based with no forced mandate, ensuring any resulting tweets are 100% authentic and generate maximum peer trust.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>What percentage of seeded creators post?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          When targeting the right niche with genuinely remarkable software, 25% to 45% of seeded creators organically tweet their experiences within 14 days.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Seed your product to leaders</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Get your software tested and organically praised by the most trusted builders on X.</p>
      <a href="../contact.html?service=creator-seeding" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
