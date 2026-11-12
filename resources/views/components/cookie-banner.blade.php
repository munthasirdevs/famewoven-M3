<!-- Cookie Consent Banner & Legal Transparency Modal -->
<div id="cookie-consent-system">

  <!-- Floating Bottom Cookie Banner -->
  <div id="cookie-consent-banner" class="hidden fixed bottom-4 left-4 right-4 sm:left-auto sm:right-6 sm:bottom-6 max-w-md z-50 transition-all duration-300">
    <div class="glass p-5 rounded-2xl border border-white/10 shadow-2xl bg-[#0E120C]/95 backdrop-blur-xl">
      <div class="flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#D4F54F]/10 border border-[#D4F54F]/20 flex items-center justify-center flex-shrink-0 text-[#D4F54F] text-sm">
          🍪
        </div>
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between mb-1">
            <h4 class="font-head text-sm font-bold text-white">Privacy &amp; Cookie Consent</h4>
            <span class="text-[9px] font-mono text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded border border-emerald-500/20">GDPR Clean</span>
          </div>
          <p class="text-xs text-[#9AA391] leading-relaxed mb-3">
            We use strictly necessary cookies for site security and anonymized telemetry to measure content reach. We strictly never use third-party ad trackers or sell your personal data.
          </p>
          <div class="flex flex-wrap items-center gap-2">
            <button type="button" id="cookie-accept-all"
                    class="px-3.5 py-1.5 rounded-lg bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors">
              Accept All
            </button>
            <button type="button" id="cookie-essential-only"
                    class="px-3 py-1.5 rounded-lg bg-white/[0.04] text-[#F2F5EC] border border-white/10 font-mono text-xs hover:bg-white/[0.08] transition-colors">
              Essential Only
            </button>
            <button type="button" id="cookie-open-details"
                    class="px-2 py-1.5 text-xs font-mono text-[#D4F54F] hover:underline transition-colors">
              Details &amp; Whitelist →
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Full Transparency & Legal Disclosure Modal -->
  <div id="cookie-consent-modal" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm grid place-items-center p-4 overflow-y-auto">
    <div class="glass p-6 sm:p-8 rounded-3xl max-w-2xl w-full border border-white/10 my-8 bg-[#0E120C]/95 relative shadow-2xl">
      
      <!-- Modal Header -->
      <div class="flex items-start justify-between mb-6 pb-4 border-b border-white/[0.08]">
        <div>
          <div class="label-caps text-[#D4F54F] mb-1">Transparency &amp; Legal Compliance</div>
          <h3 class="font-head text-xl font-bold text-white">Cookie &amp; Data Collection Policy</h3>
          <p class="text-xs text-[#9AA391] mt-1 font-mono">Strict adherence to GDPR, ePrivacy Directive, and CCPA standards.</p>
        </div>
        <button type="button" id="cookie-modal-close" class="text-[#9AA391] hover:text-white p-1 rounded-lg">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="space-y-6 max-h-[65vh] overflow-y-auto pr-2 custom-scrollbar">

        <!-- What We Collect Box -->
        <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5 space-y-3">
          <div class="flex items-center gap-2 text-xs font-mono font-bold text-[#D4F54F] uppercase tracking-wider">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>What We Collect (Legitimate &amp; Transparent)</span>
          </div>
          <ul class="text-xs text-[#9AA391] space-y-2 list-disc list-inside">
            <li><strong class="text-white">Strictly Necessary Cookies:</strong> Encrypted session token (<code class="text-[#D4F54F] text-[11px]">famewoven_session</code>), CSRF defense token (<code class="text-[#D4F54F] text-[11px]">XSRF-TOKEN</code>), and your consent state.</li>
            <li><strong class="text-white">Anonymized Traffic Telemetry:</strong> Aggregated pageviews, referring domains (e.g. Google, X), device category (mobile/desktop), and browser name.</li>
            <li><strong class="text-white">Anonymized IP Masking:</strong> The final octet of IPv4 addresses is automatically truncated (e.g. <code class="text-emerald-400 text-[11px]">192.168.1.xxx</code>), ensuring zero personal identification.</li>
            <li><strong class="text-white">Voluntary Inquiries:</strong> Any information you explicitly submit through our strategy call briefs or creator application forms.</li>
          </ul>
        </div>

        <!-- What We NEVER Collect Box (Illegal / Invasive Protections) -->
        <div class="p-4 rounded-2xl bg-red-500/[0.03] border border-red-500/20 space-y-3">
          <div class="flex items-center gap-2 text-xs font-mono font-bold text-red-400 uppercase tracking-wider">
            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>What We Strictly NEVER Collect (Zero Illegal Tracking)</span>
          </div>
          <ul class="text-xs text-[#9AA391] space-y-2 list-disc list-inside">
            <li><strong class="text-white">Zero Third-Party Advertising Pixels:</strong> We do NOT load Meta Pixels, Google Remarketing tags, TikTok Pixels, or cross-site tracking scripts.</li>
            <li><strong class="text-white">No Cross-Site Profiling:</strong> We never track your browsing behavior across other websites or domain networks.</li>
            <li><strong class="text-white">No Data Brokering or Selling:</strong> Your data is never sold, rented, or traded to data brokers or advertising exchanges.</li>
            <li><strong class="text-white">No Invasive Surveillance:</strong> No keystroke logging, no screen session recordings, no clipboard inspection, and no canvas fingerprinting.</li>
            <li><strong class="text-white">Global Privacy Control (GPC):</strong> We automatically honor <code class="text-white text-[11px]">DNT: 1</code> (Do Not Track) and GPC browser signals.</li>
          </ul>
        </div>

        <!-- Granular Cookie Controls -->
        <div class="space-y-4 pt-2">
          <h4 class="text-xs font-mono uppercase tracking-wider text-white">Your Consent Choices</h4>
          
          <!-- Category 1: Essential -->
          <div class="p-3.5 rounded-xl bg-white/[0.02] border border-white/5 flex items-center justify-between gap-4">
            <div>
              <div class="text-xs font-bold text-white flex items-center gap-2">
                <span>Strictly Necessary Cookies</span>
                <span class="text-[9px] font-mono text-[#D4F54F] bg-[#D4F54F]/10 px-1.5 py-0.5 rounded">Always Active</span>
              </div>
              <p class="text-[11px] text-[#9AA391] mt-0.5">Required for navigation, CSRF security, and submitting contact briefs.</p>
            </div>
            <input type="checkbox" checked disabled class="accent-[#D4F54F] cursor-not-allowed w-4 h-4">
          </div>

          <!-- Category 2: Analytics -->
          <div class="p-3.5 rounded-xl bg-white/[0.02] border border-white/5 flex items-center justify-between gap-4">
            <div>
              <div class="text-xs font-bold text-white flex items-center gap-2">
                <span>Anonymized Analytics Telemetry</span>
                <span class="text-[9px] font-mono text-cyan-400 bg-cyan-500/10 px-1.5 py-0.5 rounded">Optional</span>
              </div>
              <p class="text-[11px] text-[#9AA391] mt-0.5">Helps us evaluate route engagement and audience hardware composition with masked IPs.</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" id="cookie-toggle-analytics" class="sr-only peer" checked>
              <div class="w-9 h-5 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#D4F54F]"></div>
            </label>
          </div>
        </div>

      </div>

      <!-- Modal Footer Actions -->
      <div class="mt-6 pt-4 border-t border-white/[0.08] flex flex-wrap items-center justify-between gap-3">
        <button type="button" id="cookie-modal-essential"
                class="px-4 py-2 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-[#F2F5EC] border border-white/10 text-xs font-mono transition-colors">
          Reject Optional (Essential Only)
        </button>

        <div class="flex items-center gap-2">
          <button type="button" id="cookie-modal-save"
                  class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-mono text-xs font-bold transition-colors">
            Save Preferences
          </button>
          <button type="button" id="cookie-modal-accept"
                  class="px-5 py-2 rounded-xl bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors">
            Accept All
          </button>
        </div>
      </div>

    </div>
  </div>

