@extends('layouts.app')

@section('title', 'Influencer Outreach — Famewoven')
@section('description', 'Finding creators, negotiating terms and onboarding them. End-to-end creator outreach on X for AI, SaaS, and developer tools.')

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
            "name": "Services",
            "item": "{{ route('services.index') }}"
          },
          {
            "@type": "ListItem",
            "position": 3,
            "name": "Influencer Outreach",
            "item": "{{ route('services.show', 'influencer-outreach') }}"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "{{ route('services.show', 'influencer-outreach') }}#service",
        "name": "Influencer Outreach",
        "serviceType": "Creator Marketing",
        "description": "Finding creators, negotiating terms and onboarding them. End-to-end creator outreach on X for AI, SaaS, and developer tools.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "{{ route('services.show', 'influencer-outreach') }}",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "{{ route('services.show', 'influencer-outreach') }}#webpage",
        "url": "{{ route('services.show', 'influencer-outreach') }}",
        "name": "Influencer Outreach — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "{{ route('services.show', 'influencer-outreach') }}#service"
        },
        "description": "Finding creators, negotiating terms and onboarding them. End-to-end creator outreach on X for AI, SaaS, and developer tools."
      }
    ]
  }
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
<div class="mb-6 flex items-center gap-2 text-xs font-mono text-[#9AA391]">
      <a href="{{ route('services.index') }}" class="hover:text-[#D4F54F] transition-colors">Services</a>
      <span>/</span>
      <span class="text-[#D4F54F]">Partnerships & Growth</span>
    </div>

    <!-- 1. Hero -->
    <div class="max-w-3xl mb-16">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-xs font-mono font-semibold text-[#D4F54F] mb-4">
        Partnerships & Growth Pillar
      </div>
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Influencer Outreach</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Finding creators, negotiating terms and onboarding them. Stop spending 40 hours a week chasing unread DMs—let our established creator relationships do the heavy lifting.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="{{ route('contact', ['service' => 'influencer-outreach']) }}" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
          <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
        </a>
        <a href="{{ route('services.index') }}" class="glass glass--pill px-6 py-4 text-xs font-mono uppercase tracking-wider text-[#F2F5EC] hover:text-[#D4F54F] transition-colors">
          ← All Services
        </a>
      </div>
    </div>

    <!-- 2. Two Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
      <div class="glass p-8 border-l-4 border-l-[#D4F54F]">
        <div class="label-caps text-[#D4F54F] mb-3">Who it's for</div>
        <ul class="space-y-3 text-sm text-[#F2F5EC]">
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Internal marketing teams that lack the bandwidth to manage high-volume creator communication.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Startups looking for pre-negotiated, fair-market rates without middleman agency inflation.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Ensuring legal usage rights, non-disclosure compliance, and fast-track onboarding.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Automated spam email blasts that destroy brand reputation among creators.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Brands that take 3 weeks to respond to creator approval questions.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Talent Operations</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What Influencer Outreach Delivers</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Relations</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Direct Creator Access</h3>
          <p class="text-xs text-[#9AA391]">We contact creators through warm relationships and direct manager channels with 85%+ response rates.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Commercials</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Rate Negotiation</h3>
          <p class="text-xs text-[#9AA391]">Pre-negotiated package pricing, bundle discounts, and performance bonuses that protect your budget.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Contracts</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Ironclad Onboarding</h3>
          <p class="text-xs text-[#9AA391]">Standardized agreements covering content rights, delivery dates, exclusivity, and escrow payouts.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Do we own the creator relationship afterwards?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes, we operate transparently and never hide creator identities or lock you out of direct contact.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How fast can talent be secured?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Typically 48 to 72 hours from brief approval to contract sign-off across our existing vetted network.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Delegate creator outreach</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Get booked, onboarded creator talent ready to deploy without the administrative grind.</p>
      <a href="{{ route('contact', ['service' => 'influencer-outreach']) }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
</div>
@endsection
