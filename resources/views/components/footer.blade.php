<footer class="relative z-10 pt-20 pb-12 border-t border-white/[0.08] bg-[#080A07] overflow-hidden">
  <!-- Giant cropped low-opacity wordmark background -->
  <div class="absolute bottom-0 inset-x-0 font-head text-[16vw] font-bold tracking-tighter text-white/[0.03] select-none pointer-events-none text-center leading-none translate-y-1/3">
    FAMEWOVEN
  </div>

  <div class="max-w-[1280px] mx-auto px-6 sm:px-10 lg:px-16 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-12 pb-16 border-b border-white/[0.08]">

      <!-- Brand Info -->
      <div class="lg:col-span-2">
        <a href="{{ route('home') }}" class="inline-flex items-center mb-4 group focus:outline-none" aria-label="Famewoven Home">
          <img src="{{ asset('css/namelogo.png') }}" alt="Famewoven" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
        </a>
        <p class="text-sm text-[#9AA391] max-w-sm mb-6 leading-relaxed">
          The creator marketing system brands actually track. Weaving influence into culture with verified balance-sheet proof.
        </p>
        <div class="label-caps text-[#D4F54F]">Dhaka · Global Reach</div>
      </div>

      <!-- Column: Services (2 Columns with all 14 services) -->
      <div class="lg:col-span-2">
        <h4 class="label-caps text-[#F2F5EC] mb-4">Services</h4>
        <div class="grid grid-cols-2 gap-x-4 sm:gap-x-6 gap-y-2.5 text-xs sm:text-sm text-[#9AA391]">
          <ul class="space-y-2.5">
            <li><a href="{{ route('services.show', 'sponsored-x-posts') }}" class="hover:text-[#D4F54F] transition-colors">Sponsored X Posts</a></li>
            <li><a href="{{ route('services.show', 'x-threads') }}" class="hover:text-[#D4F54F] transition-colors">X Threads</a></li>
            <li><a href="{{ route('services.show', 'quote-reposts') }}" class="hover:text-[#D4F54F] transition-colors">Quote Reposts</a></li>
            <li><a href="{{ route('services.show', 'organic-amplification') }}" class="hover:text-[#D4F54F] transition-colors">Organic Amplification</a></li>
            <li><a href="{{ route('services.show', 'launch-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Launch Campaigns</a></li>
            <li><a href="{{ route('services.show', 'product-promotion') }}" class="hover:text-[#D4F54F] transition-colors">Product Promotion</a></li>
            <li><a href="{{ route('services.show', 'multi-creator-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Multi-Creator Campaigns</a></li>
          </ul>
          <ul class="space-y-2.5">
            <li><a href="{{ route('services.show', 'founder-ceo-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Founder/CEO Campaigns</a></li>
            <li><a href="{{ route('services.show', 'trend-narrative-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Trend &amp; Narrative</a></li>
            <li><a href="{{ route('services.show', 'performance-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Performance Campaigns</a></li>
            <li><a href="{{ route('services.show', 'creator-seeding') }}" class="hover:text-[#D4F54F] transition-colors">Creator Seeding</a></li>
            <li><a href="{{ route('services.show', 'influencer-outreach') }}" class="hover:text-[#D4F54F] transition-colors">Influencer Outreach</a></li>
            <li><a href="{{ route('services.show', 'long-term-creator-partnerships') }}" class="hover:text-[#D4F54F] transition-colors">Long-Term Partnerships</a></li>
            <li><a href="{{ route('services.show', 'custom-x-campaigns') }}" class="hover:text-[#D4F54F] transition-colors">Custom X Campaigns</a></li>
          </ul>
        </div>
      </div>

      <!-- Column: Newsletter & Direct -->
      <div class="lg:col-span-1">
        <h4 class="label-caps text-[#F2F5EC] mb-4">Stay Ahead</h4>
        <p class="text-xs text-[#9AA391] mb-3">Bi-weekly teardowns of high-converting creator campaigns.</p>
        <form class="space-y-2" onsubmit="event.preventDefault(); alert('Subscribed to Famewoven Insights.');">
          <input type="email" placeholder="work@brand.com" required class="w-full px-3.5 py-2 bg-white/[0.04] border border-white/10 rounded-lg text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
          <button type="submit" class="w-full py-2 bg-[#D4F54F] text-[#101210] rounded-lg text-xs font-mono font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors">
            Subscribe
          </button>
        </form>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-[#9AA391]">
      <div>© 2026 Famewoven. Where Influence Is Woven.</div>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-[#F2F5EC]">Privacy Policy</a>
        <a href="#" class="hover:text-[#F2F5EC]">Terms of Service</a>
        <a href="{{ url('sitemap.xml') }}" class="hover:text-[#F2F5EC]">Sitemap</a>
      </div>
    </div>
  </div>
</footer>
