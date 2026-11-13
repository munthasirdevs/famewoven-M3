<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Admin Sign Up — Famewoven Command Center</title>
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
        <img src="{{ asset('css/namelogo.png') }}" width="195" height="28" alt="Famewoven — Creator Marketing Agency Logo" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
      </a>
      <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-[11px] font-mono uppercase tracking-wider">
        Create Access Account
      </div>
      <h1 class="font-head text-2xl font-bold tracking-tight text-[#F2F5EC] mt-3">Staff Registration</h1>
      <p class="text-xs text-[#9AA391] mt-1">Join the administrative team with role-governed credentials.</p>
    </div>

    <!-- Card -->
    <div class="glass p-8 sm:p-10 border border-white/10 shadow-2xl relative">

      @if ($errors->any())
      <div class="mb-6 p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono">
        <ul class="list-disc list-inside space-y-1">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('admin.register.submit') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Full Name -->
        <div>
          <label for="name" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Full Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
            class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Work Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required
            class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Password (min 8 chars)</label>
          <input type="password" id="password" name="password" required
            class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required
            class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-[#F2F5EC] focus:border-[#D4F54F] focus:ring-1 focus:ring-[#D4F54F] outline-none transition-all placeholder:text-white/20">
        </div>

        <div class="pt-2">
          <button type="submit"
            class="w-full py-3.5 px-6 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-all duration-300 shadow-lg shadow-[#D4F54F]/20 flex items-center justify-center gap-2">
            <span>Create Account & Enter</span>
            <span>→</span>
          </button>
        </div>

        <div class="text-center pt-2">
          <a href="{{ route('admin.login') }}" class="text-xs font-mono text-[#9AA391] hover:text-[#D4F54F] transition-colors">
            Already have an account? <span class="underline">Sign in</span>
          </a>
        </div>
      </form>

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
