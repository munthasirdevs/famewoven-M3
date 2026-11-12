@extends('layouts.app')

@section('title', 'About Us — Famewoven | The Infrastructure Behind Influence')
@section('description', 'We build the infrastructure behind influence. Learn about our operating principles, origin story, and founder Munthasir Rahman (transliterated as Muntasir Rahman).')

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
        "@type": "Person",
        "@id": "https://famewoven.com/#person",
        "name": "Munthasir Rahman",
        "alternateName": [
          "Munthasir",
          "Muntasir",
          "Muntasir Rahman",
          "Md Munthasir",
          "Md Muntasir",
          "Montasir"
        ],
        "jobTitle": "Managing Partner & Systems Architect",
        "worksFor": {
          "@id": "https://famewoven.com/#organization"
        },
        "url": "{{ route('about') }}",
        "disambiguatingDescription": "Founder and Systems Architect of Famewoven, specializing in quantitative creator distribution networks and AI marketing systems. Frequently transliterated or searched as Muntasir Rahman.",
        "sameAs": [
          "{{ route('about') }}",
          "https://github.com/munthasir"
        ]
      },
      {
        "@type": "WebSite",
        "@id": "https://famewoven.com/#website",
        "url": "https://famewoven.com/",
        "name": "Famewoven",
        "description": "Where Influence Is Woven — Creator Marketing Agency",
        "publisher": {
          "@id": "https://famewoven.com/#organization"
        },
        "inLanguage": "en-US"
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
            "name": "About",
            "item": "{{ route('about') }}"
          }
        ]
      },
      {
        "@type": "AboutPage",
        "@id": "{{ route('about') }}#webpage",
        "url": "{{ route('about') }}",
        "name": "About Us — Famewoven | The Infrastructure Behind Influence",
        "isPartOf": {
          "@id": "https://famewoven.com/#website"
        },
        "about": [
          {
            "@id": "https://famewoven.com/#organization"
          },
          {
            "@id": "https://famewoven.com/#person"
          }
        ],
        "description": "Learn about Famewoven's operating principles, origin story, and founder Munthasir Rahman (transliterated as Muntasir Rahman)."
      }
    ]
  }
</script>
@endsection

