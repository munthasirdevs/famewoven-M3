@extends('layouts.app')

@section('title', 'Custom X Campaigns — Famewoven')
@section('description', 'A creator plan designed around your goals and budget. Bespoke influencer campaigns on X for AI, SaaS, dev tools, and tech companies.')

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
            "name": "Custom X Campaigns",
            "item": "https://famewoven.com/services/custom-x-campaigns.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/custom-x-campaigns.html#service",
        "name": "Custom X Campaigns",
        "serviceType": "Creator Marketing",
        "description": "A creator plan designed around your goals and budget. Bespoke influencer campaigns on X for AI, SaaS, dev tools, and tech companies.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/custom-x-campaigns.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/custom-x-campaigns.html#webpage",
        "url": "https://famewoven.com/services/custom-x-campaigns.html",
        "name": "Custom X Campaigns — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/custom-x-campaigns.html#service"
        },
        "description": "A creator plan designed around your goals and budget. Bespoke influencer campaigns on X for AI, SaaS, dev tools, and tech companies."
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
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Custom X Campaigns</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        A creator plan designed around your goals and budget. Tell us your target acquisition cost, launch window, and niche, and we'll architect the exact creator setup that delivers maximum impact.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=custom-x-campaigns" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Brands with non-standard requirements (e.g., hybrid Web3/AI launches, hackathons, event livestreams).</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Teams with specific budget guardrails who want the optimal creator mix engineered for that exact amount.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Multi-phase rollouts that combine seeding, launch bursts, and ongoing quote amplification.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Teams looking for automated, hands-off commodity directory listings.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Campaigns without a clear decision-maker to approve the custom proposal.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Custom Architecture</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What a Custom Campaign Includes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Architecture</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Bespoke Strategy Blueprint</h3>
          <p class="text-xs text-[#9AA391]">A tailored document outlining creator allocation, posting cadence, angles, and expected metrics.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Talent Mix</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Tailored Roster Selection</h3>
          <p class="text-xs text-[#9AA391]">Handpicked creators matched specifically to your target ICP, tech stack, and audience geographies.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Flexibility</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Agile Flight Control</h3>
          <p class="text-xs text-[#9AA391]">Ability to pivot angles, introduce new hooks, or extend high-converting creators mid-flight.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How does the strategy proposal process work?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Fill out the brief with your goals and budget range. We schedule a 20-minute strategy call and deliver a tailored proposal within 48 hours.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Can we combine multiple service formats?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes, that is the primary power of Custom Campaigns: pairing threads with quote repost waves and ongoing seeding.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Build your custom plan</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Tell us what you want to achieve and get a custom creator roadmap built for your brand.</p>
      <a href="../contact.html?service=custom-x-campaigns" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
