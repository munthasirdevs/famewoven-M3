@extends('layouts.app')

@section('title', '404 — Page Not Found | Famewoven')
@section('description', 'The page you are looking for does not exist on Famewoven. Return to homepage.')
@section('robots', 'noindex, nofollow')

@section('content')
<div class="max-w-lg mx-auto text-center my-auto py-36 px-6">
  <div class="glass p-12">
    <div class="font-head text-8xl sm:text-9xl font-bold tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-white/20 to-white/5 select-none mb-2">
      404
    </div>
    <h1 class="font-head text-2xl font-bold text-[#F2F5EC] mb-2">This page didn't get woven in.</h1>
    <p class="text-sm text-[#9AA391] mb-8">The link you followed may be broken or the URL was relocated.</p>
    
    <a href="{{ route('home') }}" class="btn-swap glass glass--lime glass--pill px-8 py-3.5 text-xs font-mono font-bold uppercase tracking-wider text-[#101210] inline-flex">
      <span class="btn-text-wrap"><span class="btn-text-primary">Return to Homepage</span><span class="btn-text-clone">Return to Homepage</span></span>
    </a>
  </div>
</div>
@endsection
