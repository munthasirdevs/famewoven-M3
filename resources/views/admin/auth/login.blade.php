<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Famewoven Command Center</title>
  <link rel="icon" type="image/png" href="{{ asset('css/iconnn.png') }}">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            bg: '#080A07', bg2: '#0E120C', ink: '#101210', text: '#F2F5EC',
            muted: '#9AA391', lime: '#D4F54F', limepale: '#F0FFB0', green: '#7CB83A'
          },
          fontFamily: {
            head: ['Space Grotesk', 'sans-serif'], body: ['Inter', 'sans-serif'], mono: ['JetBrains Mono', 'monospace']
          }
        }
      }
    };
  </script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Project Styles -->
  <link rel="stylesheet" href="{{ asset('css/glass.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-[#080A07] text-[#F2F5EC] min-h-screen flex items-center justify-center p-6 relative overflow-x-hidden selection:bg-[#D4F54F] selection:text-[#101210]">

  <!-- Noise Grain & Canvas -->
  <div class="grain-overlay"></div>
  <canvas id="bg" class="fixed inset-0 w-full h-full pointer-events-none z-0"></canvas>

  <div class="w-full max-w-md relative z-10">

    <!-- Brand Header -->
    <div class="text-center mb-8">
      <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group mb-3 focus:outline-none">
        <img src="{{ asset('css/namelogo.png') }}" alt="Famewoven" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
      </a>
      <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-[11px] font-mono uppercase tracking-wider">
        <span class="w-1.5 h-1.5 rounded-full bg-[#D4F54F] animate-pulse"></span>
        Command Center
      </div>
      <h1 class="font-head text-2xl font-bold tracking-tight text-[#F2F5EC] mt-3">Staff & Admin Access</h1>
      <p class="text-xs text-[#9AA391] mt-1">Role-authenticated session for telemetry, submissions & logs.</p>
    </div>

    <!-- Card -->
    <div class="glass p-8 sm:p-10 border border-white/10 shadow-2xl relative">

      @if(session('success'))
      <div class="mb-6 p-3.5 rounded-xl bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-xs font-mono">
        {{ session('success') }}
      </div>
      @endif

      @if(session('error'))
      <div class="mb-6 p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono">
        {{ session('error') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="mb-6 p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono">
        <ul class="list-disc list-inside space-y-1">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Work Email</label>
          <div class="relative">
            <input type="email" id="email" name="email" value="{{ old('email', 'admin@famewoven.com') }}" required autofocus
              class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
          </div>
        </div>

        <!-- Password -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label for="password" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391]">Password</label>
            <span class="text-[11px] font-mono text-[#D4F54F]/80">Demo: Famewoven2026!</span>
          </div>
          <div class="relative">
            <input type="password" id="password" name="password" required
              class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
          </div>
        </div>

        <!-- Remember & Links -->
        <div class="flex items-center justify-between text-xs">
          <label class="flex items-center gap-2 cursor-pointer select-none">
            <input type="checkbox" name="remember" class="rounded bg-white/10 border-white/20 text-[#D4F54F] focus:ring-0 accent-[#D4F54F]">
            <span class="text-[#9AA391]">Remember session</span>
          </label>
          <a href="{{ route('admin.register') }}" class="font-mono text-[#D4F54F] hover:underline">New user? Sign up</a>
        </div>

        <!-- Submit Button -->
        <button type="submit"
          class="w-full py-3.5 px-6 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-all duration-300 shadow-lg shadow-[#D4F54F]/20 flex items-center justify-center gap-2">
          <span>Authenticate & Enter</span>
          <span>→</span>
        </button>
      </form>

      <!-- Security Notice -->
      <div class="mt-8 pt-6 border-t border-white/[0.08] text-center">
        <div class="text-[11px] font-mono text-[#9AA391] flex items-center justify-center gap-2">
          <svg class="w-3.5 h-3.5 text-[#D4F54F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          <span>End-to-End Audit & RBAC Protected</span>
        </div>
      </div>

    </div>

    <!-- Back to public site -->
    <div class="text-center mt-6">
      <a href="{{ route('home') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#F2F5EC] transition-colors inline-flex items-center gap-1.5">
        <span>← Return to Public Website</span>
      </a>
    </div>

  </div>

  <script src="{{ asset('js/bg.js') }}"></script>
</body>
</html>