</div>

<!-- Cookie Consent Interactive Script -->
<script>
  (function () {
    const STORAGE_KEY = 'famewoven_cookie_consent';
    const COOKIE_NAME = 'famewoven_cookie_consent';

    function getCookie(name) {
      const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      return match ? match[2] : null;
    }

    function setCookie(name, value, days) {
      const d = new Date();
      d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
      const expires = "expires=" + d.toUTCString();
      document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
      localStorage.setItem(STORAGE_KEY, value);
    }

    function getConsent() {
      return localStorage.getItem(STORAGE_KEY) || getCookie(COOKIE_NAME);
    }

    function saveConsent(level) {
      setCookie(COOKIE_NAME, level, 365);
      hideBanner();
      hideModal();
    }

    const banner = document.getElementById('cookie-consent-banner');
    const modal = document.getElementById('cookie-consent-modal');
    const analyticsToggle = document.getElementById('cookie-toggle-analytics');

    function showBanner() {
      if (banner) banner.classList.remove('hidden');
    }

    function hideBanner() {
      if (banner) banner.classList.add('hidden');
    }

    function showModal() {
      const consent = getConsent();
      if (analyticsToggle) {
        analyticsToggle.checked = consent !== 'essential';
      }
      if (modal) modal.classList.remove('hidden');
    }

    function hideModal() {
      if (modal) modal.classList.add('hidden');
    }

    // Check on page load
    document.addEventListener('DOMContentLoaded', function () {
      const existingConsent = getConsent();
      if (!existingConsent) {
        setTimeout(showBanner, 600);
      }

      // Banner buttons
      const btnAcceptAll = document.getElementById('cookie-accept-all');
      if (btnAcceptAll) {
        btnAcceptAll.addEventListener('click', function () {
          saveConsent('all');
        });
      }

      const btnEssential = document.getElementById('cookie-essential-only');
      if (btnEssential) {
        btnEssential.addEventListener('click', function () {
          saveConsent('essential');
        });
      }

      const btnOpenDetails = document.getElementById('cookie-open-details');
      if (btnOpenDetails) {
        btnOpenDetails.addEventListener('click', function () {
          showModal();
        });
      }

      // Modal close & action buttons
      const btnModalClose = document.getElementById('cookie-modal-close');
      if (btnModalClose) {
        btnModalClose.addEventListener('click', hideModal);
      }

      const btnModalAccept = document.getElementById('cookie-modal-accept');
      if (btnModalAccept) {
        btnModalAccept.addEventListener('click', function () {
          saveConsent('all');
        });
      }

      const btnModalEssential = document.getElementById('cookie-modal-essential');
      if (btnModalEssential) {
        btnModalEssential.addEventListener('click', function () {
          saveConsent('essential');
        });
      }

      const btnModalSave = document.getElementById('cookie-modal-save');
      if (btnModalSave) {
        btnModalSave.addEventListener('click', function () {
          const level = analyticsToggle && analyticsToggle.checked ? 'all' : 'essential';
          saveConsent(level);
        });
      }

      // Close on backdrop click
      if (modal) {
        modal.addEventListener('click', function (e) {
          if (e.target === modal) {
            hideModal();
          }
        });
      }

      // Close on Escape key
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
          hideModal();
        }
      });

      // Global footer trigger button
      const footerCookieBtn = document.getElementById('open-cookie-modal-btn');
      if (footerCookieBtn) {
        footerCookieBtn.addEventListener('click', function (e) {
          e.preventDefault();
          showModal();
        });
      }
    });
  })();
</script>

