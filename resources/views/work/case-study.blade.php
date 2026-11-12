@extends('layouts.app')

@section('title', '4.6x ROAS in 4 Weeks — HeyGen AI Case Study | Famewoven')
@section('description', 'How HeyGen generated $3.84M in verified pipeline revenue with a 4.6x ROAS across 24 vetted AI creators and whitelisted paid social ads.')

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
        "url": "https://famewoven.com/about.html",
        "disambiguatingDescription": "Founder and Systems Architect of Famewoven, specializing in quantitative creator distribution networks and AI marketing systems. Frequently transliterated or searched as Muntasir Rahman.",
        "sameAs": [
          "https://famewoven.com/about.html",
          "https://github.com/munthasir"
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
          },
          {
            "@type": "ListItem",
            "position": 3,
            "name": "HeyGen AI Case Study",
            "item": "https://famewoven.com/work/case-study.html"
          }
        ]
      },
      {
        "@type": "Article",
        "@id": "https://famewoven.com/work/case-study.html#article",
        "headline": "4.6x ROAS in 4 Weeks — HeyGen AI Case Study",
        "url": "https://famewoven.com/work/case-study.html",
        "description": "How HeyGen generated $3.84M in verified pipeline revenue with a 4.6x ROAS across 24 vetted AI creators and whitelisted paid social ads.",
        "author": {
          "@id": "https://famewoven.com/#person"
        },
        "publisher": {
          "@id": "https://famewoven.com/#organization"
        },
        "datePublished": "2026-10-15T00:00:00+06:00",
        "dateModified": "2026-11-01T00:00:00+06:00",
        "mainEntityOfPage": "https://famewoven.com/work/case-study.html",
        "image": "https://famewoven.com/css/namelogo.png"
      }
    ]
  }
  </script>
@endsection

