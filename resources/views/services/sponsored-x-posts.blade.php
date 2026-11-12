@extends('layouts.app')

@section('title', 'Sponsored X Posts — Famewoven')
@section('description', 'Single posts built around your brand or product. High-converting creator placements on X for AI, SaaS, dev tools, and tech companies.')

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
            "name": "Sponsored X Posts",
            "item": "{{ route('services.show', 'sponsored-x-posts') }}"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "{{ route('services.show', 'sponsored-x-posts') }}#service",
        "name": "Sponsored X Posts",
        "serviceType": "Creator Marketing",
        "description": "Single posts built around your brand or product. High-converting creator placements on X for AI, SaaS, dev tools, and tech companies.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "{{ route('services.show', 'sponsored-x-posts') }}",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "{{ route('services.show', 'sponsored-x-posts') }}#webpage",
        "url": "{{ route('services.show', 'sponsored-x-posts') }}",
        "name": "Sponsored X Posts — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "{{ route('services.show', 'sponsored-x-posts') }}#service"
        },
        "description": "Single posts built around your brand or product. High-converting creator placements on X for AI, SaaS, dev tools, and tech companies."
      }
    ]
  }
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
<!-- Breadcrumb -->
    <div class="mb-6 flex items-center gap-2 text-xs font-mono text-[#9AA391]">
      <a href="{{ route('services.index') }}" class="hover:text-[#D4F54F] transition-colors">Services</a>
      <span>/</span>
      <span class="text-[#D4F54F]">Content</span>
    </div>

    <!-- 1. Hero -->
    <div class="max-w-3xl mb-16">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#D4F54F]/30 bg-[#D4F54F]/10 text-xs font-mono font-semibold text-[#D4F54F] mb-4">
        Content Pillar
      </div>
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">Sponsored X Posts</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Single posts built around your brand or product. Put your tech or AI product in front of an engaged audience with authentic creator commentary.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="{{ route('contact', ['service' => 'sponsored-x-posts']) }}" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
          <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
        </a>
        <a href="{{ route('services.index') }}" class="glass glass--pill px-6 py-4 text-xs font-mono uppercase tracking-wider text-[#F2F5EC] hover:text-[#D4F54F] transition-colors">
          ← All Services
        </a>
      </div>
    </div>

    <!-- 2. Two Columns: Who it's for / Not for -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
      <div class="glass p-8 border-l-4 border-l-[#D4F54F]">
        <div class="label-caps text-[#D4F54F] mb-3">Who it's for</div>
        <ul class="space-y-3 text-sm text-[#F2F5EC]">
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> AI, SaaS, and developer tools needing precise, high-intent traffic spikes.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Brands wanting to test creator-market fit without booking a multi-month sprint.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Founders with a killer demo or feature update that speaks for itself.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Brands demanding unauthentic copy-paste press releases that get ignored.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Generic non-tech consumer goods looking for lifestyle vanity metrics.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Deliverables & Specs</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What you get in every Sponsored Post</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / Angle & Hook</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Tailored Angle Architecture</h3>
          <p class="text-xs text-[#9AA391]">We design the post around the creator's natural tone and your key value proposition.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Sign-off Control</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Pre-Launch Review</h3>
          <p class="text-xs text-[#9AA391]">Review and approve the draft, visual media, and posting window before anything goes live.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / Verified Proof</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Performance Teardown</h3>
          <p class="text-xs text-[#9AA391]">Audience reach, impressions, link clicks, bookmarks, and engagement benchmarks.</p>
        </div>
      </div>
    </div>

    <!-- 4. Execution Process -->
    <div class="mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Operating Cadence</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">How it works: from brief to live post</h2>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="glass p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-1">Step 1</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-2">Brief & Matching</h3>
          <p class="text-xs text-[#9AA391]">Tell us your product and audience; we match the top niche creator with authentic reach.</p>
        </div>
        <div class="glass p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-1">Step 2</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-2">Draft Approval</h3>
          <p class="text-xs text-[#9AA391]">Creator drafts the post in their native voice. You review and greenlight before scheduling.</p>
        </div>
        <div class="glass p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-1">Step 3</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-2">Live & Measured</h3>
          <p class="text-xs text-[#9AA391]">Post goes live during peak feed traffic with tracking links and full engagement monitoring.</p>
        </div>
      </div>
    </div>

    <!-- 5. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Can we approve the post before it goes live?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes. You review and approve the draft, visual assets, and posting window before anything is published.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>What formats are supported?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Text posts, image-led teasers, short video clips, or demo walkthroughs with direct CTA links.
        </div>
      </div>
    </div>

    <!-- 6. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Ready for your Sponsored Post?</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Tell us about your brand and receive vetted creator suggestions and rate options.</p>
      <a href="{{ route('contact', ['service' => 'sponsored-x-posts']) }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
</div>
@endsection
