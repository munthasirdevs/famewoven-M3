<header id="main-header" class="fixed top-4 inset-x-0 z-50 px-4 transition-transform duration-300 pointer-events-none flex justify-center">
  <div id="header-pill" class="glass glass--pill max-w-[1100px] w-full px-5 py-3 flex items-center justify-between pointer-events-auto transition-all duration-300">

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="flex items-center group focus:outline-none" aria-label="Famewoven Home">
      <img src="{{ asset('css/namelogo.png') }}" alt="Famewoven" class="h-7 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
    </a>

    <!-- Desktop Nav Items Track with Sliding Lime Dot -->
    <nav class="hidden md:flex items-center gap-1 relative px-3 py-1" id="nav-items-track" aria-label="Primary Navigation">
      <div id="nav-active-dot" class="absolute bottom-0 left-0 w-1.5 h-1.5 rounded-full bg-[#D4F54F] opacity-0 pointer-events-none transition-transform duration-300"></div>

      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#D4F54F] transition-colors">
        Home
      </a>

      <!-- Services with Mega-Menu Trigger -->
      <div class="relative">
        <button id="nav-services-trigger" class="nav-link {{ request()->routeIs('services.*') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#F2F5EC] transition-colors flex items-center gap-1" aria-expanded="false" aria-haspopup="true">
          Services
          <svg class="w-3.5 h-3.5 text-[#9AA391]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
      </div>

      <a href="{{ route('work.index') }}" class="nav-link {{ request()->routeIs('work.*') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#F2F5EC] transition-colors">
        Work
      </a>

      <a href="{{ route('creators') }}" class="nav-link {{ request()->routeIs('creators') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#F2F5EC] transition-colors">
        Creators
      </a>

      <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#F2F5EC] transition-colors">
        About
      </a>

      <a href="{{ route('insights') }}" class="nav-link {{ request()->routeIs('insights*') ? 'is-current text-[#F2F5EC]' : 'text-[#9AA391]' }} text-sm font-medium px-4 py-2 hover:text-[#F2F5EC] transition-colors">
        Insights
      </a>
    </nav>

    <!-- Primary Action CTA -->
    <div class="hidden md:flex items-center gap-3">
      <a href="{{ route('contact') }}" class="btn-swap glass glass--lime glass--pill px-5 py-2.5 text-xs tracking-wider uppercase font-mono font-semibold" id="header-cta">
        <span class="btn-text-wrap">
          <span class="btn-text-primary">Book a strategy call</span>
          <span class="btn-text-clone">Book a strategy call</span>
        </span>
        <svg class="btn-icon w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </a>
    </div>

    <!-- Mobile Hamburger Button -->
    <button id="mobile-menu-toggle" class="md:hidden p-2 text-[#F2F5EC] hover:text-[#D4F54F] focus:outline-none" aria-label="Open Mobile Menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

  </div>

  <!-- Mega Panel: Services -->
  <div id="services-mega-menu" class="absolute top-20 left-1/2 -translate-x-1/2 w-[92vw] max-w-[880px] glass p-6 z-50 pointer-events-none">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
      <!-- 6 Featured Services Links -->
      <div class="md:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-3">
        <a href="{{ route('services.show', 'sponsored-x-posts') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            Sponsored X Posts
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">Single posts built around your brand or product.</p>
        </a>

        <a href="{{ route('services.show', 'x-threads') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            X Threads
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">Educational, storytelling or launch threads.</p>
        </a>

        <a href="{{ route('services.show', 'launch-campaigns') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            Launch Campaigns
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">Creator posts timed around your product launch.</p>
        </a>

        <a href="{{ route('services.show', 'multi-creator-campaigns') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            Multi-Creator Sprints
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">10 to 100+ creators under one campaign.</p>
        </a>

        <a href="{{ route('services.show', 'founder-ceo-campaigns') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            Founder/CEO Campaigns
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">Aimed at builders, founders and decision-makers.</p>
        </a>

        <a href="{{ route('services.show', 'long-term-creator-partnerships') }}" class="p-3 rounded-xl hover:bg-white/[0.04] transition-colors group">
          <div class="text-sm font-semibold text-[#F2F5EC] group-hover:text-[#D4F54F] flex items-center justify-between">
            Long-Term Partnerships
            <span class="text-xs text-[#9AA391] opacity-0 group-hover:opacity-100 transition-opacity">→</span>
          </div>
          <p class="text-xs text-[#9AA391] mt-1">Ongoing work with creators, monthly or in batches.</p>
        </a>
      </div>

      <!-- Featured Case Study Card Right -->
      <div class="md:col-span-5 glass glass--sub p-5 flex flex-col justify-between">
        <div>
          <div class="label-caps text-[#D4F54F] mb-1">Featured Result</div>
          <div class="font-head text-2xl font-bold text-[#F2F5EC] mt-1">4.6x ROAS</div>
          <p class="text-xs text-[#9AA391] mt-2">Generative AI video launch deployed across 24 vetted AI creators with Whitelisted Meta & X ads.</p>
        </div>
        <div class="mt-4 pt-4 border-t border-white/10 flex items-center justify-between">
          <span class="text-xs font-mono text-[#9AA391]">HeyGen</span>
          <a href="{{ route('work.case-study') }}" class="text-xs font-semibold text-[#D4F54F] hover:underline">View Study →</a>
        </div>
      </div>
    </div>
    
    <div class="mt-4 pt-4 border-t border-white/10 text-center">
      <a href="{{ route('services.index') }}" class="text-xs font-mono font-semibold text-[#D4F54F] hover:underline">
        Explore all 14 creator distribution formats →
      </a>
    </div>
  </div>
</header>

