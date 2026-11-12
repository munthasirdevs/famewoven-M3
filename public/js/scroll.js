/**
 * Famewoven Scroll & Interactive Components Orchestration
 * Spec: Sections 6, 7, 9, 10, 11 of Blueprint (New Text Document.md)
 */

document.addEventListener('DOMContentLoaded', function () {
  const isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // 1. Liquid Glass Specular Sheen Cursor Tracker (Section 6)
  if (!isTouch) {
    document.querySelectorAll('.glass').forEach(el => {
      el.addEventListener('pointermove', e => {
        const r = el.getBoundingClientRect();
        el.style.setProperty('--mx', (e.clientX - r.left) + 'px');
        el.style.setProperty('--my', (e.clientY - r.top) + 'px');
      });
    });
  }

  // 2. Custom Cursor with "View" state over case studies (Section 9.3)
  const cursorDot = document.getElementById('custom-cursor-dot');
  const cursorRing = document.getElementById('custom-cursor-ring');

  if (cursorDot && cursorRing && !isTouch && !reduceMotion && typeof gsap !== 'undefined') {
    document.documentElement.classList.add('has-custom-cursor');
    gsap.set([cursorDot, cursorRing], { xPercent: -50, yPercent: -50, opacity: 0 });

    const xToDot = gsap.quickTo(cursorDot, 'x', { duration: 0.08, ease: 'power2.out' });
    const yToDot = gsap.quickTo(cursorDot, 'y', { duration: 0.08, ease: 'power2.out' });
    const xToRing = gsap.quickTo(cursorRing, 'x', { duration: 0.25, ease: 'power2.out' });
    const yToRing = gsap.quickTo(cursorRing, 'y', { duration: 0.25, ease: 'power2.out' });

    let hasMoved = false;

    window.addEventListener('pointermove', e => {
      if (!hasMoved) {
        hasMoved = true;
        gsap.to([cursorDot, cursorRing], { opacity: 1, duration: 0.25 });
      }
      xToDot(e.clientX);
      yToDot(e.clientY);
      xToRing(e.clientX);
      yToRing(e.clientY);
    });

    document.addEventListener('mouseenter', () => {
      if (hasMoved) {
        gsap.to([cursorDot, cursorRing], { opacity: 1, duration: 0.2 });
      }
    });

    document.addEventListener('mouseleave', () => {
      gsap.to([cursorDot, cursorRing], { opacity: 0, duration: 0.2 });
    });

    // Enlarge ring and display "View" text over interactive elements
    document.querySelectorAll('a, button, .interactive-card, .case-study-card, input, textarea, select, [role="button"]').forEach(el => {
      el.addEventListener('mouseenter', () => {
        if (el.classList.contains('case-study-card') || el.hasAttribute('data-cursor-view')) {
          cursorRing.classList.add('cursor-view');
          cursorRing.textContent = 'View';
          gsap.to(cursorDot, { scale: 0.5, opacity: 0, duration: 0.2 });
          gsap.to(cursorRing, { scale: 1, duration: 0.25 });
        } else {
          cursorRing.style.borderColor = 'rgba(212, 245, 79, 0.8)';
          gsap.to(cursorRing, { scale: 1.25, duration: 0.25 });
          gsap.to(cursorDot, { scale: 1.15, rotation: 6, duration: 0.25 });
        }
      });
      el.addEventListener('mouseleave', () => {
        cursorRing.classList.remove('cursor-view');
        cursorRing.textContent = '';
        cursorRing.style.borderColor = 'rgba(212, 245, 79, 0.4)';
        gsap.to(cursorRing, { scale: 1, duration: 0.25 });
        gsap.to(cursorDot, { scale: 1, opacity: 1, rotation: 0, duration: 0.25 });
      });
    });
  } else if (isTouch) {
    if (cursorDot) cursorDot.style.display = 'none';
    if (cursorRing) cursorRing.style.display = 'none';
  }



  // 4. GSAP ScrollTrigger Animations
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && !reduceMotion) {
    gsap.registerPlugin(ScrollTrigger);

    // Text reveals on headings with .reveal-heading
    document.querySelectorAll('.reveal-heading').forEach(heading => {
      gsap.fromTo(heading.querySelectorAll('.reveal-line'),
        { yPercent: 105, opacity: 0 },
        {
          yPercent: 0,
          opacity: 1,
          duration: 1.0,
          stagger: 0.08,
          ease: 'expo.out',
          scrollTrigger: {
            trigger: heading,
            start: 'top 85%',
            once: true
          }
        }
      );
    });

    // Stagger fade-in for cards
    document.querySelectorAll('.stagger-grid').forEach(grid => {
      gsap.fromTo(grid.children,
        { y: 35, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.75,
          stagger: 0.1,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: grid,
            start: 'top 85%',
            once: true
          }
        }
      );
    });

    // Stat Band Number Counters (Section 10.6)
    document.querySelectorAll('.stat-counter').forEach(stat => {
      const targetVal = parseFloat(stat.getAttribute('data-target') || '0');
      const prefix = stat.getAttribute('data-prefix') || '';
      const suffix = stat.getAttribute('data-suffix') || '';
      const decimals = parseInt(stat.getAttribute('data-decimals') || '0', 10);
      const obj = { val: 0 };

      ScrollTrigger.create({
        trigger: stat,
        start: 'top 88%',
        once: true,
        onEnter: () => {
          gsap.to(obj, {
            val: targetVal,
            duration: 2.0,
            ease: 'power2.out',
            onUpdate: () => {
              stat.textContent = prefix + (decimals > 0 ? obj.val.toFixed(decimals) : Math.round(obj.val).toLocaleString()) + suffix;
            }
          });
        }
      });
    });

    // The Weave System Thread Draw (Section 10.4)
    const threadPath = document.getElementById('weave-thread-path');
    const weaveSteps = document.querySelectorAll('.weave-step-card');
    if (threadPath && weaveSteps.length > 0) {
      const pathLength = threadPath.getTotalLength();
      threadPath.style.strokeDasharray = pathLength;
      threadPath.style.strokeDashoffset = pathLength;

      gsap.to(threadPath, {
        strokeDashoffset: 0,
        ease: 'none',
        scrollTrigger: {
          trigger: '#weave-system-section',
          start: 'top 70%',
          end: 'bottom 80%',
          scrub: 0.5,
          onUpdate: (self) => {
            const stepIndex = Math.min(Math.floor(self.progress * weaveSteps.length), weaveSteps.length - 1);
            weaveSteps.forEach((card, idx) => {
              if (idx <= stepIndex) {
                card.classList.add('border-lime/40', 'bg-white/[0.04]');
              } else {
                card.classList.remove('border-lime/40', 'bg-white/[0.04]');
              }
            });
          }
        }
      });
    }

    // Problem Section sequential brighten scrub (Section 10.3)
    const problemCards = document.querySelectorAll('.problem-card');
    if (problemCards.length > 0) {
      problemCards.forEach((card, idx) => {
        gsap.fromTo(card,
          { opacity: 0.35, y: 15 },
          {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: card,
              start: 'top 80%',
              end: 'top 50%',
              scrub: true
            }
          }
        );
      });
    }

    // Vetting Score Animated SVG Meter Ring (Section 10.8)
    const vettingRing = document.getElementById('vetting-score-ring');
    const vettingScoreNum = document.getElementById('vetting-score-val');
    if (vettingRing && vettingScoreNum) {
      const circumference = 2 * Math.PI * 54; // r=54
      vettingRing.style.strokeDasharray = circumference;
      vettingRing.style.strokeDashoffset = circumference;

      const targetScore = 94;
      const targetOffset = circumference * (1 - targetScore / 100);
      const scoreObj = { val: 0 };

      ScrollTrigger.create({
        trigger: '#vetting-section',
        start: 'top 80%',
        once: true,
        onEnter: () => {
          gsap.to(vettingRing, {
            strokeDashoffset: targetOffset,
            duration: 2.0,
            ease: 'power2.out'
          });
          gsap.to(scoreObj, {
            val: targetScore,
            duration: 2.0,
            ease: 'power2.out',
            onUpdate: () => {
              vettingScoreNum.textContent = Math.round(scoreObj.val) + '%';
            }
          });
        }
      });
    }
  }

  // 5. Accordion Mechanics (Section 10.11)
  document.querySelectorAll('.faq-accordion-item').forEach(item => {
    const trigger = item.querySelector('.faq-trigger');
    const body = item.querySelector('.faq-answer-inner');
    const icon = item.querySelector('.faq-icon');

    if (trigger && body) {
      trigger.addEventListener('click', () => {
        const isOpen = item.classList.contains('is-open');

        // Close all other open items for cleaner UX
        document.querySelectorAll('.faq-accordion-item.is-open').forEach(other => {
          if (other !== item) {
            other.classList.remove('is-open');
            const otherBody = other.querySelector('.faq-answer-inner');
            const otherIcon = other.querySelector('.faq-icon');
            if (otherBody) otherBody.style.height = '0px';
            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
            other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
          }
        });

        if (isOpen) {
          item.classList.remove('is-open');
          body.style.height = '0px';
          if (icon) icon.style.transform = 'rotate(0deg)';
          trigger.setAttribute('aria-expanded', 'false');
        } else {
          item.classList.add('is-open');
          body.style.height = body.scrollHeight + 'px';
          if (icon) icon.style.transform = 'rotate(45deg)';
          trigger.setAttribute('aria-expanded', 'true');
        }
      });
    }
  });

  // 6. Testimonials Auto-Advancing Slider (Section 10.10)
  const slides = document.querySelectorAll('.testimonial-slide');
  if (slides.length > 1) {
    let currentSlide = 0;
    setInterval(() => {
      slides[currentSlide].classList.remove('opacity-100', 'pointer-events-auto');
      slides[currentSlide].classList.add('opacity-0', 'pointer-events-none');

      currentSlide = (currentSlide + 1) % slides.length;

      slides[currentSlide].classList.remove('opacity-0', 'pointer-events-none');
      slides[currentSlide].classList.add('opacity-100', 'pointer-events-auto');
    }, 7000);
  }

  // 7. Creators Dual Audience Switch (Section 11.3)
  const toggleBrands = document.getElementById('toggle-brands');
  const toggleCreators = document.getElementById('toggle-creators');
  const viewBrands = document.getElementById('audience-brands-view');
  const viewCreators = document.getElementById('audience-creators-view');
  const toggleThumb = document.getElementById('audience-toggle-thumb');

  if (toggleBrands && toggleCreators && viewBrands && viewCreators && toggleThumb) {
    toggleBrands.addEventListener('click', () => {
      toggleThumb.style.transform = 'translateX(0%)';
      toggleBrands.classList.add('text-ink');
      toggleBrands.classList.remove('text-muted');
      toggleCreators.classList.remove('text-ink');
      toggleCreators.classList.add('text-muted');

      viewBrands.classList.remove('hidden');
      viewCreators.classList.add('hidden');
    });

    toggleCreators.addEventListener('click', () => {
      toggleThumb.style.transform = 'translateX(100%)';
      toggleCreators.classList.add('text-ink');
      toggleCreators.classList.remove('text-muted');
      toggleBrands.classList.remove('text-ink');
      toggleBrands.classList.add('text-muted');

      viewCreators.classList.remove('hidden');
      viewBrands.classList.add('hidden');
    });
  }

  // 8. Contact Strategy Call Form AJAX Submission Simulator (Section 11.7)
  const contactForm = document.getElementById('strategy-call-form');
  const contactSuccess = document.getElementById('strategy-call-success');

  if (contactForm && contactSuccess) {
    contactForm.addEventListener('submit', e => {
      e.preventDefault();
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="label-caps">Securing Brief...</span>';
      }

      setTimeout(() => {
        contactForm.classList.add('hidden');
        contactSuccess.classList.remove('hidden');

        // Animate SVG checkmark drawing
        const checkPath = document.getElementById('success-check-path');
        if (checkPath && typeof gsap !== 'undefined') {
          const l = checkPath.getTotalLength();
          checkPath.style.strokeDasharray = l;
          checkPath.style.strokeDashoffset = l;
          gsap.to(checkPath, { strokeDashoffset: 0, duration: 0.8, ease: 'power2.out' });
        }
      }, 700);
    });
  }

  // 10. Trust Strip Infinite Marquee Dynamic Generator (Section 10.2)
  function initTrustMarquee() {
    const trustMarqueeTrack = document.getElementById('trust-marquee-track');
    if (!trustMarqueeTrack) return;
    const TRUST_BRANDS = [
      'HeyGen',
      'higgsfield',
      'omneky',
      'imagineart',
      'flot.ai',
      'skywork',
      'Sintra.ai'
    ];
    window.TRUST_BRANDS = TRUST_BRANDS;

    // Generate seamless dual sequence for infinite translation
    const items = [...TRUST_BRANDS, ...TRUST_BRANDS, ...TRUST_BRANDS, ...TRUST_BRANDS];
    trustMarqueeTrack.innerHTML = items.map(brand => `
      <span class="whitespace-nowrap transition-colors hover:text-[#D4F54F] cursor-default">${brand}</span>
      <span class="text-[#D4F54F]/40 font-mono text-sm select-none" aria-hidden="true">/</span>
    `).join('');
  }

  initTrustMarquee();
});



