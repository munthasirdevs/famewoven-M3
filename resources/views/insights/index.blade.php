@extends('layouts.app')

@section('title', 'Insights & Playbooks — Famewoven | Creator Marketing')
@section('description', 'Data-driven guides, campaign blueprints, and creator economy teardowns for AI and tech brands.')

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
          "url": "{{ asset('css/namelogo.png') }}",
          "contentUrl": "{{ asset('css/namelogo.png') }}",
          "caption": "Famewoven Logo"
        },
        "image": "{{ asset('css/namelogo.png') }}",
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
            "name": "Insights",
            "item": "{{ route('insights') }}"
          }
        ]
      },
      {
        "@type": "CollectionPage",
        "@id": "{{ route('insights') }}#webpage",
        "url": "{{ route('insights') }}",
        "name": "Insights & Research — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/#organization"
        },
        "description": "In-depth insights, teardowns, and engineering frameworks for creator distribution."
      }
    ]
  }
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
<!-- Title -->
    <div class="max-w-3xl mb-12">
      <div class="label-caps text-[#D4F54F] mb-3">Field Notes & Methodologies</div>
      <h1 class="font-head text-5xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">Insights</h1>
      <p class="text-xl text-[#9AA391]">Tactical breakdowns of creator marketing economics, fraud detection, and customer acquisition.</p>
    </div>

    <!-- Category Chips (Section 11.6) -->
    <div class="flex flex-wrap items-center gap-2 mb-16">
      <button class="px-5 py-2 rounded-full text-xs font-mono font-semibold bg-[#D4F54F] text-[#101210]">All Insights</button>
      <button class="px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">Creator Strategy</button>
      <button class="px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">Attribution & Data</button>
      <button class="px-5 py-2 rounded-full text-xs font-mono font-semibold glass text-[#9AA391] hover:text-[#F2F5EC] border border-white/10">Paid Whitelisting</button>
    </div>

    <!-- Typographic Articles Grid (No stock photo placeholders per Section 11.6) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24">
      
      <!-- Article 1 -->
      <article class="glass glass--lift p-8 flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between text-xs font-mono text-[#9AA391] mb-6">
            <span class="text-[#D4F54F]">Attribution</span>
            <span>6 min read</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-3 leading-snug">
            Why screenshot view decks are killing your marketing budget.
          </h2>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            The mathematical reality of vanity impressions vs. multi-touch UTM link tracking in Southeast Asian creator ecosystems.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-[#9AA391]">
          <span>October 2026</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read article →</span>
        </div>
      </article>

      <!-- Article 2 -->
      <article class="glass glass--lift p-8 flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between text-xs font-mono text-[#9AA391] mb-6">
            <span class="text-[#D4F54F]">Whitelisting</span>
            <span>8 min read</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-3 leading-snug">
            The Whitelisting Playbook: How to run ads through creator handles.
          </h2>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            A step-by-step technical guide to setting up Meta Partnership Ads and TikTok Spark codes to cut CAC by 35%.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-[#9AA391]">
          <span>September 2026</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read article →</span>
        </div>
      </article>

      <!-- Article 3 -->
      <article class="glass glass--lift p-8 flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between text-xs font-mono text-[#9AA391] mb-6">
            <span class="text-[#D4F54F]">Talent Vetting</span>
            <span>5 min read</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-3 leading-snug">
            15 Red Flags that expose fake influencer follower counts.
          </h2>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            How to spot engagement pods, sudden audience spikes, and geographic mismatches before signing a commercial contract.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-[#9AA391]">
          <span>September 2026</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read article →</span>
        </div>
      </article>

      <!-- Article 4 -->
      <article class="glass glass--lift p-8 flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between text-xs font-mono text-[#9AA391] mb-6">
            <span class="text-[#D4F54F]">Creative Briefing</span>
            <span>7 min read</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-3 leading-snug">
            The 3-Second Hook Rule: Structuring UGC that stops the doom-scroll.
          </h2>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            Why the first three seconds dictate 80% of video conversion value, and the 4 visual formats that work in Dhaka.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-[#9AA391]">
          <span>August 2026</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read article →</span>
        </div>
      </article>

      <!-- Article 5 -->
      <article class="glass glass--lift p-8 flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between text-xs font-mono text-[#9AA391] mb-6">
            <span class="text-[#D4F54F]">Economics</span>
            <span>6 min read</span>
          </div>
          <h2 class="font-head text-2xl font-bold text-[#F2F5EC] group-hover:text-[#D4F54F] transition-colors mb-3 leading-snug">
            Micro vs. Macro Creators: Where your marginal advertising dollar wins.
          </h2>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            Data analysis of 30+ campaigns reveals why cohorts of 10 micro-creators consistently out-convert 1 celebrity account.
          </p>
        </div>
        <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between text-xs font-mono text-[#9AA391]">
          <span>July 2026</span>
          <span class="text-[#D4F54F] group-hover:translate-x-1 transition-transform">Read article →</span>
        </div>
      </article>

      <!-- Article 6: Newsletter Callout -->
      <div class="glass glass--sub p-8 flex flex-col justify-between border-dashed border-[#D4F54F]/30 bg-[#D4F54F]/[0.02]">
        <div>
          <div class="label-caps text-[#D4F54F] mb-3">Bi-Weekly Briefing</div>
          <h3 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Subscribe to Field Notes</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed mb-6">
            Raw teardowns of creator marketing campaigns, CPM changes, and algorithmic ad strategies delivered every other Tuesday.
          </p>
          <input type="email" placeholder="work@brand.com" class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none mb-3">
        </div>
        <button onclick="alert('Subscribed to Famewoven Insights.');" class="btn-swap glass glass--lime w-full py-3 rounded-full text-center text-xs font-mono font-bold uppercase tracking-wider text-[#101210]">
          Join 1,200+ Growth Leads
        </button>
      </div>

    </div>

    <!-- Final CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Turn insights into execution.</h2>
      <p class="text-xs sm:text-sm text-[#101210]/80 mb-6 max-w-lg mx-auto">Let's build a measured creator acquisition campaign for your brand.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Book a strategy call</span><span class="btn-text-clone">Book a strategy call</span></span>
      </a>
    </div>
</div>
@endsection
