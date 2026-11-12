@extends('layouts.app')

@section('title', 'Organic Amplification — Famewoven')
@section('description', 'Real likes, reposts, replies and bookmarks from engaged accounts in tech. Give your high-impact posts algorithm traction on X.')

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
            "name": "Organic Amplification",
            "item": "https://famewoven.com/services/organic-amplification.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/organic-amplification.html#service",
        "name": "Organic Amplification",
        "serviceType": "Creator Marketing",
        "description": "Real likes, reposts, replies and bookmarks from engaged accounts in tech. Give your high-impact posts algorithm traction on X.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/organic-amplification.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/organic-amplification.html#webpage",
        "url": "https://famewoven.com/services/organic-amplification.html",
        "name": "Organic Amplification — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/organic-amplification.html#service"
        },
        "description": "Real likes, reposts, replies and bookmarks from engaged accounts in tech. Give your high-impact posts algorithm traction on X."
      }
    ]
  }
  </script>
@endsection

@section('content')

    <div class="mb-6 flex items-center gap-2 text-xs font-mono text-[#9AA391]">
      <a href="{{ route('home') }}" class="hover:text-[#D4F54F] transition-colors">Services</a>
      <span>/</span>
      <span class="text-[#D4F54F]">Content</span>
    </div>

    <!-- 1. Hero -->
    <div class="max-w-3xl mb-16">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-xs font-mono font-semibold text-[#D4F54F] mb-4">
        Content Pillar
      </div>
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Organic Amplification</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Real likes, reposts, replies and bookmarks from engaged accounts. Ignite the recommendation algorithms with organic signals from verified creators, developers, and founders.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=organic-amplification" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Brands battling algorithmic stagnation on great tweets that deserve real distribution.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Product drops and tutorials that need high bookmark velocity to trigger second-wave organic feeds.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Building genuine comment section discussions with technical depth.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Anyone looking for automated bot farms or fake scrapers (we strictly use real human accounts).</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Accounts with no clear brand identity or spammy crypto links.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Algorithmic Lift Factors</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What Organic Amplification Delivers</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Algorithm Value</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Bookmark Velocity</h3>
          <p class="text-xs text-[#9AA391]">Bookmarks are the #1 algorithmic ranking weight on modern X feeds. We stimulate natural saving.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Discussion</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Human Conversation</h3>
          <p class="text-xs text-[#9AA391]">Smart questions and relevant comments that invite other authentic readers to jump into the thread.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Protection</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">100% Genuine Accounts</h3>
          <p class="text-xs text-[#9AA391]">Zero risk of account penalties or shadowbans. All interactions originate from active tech peers.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Are the accounts real?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Always. We operate a curated network of genuine builders, developers, and tech contributors. No automated bots, ever.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How fast does amplification begin?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Within minutes of your post going live, creating the crucial early engagement velocity the X algorithm requires.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Activate Organic Amplification</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Give your best content the distribution firepower it deserves.</p>
      <a href="../contact.html?service=organic-amplification" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
