/**
 * Famewoven Weave Helix Background Canvas 2D Engine
 * Spec: Section 8 of Blueprint (New Text Document.md)
 * Strict Anti-AI Rules: Pure Canvas 2D math, zero glows, zero bloom, zero additive blending.
 */

(function () {
  const c = document.getElementById('bg');
  if (!c) return;

  const ctx = c.getContext('2d');
  const DPR = Math.min(window.devicePixelRatio || 1, 1.5);
  const LOOP = 24; // 24-second seamless rotation
  const TAU = Math.PI * 2;
  const LITE = window.innerWidth < 768 || (navigator.hardwareConcurrency || 8) <= 4;
  const N = LITE ? 22 : 36;
  const P = LITE ? 50 : 90;
  const TURNS = 2.2;

  let W = 0, H = 0;
  let tx = 0, ty = 0, mx = 0, my = 0;
  let px = -9999, py = -9999;
  let run = true;
  let scrollProgress = 0; // For scroll-driven fade and translation

  function size() {
    W = c.width = window.innerWidth * DPR;
    H = c.height = window.innerHeight * DPR;
  }
  window.addEventListener('resize', size);
  size();

  window.addEventListener('pointermove', function (e) {
    tx = e.clientX / window.innerWidth - 0.5;
    ty = e.clientY / window.innerHeight - 0.5;
    px = e.clientX * DPR;
    py = e.clientY * DPR;
  });

  window.addEventListener('pointerleave', function () {
    px = -9999;
    py = -9999;
    tx = 0;
    ty = 0;
  });

  // Track scroll position to fade and shift the helix gently
  window.addEventListener('scroll', function () {
    const maxScroll = Math.max(document.body.scrollHeight - window.innerHeight, 1);
    scrollProgress = Math.min(window.scrollY / maxScroll, 1);
  }, { passive: true });

  // Dust particles on closed orbits (integer k keeps the loop perfectly seamless)
  const dust = Array.from({ length: P }, function (_, i) {
    return {
      a: Math.random() * TAU,
      r: 0.5 + Math.random() * 0.6,
      k: 1 + (i % 3),
      y: Math.random() * 2 - 1,
      lime: i % 9 === 0
    };
  });

  // 3D perspective projection into 2D canvas coordinates
  function project(x, y, z, rot) {
    const cs = Math.cos(rot), sn = Math.sin(rot);
    const X = x * cs + z * sn;
    const Z = -x * sn + z * cs;
    const s = 1 / (1.6 - Z * 0.6); // perspective scale
    
    // Shift slightly to the right on desktop to leave breathing room for hero text,
    // and shift right as user scrolls down
    const xOffsetRatio = (window.innerWidth >= 1024 ? 0.62 : 0.5) + (scrollProgress * 0.15);
    return {
      x: W * xOffsetRatio + X * s * H * 0.48,
      y: H * 0.5 + y * s * H * 0.48,
      s: s,
      z: Z
    };
  }

  function draw(now) {
    const ph = ((now / 1000) % LOOP) / LOOP * TAU;
    mx += (tx - mx) * 0.04;
    my += (ty - my) * 0.04;
    const rot = ph + mx * 0.5;

    ctx.clearRect(0, 0, W, H);
    ctx.lineWidth = DPR;

    // Apply scroll-scrubbed alpha so content remains perfectly legible as user scrolls
    const baseAlpha = Math.max(0.35, 1 - scrollProgress * 0.65);
    ctx.globalAlpha = baseAlpha;

    const A = [];
    const B = [];
    for (let i = 0; i < N; i++) {
      const u = i / (N - 1);
      const y = (u - 0.5) * 2.1 + my * 0.15;
      const ang = u * TURNS * TAU;
      A.push(project(Math.cos(ang) * 0.42, y, Math.sin(ang) * 0.42, rot));
      B.push(project(Math.cos(ang + Math.PI) * 0.42, y, Math.sin(ang + Math.PI) * 0.42, rot));
    }
    const all = A.concat(B);

    // Hairlines: Strands & Rungs (1px hairlines, alpha scaled by depth)
    const drawLine = function (p, q) {
      const d = (p.z + q.z) / 2 + 0.5;
      const alpha = Math.max(0.08, Math.min(0.35, 0.10 + 0.25 * d));
      ctx.strokeStyle = 'rgba(242, 245, 236, ' + alpha + ')';
      ctx.beginPath();
      ctx.moveTo(p.x, p.y);
      ctx.lineTo(q.x, q.y);
      ctx.stroke();
    };

    for (let i = 0; i < N; i++) {
      if (i < N - 1) {
        drawLine(A[i], A[i + 1]);
        drawLine(B[i], B[i + 1]);
      }
      drawLine(A[i], B[i]); // Rungs connecting strand A and strand B
    }

    // Dust & Nearest-Node Hairline Connections
    const reach = H * 0.16;
    dust.forEach(function (d) {
      const a = d.a + ph * d.k;
      const p = project(Math.cos(a) * d.r, d.y, Math.sin(a) * d.r, rot * 0.5);
      let best = null;
      let bd = reach;

      for (let j = 0; j < all.length; j++) {
        const n = all[j];
        const dd = Math.hypot(n.x - p.x, n.y - p.y);
        if (dd < bd) {
          bd = dd;
          best = n;
        }
      }

      if (best && !LITE) {
        const linkAlpha = 0.22 * (1 - bd / reach);
        ctx.strokeStyle = 'rgba(242, 245, 236, ' + linkAlpha + ')';
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(best.x, best.y);
        ctx.stroke();
      }

      ctx.fillStyle = d.lime
        ? 'rgba(212, 245, 79, 0.75)'
        : 'rgba(242, 245, 236, ' + (0.15 + 0.25 * (p.z + 0.6)) + ')';
      ctx.beginPath();
      ctx.arc(p.x, p.y, Math.max(1, (1 + p.s) * DPR * 0.8), 0, TAU);
      ctx.fill();
    });

    // Helix Nodes (Solid circular dots, cursor proximity repel)
    all.forEach(function (n, i) {
      let x = n.x, y = n.y;
      const dx = x - px, dy = y - py;
      const dist = Math.hypot(dx, dy);
      const R = 120 * DPR;

      if (dist < R && dist > 0) {
        const f = (1 - dist / R) * 10 * DPR;
        x += (dx / dist) * f;
        y += (dy / dist) * f;
      }

      ctx.fillStyle = (i % 11 === 0)
        ? '#D4F54F'
        : 'rgba(242, 245, 236, ' + Math.min(1, Math.max(0.2, 0.35 + 0.6 * (n.z + 0.5))) + ')';

      ctx.beginPath();
      ctx.arc(x, y, Math.max(1.2, (1.5 + 2.5 * n.s) * DPR * 0.75), 0, TAU);
      ctx.fill();
    });

    ctx.globalAlpha = 1.0;
  }

  let last = 0;
  function tick(now) {
    if (run && now - last > (LITE ? 33 : 16)) {
      last = now;
      draw(now);
    }
    requestAnimationFrame(tick);
  }

  // Accessibility check: Render static single frame if user prefers reduced motion
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    draw(0);
  } else {
    requestAnimationFrame(tick);
  }

  // Pause rendering when tab is hidden or canvas is not intersecting
  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      if (entries[0]) run = entries[0].isIntersecting;
    }).observe(c);
  }

  document.addEventListener('visibilitychange', function () {
    run = !document.hidden;
  });
})();
