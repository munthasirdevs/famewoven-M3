@extends('layouts.app')

@section('title', 'Services — Famewoven | Creator Marketing Infrastructure')
@section('description', '14 specialized creator marketing formats on X. From sponsored posts and viral threads to coordinated launch blitzes and long-term ambassador partnerships.')

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
          }
        ]
      },
      {
        "@type": "CollectionPage",
        "@id": "https://famewoven.com/services/index.html#webpage",
        "url": "https://famewoven.com/services/index.html",
        "name": "Services — Famewoven | Creator Marketing Infrastructure",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/#organization"
        },
        "description": "Catalog of 14 high-impact creator marketing campaign formats on X."
      }
    ]
  }
  </script>
@endsection

@section('content')

    <!-- Header Hero -->
    <div class="max-w-3xl mb-12">
      <div class="label-caps text-[#D4F54F] mb-3">Service Architecture</div>
      <h1 class="font-head text-5xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">Services</h1>
      <p class="text-lg sm:text-xl text-[#9AA391] leading-relaxed">
        Everything between a brief and a result. 14 specialized creator marketing formats built for commercial velocity on X.
      </p>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-12">
      <button data-filter="all" class="filter-tab px-5 py-2.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wider transition-all duration-300 bg-[#D4F54F] text-[#101210] shadow-lg shadow-[#D4F54F]/10">
        All (14)
      </button>
      <button data-filter="content" class="filter-tab px-5 py-2.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wider transition-all duration-300 glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">
        Content (4)
      </button>
      <button data-filter="campaigns" class="filter-tab px-5 py-2.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wider transition-all duration-300 glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">
        Campaigns (6)
      </button>
      <button data-filter="partnerships" class="filter-tab px-5 py-2.5 rounded-full text-xs font-mono font-semibold uppercase tracking-wider transition-all duration-300 glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">
        Partnerships & Growth (4)
      </button>
    </div>

    <!-- 14 Service Cards Grid -->
    <div id="services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-24">
      
      <!-- 01: Sponsored X Posts (Content) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="content">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-[#D4F54F]">
              Content
            </span>
            <span class="font-mono text-xs text-[#9AA391]">01 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Sponsored X Posts
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Single posts built around your brand or product.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Native creator voice integration</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Draft review before publishing</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Direct link & tracking setup</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=sponsored-x-posts" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'sponsored-x-posts') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 02: X Threads (Content) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="content">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-[#D4F54F]">
              Content
            </span>
            <span class="font-mono text-xs text-[#9AA391]">02 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            X Threads
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Educational, storytelling, product-led or launch threads.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Viral hook & frame structure</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Workflow & code breakdowns</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> High bookmark velocity design</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=x-threads" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'x-threads') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 03: Quote Reposts (Content) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="content">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-[#D4F54F]">
              Content
            </span>
            <span class="font-mono text-xs text-[#9AA391]">03 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Quote Reposts
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Relevant creators quote and boost your official posts.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Instant social proof & authority</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Staggered timing for momentum</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Traffic directed to main handle</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=quote-reposts" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'quote-reposts') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 04: Organic Amplification (Content) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="content">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-[#D4F54F]">
              Content
            </span>
            <span class="font-mono text-xs text-[#9AA391]">04 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Organic Amplification
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Real likes, reposts, replies and bookmarks from engaged accounts.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> High bookmark velocity triggers</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Real human builder interactions</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Zero bot penalty or shadowban risk</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=organic-amplification" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'organic-amplification') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 05: Launch Campaigns (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">05 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Launch Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Creator posts timed together around your product launch.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Coordinated launch-day surge</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Multi-angle creator coverage</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Live traffic & sign-up monitoring</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=launch-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'launch-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 06: Product Promotion (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">06 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Product Promotion
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Awareness campaigns for AI, SaaS and tech products.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Hands-on workflow screen demos</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Conversion-focused CTA links</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Continuous buyer acquisition</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=product-promotion" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'product-promotion') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 07: Multi-Creator Campaigns (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">07 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Multi-Creator Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            10 to 100+ creators working under one campaign.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Complete category feed omnipresence</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Turnkey cohort administration</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Aggregate performance reporting</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=multi-creator-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'multi-creator-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 08: Founder/CEO Campaigns (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">08 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Founder/CEO Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Creator campaigns aimed at builders, founders and decision-makers.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> B2B enterprise & dev infra reach</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> High-credibility peer endorsement</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Inbound demo pipeline generation</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=founder-ceo-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'founder-ceo-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 09: Trend & Narrative Campaigns (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">09 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Trend & Narrative Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Many creators talking about one product, feature or topic at once.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Industry category definition</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Synchronized debate sparks</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Viral feed narrative control</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=trend-narrative-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'trend-narrative-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 10: Performance Campaigns (Campaigns) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="campaigns">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#7CB83A]/40 bg-[#7CB83A]/10 text-[#F0FFB0]">
              Campaigns
            </span>
            <span class="font-mono text-xs text-[#9AA391]">10 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Performance Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Built to hit agreed KPIs for reach, impressions or engagement.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Pre-agreed KPI milestone targets</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Dynamic budget re-routing</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Complete CPM, CPC & CPA audit</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=performance-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'performance-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 11: Creator Seeding (Partnerships & Growth) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="partnerships">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#9AA391]/30 bg-white/[0.04] text-[#F2F5EC]">
              Partnerships & Growth
            </span>
            <span class="font-mono text-xs text-[#9AA391]">11 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Creator Seeding
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Your product or early access, sent to the right AI and tech creators.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> VIP beta access distribution</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> High-authority power user adoption</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Spontaneous post tracking & alerts</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=creator-seeding" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'creator-seeding') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 12: Influencer Outreach (Partnerships & Growth) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="partnerships">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#9AA391]/30 bg-white/[0.04] text-[#F2F5EC]">
              Partnerships & Growth
            </span>
            <span class="font-mono text-xs text-[#9AA391]">12 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Influencer Outreach
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Finding creators, negotiating terms and onboarding them.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Direct relationships & 85%+ response</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Fair-market rate negotiations</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Legal contracts & escrow payouts</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=influencer-outreach" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'influencer-outreach') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 13: Long-Term Creator Partnerships (Partnerships & Growth) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="partnerships">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#9AA391]/30 bg-white/[0.04] text-[#F2F5EC]">
              Partnerships & Growth
            </span>
            <span class="font-mono text-xs text-[#9AA391]">13 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Long-Term Creator Partnerships
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            Ongoing work with creators, monthly or in batches.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Dedicated brand ambassador roster</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Strict competitor category lockout</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Compounding trust & retention</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=long-term-creator-partnerships" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'long-term-creator-partnerships') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

      <!-- 14: Custom X Campaigns (Partnerships & Growth) -->
      <div class="service-card glass glass--lift p-7 flex flex-col justify-between group transition-all" data-category="partnerships">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-semibold border border-[#9AA391]/30 bg-white/[0.04] text-[#F2F5EC]">
              Partnerships & Growth
            </span>
            <span class="font-mono text-xs text-[#9AA391]">14 / 14</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-2">
            Custom X Campaigns
          </h2>
          <p class="text-sm text-[#9AA391] leading-relaxed mb-6">
            A creator plan designed around your goals and budget.
          </p>
          <ul class="space-y-2 text-xs font-mono text-[#F2F5EC]/80 mb-6">
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Bespoke cross-format architecture</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Engineered to exact budget parameters</li>
            <li class="flex items-center gap-2"><span class="text-[#D4F54F]">✓</span> Strategic roadmap delivered in 48h</li>
          </ul>
        </div>
        <div class="pt-5 border-t border-white/10 flex items-center justify-between gap-3">
          <a href="../contact.html?service=custom-x-campaigns" class="btn-swap glass glass--lime px-5 py-2.5 rounded-full text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
            <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
          </a>
          <a href="{{ route('services.show', 'custom-x-campaigns') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors flex items-center gap-1">
            Details <span>→</span>
          </a>
        </div>
      </div>

    </div>

    <!-- The Weave System Link Banner -->
    <div class="glass p-10 text-center mb-16">
      <div class="label-caps text-[#D4F54F] mb-2">Standardized Process</div>
      <h3 class="font-head text-3xl font-bold text-[#F2F5EC] mb-3">Powered by The Weave System</h3>
      <p class="text-sm text-[#9AA391] max-w-xl mx-auto mb-6">Every service we offer is executed under our proven 4-step framework: Map → Match → Make → Measure.</p>
      <a href="../index.html#weave-system-section" class="inline-flex items-center gap-2 font-mono text-sm text-[#D4F54F] hover:underline font-semibold">
        View Operating Framework <span>→</span>
      </a>
    </div>

    <!-- Final CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Ready to build your campaign?</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Get a full creative strategy and creator shortlist proposal within 48 hours.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
