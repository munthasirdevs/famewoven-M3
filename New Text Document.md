Famewoven Website Blueprint
Front-end design spec · HTML + CSS + Tailwind + JS + GSAP only · no images required

0. Read this first
Assumption: your dictation said "X-based agency." I read that as influencer / creator marketing agency, which matches Famewoven. If you meant something else, sections 1–2 change, sections 3–12 mostly don't.
Honesty note on the research: I pulled structure, nav, copy patterns and positioning from the agencies' public pages and directory listings. Animation behavior is my recommendation, not a claim about what they run. Open each reference site yourself with DevTools before you copy any detail.
The goal in one line: a dark, cinematic, liquid-glass site where the lime from your logo is the only color that matters, and every animation exists to guide attention to the next action: book a call.

1. Research: five influencer agencies, what to steal, what to skip
Agency	What their site does	Steal	Skip
Obviously (NYC, WPP-owned)	Leads with a big "iconic brands" claim, Fortune 500 trust strip, then hard counters: 152,562 collaborations, 5.17B+ organic impressions, 425,634 pieces of content. Sells scale and proprietary tech under a full-service agency.	The stat counter band. Numbers do the persuading. A "competitive analysis" hook as a lead magnet.	Corporate heaviness, long text blocks, generic stock-style layout.
Viral Nation	Enterprise "operating model" pitch. Nav is Marketing Services / Talent / Solutions / Resources / About. Branded proprietary products (Secure, CreatorOS). Gated white paper as a CTA. Resources hub with lists and blog.	Productized naming of your systems (give your internal process a name). Mega-menu structure. Gated report CTA.	Overstuffed nav, too many service lines. You're not selling to Fortune 500s yet.
Ubiquitous	Modern, short-form focused. Paid amplification plus creator matchmaking. Large minimum engagement, which signals premium and filters leads. 300+ Google reviews used as social proof.	Premium filtering: state who you're for. Review/rating proof. Focus on one core promise.	Anything that reads like a listicle-driven SEO site.
NoGood	Performance-led positioning, award-backed case studies, creator campaigns tied to measurable outcomes.	Case study cards led by a result number, not a logo. Performance language.	Growth-agency jargon overload.
The Influencer Marketing Factory	Global creator relationships, full-service across TikTok, Instagram, YouTube, creative production.	Platform icons as a minimal credibility strip. Clear "what we run" breakdown by platform.	Dense service lists, busy layout.
Design references (non-agency) for the feel: Linear (dark restraint, typography), Stripe (gradient craft, spacing), Framer (scroll storytelling), Apple (liquid glass material language), Vercel and Resend (premium dark with a single accent).

2. What actually makes these sites convert (the mechanism)
1.	One promise above the fold. Not a service list. A promise plus one button.
2.	Proof within one scroll. Numbers, logos, ratings. The fastest trust transfer.
3.	Productized process. A named, numbered system makes you look like a company, not freelancers.
4.	Results-first case studies. The metric is the headline.
5.	Repeated CTA, same wording. Visible in header, hero, mid-page, footer.
6.	Filtering. Telling the wrong customer "not for you" raises perceived value.
Why most agency sites fail: they describe services. The visitor wants to know one thing: will this person make me money, and how fast? Everything on the page answers that or gets cut.
Your unfair advantage on the site: you build systems and automation. Make the site itself the proof: fast, precise, zero template feel.

3. Positioning and voice
Core line (confirm before building): Famewoven weaves brands into creator culture, and tracks every rupee of it.
Voice: direct, sharp, slightly dry. No "synergy," no "unlock," no exclamation marks.
Primary CTA label (use everywhere, identical): Book a strategy call Secondary CTA: See the work
H1 options for the hero (pick one, A/B later):
•	A: Creators don't sell ads. They sell trust. We weave it.
•	B: Influence, engineered.
•	C: The creator marketing system brands actually track.
Recommendation: B as H1, A as the sub-headline. B is short enough to animate letter by letter and sits well beside a logo this geometric.

