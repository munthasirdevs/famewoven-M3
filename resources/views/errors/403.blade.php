@extends('layouts.app')

@section('title', '403 — Unauthorized Role Access | Famewoven')
@section('description', 'You do not have the required role permissions to view this resource.')
@section('robots', 'noindex, nofollow')

@section('content')
<div class="max-w-lg mx-auto text-center my-auto py-36 px-6">
  <div class="glass p-12 border border-red-500/20">
    <div class="font-head text-8xl sm:text-9xl font-bold tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-red-400/40 to-red-400/10 select-none mb-2">
      403
    </div>
    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-mono uppercase tracking-wider mb-4">
      Restricted Permission Tier
    </div>
    <h1 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">Access Denied</h1>
    <p class="text-sm text-[#9AA391] mb-8 leading-relaxed">
      {{ $exception->getMessage() ?: 'Your assigned administrative role does not have authorization to view this section or execute this action.' }}
    </p>
    
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
      <a href="{{ route('admin.dashboard') }}" class="btn-swap glass glass--lime glass--pill px-6 py-3 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] inline-flex">
        <span class="btn-text-wrap"><span class="btn-text-primary">Admin Dashboard</span><span class="btn-text-clone">Admin Dashboard</span></span>
      </a>
      <a href="{{ route('home') }}" class="glass glass--pill px-6 py-3 text-xs font-mono font-bold uppercase tracking-wider text-[#9AA391] hover:text-[#F2F5EC] inline-flex">
        Return Home
      </a>
    </div>
  </div>
</div>
@endsection