@section('content')
<div class="pt-36 pb-24 px-6 sm:px-10 lg:px-16 max-w-[1280px] mx-auto">
<!-- Hero (Blueprint spec 11.5) -->
    <div class="max-w-4xl mb-24">
      <div class="label-caps text-[#D4F54F] mb-3">Our Mandate</div>
      <h1 class="font-head text-4xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-8 leading-[1.05]">
        We build the infrastructure behind influence.
      </h1>

      <!-- Story in 3 short paragraphs (Blueprint spec 11.5) -->
      <div class="space-y-6 text-lg sm:text-xl text-[#9AA391] leading-relaxed max-w-3xl">
        <p>
          Creator marketing is the most potent trust mechanism in modern commerce. When someone we follow demonstrates how an outfit fits or how an app works, we believe them in seconds. Yet 90% of brands still run creator marketing like an improvised freelance experiment: trading chaotic WhatsApp voice notes, guessing follower counts, and paying invoices for vanity screenshot decks.
        </p>
        <p>
          Famewoven was built to replace that chaos with software-like precision. We engineer campaigns around real financial attribution: multi-layer fraud vetting, direct response creative hooks, whitelisted social ad rights, and tracked e-commerce promo codes.
        </p>
        <p>
          Headquartered in Dhaka with global operating standards, we weave growth brands into authentic creator culture—and track every single dollar earned along the way.
        </p>
      </div>
    </div>

    <!-- 4 Principles (Section 11.5) -->
    <div class="mb-24">
      <div class="label-caps text-[#D4F54F] mb-3">Operating Philosophy</div>
      <h2 class="font-head text-3xl sm:text-5xl font-bold tracking-tight text-[#F2F5EC] mb-12">How we work</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Principle 1 -->
        <div class="glass glass--lift p-8">
          <div class="font-mono text-xs text-[#D4F54F] mb-4">01 / DISCIPLINE</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Systems over hustle.</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            We don't scramble. We operate through our 4-step Weave System. Predictable processes yield repeatable commercial outcomes.
          </p>
        </div>

        <!-- Principle 2 -->
        <div class="glass glass--lift p-8">
          <div class="font-mono text-xs text-[#D4F54F] mb-4">02 / PROOF</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Numbers over vibes.</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            Impressions and likes do not pay payroll. We optimize for customer acquisition cost, checkout conversion rate, and net verified ROAS.
          </p>
        </div>

        <!-- Principle 3 -->
        <div class="glass glass--lift p-8">
          <div class="font-mono text-xs text-[#D4F54F] mb-4">03 / FOCUS</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Fewer clients, better work.</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            We intentionally cap our active client roster to preserve obsessive attention to detail and uncompromising talent quality.
          </p>
        </div>

        <!-- Principle 4 -->
        <div class="glass glass--lift p-8">
          <div class="font-mono text-xs text-[#D4F54F] mb-4">04 / CANDOR</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC] mb-2">Say it straight.</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            No agency buzzwords, no inflated view claims, and no false promises. If an angle or creator won't convert, we tell you immediately.
          </p>
        </div>
      </div>
    </div>

    <!-- Team Row (Blueprint spec 11.5: initials in glass circles) -->
    <div class="glass p-10 sm:p-14 mb-24">
      <div class="label-caps text-[#D4F54F] mb-2">Core Leadership</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-10">The team engineering the weave</h2>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div class="flex items-start gap-4">
          <div class="w-14 h-14 rounded-full glass glass--sub border border-[#D4F54F]/40 text-[#D4F54F] flex items-center justify-center font-mono font-bold text-lg flex-shrink-0">
            MR
          </div>
          <div>
            <div class="font-head text-lg font-bold text-[#F2F5EC]">Munthasir Rahman</div>
            <div class="text-xs text-[#D4F54F] font-mono mb-2">Managing Partner &amp; Systems</div>
            <p class="text-xs text-[#9AA391] leading-relaxed">
              Founder and Systems Architect of Famewoven. Munthasir (frequently transliterated or searched as Muntasir Rahman) engineers quantitative creator distribution networks, viral campaign mechanics, and attribution infrastructure for high-growth tech platforms.
            </p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-14 h-14 rounded-full glass glass--sub border border-white/20 text-[#F2F5EC] flex items-center justify-center font-mono font-bold text-lg flex-shrink-0">
            NK
          </div>
          <div>
            <div class="font-head text-lg font-bold text-[#F2F5EC]">Nabila Khan</div>
            <div class="text-xs text-[#9AA391] font-mono mb-2">Head of Creator Talent &amp; QA</div>
            <p class="text-xs text-[#9AA391] leading-relaxed">
              Oversees creator vetting, brand-safety filtering, and contract execution across our curated roster of 500+ verified creators on X.
            </p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-14 h-14 rounded-full glass glass--sub border border-white/20 text-[#F2F5EC] flex items-center justify-center font-mono font-bold text-lg flex-shrink-0">
            ZK
          </div>
          <div>
            <div class="font-head text-lg font-bold text-[#F2F5EC]">Zain Karim</div>
            <div class="text-xs text-[#9AA391] font-mono mb-2">Performance Media &amp; Growth</div>
            <p class="text-xs text-[#9AA391] leading-relaxed">
              Manages creator ad whitelisting, paid amplification pipelines, conversion tracking, and multi-touch attribution analytics.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Final CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl sm:text-5xl font-bold text-[#101210] mb-3">Partner with Famewoven.</h2>
      <p class="text-xs sm:text-sm text-[#101210]/80 mb-6 max-w-lg mx-auto">Let's discuss your acquisition targets and how our creator system can scale your revenue.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Book a strategy call</span><span class="btn-text-clone">Book a strategy call</span></span>
      </a>
    </div>
</div>
@endsection
