@extends('layouts.app')

@section('title', 'Case Studies & Work — Famewoven')
@section('description', 'Measurable creator marketing case studies. See verified ROAS, attributed revenue, and reduced CAC across AI and tech brands like HeyGen, Higgsfield, Omneky, and more.')

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
            "name": "Work",
            "item": "https://famewoven.com/work/index.html"
          }
        ]
      },
      {
        "@type": "CollectionPage",
        "@id": "https://famewoven.com/work/index.html#webpage",
        "url": "https://famewoven.com/work/index.html",
        "name": "Case Studies & Work — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/#organization"
        },
        "description": "Portfolio of verified creator marketing campaigns for top AI and technology companies."
      }
    ]
  }
  </script>
@endsection

@section('content')

    
    <!-- Hero Title -->
    <div class="max-w-3xl mb-12">
      <div class="label-caps text-[#D4F54F] mb-3">Verified Results</div>
      <h1 class="font-head text-5xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">Results, not reach.</h1>
      <p class="text-xl text-[#9AA391]">We judge campaigns by what hits the balance sheet. Browse case studies filtered by industry sector.</p>
    </div>

    <!-- Filter Chips (AI Tools & Platforms) -->
    <div class="flex flex-wrap items-center gap-2 mb-16" id="work-filters">
      <button data-filter="all" class="filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold bg-[#D4F54F] text-[#101210] border border-[#D4F54F] transition-all">All Companies</button>
      <button data-filter="video" class="filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 transition-all">AI Video</button>
      <button data-filter="adtech" class="filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 transition-all">Automation & AdTech</button>
      <button data-filter="creative" class="filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 transition-all">Creative AI</button>
      <button data-filter="productivity" class="filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 transition-all">Productivity & Search</button>
    </div>

    <!-- Grid of Metric Cards: Exclusively the 7 Featured AI Companies -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24" id="case-studies-grid">
      
      <!-- Company 1: HeyGen -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="video" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">Generative AI Video</span>
            <span class="font-mono text-xs text-[#9AA391]">4-Week Sprint</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            4.6x ROAS
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Multi-creator product demo campaign across 24 AI educators & tech founders demonstrating real-time avatar translation and workflow automation.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">HeyGen</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 2: higgsfield -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="video" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">Cinematic AI Video</span>
            <span class="font-mono text-xs text-[#9AA391]">Global Launch</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            -48% CAC
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Coordinated viral creator challenge showcasing cinematic camera control and character animation hooks, driving 420k+ qualified mobile app installs.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">higgsfield</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 3: omneky -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="adtech" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">AI Ad Generation</span>
            <span class="font-mono text-xs text-[#9AA391]">B2B Pipeline</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            +240% Demos
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            High-signal founder breakdowns and performance marketing threads on X driving enterprise inbound demo bookings and qualified signups.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">omneky</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 4: imagineart -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="creative" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">Creative AI & Art</span>
            <span class="font-mono text-xs text-[#9AA391]">Feature Rollout</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            2.4M Views
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Graphic designers and digital artists sharing prompt engineering workflows and comparative render tests across YouTube shorts and X.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">imagineart</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 5: flot.ai -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="productivity" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">AI Copilot & Desktop</span>
            <span class="font-mono text-xs text-[#9AA391]">30-Day Blitz</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            68k Signups
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Targeted workflow integration videos with productivity curators demonstrating seamless cross-app writing and context reading on macOS and Windows.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">flot.ai</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 6: skywork -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="productivity" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">Deep Research AI</span>
            <span class="font-mono text-xs text-[#9AA391]">Beta Expansion</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            340k Queries
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Developer and researcher seeding demonstrating multi-step document synthesis and factual citation parsing against legacy search engines.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">skywork</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

      <!-- Company 7: Sintra.ai -->
      <a href="{{ route('services.show', 'case-study') }}" class="case-study-card glass glass--lift p-8 flex flex-col justify-between group transition-all" data-category="adtech" data-cursor-view="true">
        <div>
          <div class="flex items-center justify-between mb-8">
            <span class="label-caps text-[#D4F54F]">AI Automation Bots</span>
            <span class="font-mono text-xs text-[#9AA391]">Performance Push</span>
          </div>
          <div class="font-head text-4xl sm:text-5xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-4">
            5.2x ROAS
          </div>
          <p class="text-sm text-[#9AA391] leading-relaxed">
            Solo founder and agency operator breakdown videos demonstrating pre-built AI assistants replacing 20+ hours of repetitive manual admin work weekly.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between font-mono text-xs text-[#9AA391]">
          <span class="font-bold text-[#F2F5EC]">Sintra.ai</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read breakdown →</span>
        </div>
      </a>

    </div>

    <!-- Client-side filter script -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('#work-filters .filter-btn');
        const cards = document.querySelectorAll('#case-studies-grid .case-study-card');

        filterBtns.forEach(btn => {
          btn.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');

            // Active button styles
            filterBtns.forEach(b => {
              b.className = 'filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10 transition-all';
            });
            this.className = 'filter-btn px-5 py-2 rounded-full text-xs font-mono font-semibold bg-[#D4F54F] text-[#101210] border border-[#D4F54F] transition-all';

            // Filter cards
            cards.forEach(card => {
              const cat = card.getAttribute('data-category');
              if (filter === 'all' || cat === filter) {
                card.style.display = 'flex';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
              } else {
                card.style.display = 'none';
              }
            });
          });
        });
      });
    </script>

    <!-- Final CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Want numbers like these?</h2>
      <p class="text-xs sm:text-sm text-[#101210]/80 mb-6 max-w-lg mx-auto">Let's audit your customer acquisition targets and build your creator strategy.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Book a strategy call</span><span class="btn-text-clone">Book a strategy call</span></span>
      </a>
    </div>

  
@endsection
