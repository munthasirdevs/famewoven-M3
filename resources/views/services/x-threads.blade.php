@extends('layouts.app')

@section('title', 'X Threads — Famewoven')
@section('description', 'Educational, storytelling, product-led or launch threads. In-depth formats on X that convert technical audiences and build authority.')

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
            "name": "X Threads",
            "item": "https://famewoven.com/services/x-threads.html"
          }
        ]
      },
      {
        "@type": "Service",
        "@id": "https://famewoven.com/services/x-threads.html#service",
        "name": "X Threads",
        "serviceType": "Creator Marketing",
        "description": "Educational, storytelling, product-led or launch threads. In-depth formats on X that convert technical audiences and build authority.",
        "provider": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "https://famewoven.com/services/x-threads.html",
        "areaServed": "Global",
        "audience": {
          "@type": "Audience",
          "audienceType": "AI, SaaS, and Technology Companies"
        }
      },
      {
        "@type": "WebPage",
        "@id": "https://famewoven.com/services/x-threads.html#webpage",
        "url": "https://famewoven.com/services/x-threads.html",
        "name": "X Threads — Famewoven",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": {
          "@id": "https://famewoven.com/services/x-threads.html#service"
        },
        "description": "Educational, storytelling, product-led or launch threads. In-depth formats on X that convert technical audiences and build authority."
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
      <h1 class="font-head text-4xl sm:text-6xl font-bold tracking-tight text-[#F2F5EC] mb-4">X Threads</h1>
      <p class="text-xl text-[#9AA391] mb-8 leading-relaxed font-normal">
        Educational, storytelling, product-led or launch threads. Turn your software workflows, engineering breakthroughs, and product narratives into viral, bookmark-worthy long-form reads.
      </p>
      <div class="flex flex-wrap items-center gap-4">
        <a href="../contact.html?service=x-threads" class="btn-swap glass glass--lime glass--pill px-8 py-4 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] shadow-xl">
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
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Products with genuine depth: AI workflows, developer infrastructure, API platforms, and SaaS suites.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Founders sharing the build story, technical architecture, or benchmark comparisons.</li>
          <li class="flex items-start gap-2"><span class="text-[#D4F54F] font-bold">✓</span> Teams looking to generate high-intent bookmarks and long-tail organic search presence on X.</li>
        </ul>
      </div>

      <div class="glass p-8 border-l-4 border-l-rose-500/60">
        <div class="label-caps text-rose-400 mb-3">Who it's not for</div>
        <ul class="space-y-3 text-sm text-[#9AA391]">
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Superficial products with no real substance or problem-solving capability.</li>
          <li class="flex items-start gap-2"><span class="text-rose-400 font-bold">✕</span> Brands unwilling to let creators explain concepts in their natural, authoritative technical voice.</li>
        </ul>
      </div>
    </div>

    <!-- 3. Deliverables -->
    <div class="glass p-10 mb-20">
      <div class="label-caps text-[#D4F54F] mb-3">Thread Architecture</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-8">What you get in an X Thread Campaign</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">01 / The Hook</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Magnetic Hook & Frame</h3>
          <p class="text-xs text-[#9AA391]">A compelling first post engineered to stop feed scrolling and demand thread expansion.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">02 / Educational Core</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Step-by-Step Breakdown</h3>
          <p class="text-xs text-[#9AA391]">Value-first insights, real code/screen snippets, and workflow explanations that prove utility.</p>
        </div>
        <div class="glass glass--sub p-6">
          <span class="font-mono text-xs text-[#D4F54F] block mb-2">03 / The Closer</span>
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">High-Conversion CTA</h3>
          <p class="text-xs text-[#9AA391]">Clear, unmissable closing link driving readers straight to your trial, repo, or signup page.</p>
        </div>
      </div>
    </div>

    <!-- 4. FAQ -->
    <div class="max-w-2xl mx-auto mb-20 space-y-4">
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>How many posts are typically in a thread?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Most high-performing threads range from 5 to 10 posts, optimizing for readability, algorithm engagement, and retention.
        </div>
      </div>
      <div class="faq-accordion-item glass">
        <button class="faq-trigger w-full p-5 text-left flex justify-between font-semibold text-sm sm:text-base text-[#F2F5EC]" aria-expanded="false">
          <span>Can we include visual assets and screen recordings?</span>
          <span class="faq-icon text-[#D4F54F] font-mono">+</span>
        </button>
        <div class="faq-answer-inner px-5 pb-5 text-xs text-[#9AA391]">
          Yes! Custom diagrams, UI gifs, architecture charts, and terminal captures significantly elevate thread save rates.
        </div>
      </div>
    </div>

    <!-- 5. Bottom CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Deploy an in-depth X Thread</h2>
      <p class="text-sm sm:text-base text-[#101210]/80 mb-6 max-w-lg mx-auto">Turn complex product value into viral clarity with trusted tech creators.</p>
      <a href="../contact.html?service=x-threads" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Start brief</span><span class="btn-text-clone">Start brief</span></span>
      </a>
    </div>
  
@endsection
