<?php
/**
 * Skills Component - 3D Cube Gallery Layout
 *
 * A fixed 3D rotating cube sits behind 6 scroll-driven skill sections.
 * The cube rotates to a new face on every section. Adapted from the
 * Reverse Creativity gallery pattern; uses the PrimeOrbit Corporate Platform theme
 * (white bg, Google accent colors, Outfit / Space Grotesk fonts).
 */

$skillGroups = [
  [
    'tag' => '01 - Frontend',
    'title' => 'FRONTEND<br><span class="skl-orange">ARCHITECTURE</span>',
    'body' => 'React, Next.js, Tailwind CSS, GSAP & Framer Motion. Pixel-perfect interfaces engineered for performance, accessibility, and delight at every interaction point.',
    'skills' => ['React / Next.js', 'Tailwind CSS', 'GSAP / Framer Motion', 'TypeScript'],
    'color' => '#4285F4',
    'icon' => 'layout',
    'align' => 'left',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/uggogysepkl5dkr9zqkx.mp4',
  ],
  [
    'tag' => '02 - Backend',
    'title' => 'BACKEND<br><span class="skl-orange">ENGINEERING</span>',
    'body' => 'Node.js, PHP / Laravel, Python / C-Sharp, .Net. Architecting resilient server-side systems that scale gracefully and process data without compromise.',
    'skills' => ['Node.js / Express', 'PHP / Laravel', 'Python / C-Sharp', '.Net'],
    'color' => '#EA4335',
    'icon' => 'server',
    'align' => 'right',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/nmy2qsn5kiijlxvvgcsm.mp4',
  ],
  [
    'tag' => '03 - Database',
    'title' => 'DATABASE<br><span class="skl-orange">SYSTEMS</span>',
    'body' => 'PostgreSQL, Sql Server, Redis, MySQL. Designing schemas and query patterns that keep mission-critical data consistent, fast, and always available.',
    'skills' => ['PostgreSQL', 'Sql Server', 'Redis', 'MySQL'],
    'color' => '#FBBC05',
    'icon' => 'database',
    'align' => 'left',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/db4c63a7-b6d6-469f-adfb-f44778d51d7a.mp4',
    'stats' => [
      ['num' => '6', 'label' => 'Domains'],
      ['num' => '360 deg', 'label' => 'Expertise'],
      ['num' => '1', 'label' => 'Vision'],
    ],
  ],
  [
    'tag' => '04 - Digital Marketing',
    'title' => 'DIGITAL<br><span class="skl-orange">MARKETING</span>',
    'body' => 'SEO, Social Media, Content Strategy, PPC, Email Automation, Analytics. From visibility to conversion - data-driven campaigns that scale.',
    'skills' => ['SEO / SEM', 'Social Media Management', 'PPC Campaigns', 'Analytics & Reporting'],
    'color' => '#34A853',
    'icon' => 'trending-up',
    'align' => 'right',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/idanyisv9j77bynfro0n.mp4',
  ],
  [
    'tag' => '05 - AI & Automation',
    'title' => 'AI &amp;<br><span class="skl-orange">AUTOMATION</span>',
    'body' => 'LLMs, Agentic Workflows, RAG, AutoML, Process Automation. Supercharge productivity - intelligent systems that execute, decide, and optimize without human intervention.',
    'skills' => ['LLMs / GPT', 'Agentic Workflows', 'RAG', 'Process Automation'],
    'color' => '#4285F4',
    'icon' => 'bot',
    'align' => 'left',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/t9yt8oijopma42yuetlz.mp4',
  ],
  [
    'tag' => '06 - UX / UI',
    'title' => 'UX / UI<br><span class="skl-orange">DIRECTION</span>',
    'body' => 'Figma, Adobe XD, Design Systems, Core Web Vitals, Accessibility. Blending research and aesthetics - because good design is invisible, and great design is unforgettable.',
    'skills' => ['Figma / Adobe XD', 'Design Systems', 'Core Web Vitals', 'Accessibility'],
    'color' => '#EA4335',
    'icon' => 'monitor',
    'align' => 'right',
    'video' => 'https://pub-8c02bb0f8aa04c19b7b7ee44644801fd.r2.dev/videos/1440/38ed8182-83c9-433d-9ff8-51b62effda35.mp4',
  ],
];

