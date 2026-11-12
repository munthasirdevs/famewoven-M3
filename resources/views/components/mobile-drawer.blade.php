<div id="mobile-drawer" class="fixed inset-0 z-[100] bg-[#080A07]/95 backdrop-blur-2xl p-6 hidden flex-col justify-between pointer-events-auto" aria-hidden="true">
  <div class="flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center group focus:outline-none" aria-label="Famewoven Home">
      <img src="{{ asset('css/namelogo.png') }}" alt="Famewoven" class="h-8 w-auto object-contain">
    </a>
    <button id="mobile-menu-close" class="p-2 text-[#9AA391] hover:text-[#F2F5EC]" aria-label="Close Mobile Menu">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <nav class="flex flex-col gap-6 my-auto">
    <a href="{{ route('home') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('home') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      Home
    </a>
    <a href="{{ route('services.index') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('services.*') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      Services
    </a>
    <a href="{{ route('work.index') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('work.*') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      Work
    </a>
    <a href="{{ route('creators') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('creators') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      Creators
    </a>
    <a href="{{ route('about') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('about') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      About
    </a>
    <a href="{{ route('insights') }}" class="mobile-nav-item font-head text-3xl font-semibold {{ request()->routeIs('insights*') ? 'text-[#D4F54F]' : 'text-[#F2F5EC] hover:text-[#D4F54F]' }}">
      Insights
    </a>
  </nav>

  <div class="pt-6 border-t border-white/10">
    <a href="{{ route('contact') }}" class="btn-swap glass glass--lime w-full py-4 rounded-xl text-center font-mono font-semibold uppercase tracking-wider text-sm block">
      Book a strategy call
    </a>
  </div>
</div>