@section('content')

    
    <!-- Breadcrumb -->
    <div class="mb-8 font-mono text-xs text-[#9AA391]">
      <a href="{{ route('home') }}" class="hover:text-[#F2F5EC]">Case Studies</a> / <span class="text-[#D4F54F]">HeyGen</span>
    </div>

    <!-- H1 = The Result (Blueprint spec 11.4) -->
    <div class="mb-14">
      <div class="label-caps text-[#D4F54F] mb-3">Case Study · Generative AI Video</div>
      <h1 class="font-head text-4xl sm:text-7xl font-bold tracking-tight text-[#F2F5EC] mb-4">
        4.6x ROAS in 4 weeks.
      </h1>
      <p class="text-xl text-[#9AA391] leading-relaxed">
        How HeyGen bypassed generative AI market noise by turning 24 vetted AI creators into an enterprise customer acquisition engine.
      </p>
    </div>

    <!-- Results Counter Band (Blueprint spec 11.4) -->
    <div class="glass p-8 mb-16 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
      <div>
        <div class="font-head text-3xl sm:text-4xl font-bold text-[#D4F54F]">$3.84M</div>
        <div class="label-caps text-[#9AA391] mt-1">Tracked Revenue</div>
      </div>
      <div>
        <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC]">4.6x</div>
        <div class="label-caps text-[#9AA391] mt-1">Verified ROAS</div>
      </div>
      <div>
        <div class="font-head text-3xl sm:text-4xl font-bold text-[#D4F54F]">24</div>
        <div class="label-caps text-[#9AA391] mt-1">Creators Deployed</div>
      </div>
      <div>
        <div class="font-head text-3xl sm:text-4xl font-bold text-[#F2F5EC]">-42%</div>
        <div class="label-caps text-[#9AA391] mt-1">Blended CAC</div>
      </div>
    </div>

    <!-- Challenge Section -->
    <section class="mb-16">
      <div class="label-caps text-[#D4F54F] mb-2">01 / The Challenge</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-4">Ad blindness and creative noise in generative AI</h2>
      <p class="text-base text-[#9AA391] leading-relaxed mb-4">
        HeyGen was facing rising customer acquisition costs on traditional paid social ads as tech audiences developed severe banner blindness to generic studio screen-recordings. Previous sponsorship experiments had underdelivered: macro tech reviewers gave surface-level shoutouts without demonstrating true workflow integrations, failing to convert business trials.
      </p>
      <p class="text-base text-[#9AA391] leading-relaxed">
        The challenge was proving HeyGen's instant avatar translation and production speed to enterprise video teams who needed tangible workflow proof before buying quarterly licenses.
      </p>
    </section>

    <!-- Approach Section -->
    <section class="mb-16">
      <div class="label-caps text-[#D4F54F] mb-2">02 / The Approach</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-4">Deploying The Weave System</h2>
      
      <div class="space-y-6">
        <div class="glass p-6">
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Phase 1: High-Signal AI Practitioner Vetting</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            We audited 90+ tech and productivity creators, disqualifying channels with inflated vanity metrics. The remaining 24 creators had verified 80%+ audiences of corporate video producers, growth marketers, and software engineers with direct corporate purchasing power.
          </p>
        </div>

        <div class="glass p-6">
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Phase 2: Use-Case Hook Testing & Workflow Briefs</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            Instead of static talking-head clips, creators filmed authentic vertical workflows: multi-lingual team dubbing in seconds, real estate video translation, and automated marketing video funnels. Each creator tested three distinct 3-second opening hook variations.
          </p>
        </div>

        <div class="glass p-6">
          <h3 class="font-head text-lg font-bold text-[#F2F5EC] mb-1">Phase 3: Creator Whitelisting & Paid Amplification</h3>
          <p class="text-xs text-[#9AA391] leading-relaxed">
            We secured advertising rights to the creators' handles. The top 6 organically performing workflow videos were immediately scaled through Meta and X Spark partnership ads, directing high-intent viewers directly into interactive trial funnels.
          </p>
        </div>
      </div>
    </section>

    <!-- Creators Used Section -->
    <section class="mb-16">
      <div class="label-caps text-[#D4F54F] mb-2">03 / Creators Used</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-6">Talent Cohort Composition</h2>
      
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="glass p-6 text-center">
          <div class="font-mono text-2xl font-bold text-[#D4F54F]">14</div>
          <div class="text-sm font-semibold text-[#F2F5EC] mt-1">Micro Tech Creators</div>
          <div class="text-xs text-[#9AA391] mt-1">15k - 45k Followers</div>
          <div class="text-[11px] text-[#9AA391] mt-2">Drove 52% of direct free trial signups.</div>
        </div>

        <div class="glass p-6 text-center">
          <div class="font-mono text-2xl font-bold text-[#D4F54F]">7</div>
          <div class="text-sm font-semibold text-[#F2F5EC] mt-1">Mid-Tier AI Educators</div>
          <div class="text-xs text-[#9AA391] mt-1">60k - 180k Followers</div>
          <div class="text-[11px] text-[#9AA391] mt-2">Delivered deep workflow retention & enterprise trial starts.</div>
        </div>

        <div class="glass p-6 text-center">
          <div class="font-mono text-2xl font-bold text-[#D4F54F]">3</div>
          <div class="text-sm font-semibold text-[#F2F5EC] mt-1">Category Headliners</div>
          <div class="text-xs text-[#9AA391] mt-1">250k+ Followers</div>
          <div class="text-[11px] text-[#9AA391] mt-2">Anchored massive industry credibility and viral reach on X.</div>
        </div>
      </div>
    </section>

    <!-- One Big Quote (Blueprint spec 11.4) -->
    <div class="glass p-10 sm:p-14 my-16 border-l-4 border-l-[#D4F54F]">
      <blockquote class="font-head text-2xl sm:text-3xl font-medium text-[#F2F5EC] leading-relaxed mb-6">
        "Working with Famewoven felt like partnering with a quantitative growth team, not a traditional agency. We could see the exact revenue generated by each creator in real time."
      </blockquote>
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-[#D4F54F] text-[#101210] font-bold text-sm flex items-center justify-center font-mono">TR</div>
        <div>
          <div class="font-mono text-sm font-semibold text-[#F2F5EC]">Tanvir Rahman</div>
          <div class="text-xs text-[#9AA391]">Head of Growth · HeyGen</div>
        </div>
      </div>
    </div>

    <!-- What We'd Do Next (Blueprint spec 11.4) -->
    <section class="mb-20">
      <div class="label-caps text-[#D4F54F] mb-2">04 / Growth Trajectory</div>
      <h2 class="font-head text-3xl font-bold text-[#F2F5EC] mb-4">What we'd do next</h2>
      <p class="text-base text-[#9AA391] leading-relaxed mb-4">
        Following this benchmark sprint, HeyGen transitioned the top 6 performing creators into annual brand ambassador agreements with guaranteed monthly video retainers.
      </p>
      <p class="text-base text-[#9AA391] leading-relaxed">
        The raw demonstration footage and hook variants were reorganized into a modular 50-asset creative library, allowing HeyGen's internal growth team to continuously test high-converting iterations without paying new agency fees.
      </p>
    </section>

    <!-- Final CTA -->
    <div class="glass glass--lime p-10 sm:p-14 rounded-3xl text-center">
      <h2 class="font-head text-3xl font-bold text-[#101210] mb-2">Ready to engineer results like these?</h2>
      <p class="text-xs sm:text-sm text-[#101210]/80 mb-6 max-w-lg mx-auto">Let's build a dedicated creator strategy sprint for your brand.</p>
      <a href="{{ route('contact') }}" class="btn-swap inline-flex px-8 py-3.5 bg-[#101210] text-[#F2F5EC] rounded-full text-xs font-mono font-bold uppercase tracking-wider">
        <span class="btn-text-wrap"><span class="btn-text-primary">Book a strategy call</span><span class="btn-text-clone">Book a strategy call</span></span>
      </a>
    </div>

  
@endsection
