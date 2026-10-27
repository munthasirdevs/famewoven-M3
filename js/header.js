/**
 * Famewoven Global Floating Glass Navigation & Mega-Menu
 * Spec: Section 9.1 of Blueprint (New Text Document.md)
 */

document.addEventListener('DOMContentLoaded', function () {
  const header = document.getElementById('main-header');
  if (!header) return;

  const headerPill = document.getElementById('header-pill');
  const servicesTrigger = document.getElementById('nav-services-trigger');
  const servicesMegaMenu = document.getElementById('services-mega-menu');
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileDrawer = document.getElementById('mobile-drawer');
  const mobileClose = document.getElementById('mobile-menu-close');
  const navTrack = document.getElementById('nav-items-track');
  const navDot = document.getElementById('nav-active-dot');

  let lastScrollY = window.scrollY;
  let isMegaOpen = false;

  // 1. Scroll-Direction Hide / Reveal & Glass Density
  function handleScroll() {
    const currentY = window.scrollY;

    // Glass density enhancement after 80px
    if (headerPill) {
      if (currentY > 80) {
        headerPill.classList.add('glass--dense');
      } else {
        headerPill.classList.remove('glass--dense');
      }
    }

    // Hide on scroll down, show on scroll up
    if (currentY > 140 && currentY > lastScrollY && !isMegaOpen) {
      header.style.transform = 'translateY(-120%)';
    } else {
      header.style.transform = 'translateY(0%)';
    }
    lastScrollY = Math.max(0, currentY);
  }

  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  // 2. Sliding Active Lime Dot on Nav Hover
  if (navTrack && navDot) {
    const links = navTrack.querySelectorAll('.nav-link');
    const activeLink = navTrack.querySelector('.nav-link.is-current') || links[0];

    function moveDot(target) {
      if (!target) return;
      const trackRect = navTrack.getBoundingClientRect();
      const targetRect = target.getBoundingClientRect();
      const x = targetRect.left - trackRect.left + (targetRect.width / 2) - 3;
      navDot.style.transform = `translateX(${x}px)`;
      navDot.style.opacity = '1';
    }

    if (activeLink) {
      setTimeout(() => moveDot(activeLink), 150);
    }

    links.forEach(link => {
      link.addEventListener('mouseenter', () => moveDot(link));
    });

    navTrack.addEventListener('mouseleave', () => {
      if (activeLink) moveDot(activeLink);
      else navDot.style.opacity = '0';
    });
  }

  // 3. Services Mega-Menu (clipPath reveal & light-dismiss)
  if (servicesTrigger && servicesMegaMenu) {
    let closeTimeout;

    function openMega() {
      clearTimeout(closeTimeout);
      isMegaOpen = true;
      servicesMegaMenu.classList.add('is-active');
      servicesTrigger.setAttribute('aria-expanded', 'true');
    }

    function closeMega() {
      closeTimeout = setTimeout(() => {
        isMegaOpen = false;
        servicesMegaMenu.classList.remove('is-active');
        servicesTrigger.setAttribute('aria-expanded', 'false');
      }, 180);
    }

    servicesTrigger.addEventListener('mouseenter', openMega);
    servicesTrigger.addEventListener('focus', openMega);
    servicesMegaMenu.addEventListener('mouseenter', openMega);

    servicesTrigger.addEventListener('mouseleave', closeMega);
    servicesMegaMenu.addEventListener('mouseleave', closeMega);

    // Toggle on touch / click for keyboard and mobile accessibility
    servicesTrigger.addEventListener('click', function (e) {
      e.preventDefault();
      if (servicesMegaMenu.classList.contains('is-active')) {
        closeMega();
      } else {
        openMega();
      }
    });

    document.addEventListener('click', function (e) {
      if (!servicesMegaMenu.contains(e.target) && !servicesTrigger.contains(e.target)) {
        isMegaOpen = false;
        servicesMegaMenu.classList.remove('is-active');
        servicesTrigger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // 4. Mobile Full-Screen Glass Sheet Navigation
  if (mobileToggle && mobileDrawer) {
    function openMobileMenu() {
      mobileDrawer.classList.remove('hidden');
      mobileDrawer.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      if (typeof gsap !== 'undefined') {
        gsap.fromTo(mobileDrawer, { opacity: 0 }, { opacity: 1, duration: 0.35, ease: 'power2.out' });
        const items = mobileDrawer.querySelectorAll('.mobile-nav-item');
        gsap.fromTo(items, 
          { y: 35, opacity: 0 }, 
          { y: 0, opacity: 1, duration: 0.5, stagger: 0.08, ease: 'expo.out', delay: 0.1 }
        );
      }
    }

    function closeMobileMenu() {
      if (typeof gsap !== 'undefined') {
        gsap.to(mobileDrawer, {
          opacity: 0,
          duration: 0.3,
          ease: 'power2.in',
          onComplete: () => {
            mobileDrawer.classList.add('hidden');
            mobileDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
          }
        });
      } else {
        mobileDrawer.classList.add('hidden');
        mobileDrawer.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }
    }

    mobileToggle.addEventListener('click', openMobileMenu);
    if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);

    mobileDrawer.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', closeMobileMenu);
    });
  }
});
