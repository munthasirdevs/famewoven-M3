<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard') — Famewoven Command Center</title>
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
  @stack('styles')
</head>

<body class="bg-[#080A07] text-[#F2F5EC] min-h-screen relative flex overflow-x-hidden selection:bg-[#D4F54F] selection:text-[#101210]">

  <!-- Noise Grain Overlay -->
  <div class="grain-overlay pointer-events-none"></div>

  <!-- Mobile Sidebar Backdrop -->
  <div id="sidebar-backdrop" class="fixed inset-0 bg-black/80 z-40 lg:hidden hidden transition-opacity duration-300"></div>

  <!-- Sidebar -->
  <aside id="admin-sidebar" class="fixed top-0 bottom-0 left-0 w-72 bg-[#0E120C]/95 backdrop-blur-xl border-r border-white/10 z-50 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0">
    
    <div>
      <!-- Brand Logo & Badge -->
      <div class="p-6 border-b border-white/[0.08] flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
          <img src="{{ asset('css/namelogo.png') }}" alt="Famewoven" class="h-6 w-auto object-contain">
        </a>
        <div class="flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-[10px] font-mono uppercase font-bold tracking-wider">
          <span class="w-1.5 h-1.5 rounded-full bg-[#D4F54F] animate-pulse"></span>
          Ops
        </div>
      </div>

      <!-- User Profile Card -->
      <div class="p-4 mx-4 my-4 rounded-2xl bg-white/[0.02] border border-white/10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#D4F54F] to-[#7CB83A] text-[#101210] font-head font-bold text-sm grid place-items-center shadow-lg shadow-[#D4F54F]/10">
          {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
        </div>
        <div class="flex-1 min-w-0">
          <div class="text-sm font-semibold text-[#F2F5EC] truncate">{{ auth()->user()->name }}</div>
          <div class="flex items-center gap-2 mt-0.5">
            <span class="inline-block px-2 py-0.5 rounded-full text-[9px] font-mono uppercase font-bold tracking-wider {{ auth()->user()->isSuperAdmin() ? 'bg-[#D4F54F]/20 text-[#D4F54F] border border-[#D4F54F]/30' : (auth()->user()->isAdmin() ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : (auth()->user()->isEditor() ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : 'bg-white/10 text-[#9AA391]')) }}">
              {{ str_replace('_', ' ', auth()->user()->role) }}
            </span>
          </div>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="px-4 space-y-1.5">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span>Dashboard</span>
        </a>

        <!-- Section: Website Inquiries -->
        <div class="pt-4 pb-1 px-3.5 text-[10px] font-mono uppercase tracking-wider text-white/30 font-semibold">
          Forms & Telemetry
        </div>

        <!-- Strategy Inquiries -->
        <a href="{{ route('admin.strategy-calls.index') }}"
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.strategy-calls.*') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <div class="flex items-center gap-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <span>Strategy Inquiries</span>
          </div>
          @php $pendingCalls = \App\Models\StrategyCall::where('status', 'pending')->count(); @endphp
          @if($pendingCalls > 0)
          <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ request()->routeIs('admin.strategy-calls.*') ? 'bg-[#101210] text-[#D4F54F]' : 'bg-[#D4F54F]/20 text-[#D4F54F]' }}">
            {{ $pendingCalls }}
          </span>
          @endif
        </a>

        <!-- Creator Applications -->
        <a href="{{ route('admin.creators.index') }}"
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.creators.*') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <div class="flex items-center gap-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span>Creators Vetting</span>
          </div>
          @php $pendingCreators = \App\Models\CreatorApplication::where('status', 'pending')->count(); @endphp
          @if($pendingCreators > 0)
          <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ request()->routeIs('admin.creators.*') ? 'bg-[#101210] text-[#D4F54F]' : 'bg-[#D4F54F]/20 text-[#D4F54F]' }}">
            {{ $pendingCreators }}
          </span>
          @endif
        </a>

        <!-- Newsletter Subscribers -->
        <a href="{{ route('admin.subscribers.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.subscribers.*') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          <span>Subscribers</span>
        </a>

        <!-- Section: Logging & Intelligence -->
        <div class="pt-4 pb-1 px-3.5 text-[10px] font-mono uppercase tracking-wider text-white/30 font-semibold">
          Logs & Intelligence
        </div>

        <!-- Activity Logs -->
        <a href="{{ route('admin.logs.activity') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.logs.activity') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span>Activity Audit Trail</span>
        </a>

        <!-- System Logs -->
        <a href="{{ route('admin.logs.system') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.logs.system') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
          </svg>
          <span>System & Error Logs</span>
        </a>

        <!-- Section: Administration -->
        @if(auth()->user()->canManageUsers())
        <div class="pt-4 pb-1 px-3.5 text-[10px] font-mono uppercase tracking-wider text-white/30 font-semibold">
          System Governance
        </div>

        <!-- Users Management -->
        <a href="{{ route('admin.users.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
          <span>Users & RBAC Roles</span>
        </a>
        @endif

        <!-- My Profile -->
        <a href="{{ route('admin.profile') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-mono font-medium transition-colors {{ request()->routeIs('admin.profile') ? 'bg-[#D4F54F] text-[#101210] font-bold shadow-lg shadow-[#D4F54F]/10' : 'text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04]' }}">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
          <span>Account Settings</span>
        </a>

      </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-white/[0.08] space-y-2">
      <!-- Public Site Link -->
      <a href="{{ route('home') }}" target="_blank"
        class="w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-mono text-[#9AA391] hover:text-[#F2F5EC] hover:bg-white/[0.04] transition-colors">
        <span>Public Website</span>
        <span>↗</span>
      </a>

      <!-- Logout Form -->
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
          class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-mono text-red-400 hover:bg-red-500/10 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>Sign Out</span>
        </button>
      </form>
    </div>

  </aside>

  <!-- Main Content Wrapper -->
  <div class="flex-1 lg:pl-72 flex flex-col min-h-screen">
    
    <!-- Topbar -->
    <header class="sticky top-0 z-30 h-16 bg-[#080A07]/90 backdrop-blur-md border-b border-white/[0.08] px-6 sm:px-8 flex items-center justify-between">
      
      <!-- Left: Mobile Menu Toggle & Breadcrumbs -->
      <div class="flex items-center gap-4">
        <button id="mobile-sidebar-toggle" class="lg:hidden p-2 text-[#9AA391] hover:text-[#F2F5EC] rounded-lg border border-white/10">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <div>
          <h1 class="font-head text-lg font-bold text-[#F2F5EC]">@yield('header_title', 'Command Center')</h1>
        </div>
      </div>

      <!-- Right: User Chip & Telemetry Status -->
      <div class="flex items-center gap-3">
        <div class="hidden sm:flex items-center gap-2 px-3 py-1 rounded-full bg-white/[0.03] border border-white/10 text-xs font-mono text-[#9AA391]">
          <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
          <span>MySQL Live</span>
        </div>

        <div class="flex items-center gap-2">
          <span class="text-xs font-mono font-semibold text-[#F2F5EC] hidden md:inline">{{ auth()->user()->name }}</span>
          <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ auth()->user()->isSuperAdmin() ? 'bg-[#D4F54F]/20 text-[#D4F54F] border border-[#D4F54F]/30' : (auth()->user()->isAdmin() ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : 'bg-white/10 text-[#9AA391]') }}">
            {{ str_replace('_', ' ', auth()->user()->role) }}
          </span>
        </div>
      </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 p-6 sm:p-8 max-w-7xl w-full mx-auto">
      
      <!-- Flash Messages -->
      @if(session('success'))
      <div class="mb-6 p-4 rounded-2xl bg-[#D4F54F]/10 border border-[#D4F54F]/30 text-[#D4F54F] text-xs font-mono flex items-center justify-between">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-[#D4F54F] hover:opacity-75">✕</button>
      </div>
      @endif

      @if(session('error'))
      <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono flex items-center justify-between">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          <span>{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-400 hover:opacity-75">✕</button>
      </div>
      @endif

      @yield('content')
    </main>

    <!-- Admin Footer -->
    <footer class="p-6 border-t border-white/[0.08] text-center text-xs font-mono text-[#9AA391]">
      Famewoven Infrastructure Command Center · PHP {{ PHP_VERSION }} · Laravel v{{ app()->version() }}
    </footer>

  </div>

  <!-- Mobile Sidebar Toggle JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggle = document.getElementById('mobile-sidebar-toggle');
      const sidebar = document.getElementById('admin-sidebar');
      const backdrop = document.getElementById('sidebar-backdrop');

      if (toggle && sidebar && backdrop) {
        function openSidebar() {
          sidebar.classList.remove('-translate-x-full');
          backdrop.classList.remove('hidden');
        }
        function closeSidebar() {
          sidebar.classList.add('-translate-x-full');
          backdrop.classList.add('hidden');
        }
        toggle.addEventListener('click', openSidebar);
        backdrop.addEventListener('click', closeSidebar);
      }
    });
  </script>
  @stack('scripts')
</body>
</html>
