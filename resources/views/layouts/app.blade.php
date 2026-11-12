<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Famewoven — Where Influence Is Woven | Creator Marketing Agency')</title>
  <meta name="description" content="@yield('description', 'Famewoven weaves brands into creator culture, and tracks every dollar of it. Creator marketing, influencer campaigns, UGC production, and paid amplification for high-growth AI and tech companies.')">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <link rel="icon" type="image/png" href="{{ asset('css/iconnn.png') }}">

  <!-- Open Graph / Facebook -->
  <meta property="og:site_name" content="Famewoven">
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:title" content="@yield('og_title', 'Famewoven — Where Influence Is Woven | Creator Marketing Agency')">
  <meta property="og:description" content="@yield('og_description', 'Famewoven weaves brands into creator culture, and tracks every dollar of it. Creator marketing, influencer campaigns, UGC production, and paid amplification for high-growth AI and tech companies.')">
  <meta property="og:url" content="@yield('canonical', url()->current())">
  <meta property="og:image" content="@yield('og_image', asset('css/namelogo.png'))">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="Famewoven — Where Influence Is Woven">

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@Famewoven">
  <meta name="twitter:creator" content="@Famewoven">
  <meta name="twitter:title" content="@yield('og_title', 'Famewoven — Where Influence Is Woven | Creator Marketing Agency')">
  <meta name="twitter:description" content="@yield('og_description', 'Famewoven weaves brands into creator culture, and tracks every dollar of it.')">
  <meta name="twitter:image" content="@yield('og_image', asset('css/namelogo.png'))">

  @yield('schema')

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            bg: '#080A07',
            bg2: '#0E120C',
            ink: '#101210',
            text: '#F2F5EC',
            muted: '#9AA391',
            lime: '#D4F54F',
            limepale: '#F0FFB0',
            green: '#7CB83A'
          },
          fontFamily: {
            head: ['Space Grotesk', 'sans-serif'],
            body: ['Inter', 'sans-serif'],
            mono: ['JetBrains Mono', 'monospace']
          }
        }
      }
    };
  </script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- GSAP & ScrollTrigger -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <!-- Project Styles -->
  <link rel="stylesheet" href="{{ asset('css/glass.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>

<body class="bg-[#080A07] text-[#F2F5EC] relative overflow-x-hidden selection:bg-[#D4F54F] selection:text-[#101210]">

  <!-- Noise Grain Overlay -->
  <div class="grain-overlay"></div>

  <!-- Custom Cursor -->
  <div id="custom-cursor-dot"></div>
  <div id="custom-cursor-ring"></div>

  <!-- Background Weave Helix Canvas -->
  <canvas id="bg" class="fixed inset-0 w-full h-full pointer-events-none z-0"></canvas>

  @if(request()->is('/') && (!isset($hideLoader) || !$hideLoader))
  <!-- Loading Screen (Session controlled) -->
  <div id="loader" class="fixed inset-0 z-[999] bg-[#080A07] grid place-items-center">
    <div class="text-center px-4 max-w-lg w-full">
      <div id="loader-word" class="font-head text-4xl sm:text-6xl md:text-7xl font-bold tracking-tight select-none overflow-hidden pb-1" style="perspective: 800px;">
        <span class="loader-letter inline-block text-[#F2F5EC]">F</span><span class="loader-letter inline-block text-[#F2F5EC]">a</span><span class="loader-letter inline-block text-[#F2F5EC]">m</span><span class="loader-letter inline-block text-[#F2F5EC]">e</span><span class="loader-letter loader-lime inline-block text-[#D4F54F]">w</span><span class="loader-letter loader-lime inline-block text-[#D4F54F]">o</span><span class="loader-letter loader-lime inline-block text-[#D4F54F]">v</span><span class="loader-letter loader-lime inline-block text-[#D4F54F]">e</span><span class="loader-letter loader-lime inline-block text-[#D4F54F]">n</span>
      </div>
      <div id="loader-bar-wrap" class="w-48 sm:w-64 h-[2px] bg-white/10 mt-6 sm:mt-8 mx-auto overflow-hidden rounded-full">
        <div id="loader-bar" class="h-full w-full bg-gradient-to-r from-[#D4F54F] to-[#7CB83A] origin-left scale-x-0"></div>
      </div>
    </div>
  </div>
  @endif

  <!-- Header Navigation -->
  @include('components.header')

  <!-- Mobile Drawer -->
  @include('components.mobile-drawer')

  <!-- Main Content -->
  <main class="relative z-10">
    @yield('content')
  </main>

  <!-- Global Footer -->
  @include('components.footer')

  <!-- Scripts -->
  <script src="{{ asset('js/bg.js') }}"></script>
  <script src="{{ asset('js/loader.js') }}"></script>
  <script src="{{ asset('js/header.js') }}"></script>
  <script src="{{ asset('js/hero.js') }}"></script>
  <script src="{{ asset('js/scroll.js') }}"></script>
  <script src="{{ asset('js/brand-video.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>