$N = count($skillGroups);

// Inline SVG paths for each icon
$svgPaths = [
  'layout' => '<polyline points="3 9 3 21 21 21 21 9"/><polyline points="3 9 12 3 21 9"/><line x1="9" y1="21" x2="9" y2="12"/><line x1="15" y1="21" x2="15" y2="12"/>',
  'server' => '<rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/>',
  'database' => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>',
  'cloud' => '<path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>',
  'cpu' => '<rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/>',
  'monitor' => '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',
];

$faceOrder = ['top', 'front', 'right', 'back', 'left', 'bottom'];
?>

<!-- ========================================================
  SKILLS - 3D Cube Gallery
  All styles and JS are scoped to #skl-world to avoid
  conflicts with the rest of the Company.
  ======================================================== -->
<div id="skl-world">

  <style>
    #skl-world {
      position: relative;
      background: #ffffff;
    }

    #skl-intro {
      position: relative;
      z-index: 5;
      background: #ffffff;
      text-align: center;
      padding: 6rem 2rem 3rem;
    }

    #skl-scene {
      position: fixed;
      inset: 0;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      perspective: 1100px;
      pointer-events: none;
      background: #ffffff;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    #skl-scene.active {
      opacity: 1;
    }

    /* Dot-grid bg */
    #skl-scene::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: radial-gradient(#e5e7eb 1.2px, transparent 1.2px);
      background-size: 36px 36px;
      pointer-events: none;
    }

    #skl-cube {
      --s: min(56vw, 56vh, 400px);
      width: var(--s);
      height: var(--s);
      position: relative;
      transform-style: preserve-3d;
      transform: rotateX(90deg) rotateY(0deg);
      will-change: transform;
    }

    .skl-face {
      position: absolute;
      inset: 0;
      overflow: hidden;
      backface-visibility: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background: #ffffff;
      border: 1px solid rgba(66, 133, 244, 0.1);
    }

    .skl-face video {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 1;
    }

    .skl-face[data-face="front"] {
      transform: translateZ(calc(var(--s)/2));
    }

    .skl-face[data-face="back"] {
      transform: rotateY(180deg) translateZ(calc(var(--s)/2));
    }

    .skl-face[data-face="right"] {
      transform: rotateY(90deg) translateZ(calc(var(--s)/2));
    }

    .skl-face[data-face="left"] {
      transform: rotateY(-90deg) translateZ(calc(var(--s)/2));
    }

    .skl-face[data-face="top"] {
      transform: rotateX(-90deg) translateZ(calc(var(--s)/2));
    }

    .skl-face[data-face="bottom"] {
      transform: rotateX(90deg) translateZ(calc(var(--s)/2));
    }

    .skl-face-icon {
      width: clamp(56px, 13vw, 92px);
      height: clamp(56px, 13vw, 92px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .skl-face-icon svg {
      width: 44%;
      height: 44%;
    }

    .skl-face-lbl {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: clamp(0.65rem, 2vw, 1rem);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      text-align: center;
      padding: 0 0.5rem;
      line-height: 1.2;
    }

    #skl-hud {
      position: fixed;
      top: 1.6rem;
      right: 1.75rem;
      z-index: 50;
      text-align: right;
      font-family: 'Outfit', sans-serif;
      font-size: 0.58rem;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: #9aa0a6;
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    #skl-hud.active {
      opacity: 1;
    }

    #skl-prog-bar {
      width: 6.5rem;
      height: 1px;
      background: #e8eaed;
      margin-top: 0.5rem;
      margin-left: auto;
      position: relative;
      overflow: hidden;
    }

    #skl-prog-fill {
      position: absolute;
      inset: 0 auto 0 0;
      width: 0%;
      background: #4285F4;
      transition: width 0.12s linear;
    }

    #skl-hud-name {
      margin-top: 0.3rem;
      font-size: 0.52rem;
      color: #4285F4;
    }

    #skl-nav {
      position: fixed;
      left: 1.75rem;
      top: 50%;
      transform: translateY(-50%);
      z-index: 50;
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
      opacity: 0;
      transition: opacity 0.4s ease;
      pointer-events: none;
    }

    #skl-nav.active {
      opacity: 1;
      pointer-events: all;
    }

    .skl-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #dadce0;
      cursor: pointer;
      transition: background 0.3s, transform 0.3s;
      display: block;
    }

    .skl-dot.on {
      background: #4285F4;
      transform: scale(1.65);
    }

    #skl-cap {
      position: fixed;
      bottom: 1.5rem;
      left: 50%;
      transform: translateX(-50%);
      z-index: 50;
      text-align: center;
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    #skl-cap.active {
      opacity: 1;
    }

    #skl-cap-num {
      font-family: 'Outfit', sans-serif;
      font-size: 0.52rem;
      letter-spacing: 0.28em;
      color: #4285F4;
      text-transform: uppercase;
      margin-bottom: 0.2rem;
    }

    #skl-cap-name {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: clamp(1.4rem, 4vw, 2.4rem);
      letter-spacing: 0.07em;
      text-transform: uppercase;
      color: #dadce0;
      line-height: 1;
    }

    #skl-sections {
      position: relative;
      z-index: 5;
    }

    .skl-section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 6rem 5rem;
      position: relative;
      /* Transparent so the fixed cube shows through */
      background: transparent;
    }

    .skl-card {
      max-width: 22rem;
      padding: 2.25rem 2rem;
      background: rgba(255, 255, 255, 0.91);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      box-shadow: 0 4px 32px rgba(0, 0, 0, 0.06);
    }

    .skl-card.left {
      border-left: 2px solid rgba(66, 133, 244, 0.25);
    }

    .skl-card.right {
      margin-left: auto;
      border-right: 2px solid rgba(66, 133, 244, 0.25);
      text-align: right;
    }

    /* Animated children - hidden initially */
    .skl-card .skl-line {
      width: 2.5rem;
      height: 1px;
      background: #4285F4;
      margin-bottom: 1.1rem;
      opacity: 0;
      transform: scaleX(0);
      transform-origin: left;
      transition: opacity 0.4s ease, transform 0.4s ease;
    }

    .skl-card.right .skl-line {
      margin-left: auto;
      transform-origin: right;
    }

    .skl-tag-lbl {
      font-family: 'Outfit', sans-serif;
      font-size: 0.56rem;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: #4285F4;
      margin-bottom: 0.7rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.5s ease 0s, transform 0.5s ease 0s;
    }

    .skl-ttl {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: clamp(1.65rem, 3.5vw, 2.6rem);
      line-height: 1.0;
      color: #202124;
      margin-bottom: 1rem;
      opacity: 0;
      transform: translateY(18px);
      transition: opacity 0.5s ease 0.08s, transform 0.5s ease 0.08s;
    }

    .skl-orange {
      color: #ff6b00; /* Vibrant high-end orange */
    }

    .skl-body {
      font-family: 'Outfit', sans-serif;
      font-size: 0.79rem;
      line-height: 1.78;
      color: #5f6368;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.5s ease 0.18s, transform 0.5s ease 0.18s;
    }

    .skl-chips {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
      margin-top: 1.1rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.5s ease 0.26s, transform 0.5s ease 0.26s;
    }

    .skl-card.right .skl-chips {
      justify-content: flex-end;
    }

    .skl-chip {
      font-family: 'Outfit', sans-serif;
      font-size: 0.6rem;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 0.28rem 0.72rem;
      border-radius: 999px;
      background: #ffffff;
      border: 1px solid #e8eaed;
      color: #5f6368;
    }

    .skl-stats {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
      margin-top: 1.4rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.5s ease 0.3s, transform 0.5s ease 0.3s;
    }

    .skl-card.right .skl-stats {
      justify-content: flex-end;
    }

    .skl-snum {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.9rem;
      font-weight: 700;
      color: #4285F4;
      line-height: 1;
    }

    .skl-slbl {
      font-size: 0.52rem;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: #9aa0a6;
    }

    .skl-ctas {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      margin-top: 1.5rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.5s ease 0.36s, transform 0.5s ease 0.36s;
    }

    .skl-card.right .skl-ctas {
      justify-content: flex-end;
    }

    .skl-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.48rem 1.1rem;
      font-family: 'Outfit', sans-serif;
      font-size: 0.57rem;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      text-decoration: none;
      cursor: pointer;
      background: transparent;
      transition: background 0.2s, color 0.2s, border-color 0.2s;
      border: 1px solid rgba(66, 133, 244, 0.35);
      color: #9aa0a6;
    }

    .skl-btn:hover {
      border-color: #9aa0a6;
      color: #5f6368;
    }

    .skl-btn.pri {
      border-color: #4285F4;
      color: #4285F4;
    }

    .skl-btn.pri:hover {
      background: #4285F4;
      color: #ffffff;
    }

    .skl-btn svg {
      width: 10px;
      height: 10px;
      flex-shrink: 0;
    }

    /* Reveal state */
    .skl-card.revealed .skl-line,
    .skl-card.revealed .skl-tag-lbl,
    .skl-card.revealed .skl-ttl,
    .skl-card.revealed .skl-body,
    .skl-card.revealed .skl-chips,
    .skl-card.revealed .skl-stats,
    .skl-card.revealed .skl-ctas {
      opacity: 1;
      transform: translateY(0);
    }

    .skl-card.revealed .skl-line {
      transform: scaleX(1);
    }

    @media (max-width: 56.25em) {

      #skl-nav,
      #skl-cap {
        display: none !important;
      }

      .skl-section {
        min-height: 120vh;
        align-items: flex-end;
        padding: 0 1.5rem 4rem;
      }

      .skl-card,
      .skl-card.right {
        max-width: 100%;
        margin-left: 0;
        text-align: left;
        border-left: 2px solid rgba(66, 133, 244, 0.25);
        border-right: none;
      }

      .skl-card.right .skl-chips,
      .skl-card.right .skl-stats,
      .skl-card.right .skl-ctas {
        justify-content: flex-start;
      }

      .skl-card.right .skl-line {
        margin-left: 0;
        transform-origin: left;
      }
    }
  </style>

  <div id="skl-intro">
    <span class="block text-google-blue font-semibold text-xs tracking-[0.25em] uppercase mb-3">Arsenal</span>
    <h2 class="text-4xl md:text-6xl font-display font-bold text-gray-900 mb-4">
      Technical <span class="text-google-blue">Proficiency</span>
    </h2>
    <p class="text-lg text-gray-500 max-w-2xl mx-auto">
      A curated stack of high-performance tools and languages engineered for modern scale.
    </p>
  </div>

  <div id="skl-scene">
    <div id="skl-cube">
      <?php foreach ($faceOrder as $fi => $face):
        $g = $skillGroups[$fi] ?? $skillGroups[0];
        $col = $g['color'];
        $svg = $svgPaths[$g['icon']] ?? '';
        ?>
        <div class="skl-face" data-face="<?= $face ?>" style="border-color:<?= $col ?>44;">
          <?php if (!empty($g['video'])): ?>
            <video data-src="<?= $g['video'] ?>" loop muted playsinline preload="none" class="skl-video-el"></video>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="skl-hud">
    <div id="skl-hud-pct">000%</div>
    <div id="skl-prog-bar">
      <div id="skl-prog-fill"></div>
    </div>
    <div id="skl-hud-name">LAYOUT</div>
  </div>

  <nav id="skl-nav" aria-label="Skill sections">
    <?php for ($i = 0; $i < $N; $i++): ?>
      <a class="skl-dot <?= $i === 0 ? 'on' : '' ?>" data-skl-idx="<?= $i ?>" aria-label="Skill group <?= $i + 1 ?>"></a>
    <?php endfor; ?>
  </nav>

  <div id="skl-cap">
    <div id="skl-cap-num">01</div>
    <div id="skl-cap-name">LAYOUT</div>
  </div>

  <div id="skl-sections">
    <?php foreach ($skillGroups as $si => $g):
      $right = $g['align'] === 'right';
      $hasStats = isset($g['stats']);
      $isLast = $si === $N - 1;
      $colHex = $g['color'];
      ?>
      <section id="skl-s<?= $si ?>" class="skl-section">
        <div class="skl-card <?= $right ? 'right' : 'left' ?>">

          <!-- Hairline accent -->
          <div class="skl-line"></div>

          <!-- Tag label -->
          <div class="skl-tag-lbl"><?= htmlspecialchars($g['tag']) ?></div>

          <!-- Title -->
          <h2 class="skl-ttl"><?= $g['title'] ?></h2>

          <!-- Body copy -->
          <p class="skl-body"><?= htmlspecialchars($g['body']) ?></p>

          <!-- Skill chips -->
          <div class="skl-chips">
            <?php foreach ($g['skills'] as $sk): ?>
              <span class="skl-chip"><?= htmlspecialchars($sk) ?></span>
            <?php endforeach; ?>
          </div>

          <!-- Stats (section 3 only) -->
          <?php if ($hasStats): ?>
            <div class="skl-stats">
              <?php foreach ($g['stats'] as $st): ?>
                <div>
                  <div class="skl-snum"><?= htmlspecialchars($st['num']) ?></div>
                  <div class="skl-slbl"><?= htmlspecialchars($st['label']) ?></div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- CTAs -->
          <div class="skl-ctas">
            <?php if ($si > 0): ?>
              <a class="skl-btn" data-skl-goto="<?= $si - 1 ?>">
                <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M11 6H1M6 11L1 6l5-5" />
                </svg>
                Back
              </a>
            <?php endif; ?>
            <a class="skl-btn pri" data-skl-goto="<?= $isLast ? 0 : $si + 1 ?>">
              <?= $isLast ? 'Begin again' : 'Next' ?>
              <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M1 6h10M6 1l5 5-5 5" />
              </svg>
            </a>
          </div>

        </div>
      </section>
    <?php endforeach; ?>
  </div><!-- /#skl-sections -->

