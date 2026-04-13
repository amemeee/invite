<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INVITE | Invitation Atelier</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0a0b;
    --bg-2: #111113;
    --bg-3: #18181c;
    --bg-4: #1e1e24;
    --border: rgba(255,255,255,0.06);
    --border-hover: rgba(255,255,255,0.12);
    --text: #f0eeeb;
    --text-muted: #6b6a6f;
    --text-sub: #9d9ba3;
    --gold: #c9a96e;
    --gold-dim: rgba(201,169,110,0.12);
    --gold-glow: rgba(201,169,110,0.06);
    --accent: #e8b87a;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
  }

  /* ── NOISE OVERLAY ── */
  body::after {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
  }

  /* ── NAV ── */
  nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    height: 56px;
    background: rgba(10,10,11,0.85);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
  }

  .nav-logo {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.1rem;
    letter-spacing: 0.15em;
    color: var(--text);
    text-decoration: none;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 2rem;
    list-style: none;
  }

  .nav-links a {
    font-size: 0.8rem;
    color: var(--text-sub);
    text-decoration: none;
    letter-spacing: 0.03em;
    transition: color 0.2s;
  }

  .nav-links a:hover { color: var(--text); }

  .nav-cta {
    font-size: 0.75rem;
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    color: var(--bg);
    background: var(--gold);
    padding: 7px 18px;
    border-radius: 6px;
    text-decoration: none;
    letter-spacing: 0.03em;
    transition: opacity 0.2s;
  }

  .nav-cta:hover { opacity: 0.85; }

  /* ── HERO ── */
  .hero {
    min-height: 100vh;
    padding-top: 56px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    overflow: hidden;
    padding-bottom: 4rem;
  }

  /* radial glow */
  .hero::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    width: 900px;
    height: 500px;
    background: radial-gradient(ellipse at 50% 0%, rgba(201,169,110,0.08) 0%, transparent 70%);
    pointer-events: none;
  }

  .hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.72rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    border: 1px solid var(--gold-dim);
    background: var(--gold-glow);
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 2rem;
  }

  .hero-eyebrow .dot {
    width: 5px; height: 5px;
    background: var(--gold);
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
  }

  .hero-title {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: clamp(3.2rem, 8vw, 6.5rem);
    line-height: 1.0;
    letter-spacing: -0.02em;
    color: var(--text);
    max-width: 900px;
    margin-bottom: 1.5rem;
  }

  .hero-title .accent {
    color: var(--gold);
    position: relative;
    display: inline-block;
  }

  #dynamic-subject {
    color: var(--gold);
    transition: opacity 0.4s ease;
    display: inline-block;
  }

  .fade-out { opacity: 0; }

  .hero-sub {
    font-size: 1rem;
    color: var(--text-sub);
    line-height: 1.7;
    max-width: 500px;
    margin: 0 auto 2.5rem;
    font-weight: 300;
  }

  .hero-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3.5rem;
  }

  .btn-primary {
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    font-weight: 500;
    background: var(--gold);
    color: #0a0a0b;
    border: none;
    padding: 11px 24px;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    letter-spacing: 0.02em;
    transition: opacity 0.2s, transform 0.15s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }

  .btn-ghost {
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    font-weight: 400;
    background: transparent;
    color: var(--text-sub);
    border: 1px solid var(--border-hover);
    padding: 11px 24px;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    letter-spacing: 0.02em;
    transition: border-color 0.2s, color 0.2s;
  }

  .btn-ghost:hover { border-color: rgba(255,255,255,0.2); color: var(--text); }

  /* hero preview card */
  .hero-preview {
    position: relative;
    max-width: 720px;
    width: 90%;
    margin: 0 auto;
  }

  .preview-window {
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    position: relative;
  }

  .preview-titlebar {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    background: var(--bg-2);
  }

  .dot-red { width: 10px; height: 10px; border-radius: 50%; background: #ff5f57; }
  .dot-yellow { width: 10px; height: 10px; border-radius: 50%; background: #febc2e; }
  .dot-green { width: 10px; height: 10px; border-radius: 50%; background: #28c840; }

  .preview-titlebar span {
    font-size: 0.72rem;
    color: var(--text-muted);
    margin-left: auto;
    margin-right: auto;
    letter-spacing: 0.05em;
  }

  .preview-body {
    padding: 2.5rem 3rem;
    text-align: center;
    background: linear-gradient(160deg, var(--bg-3) 0%, var(--bg-4) 100%);
  }

  .preview-tag {
    font-size: 0.65rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.75rem;
    opacity: 0.8;
  }

  .preview-names {
    font-family: 'Syne', sans-serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 0.4rem;
  }

  .preview-amp {
    color: var(--gold);
    font-weight: 400;
    font-style: italic;
    font-family: Georgia, serif;
  }

  .preview-request {
    font-size: 0.8rem;
    color: var(--text-sub);
    margin-bottom: 1.5rem;
    font-weight: 300;
    letter-spacing: 0.02em;
  }

  .preview-divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  .preview-divider::before,
  .preview-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border-hover);
  }

  .preview-divider span {
    font-size: 0.65rem;
    color: var(--text-muted);
    letter-spacing: 0.1em;
    text-transform: uppercase;
  }

  .preview-details {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border: 1px solid var(--border-hover);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 1.5rem;
  }

  .preview-detail-item {
    padding: 1rem 0.75rem;
    border-right: 1px solid var(--border);
    position: relative;
  }

  .preview-detail-item:last-child { border-right: none; }

  .preview-detail-label {
    font-size: 0.62rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 4px;
  }

  .preview-detail-val {
    font-family: 'Syne', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text);
  }

  .preview-detail-sub {
    font-size: 0.7rem;
    color: var(--text-muted);
    margin-top: 2px;
  }

  .preview-venue {
    font-size: 0.75rem;
    color: var(--text-sub);
    letter-spacing: 0.06em;
    padding: 8px 16px;
    border: 1px solid var(--border);
    border-radius: 6px;
    display: inline-block;
  }

  /* ── MARQUEE ── */
  .marquee-band {
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 14px 0;
    overflow: hidden;
    white-space: nowrap;
    background: var(--bg-2);
  }

  .marquee-track {
    display: inline-flex;
    animation: marquee 26s linear infinite;
  }

  .marquee-track span {
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: 0 2rem;
    font-weight: 400;
  }

  .marquee-track span.gem {
    color: var(--gold);
    font-size: 0.55rem;
    align-self: center;
  }

  @keyframes marquee {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
  }

  /* ── SECTIONS ── */
  section {
    padding: 6rem 2rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  .section-eyebrow {
    font-size: 0.7rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 0.75rem;
  }

  .section-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--text);
    line-height: 1.15;
    margin-bottom: 1rem;
    letter-spacing: -0.01em;
  }

  .section-body {
    font-size: 0.95rem;
    color: var(--text-sub);
    line-height: 1.7;
    max-width: 480px;
    font-weight: 300;
  }

  /* ── FEATURE ROWS ── */
  .feature-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    padding: 5rem 2rem;
    max-width: 1100px;
    margin: 0 auto;
    border-top: 1px solid var(--border);
  }

  .feature-row.reverse { direction: rtl; }
  .feature-row.reverse > * { direction: ltr; }

  .feature-visual {
    background: var(--bg-2);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    aspect-ratio: 4/3;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .feature-visual img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.7;
    filter: grayscale(30%);
    transition: opacity 0.4s, filter 0.4s;
  }

  .feature-visual:hover img {
    opacity: 0.9;
    filter: grayscale(0%);
  }

  .feature-visual-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,10,11,0.5) 0%, transparent 50%);
    pointer-events: none;
  }

  .feature-badge {
    position: absolute;
    bottom: 1rem; left: 1rem;
    font-size: 0.68rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--gold);
    background: rgba(10,10,11,0.7);
    border: 1px solid var(--gold-dim);
    padding: 4px 10px;
    border-radius: 100px;
    backdrop-filter: blur(8px);
  }

  .feature-list {
    list-style: none;
    margin-top: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .feature-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.87rem;
    color: var(--text-sub);
    line-height: 1.5;
  }

  .feature-list li::before {
    content: '';
    width: 5px; height: 5px;
    min-width: 5px;
    border-radius: 50%;
    background: var(--gold);
    margin-top: 6px;
  }

  /* ── COLLECTIONS GRID ── */
  .collections-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: var(--border);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    margin-top: 3rem;
  }

  .collection-item {
    background: var(--bg-2);
    padding: 1.75rem 1.5rem;
    transition: background 0.25s;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }

  .collection-item:hover { background: var(--bg-3); }

  .collection-item::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--gold);
    transform: scaleX(0);
    transition: transform 0.3s;
    transform-origin: left;
  }

  .collection-item:hover::after { transform: scaleX(1); }

  .collection-num {
    font-size: 0.6rem;
    letter-spacing: 0.15em;
    color: var(--text-muted);
    text-transform: uppercase;
    margin-bottom: 0.75rem;
  }

  .collection-name {
    font-family: 'Syne', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
  }

  .collection-desc {
    font-size: 0.78rem;
    color: var(--text-muted);
    line-height: 1.5;
  }

  .collection-arrow {
    display: block;
    margin-top: 1.2rem;
    font-size: 0.72rem;
    color: var(--gold);
    letter-spacing: 0.08em;
  }

  /* ── PROCESS ── */
  .process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    margin-top: 3rem;
  }

  .process-card {
    border-top: 2px solid var(--border);
    padding-top: 1.5rem;
    transition: border-color 0.3s;
  }

  .process-card:hover { border-color: var(--gold); }

  .process-num {
    font-family: 'Syne', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--bg-4);
    line-height: 1;
    margin-bottom: 0.75rem;
  }

  .process-title {
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
  }

  .process-body {
    font-size: 0.8rem;
    color: var(--text-muted);
    line-height: 1.6;
  }

  /* ── TESTIMONIAL ── */
  .testimonial-section {
    padding: 5rem 2rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  .testimonial-card {
    background: var(--bg-2);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 3.5rem 4rem;
    position: relative;
    overflow: hidden;
  }

  .testimonial-card::before {
    content: '\201C';
    position: absolute;
    top: -1rem;
    left: 2.5rem;
    font-family: Georgia, serif;
    font-size: 10rem;
    color: var(--gold);
    opacity: 0.07;
    line-height: 1;
    pointer-events: none;
  }

  .testimonial-text {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.1rem, 2.5vw, 1.55rem);
    font-weight: 400;
    color: var(--text);
    line-height: 1.55;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
  }

  .testimonial-attr {
    font-size: 0.75rem;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    text-transform: uppercase;
  }

  .testimonial-attr span {
    color: var(--gold);
    font-style: normal;
  }

  /* ── STATS ── */
  .stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    background: var(--bg-2);
  }

  .stat-item {
    padding: 2.5rem 2rem;
    border-right: 1px solid var(--border);
    text-align: center;
  }

  .stat-item:last-child { border-right: none; }

  .stat-num {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2.2rem, 5vw, 3.5rem);
    font-weight: 800;
    color: var(--gold);
    line-height: 1;
    margin-bottom: 0.4rem;
  }

  .stat-label {
    font-size: 0.75rem;
    letter-spacing: 0.08em;
    color: var(--text-muted);
    text-transform: uppercase;
  }

  /* ── CTA BAND ── */
  .cta-band {
    max-width: 1100px;
    margin: 0 auto 6rem;
    padding: 0 2rem;
  }

  .cta-inner {
    background: var(--bg-2);
    border: 1px solid var(--border-hover);
    border-radius: 16px;
    padding: 4rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    position: relative;
    overflow: hidden;
  }

  .cta-inner::before {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 400px;
    height: 100%;
    background: radial-gradient(ellipse at 100% 50%, rgba(201,169,110,0.06) 0%, transparent 65%);
    pointer-events: none;
  }

  .cta-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(1.4rem, 3vw, 2rem);
    font-weight: 700;
    color: var(--text);
    line-height: 1.2;
    margin-bottom: 0.5rem;
  }

  .cta-sub { font-size: 0.87rem; color: var(--text-muted); line-height: 1.6; }

  /* ── FOOTER ── */
  footer {
    border-top: 1px solid var(--border);
    padding: 4rem 2rem 2rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  .footer-top {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 2fr;
    gap: 3rem;
    margin-bottom: 3rem;
  }

  .footer-brand {
    font-family: 'Syne', sans-serif;
    font-size: 1.3rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    color: var(--text);
    margin-bottom: 0.75rem;
  }

  .footer-tagline {
    font-size: 0.82rem;
    color: var(--text-muted);
    line-height: 1.6;
    max-width: 220px;
  }

  .footer-col-title {
    font-size: 0.68rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1rem;
  }

  .footer-links { list-style: none; }

  .footer-links li { margin-bottom: 0.55rem; }

  .footer-links a {
    font-size: 0.82rem;
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .footer-links a:hover { color: var(--text); }

  .footer-email {
    display: flex;
    gap: 8px;
    margin-top: 0.5rem;
  }

  .footer-email input {
    flex: 1;
    background: var(--bg-3);
    border: 1px solid var(--border-hover);
    border-radius: 6px;
    color: var(--text);
    font-family: 'Inter', sans-serif;
    font-size: 0.78rem;
    padding: 8px 12px;
    outline: none;
    transition: border-color 0.2s;
  }

  .footer-email input:focus { border-color: var(--gold); }
  .footer-email input::placeholder { color: var(--text-muted); }

  .footer-email button {
    background: var(--gold);
    color: var(--bg);
    border: none;
    border-radius: 6px;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 500;
    padding: 8px 16px;
    cursor: pointer;
    transition: opacity 0.2s;
    flex-shrink: 0;
  }

  .footer-email button:hover { opacity: 0.85; }

  .footer-bottom {
    border-top: 1px solid var(--border);
    padding-top: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .footer-bottom span {
    font-size: 0.72rem;
    color: var(--text-muted);
    letter-spacing: 0.04em;
  }

  /* ── SCROLL ANIMATION ── */
  .fade-up {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.65s ease, transform 0.65s ease;
  }

  .fade-up.visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── RESPONSIVE ── */
  @media (max-width: 900px) {
    .feature-row { grid-template-columns: 1fr; gap: 2rem; }
    .feature-row.reverse { direction: ltr; }
    .collections-grid { grid-template-columns: repeat(2, 1fr); }
    .process-grid { grid-template-columns: repeat(2, 1fr); }
    .footer-top { grid-template-columns: 1fr 1fr; }
    .cta-inner { flex-direction: column; align-items: flex-start; }
  }

  @media (max-width: 600px) {
    nav .nav-links { display: none; }
    .collections-grid { grid-template-columns: 1fr; }
    .process-grid { grid-template-columns: 1fr; }
    .stats-row { grid-template-columns: 1fr; }
    .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
    .footer-top { grid-template-columns: 1fr; }
    .preview-body { padding: 1.5rem; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a class="nav-logo" href="#">INVITE</a>
  <ul class="nav-links">
    <li><a href="#collections">Collections</a></li>
    <li><a href="#process">Atelier</a></li>
    <li><a href="#">Our Story</a></li>
    <li><a href="#">Journal</a></li>
  </ul>
  <a href="/cards" class="nav-cta">Collection</a>
</nav>

<!-- HERO -->
<header class="hero">
  <h1 class="hero-title">
    Invite Your<br><span id="dynamic-subject">Friend</span>
  </h1>
  <p class="hero-sub">
    Every celebration deserves a first impression worthy of framing. We craft invitation suites that begin the story before you arrive.
  </p>
  <div class="hero-actions">
    <a href="#collections" class="btn-primary">
      View Collections
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
    <a href="#" class="btn-ghost">Book Consultation</a>
  </div>

  <!-- PREVIEW CARD -->
  <div class="hero-preview fade-up">
    <div class="preview-window">
      <div class="preview-titlebar">
        <div class="dot-red"></div>
        <div class="dot-yellow"></div>
        <div class="dot-green"></div>
        <span>Walimatul Urus — Preview</span>
      </div>
      <div class="preview-body">
        <p class="preview-tag">Bespoke Invitation Suite</p>
        <h2 class="preview-names">He <span class="preview-amp">&amp;</span> She</h2>
        <p class="preview-request">Request the honour of your presence to celebrate their union</p>
        <div class="preview-divider"><span>Event Details</span></div>
        <div class="preview-details">
          <div class="preview-detail-item">
            <div class="preview-detail-label">Day</div>
            <div class="preview-detail-val" id="p-day">—</div>
            <div class="preview-detail-sub" id="p-dow">—</div>
          </div>
          <div class="preview-detail-item">
            <div class="preview-detail-label">Month / Year</div>
            <div class="preview-detail-val" id="p-month">—</div>
            <div class="preview-detail-sub" id="p-year">—</div>
          </div>
          <div class="preview-detail-item">
            <div class="preview-detail-label">Time</div>
            <div class="preview-detail-val" id="p-time">—</div>
            <div class="preview-detail-sub" id="p-ampm">—</div>
          </div>
        </div>
        <div class="preview-venue">Venue · City, State</div>
      </div>
    </div>
  </div>
</header>

<!-- MARQUEE -->
<div class="marquee-band">
  <div class="marquee-track">
    <span>The Wedding Suite</span><span class="gem">✦</span>
    <span>Gala Invitations</span><span class="gem">✦</span>
    <span>Custom Typography</span><span class="gem">✦</span>
    <span>Gold Foil Printing</span><span class="gem">✦</span>
    <span>Letterpress Edition</span><span class="gem">✦</span>
    <span>Digital E-Invites</span><span class="gem">✦</span>
    <span>Bespoke Monograms</span><span class="gem">✦</span>
    <span>The Wedding Suite</span><span class="gem">✦</span>
    <span>Gala Invitations</span><span class="gem">✦</span>
    <span>Custom Typography</span><span class="gem">✦</span>
    <span>Gold Foil Printing</span><span class="gem">✦</span>
    <span>Letterpress Edition</span><span class="gem">✦</span>
    <span>Digital E-Invites</span><span class="gem">✦</span>
    <span>Bespoke Monograms</span><span class="gem">✦</span>
  </div>
</div>

<!-- FEATURE ROW 1 -->
<div class="feature-row fade-up">
  <div>
    <p class="section-eyebrow">01 — Craftsmanship</p>
    <h2 class="section-title">Printed with intention, finished by hand</h2>
    <p class="section-body">Our atelier combines archival printing techniques with modern design sensibility — letterpress, gold foil stamping, and vellum overlays, each suite produced with care.</p>
    <ul class="feature-list">
      <li>Letterpress on 600gsm cotton paper</li>
      <li>Gold and rose gold foil stamping</li>
      <li>Hand-assembled with linen envelope lining</li>
      <li>Wax seal and ribbon finishing available</li>
    </ul>
  </div>
  <div class="feature-visual">
    <img src="https://images.unsplash.com/photo-1607190074257-dd4b7af0309f?q=80&w=900&auto=format&fit=crop" alt="Wedding invitation suite">
    <div class="feature-visual-overlay"></div>
    <div class="feature-badge">The Wedding Suite</div>
  </div>
</div>

<!-- FEATURE ROW 2 -->
<div class="feature-row reverse fade-up">
  <div>
    <p class="section-eyebrow">02 — Digital</p>
    <h2 class="section-title">Modern e-invites, beautifully animated</h2>
    <p class="section-body">For the couple who wants reach without compromise. Our digital suites carry the same typographic weight and visual elegance — delivered instantly to every guest.</p>
    <ul class="feature-list">
      <li>Motion-designed card with RSVP link</li>
      <li>Full i18n support (Malay, English, Arabic)</li>
      <li>WhatsApp-ready share preview</li>
      <li>Live guest tracker dashboard</li>
    </ul>
  </div>
  <div class="feature-visual">
    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=900&auto=format&fit=crop" alt="Digital invitation preview">
    <div class="feature-visual-overlay"></div>
    <div class="feature-badge">Digital Suite</div>
  </div>
</div>

<!-- FEATURE ROW 3 -->
<div class="feature-row fade-up">
  <div>
    <p class="section-eyebrow">03 — Corporate</p>
    <h2 class="section-title">Gala events done with gravitas</h2>
    <p class="section-body">From brand launches to charity galas — we design event collateral that communicates prestige before guests arrive. Branded suites, name cards, and event programmes.</p>
    <ul class="feature-list">
      <li>Bespoke brand integration</li>
      <li>Large-order production capability</li>
      <li>Event programme and menu design</li>
      <li>Worldwide express white-glove delivery</li>
    </ul>
  </div>
  <div class="feature-visual">
    <img src="https://images.unsplash.com/photo-1550005809-91ad75fb315f?q=80&w=900&auto=format&fit=crop" alt="Corporate event invitations">
    <div class="feature-visual-overlay"></div>
    <div class="feature-badge">Corporate & Gala</div>
  </div>
</div>

<!-- COLLECTIONS -->
<section id="collections" style="padding-top: 2rem;">
  <div class="fade-up">
    <p class="section-eyebrow">04 — Collections</p>
    <h2 class="section-title">Curated for every occasion</h2>
  </div>
  <div class="collections-grid fade-up" style="transition-delay: 0.1s;">
    <div class="collection-item">
      <div class="collection-num">No. 001</div>
      <div class="collection-name">The Wedding Suite</div>
      <div class="collection-desc">Letterpress · Gold Foil · Vellum. Our flagship suite for life's greatest celebration.</div>
      <span class="collection-arrow">Explore →</span>
    </div>
    <div class="collection-item">
      <div class="collection-num">No. 002</div>
      <div class="collection-name">Walimah & Akad</div>
      <div class="collection-desc">Culturally sensitive designs with calligraphy options and bilingual typesetting.</div>
      <span class="collection-arrow">Explore →</span>
    </div>
    <div class="collection-item">
      <div class="collection-num">No. 003</div>
      <div class="collection-name">Gala & Corporate</div>
      <div class="collection-desc">Premium branded collateral for launches, galas, and high-profile events.</div>
      <span class="collection-arrow">Explore →</span>
    </div>
    <div class="collection-item">
      <div class="collection-num">No. 004</div>
      <div class="collection-name">Milestone & Birthday</div>
      <div class="collection-desc">21st, 50th, and beyond — elegant invitations for every milestone worth celebrating.</div>
      <span class="collection-arrow">Explore →</span>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section id="process">
  <div class="fade-up">
    <p class="section-eyebrow">05 — Our Process</p>
    <h2 class="section-title">Crafted with intention at every step</h2>
  </div>
  <div class="process-grid">
    <div class="process-card fade-up" style="transition-delay: 0.05s;">
      <div class="process-num">01</div>
      <div class="process-title">Consultation</div>
      <p class="process-body">We begin with a discovery call to understand your story, aesthetic, and vision for the event.</p>
    </div>
    <div class="process-card fade-up" style="transition-delay: 0.1s;">
      <div class="process-num">02</div>
      <div class="process-title">Design Development</div>
      <p class="process-body">Our atelier presents three bespoke concepts tailored to your brief, refining until perfect.</p>
    </div>
    <div class="process-card fade-up" style="transition-delay: 0.15s;">
      <div class="process-num">03</div>
      <div class="process-title">Print Production</div>
      <p class="process-body">Handcrafted using letterpress, foil stamping, or archival digital print — your choice of finish.</p>
    </div>
    <div class="process-card fade-up" style="transition-delay: 0.2s;">
      <div class="process-num">04</div>
      <div class="process-title">Global Delivery</div>
      <p class="process-body">White-glove packaging and worldwide express shipping, tracked from atelier to your door.</p>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<div class="testimonial-section">
  <div class="testimonial-card fade-up">
    <p class="testimonial-text">
      "When guests received our invitations, three of them called us before the wedding just to say how beautiful they were. INVITE didn't just design an invite — they set the tone for our entire day."
    </p>
    <div class="testimonial-attr">— <span>Amara &amp; James</span> · Married June 2025</div>
  </div>
</div>

<!-- STATS -->
<section style="padding-top: 0;">
  <div class="stats-row fade-up">
    <div class="stat-item">
      <div class="stat-num">500+</div>
      <div class="stat-label">Celebrations Designed</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">24hr</div>
      <div class="stat-label">Designer Response Time</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">40+</div>
      <div class="stat-label">Countries Shipped To</div>
    </div>
  </div>
</section>

<!-- CTA BAND -->
<div class="cta-band" style="margin-top: 4rem;">
  <div class="cta-inner fade-up">
    <div>
      <h2 class="cta-title">Ready to begin your suite?</h2>
      <p class="cta-sub">Book a free 30-minute consultation with one of our designers.</p>
    </div>
    <a href="#" class="btn-primary" style="flex-shrink: 0;">
      Book Consultation
      <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div>
      <div class="footer-brand">INVITE</div>
      <p class="footer-tagline">An invitation atelier for life's most beautiful moments.</p>
    </div>
    <div>
      <div class="footer-col-title">Studio</div>
      <ul class="footer-links">
        <li><a href="#">Collections</a></li>
        <li><a href="#">Custom Work</a></li>
        <li><a href="#">Our Story</a></li>
        <li><a href="#">Journal</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">Client</div>
      <ul class="footer-links">
        <li><a href="#">Portal Login</a></li>
        <li><a href="#">Book Consult</a></li>
        <li><a href="#">Order Status</a></li>
        <li><a href="#">FAQs</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">Stay in Touch</div>
      <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.75rem; line-height: 1.5;">Join the atelier newsletter for seasonal lookbooks and early access.</p>
      <div class="footer-email">
        <input type="email" placeholder="your@email.com">
        <button>Join</button>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 INVITE Studio. All rights reserved.</span>
    <span>Privacy · Terms · Instagram</span>
  </div>
</footer>

<script>
  // Scroll reveal
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) e.target.classList.add('visible');
    });
  }, { threshold: 0.08 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  // Dynamic subject
  const subjects = ['Friend', 'Family', 'Comrade', 'Partner', 'Love'];
  let idx = 0;
  const el = document.getElementById('dynamic-subject');
  setInterval(() => {
    el.classList.add('fade-out');
    setTimeout(() => {
      idx = (idx + 1) % subjects.length;
      el.textContent = subjects[idx];
      el.classList.remove('fade-out');
    }, 400);
  }, 2200);

  // Live date in preview
  const now = new Date();
  const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  document.getElementById('p-day').textContent = now.getDate();
  document.getElementById('p-dow').textContent = days[now.getDay()];
  document.getElementById('p-month').textContent = months[now.getMonth()];
  document.getElementById('p-year').textContent = now.getFullYear();
  let h = now.getHours(), m = now.getMinutes();
  const ampm = h >= 12 ? 'PM' : 'AM';
  h = h % 12 || 12;
  document.getElementById('p-time').textContent = h + ':' + String(m).padStart(2, '0');
  document.getElementById('p-ampm').textContent = ampm;
</script>
</body>
</html>