4. Brand tokens (from your logo)
The logo is a near-black geometric mark (a V that reads as a W/F hybrid with a detached triangle) on a gradient running from pale lime (top-left) through bright lime to a deeper green (bottom-right). Values below are sampled by eye from the image. Verify with an eyedropper on the original file and correct.
Token	Hex	Use
--bg	#080A07	Page background (near-black with a green undertone, not pure black)
--bg-2	#0E120C	Section alternates, cards base
--ink	#101210	The logo's mark color
--text	#F2F5EC	Primary text (warm off-white)
--muted	#9AA391	Secondary text
--lime	#D4F54F	Primary accent, CTAs, glows
--lime-pale	#F0FFB0	Highlights, hero light source
--green	#7CB83A	Gradient end, secondary accent
--line	rgba(255,255,255,0.08)	Hairlines and glass borders
Brand gradient: linear-gradient(135deg, #F0FFB0 0%, #D4F54F 45%, #7CB83A 100%)
Rules:
•	Lime appears in at most ~8% of any viewport: CTA, one headline word, glows, icons. More than that looks cheap.
•	Black text on lime surfaces (matches the logo). Never white on lime.
•	No second accent color. Ever.
Typography (Google Fonts, free):
•	Headings: Space Grotesk or Sora (geometric, matches the logo's angles). Weight 500–600, tight tracking (-0.03em).
•	Body: Inter 400/500.
•	Mono accents (labels, numbers): JetBrains Mono.
•	Type scale (desktop): H1 clamp(3.5rem, 9vw, 8.5rem), H2 clamp(2.25rem, 5vw, 4.5rem), H3 1.5rem, body 1.0625rem, label 0.75rem uppercase with 0.14em tracking.
•	Line-height: headings 0.95–1.05, body 1.6.
Spacing: 8px base. Section padding clamp(6rem, 12vw, 12rem) vertical. Max content width 1280px. Lots of air; that's what "premium minimal" is made of.

5. Stack and file structure
•	HTML5, semantic.
•	Tailwind via CDN for speed during build (switch to the Tailwind CLI build for production so unused CSS is purged).
•	Vanilla JS modules.
•	GSAP with ScrollTrigger and SplitText (GSAP and its plugins are now free to use; confirm the current license on gsap.com before shipping).
•	No Three.js, no React, no smooth-scroll library. Native scroll plus ScrollTrigger is enough and more reliable.
/famewoven
  index.html
  /services/index.html
  /services/influencer-campaigns.html (+ other service pages)
  /creators.html
  /work/index.html
  /work/case-study.html (template)
  /about.html
  /insights/index.html
  /contact.html
  404.html
  /css/glass.css      (glass + tokens, things Tailwind can't express)
  /js/loader.js
  /js/header.js
  /js/hero.js
  /js/scroll.js       (all ScrollTrigger sections)
  /js/bg.js           (background shader / canvas)
  /js/main.js         (init order)
Tailwind config (inline in <script> for CDN mode):
tailwind.config = {
  theme: { extend: {
    colors: { bg:'#080A07', bg2:'#0E120C', ink:'#101210', text:'#F2F5EC',
              muted:'#9AA391', lime:'#D4F54F', limepale:'#F0FFB0', green:'#7CB83A' },
    fontFamily: { head:['Space Grotesk','sans-serif'], body:['Inter','sans-serif'],
                  mono:['JetBrains Mono','monospace'] }
  }}
}

6. The liquid glass system
What "liquid glass" actually is: a translucent surface that blurs and refracts what's behind it, with a bright rim light on the edge. Cheap versions only blur. The premium look comes from four layers: blur, tint, inner highlight, and edge light.
Core CSS (glass.css):
:root{
  --bg:#080A07; --text:#F2F5EC; --lime:#D4F54F; --line:rgba(255,255,255,.08);
}
html{background:var(--bg);color:var(--text);scroll-behavior:auto}

.glass{
  position:relative;
  background:linear-gradient(135deg,rgba(255,255,255,.08),rgba(255,255,255,.02));
  -webkit-backdrop-filter:blur(18px) saturate(160%);
  backdrop-filter:blur(18px) saturate(160%);
  border:1px solid var(--line);
  border-radius:24px;
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,.18),      /* top rim light */
    inset 0 -1px 0 rgba(255,255,255,.03),
    0 20px 60px -20px rgba(0,0,0,.7);
  overflow:hidden;
}
/* specular sheen that follows the cursor (2D, not 3D) */
.glass::before{
  content:"";position:absolute;inset:0;pointer-events:none;
  background:radial-gradient(420px circle at var(--mx,50%) var(--my,0%),
             rgba(212,245,79,.12),transparent 60%);
  opacity:0;transition:opacity .4s ease;
}
.glass:hover::before{opacity:1}
/* edge light */
.glass::after{
  content:"";position:absolute;inset:0;border-radius:inherit;padding:1px;
  background:linear-gradient(160deg,rgba(255,255,255,.35),transparent 35%,transparent 65%,rgba(212,245,79,.25));
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
  -webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none;
}
.glass--pill{border-radius:999px}
.glass--lime{background:linear-gradient(135deg,#F0FFB0,#D4F54F 50%,#9CD13F);color:#101210;border:0}

@supports not (backdrop-filter:blur(1px)){
  .glass{background:rgba(20,26,18,.92)}
}
Optional refraction (Chromium only, progressive enhancement): an SVG displacement filter makes the glass bend the background. Use it only on the header pill and one hero card, never on everything.
<svg width="0" height="0" style="position:absolute">
  <filter id="refract" x="0" y="0" width="100%" height="100%">
    <feTurbulence type="fractalNoise" baseFrequency="0.012" numOctaves="2" seed="4" result="n"/>
    <feDisplacementMap in="SourceGraphic" in2="n" scale="14" xChannelSelector="R" yChannelSelector="G"/>
  </filter>
</svg>

@supports (backdrop-filter:url(#refract)) {
  .glass--refract{backdrop-filter:url(#refract) blur(10px) saturate(160%)}
}
Safari and Firefox ignore this, so the base blur must always look good alone.
Cursor-following sheen (JS):
document.querySelectorAll('.glass').forEach(el=>{
  el.addEventListener('pointermove',e=>{
    const r=el.getBoundingClientRect();
    el.style.setProperty('--mx',(e.clientX-r.left)+'px');
    el.style.setProperty('--my',(e.clientY-r.top)+'px');
  });
});
Glass rules: blur 12–24px. Max 4 overlapping glass layers on screen. Glass needs something behind it that moves or glows, otherwise it's just a gray box. That's the job of the background (section 8).

7. Motion system (GSAP)
No 3D hover. No tilt cards, no rotateX/rotateY on hover. Hover feedback is limited to: translate Y by up to 4px, border brightening, cursor sheen, and underline wipes.
Global timing tokens:
•	Ease in: power3.out for entrances, power2.inOut for transitions, expo.out for hero reveals.
•	Durations: micro 0.25s, standard 0.6–0.9s, hero 1.2–1.6s.
•	Stagger: 0.06–0.1s.
•	Distance: entrances translate 40px max. Bigger looks like a template.
•	Rule: every animation answers "where should the eye go next?" If it can't, delete it.
Reduced motion (mandatory):
const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
if (reduce) { gsap.globalTimeline.timeScale(100); ScrollTrigger.config({limitCallbacks:true}); }
7.1 Loading screen (name + logo)
Concept: full black screen, the mark draws itself, wordmark reveals under it, a thin lime progress line fills, then the screen splits upward like a curtain and the hero begins. Total time 2.2–2.8s, and it only plays once per session (sessionStorage).
Structure:
<div id="loader" class="fixed inset-0 z-[999] bg-bg grid place-items-center">
  <div class="text-center">
    <!-- inline the logo as SVG so paths can animate -->
    <svg id="loader-mark" viewBox="0 0 400 400" class="w-24 h-24 mx-auto">
      <path id="mark-main" d="/* logo path */" fill="none" stroke="#D4F54F" stroke-width="2"/>
      <path id="mark-tri"  d="/* triangle path */" fill="none" stroke="#D4F54F" stroke-width="2"/>
    </svg>
    <div id="loader-word" class="font-head text-3xl tracking-tight mt-6 overflow-hidden">
      <span class="inline-block">Famewoven</span>
    </div>
    <div class="w-48 h-px bg-white/10 mt-8 mx-auto overflow-hidden">
      <div id="loader-bar" class="h-full w-full bg-lime origin-left scale-x-0"></div>
    </div>
  </div>
</div>
Timeline (loader.js): export the logo from Illustrator/Figma as SVG and paste its path data in. Compute lengths with getTotalLength().
function playLoader(done){
  if (sessionStorage.getItem('fw_seen')) { document.getElementById('loader').remove(); return done(); }
  const paths = document.querySelectorAll('#loader-mark path');
  paths.forEach(p=>{ const L=p.getTotalLength(); p.style.strokeDasharray=L; p.style.strokeDashoffset=L; });

  const tl = gsap.timeline({ onComplete:()=>{ sessionStorage.setItem('fw_seen','1'); done(); }});
  tl.to(paths,{strokeDashoffset:0,duration:1.1,ease:'power2.inOut',stagger:.15})
    .to(paths,{fill:'#D4F54F',stroke:'transparent',duration:.4},'-=.2')           // fill in
    .from('#loader-word span',{yPercent:110,duration:.7,ease:'expo.out'},'-=.3')
    .to('#loader-bar',{scaleX:1,duration:.9,ease:'power1.inOut'},'<')
    .to('#loader-mark,#loader-word,#loader-bar',{opacity:0,y:-12,duration:.4,stagger:.04},'+=.15')
    .to('#loader',{yPercent:-100,duration:.9,ease:'expo.inOut'})
    .set('#loader',{display:'none'});
}
Do not fake a long load. If the page is ready earlier, still play the short version. If it's not ready, hold on the bar at 90% until window.load fires.
7.2 Page transitions (multi-page)
On internal link click: a lime-tinted glass panel wipes up (0.6s expo.inOut), navigate, panel wipes away on the new page. Keep it under 1.2s total. Skip on reduced motion.
7.3 Text reveal pattern (all H1/H2)
Use SplitText by lines. Each line sits in an overflow:hidden mask and rises from yPercent:105.
function revealHeading(el){
  const split = SplitText.create(el,{type:'lines',mask:'lines'});
  gsap.from(split.lines,{yPercent:105,duration:1,ease:'expo.out',stagger:.08,
    scrollTrigger:{trigger:el,start:'top 85%',once:true}});
}
7.4 Buttons (2D only)
•	Primary (lime): on hover the label slides up and an identical label slides in from below (text-swap), and a soft lime glow expands. Arrow icon translates 4px right.
•	Secondary (glass): border brightens, sheen follows cursor.
•	Magnetic pull: max 8px translate toward the cursor, desktop only. It's 2D, so it fits the "no 3D" rule. Cut it if it feels gimmicky in testing.

8. Background: the Weave Helix
Decision: a looping double helix of connected nodes and drifting particles, drawn flat. No glow of any kind. It replaces the shader idea from the first draft.
Why a helix: two strands interlacing is the brand name made visible. Fame and woven in one shape: brand strand, creator strand, rungs between them. It's a metaphor you can explain in one sentence, which is what separates a concept from decoration.
The anti-AI-look rules (hard bans):
•	No bloom, box-shadow glows, shadowBlur, radial-gradient orbs or blurred blobs.
•	No additive blending (lighter), lens flares, sparkles, neon outlines or gradient strokes.
•	No purple/blue haze and no "aurora." The only color is off-white and a few lime nodes.
•	Everything is a solid dot or a 1px hairline. Depth comes from size and opacity only.
This is what makes it read as engineered instead of generated: precision, restraint and math, not effects.
Visual spec:
Element	Spec
Helix	2 strands, 36 rungs (22 on mobile), 2.2 turns, radius ~42% of viewport height, rotating about the vertical axis
Nodes	Solid circles, 1.5–3px scaled by depth. 90% off-white #F2F5EC, ~10% lime #D4F54F. No outline, no halo
Lines	1px hairlines along each strand and one rung per node pair, alpha 0.10 (back) to 0.35 (front)
Dust	90 tiny particles on closed orbits around the helix, 1–2px, alpha 0.15–0.40
Connections	Each dust particle links to its single nearest helix node if within ~16% of viewport height. Alpha falls off with distance
Loop	One full rotation every 24s. Dust orbits use whole-number cycles, so the loop has no visible seam
Depth	Perspective projection, back nodes smaller and fainter. Looks 3D, but it's plain 2D canvas math
Interaction	Cursor tilts the helix up to ~6° (eased). Nodes within 120px of the cursor are pushed away by a few pixels. No click effects
Scroll	Helix slides right and drops to ~35% opacity as content arrives (ScrollTrigger scrub) so text stays readable
Grain	Optional fixed noise overlay at 3–4%, only to prevent gradient banding on the dark background. If it reads as a texture effect, delete it
Implementation (bg.js, Canvas 2D, zero libraries, no glow):
const c = document.getElementById('bg'), ctx = c.getContext('2d');
const DPR = Math.min(devicePixelRatio, 1.5), LOOP = 24, TAU = Math.PI * 2;
const LITE = innerWidth < 768 || (navigator.hardwareConcurrency || 8) <= 4;
const N = LITE ? 22 : 36, P = LITE ? 50 : 90, TURNS = 2.2;
let W, H, tx = 0, ty = 0, mx = 0, my = 0, run = true, px = -999, py = -999;

function size(){ W = c.width = innerWidth * DPR; H = c.height = innerHeight * DPR; }
addEventListener('resize', size); size();
addEventListener('pointermove', e => {
  tx = e.clientX / innerWidth - .5; ty = e.clientY / innerHeight - .5;
  px = e.clientX * DPR; py = e.clientY * DPR;
});

// dust rides closed orbits; integer k keeps the loop seamless
const dust = Array.from({ length: P }, (_, i) => ({
  a: Math.random() * TAU, r: .5 + Math.random() * .6, k: 1 + (i % 3),
  y: Math.random() * 2 - 1, lime: i % 9 === 0
}));

function project(x, y, z, rot){
  const cs = Math.cos(rot), sn = Math.sin(rot);
  const X = x * cs + z * sn, Z = -x * sn + z * cs, s = 1 / (1.6 - Z * .6);
  return { x: W * .62 + X * s * H * .5, y: H * .5 + y * s * H * .5, s, z: Z };
}

function draw(now){
  const ph = ((now / 1000) % LOOP) / LOOP * TAU;
  mx += (tx - mx) * .04; my += (ty - my) * .04;
  const rot = ph + mx * .5;
  ctx.clearRect(0, 0, W, H);
  ctx.lineWidth = DPR;

  const A = [], B = [];
  for (let i = 0; i < N; i++){
    const u = i / (N - 1), y = (u - .5) * 2.1 + my * .15, ang = u * TURNS * TAU;
    A.push(project(Math.cos(ang) * .42, y, Math.sin(ang) * .42, rot));
    B.push(project(Math.cos(ang + Math.PI) * .42, y, Math.sin(ang + Math.PI) * .42, rot));
  }
  const all = A.concat(B);

  // hairlines: strands + rungs
  const line = (p, q) => {
    const d = (p.z + q.z) / 2 + .5;
    ctx.strokeStyle = `rgba(242,245,236,${.10 + .25 * Math.max(0, Math.min(1, d))})`;
    ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(q.x, q.y); ctx.stroke();
  };
  for (let i = 0; i < N; i++){
    if (i < N - 1){ line(A[i], A[i + 1]); line(B[i], B[i + 1]); }
    line(A[i], B[i]);
  }

  // dust + nearest-node connection
  const reach = H * .16;
  dust.forEach(d => {
    const a = d.a + ph * d.k;
    const p = project(Math.cos(a) * d.r, d.y, Math.sin(a) * d.r, rot * .5);
    let best = null, bd = reach;
    for (const n of all){ const dd = Math.hypot(n.x - p.x, n.y - p.y); if (dd < bd){ bd = dd; best = n; } }
    if (best && !LITE){
      ctx.strokeStyle = `rgba(242,245,236,${.22 * (1 - bd / reach)})`;
      ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(best.x, best.y); ctx.stroke();
    }
    ctx.fillStyle = d.lime ? 'rgba(212,245,79,.7)' : `rgba(242,245,236,${.15 + .25 * (p.z + .6)})`;
    ctx.beginPath(); ctx.arc(p.x, p.y, (1 + p.s) * DPR, 0, TAU); ctx.fill();
  });

  // helix nodes (solid dots, cursor repel)
  all.forEach((n, i) => {
    let x = n.x, y = n.y;
    const dx = x - px, dy = y - py, dist = Math.hypot(dx, dy), R = 120 * DPR;
    if (dist < R){ const f = (1 - dist / R) * 10 * DPR; x += dx / dist * f; y += dy / dist * f; }
    ctx.fillStyle = i % 11 === 0 ? '#D4F54F' : `rgba(242,245,236,${.35 + .6 * (n.z + .5)})`;
    ctx.beginPath(); ctx.arc(x, y, (1.5 + 2.5 * n.s) * DPR, 0, TAU); ctx.fill();
  });
}

let last = 0;
function tick(now){
  if (run && now - last > (LITE ? 33 : 16)){ last = now; draw(now); }
  requestAnimationFrame(tick);
}
if (matchMedia('(prefers-reduced-motion: reduce)').matches) draw(0); else requestAnimationFrame(tick);

new IntersectionObserver(([e]) => run = e.isIntersecting).observe(c);
document.addEventListener('visibilitychange', () => run = !document.hidden);
The canvas is position:fixed; inset:0; z-index:0, content sits above it, and the glass panels blur the helix as it passes behind them. That's the whole point of the glass system: structure behind frosted glass reads as depth, a flat color doesn't.
Intro assembly (GSAP): instead of fading in, the helix builds itself. Animate a progress value from 0 to 1 over 1.6s (expo.out); only rungs with u <= progress are drawn, so the helix grows bottom to top. Dust fades in after, over 1s.
Option B, lite mode (mobile, 4 cores or fewer): 22 rungs, 50 dust particles, no proximity lines, 30fps cap. All of it is in the code above (LITE). Reduced motion: one static frame.
Fallback if canvas fails: a static inline SVG of the same helix (export one frame). Never a blank background.
Why not WebGL or Three.js: nodes and hairlines are cheap in Canvas 2D, and it keeps you inside the stack you asked for. WebGL earns its cost only for heavy fragment effects, which are exactly the glowy look we're banning.

9. Global components
9.1 Header
•	Style: floating glass pill, centered, max-width:1100px, top:16px. Not full-width.
•	Left: logo mark (28px) + wordmark Famewoven.
•	Center: Services (hover opens mega-glass panel), Work, Creators, About, Insights.
•	Right: lime pill button Book a strategy call.
•	Behavior: hides on scroll down, returns on scroll up (ScrollTrigger direction check, 0.4s power3.out). After 80px of scroll the glass gets denser (blur 24px, background alpha up).
•	Active link: a small lime dot under the label, which slides between items on hover (GSAP x tween on a shared element).
•	Mega panel (Services): two-column glass panel. Left: 6 service links with one-line descriptions. Right: one featured case study with its headline metric. Opens with clipPath from inset(0 0 100% 0 round 24px) to inset(0 0 0 0 round 24px), 0.5s.
•	Mobile: pill collapses to logo + hamburger. Menu is a full-screen glass sheet, links stagger in, big type (3rem).
9.2 Footer
Large wordmark spanning the full width, very low opacity (text-white/5), cropped by the bottom edge. Above it: 4 columns (Services, Company, Resources, Contact), newsletter field, social links, © Famewoven and legal. Final CTA band sits above the footer.
9.3 Custom cursor (desktop only, optional)
Small lime dot (8px) plus a 36px glass ring that lags behind (gsap.quickTo, 0.3s). Ring grows to 64px with the label View over case study cards. Hide on touch.
9.4 Scroll progress
2px lime line at the very top, scaleX bound to page scroll.

10. Home page, section by section
Order matters. This is the conversion path.
10.1 Hero
•	Goal: hook the right visitor in 3 seconds and make them want to scroll. Attention comes from motion that feels mechanical and playful, not from glow.
•	Layout: full viewport. Text left (centered on mobile). The Weave Helix from section 8 fills the right 60% as the hero visual, so the hero needs no images.
•	Label (mono, glass pill): ● Creator marketing, engineered
•	H1: Influence, engineered. Set huge, tight tracking. The word engineered is lime. Each line rises through a mask.
•	The audience hook (the funky part): directly under the H1, a line that reads Built for + a split-flap board (the airport departure-board style) that rolls through your audiences: fashion brands, food brands, tech startups, founders, local shops. Each letter is its own cell and spins through random letters before landing on the right one, left to right, with a tiny stagger. A new word flips in every 3.2s. Why it works: the visitor waits for their word, and a visitor who sees themselves stays. Mechanical motion also looks expensive, with no effects needed. Confirm the real audience list in section 14.
•	Sticker: a lime pill rotated -4° near the H1: Now onboarding 5 founding brands. It enters with elastic.out(1, 0.5) from scale 0, then does a slow 2° wobble loop. This is the one loud element, so keep it to one.
•	Sub (max 52ch): Creators don't sell ads. They sell trust. We weave it into your brand and track every taka it earns.
•	CTAs: Book a strategy call (lime, text-swap hover) and See the work (glass).
•	One glass card overlapping the helix, bottom right: a mini campaign tracker with a bar that fills as you watch. Placeholder figures only; replace with real numbers before launch.
•	Helix reacts to the visitor: nodes lean away from the cursor. People poke at it, and that's the engagement.
•	Entrance timeline (after loader, ~2.6s total):
a.	0.0s: helix assembles bottom to top
b.	0.4s: label slides in
c.	0.6s: H1 lines rise
d.	1.1s: flap board rolls its first word
e.	1.8s: sub fades up
f.	2.1s: CTAs rise
g.	2.4s: sticker pops in
•	Scroll cue: a thin vertical lime line that draws down in a loop, bottom-center.
Split-flap code (hero.js):
const WORDS = ['fashion brands','food brands','tech startups','founders','local shops'];
const CH = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const board = document.getElementById('flap');   // .cell{display:inline-block;height:1em;overflow:hidden;line-height:1}
                                                  // .strip{display:block} .strip i{display:block;height:1em;font-style:normal}
function rollTo(text){
  board.innerHTML = '';
  [...text.toUpperCase()].forEach((ch, i) => {
    const cell = document.createElement('span'); cell.className = 'cell';
    const strip = document.createElement('span'); strip.className = 'strip';
    const n = 6 + i;
    let html = '';
    for (let k = 0; k < n; k++) html += `<i>${CH[(Math.random() * 26) | 0]}</i>`;
    html += `<i>${ch === ' ' ? '&nbsp;' : ch}</i>`;
    strip.innerHTML = html; cell.appendChild(strip); board.appendChild(cell);
    gsap.fromTo(strip, { yPercent: 0 },
      { yPercent: -100 * n / (n + 1), duration: .9 + i * .03, ease: 'power3.out', delay: i * .025 });
  });
}
let w = 0; rollTo(WORDS[0]);
if (!matchMedia('(prefers-reduced-motion: reduce)').matches)
  setInterval(() => rollTo(WORDS[w = (w + 1) % WORDS.length]), 3200);
Use a monospace font for the board so cell widths stay stable between words. Add an aria-label with the current word on the container so screen readers read it once, and mark the cells aria-hidden.
10.2 Trust strip
•	H2 (small, muted, label style): Trusted by brands that track their results
•	Infinite horizontal marquee of client names in --muted, set as text wordmarks (no logo images). Pauses on hover. Edges fade with a CSS mask-image gradient. GSAP x tween, repeat:-1, ease:'none', duration ~40s.
•	If you don't have clients yet: swap this for platform strip (Instagram, TikTok, YouTube, Facebook) and a line like We run campaigns across the platforms Bangladeshi audiences actually use.
10.3 The problem (positioning)
•	H2: Most influencer campaigns are guesswork with a invoice.
•	Three glass cards, each one sentence of pain: Wrong creators, right follower counts. / Posts go live. Nobody knows what they earned. / Every campaign starts from zero.
•	Motion: pinned section; as you scroll, each card's text brightens from 0.25 to 1 opacity in sequence (ScrollTrigger scrub). Calm, no movement.
10.4 The system (your named process)
•	H2: The Weave System
•	Sub: Four steps. Every campaign. No improvisation.
•	Steps (numbered, mono): 01 Map (audience and goal) → 02 Match (creator sourcing and vetting) → 03 Make (briefs, content, approvals) → 04 Measure (tracked links, codes, reporting).
•	Layout: horizontal pinned scroller on desktop. A thin lime thread (SVG path) draws across as you scroll (strokeDashoffset scrub), and each step card brightens when the thread reaches it. Vertical stack on mobile.
•	Why it works: a named system makes you a company with a method. This is the Viral Nation lesson.
10.5 Services overview
•	H2: What we run
•	Grid: 6 glass cards (3×2): Influencer Campaigns, Creator Sourcing & Vetting, UGC & Content Production, Paid Amplification, Creator Management, Analytics & Reporting. Each: icon (inline SVG, 1.5px stroke), H3, one line, Learn more →.
•	Hover: border brightens, sheen follows cursor, arrow nudges 4px. No tilt.
•	Entrance: stagger fade-up 0.08s.
10.6 Stat band
•	Four big numbers in mono/heading font, counted up on enter: Campaigns run, Creators in network, Reach delivered, Average ROI. Use real numbers only. If you have fewer than three honest numbers, drop this section until you do.
•	Counter: gsap.to(obj,{val:target,duration:2,ease:'power2.out',onUpdate:...}).
10.7 Case studies
•	H2: Results, not reach.
•	3 large glass cards in a row (desktop) / swipe row (mobile). Headline is the metric (3.4x ROAS in 6 weeks), then brand name, then 2 tags. No photos needed; use a gradient field unique to each card (variations of lime→green at different angles) and a large outlined number.
•	Hover: cursor ring turns into View. Card lifts 4px.
•	No case studies yet? Use a Pilot Program block instead: We're taking 5 founding brands. Reduced rate. Full tracking. You get the case study, we get the proof. That's honest and filters buyers.
10.8 Creator network teaser
•	H2: Creators, vetted.
•	Sub: Every creator in our network passes an audience-quality check before they touch your brand.
•	Left: 3 bullet checks (Audience authenticity, Engagement quality, Brand safety). Right: a glass panel with an animated "vetting score" ring (SVG circle, strokeDashoffset from full to 0.82).
•	CTA: Explore the network →
10.9 Why Famewoven (differentiation)
•	H2: Built like software. Run like a studio.
•	Comparison glass table: Typical agency vs Famewoven across 5 rows (Reporting, Creator selection, Turnaround, Pricing clarity, Ownership of data). Lime checks on our side, muted dashes on theirs.
10.10 Testimonials (only if real)
•	One large quote at a time, auto-advance every 8s, crossfade. Name and role in mono.
10.11 FAQ
•	H2: Straight answers.
•	Accordion in glass. Height animates with GSAP (height:'auto'), plus-icon rotates 45°. 6 questions: pricing, minimum budget, timelines, which platforms, how reporting works, who it's not for (this filtering question is deliberate).
10.12 Final CTA
•	Full-bleed lime-gradient glass panel, black text (matches the logo's contrast).
•	H2: Let's weave your brand into culture.
•	Sub: Tell us your goal. You get a plan in 48 hours.
•	Button: black pill, Book a strategy call.
•	The panel's gradient slowly shifts hue position (backgroundPosition loop, 12s).

11. Inner pages
11.1 Services index (/services)
•	H1: Services · H2 sub: Everything between a brief and a result.
•	Grid of the same 6 services, larger cards, each with a 3-bullet outcome list.
•	Bottom: link to The Weave System section and the CTA band.
11.2 Service detail template (use for all 6)
Sections, in order:
1.	Hero: H1 (service name), one-line outcome, CTA.
2.	Who it's for / not for (two glass columns).
3.	What you get (4–6 deliverables).
4.	How it runs (mini 4-step timeline).
5.	Pricing signal (From ৳XX,000 / campaign, or Custom after a call. Transparency filters leads).
6.	Related case study.
7.	FAQ (3 questions, service-specific).
8.	Final CTA.
The six services (copy skeleton):
•	Influencer Campaigns — End-to-end campaigns: strategy, creators, content, launch, reporting.
•	Creator Sourcing & Vetting — Shortlists of creators checked for audience quality, with fit scores.
•	UGC & Content Production — Creator-style video and photo content for your own channels and ads.
•	Paid Amplification — Turning top creator posts into ads (whitelisting, partnership ads) so winners scale beyond organic reach.
•	Creator Management — Contracts, briefs, approvals, payments, one point of contact.
•	Analytics & Reporting — Tracked links, promo codes, dashboards, post-campaign analysis.
11.3 Creators (/creators)
Two audiences, one page with a toggle (glass segmented control with a sliding lime thumb):
•	For brands: how the network works, vetting, categories (fashion, tech, food, lifestyle, education).
•	For creators: Join the network form (name, handle, platform, niche, audience size). H1: Get paid to be you.
11.4 Work (/work) and case study template
•	Index: filter chips (All, Fashion, Tech, F&B, Services), masonry-less grid of metric cards.
•	Case study template: H1 = the result. Then Challenge, Approach, Creators used, Results (counter band), What we'd do next. Lots of whitespace, one big quote.
11.5 About (/about)
•	H1: We build the infrastructure behind influence.
•	Story in 3 short paragraphs, principles (4 glass cards: Systems over hustle, Numbers over vibes, Fewer clients, better work, Say it straight), team row (text-only cards or initials in glass circles).
11.6 Insights (/insights)
•	Article grid with category chips. No thumbnails: use typographic cards (big title, mono meta). Article page: narrow column 68ch, reading progress bar, sticky mini table of contents on desktop.
11.7 Contact / Book a call (/contact)
•	H1: Tell us what you want to move.
•	Split layout. Left: short form (name, brand, budget range select, goal select, message). Right: glass card with What happens next (3 steps) and direct email/WhatsApp.
•	Budget field doubles as a qualifier. Include a Not sure yet option so you don't lose people.
•	Success state: form collapses, a lime check draws itself (SVG stroke), message says exactly when they'll hear back.
•	Front-end only for now. Wire the form later to a webhook (Formspree, n8n, Make) when you want to automate lead routing.
11.8 404 and legal
•	404: giant 404 in outlined text, a line This page didn't get woven in. and a CTA home.
•	Privacy and Terms: plain narrow-column text.

12. Responsive, accessibility, performance
Breakpoints: 640 / 768 / 1024 / 1280. Design mobile first. In Bangladesh most traffic will be mid-range Android on mobile data, so mobile performance is the real design constraint.
Mobile rules:
•	Switch the helix to lite mode below 768px or on navigator.hardwareConcurrency <= 4. Use Option B.
•	Disable the custom cursor and magnetic buttons.
•	Replace pinned horizontal scroll with a vertical stack.
•	Reduce backdrop-filter blur to 10–12px and cut glass layers on screen to 2.
•	Touch targets at least 44px.
Accessibility:
•	Text contrast at least 4.5:1. Muted text on glass often fails: check it.
•	Visible focus ring (2px lime outline, 3px offset).
•	All animation respects prefers-reduced-motion.
•	Menu and accordion are keyboard operable with correct ARIA.
•	Loader doesn't trap focus or block content from screen readers.
Performance budget:
•	LCP under 2.5s on 4G. Total JS under ~150KB (GSAP core + ScrollTrigger + SplitText is the bulk).
•	Animate only transform and opacity (and clip-path sparingly). Never animate width/height/top/left except the accordion.
•	will-change only on elements actively animating, removed after.
•	Self-host fonts, subset them, font-display:swap, preload the heading font.
•	Inline SVG icons. No icon fonts.
•	backdrop-filter is expensive: never put it on elements larger than the viewport or inside a scrolling transformed parent.
SEO basics: one H1 per page, semantic landmarks, meta title/description per page, Open Graph tags, JSON-LD Organization, sitemap.xml, robots.txt.

13. Build order (so you ship, not tinker)
1.	Tokens and base: Tailwind config, fonts, glass.css, grain overlay. (half day)
2.	Header and footer as reusable HTML partials. (half day)
3.	Loader. Get the logo SVG paths exported cleanly first; this is the step that blocks everything. (half day)
4.	Hero with CSS background (Option B), then swap in the shader. (1 day)
5.	Remaining home sections, top to bottom. (2 days)
6.	Services index plus one detail page, then clone the template five times. (1 day)
7.	Contact, About, Work, Creators, Insights, 404. (2 days)
8.	Motion polish pass: timings, reduced motion, mobile fallbacks. (1 day)
9.	Performance and Lighthouse pass on a throttled mobile profile. (half day)
Trade-off I'd flag: the loader, shader, pinned scroll and glass together can push a mid-range phone over budget. If you have to cut, cut in this order: custom cursor → magnetic buttons → full helix on mobile → SVG refraction. Never cut the loader or the text reveals; those are what make it feel like a brand.

14. Decisions I need from you
1.	Confirm the interpretation: influencer/creator marketing agency, not another category.
2.	Who is the buyer? Bangladeshi SMEs, or international brands buying Bangladeshi creators? This changes H1, pricing display (৳ vs $), and every proof element.
3.	Do you have real numbers and case studies today? If not, we use the Pilot Program block and drop the stat band.
4.	Logo as SVG. I need the vector file for the loader. A PNG won't draw.
5.	Pricing transparency level: public ranges or call-only.
6.	Is Famewoven also a platform (self-serve creator marketplace) or agency-only at launch? If platform, the Creators page and the nav get a login/dashboard path.

Next step: answer 1–6 and I'll produce the full HTML/Tailwind/GSAP code for the loader, header, and hero as the first working slice.