</div><!-- /#skl-world -->

<script>
  (function () {
    'use strict';

    const N = <?= $N ?>;
    const SHORT_NAMES = <?= json_encode(array_map(fn($g) => strtoupper($g['icon']), $skillGroups)) ?>;

    const STOPS = [
      { rx: 90, ry: 0 },
      { rx: 0, ry: 0 },
      { rx: 0, ry: -90 },
      { rx: 0, ry: -180 },
      { rx: 0, ry: -270 },
      { rx: -90, ry: -360 }
    ];

    const scene = document.getElementById('skl-scene');
    const cube = document.getElementById('skl-cube');
    const hud = document.getElementById('skl-hud');
    const hudPct = document.getElementById('skl-hud-pct');
    const hudName = document.getElementById('skl-hud-name');
    const progFill = document.getElementById('skl-prog-fill');
    const navEl = document.getElementById('skl-nav');
    const capEl = document.getElementById('skl-cap');
    const capNum = document.getElementById('skl-cap-num');
    const capName = document.getElementById('skl-cap-name');
    const dots = [...document.querySelectorAll('.skl-dot')];
    const sections = [...document.querySelectorAll('#skl-sections section')];
    const cards = [...document.querySelectorAll('.skl-card')];
    const videos = [...document.querySelectorAll('.skl-video-el')];
    const world = document.getElementById('skl-world');

    let smooth = 0, tgt = 0, vel = 0;
    let lastIdx = -1;
    let anchorRaf = null;
    let isAnchor = false;
    let sectionTops = [];
    let vh = window.innerHeight;
    let scrollArea = { start: 0, end: 0 };

    const easeIO = t => t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    const easeInOutCubic = t =>
      t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

    function measure() {
      vh = window.innerHeight;
      sectionTops = sections.map(s => s.getBoundingClientRect().top + window.scrollY);
      scrollArea.start = sectionTops[0];
      scrollArea.end = sectionTops[N - 1] + sections[N - 1].offsetHeight - vh;
    }

    function inZone() {
      const sy = window.scrollY;
      return sy >= scrollArea.start - vh * 0.1 &&
        sy <= scrollArea.end + vh * 1.2;
    }

    function progress() {
      const sy = window.scrollY;
      const range = Math.max(1, scrollArea.end - scrollArea.start);
      return Math.max(0, Math.min(1, (sy - scrollArea.start) / range));
    }

    function setCube(s) {
      const t = s * (N - 1);
      const i = Math.min(Math.floor(t), N - 2);
      const f = easeIO(t - i);
      const a = STOPS[i], b = STOPS[i + 1];
      cube.style.transform =
        `rotateX(${a.rx + (b.rx - a.rx) * f}deg) rotateY(${a.ry + (b.ry - a.ry) * f}deg)`;
    }

    function updateUI(s) {
      const pct = Math.round(s * 100);
      const idx = Math.min(N - 1, Math.round(s * (N - 1)));

      hudPct.textContent = String(pct).padStart(3, '0') + '%';
      progFill.style.width = pct + '%';

      if (idx !== lastIdx) {
        lastIdx = idx;
        const nm = SHORT_NAMES[idx] || '';
        hudName.textContent = nm;
        capNum.textContent = String(idx + 1).padStart(2, '0');
        capName.textContent = nm;
        dots.forEach((d, i) => d.classList.toggle('on', i === idx));
      }
    }

    function setActive(on) {
      [scene, hud, navEl, capEl].forEach(el => el.classList.toggle('active', on));
    }

    function gotoIdx(idx) {
      if (anchorRaf) cancelAnimationFrame(anchorRaf);
      isAnchor = true;
      vel = 0;
      const dst = sectionTops[Math.max(0, Math.min(N - 1, idx))] || 0;
      const start = window.scrollY;
      const diff = dst - start;
      const t0 = performance.now();
      const dur = 900;

      (function tick(now) {
        const p = Math.min(1, (now - t0) / dur);
        window.scrollTo(0, start + diff * easeInOutCubic(p));
        if (p < 1) anchorRaf = requestAnimationFrame(tick);
        else { anchorRaf = null; isAnchor = false; }
      })(t0);
    }

    const obs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('revealed');
      });
    }, { threshold: 0.22 });
    cards.forEach(c => obs.observe(c));

    let skillVideosLoaded = false;
    const loadSkillVideos = () => {
      if (skillVideosLoaded) return;
      skillVideosLoaded = true;
      videos.forEach(video => {
        if (!video.src && video.dataset.src) {
          video.src = video.dataset.src;
          video.load();
        }
      });
    };

    const videoObs = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadSkillVideos();
          videos.forEach(video => video.play().catch(() => {}));
        } else {
          videos.forEach(video => video.pause());
        }
      });
    }, { rootMargin: '500px 0px', threshold: 0.01 });
    if (world) videoObs.observe(world);

    document.addEventListener('click', e => {
      // CTA / dot goto
      const btn = e.target.closest('[data-skl-goto]');
      if (btn) { measure(); gotoIdx(+btn.dataset.sklGoto); return; }
      const dot = e.target.closest('[data-skl-idx]');
      if (dot) { measure(); gotoIdx(+dot.dataset.sklIdx); }
    });

    window.addEventListener('wheel', e => {
      if (!inZone()) return;
      const lp = 16, pp = vh * 0.9;
      const d = e.deltaMode === 1 ? e.deltaY * lp
        : e.deltaMode === 2 ? e.deltaY * pp
          : e.deltaY;
      if (Math.abs(d) < 4) return;
      if (anchorRaf) { cancelAnimationFrame(anchorRaf); isAnchor = false; }
      vel += d;
      vel = Math.max(-550, Math.min(550, vel));
    }, { passive: true });

    window.addEventListener('scroll', () => {
      if (!isAnchor) tgt = progress();
      setActive(inZone());
    }, { passive: true });

    window.addEventListener('resize', () => { measure(); });

    const friction = v => Math.abs(v) > 150 ? 0.78 : 0.87;
    let lastT = performance.now();

    (function frame(now) {
      requestAnimationFrame(frame);
      if (document.hidden) { lastT = now; return; }

      const dt = Math.min((now - lastT) / 1000, 0.05);
      lastT = now;

      vel *= Math.pow(friction(vel), dt * 60);
      if (Math.abs(vel) < 0.05) vel = 0;

      if (Math.abs(vel) > 0.5 && !isAnchor && inZone()) {
        const maxSY = document.documentElement.scrollHeight - vh;
        const nextY = Math.max(0, Math.min(window.scrollY + vel * 0.1, maxSY));
        window.scrollTo(0, nextY);
        tgt = progress();
      }

      smooth += (tgt - smooth) * (1 - Math.exp(-dt * 8));
      smooth = Math.max(0, Math.min(1, smooth));

      if (inZone()) {
        setCube(smooth);
        updateUI(smooth);
      }
    })(lastT);

    measure();
    setActive(inZone());

  })();
</script>


