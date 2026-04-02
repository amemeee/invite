<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVITE | Invitation Atelier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=DM+Mono:wght@300;400&family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --cream: #F5F0E8;
            --ink: #1A1714;
            --terracotta: #C0614A;
            --sage: #8A9E89;
            --warm-mid: #D4C5A9;
            --accent-rust: #B85C3A;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: var(--cream);
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ── Texture overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.6;
        }

        /* ── Typography ── */
        .display-editorial {
            /* font-family: 'Bebas Neue', sans-serif; */
            font-size: clamp(5rem, 14vw, 11rem);
            line-height: 0.9;
            font-family: 'Playfair Display', serif; /* Or your preferred editorial font */
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--ink);
        }

        #dynamic-subject {
            color: goldenrod;
            transition: opacity 0.5s ease-in-out;
            display: inline-block;
            min-width: 120px; /* Prevents layout jumping if words are different lengths */
        }

        .fade-out {
            opacity: 0;
        }

        .cormorant-italic {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-weight: 300;
        }

        .mono {
            font-family: 'DM Mono', monospace;
            font-weight: 300;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        /* ── Navbar ── */
        .navbar {
            background: var(--cream);
            border-bottom: 1px solid var(--ink);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.5rem;
            color: var(--ink) !important;
            letter-spacing: 3px;
        }

        .nav-link {
            font-family: 'DM Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--ink) !important;
            transition: color 0.2s;
        }

        .nav-link:hover { color: var(--terracotta) !important; }

        .btn-ink {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            background: var(--ink);
            color: var(--cream);
            border: none;
            padding: 10px 24px;
            border-radius: 0;
            transition: background 0.25s, color 0.25s;
        }

        .btn-ink:hover {
            background: var(--terracotta);
            color: #fff;
        }

        .btn-outline-ink {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            background: transparent;
            color: var(--ink);
            border: 1px solid var(--ink);
            padding: 10px 24px;
            border-radius: 0;
            transition: background 0.25s, color 0.25s;
        }

        .btn-outline-ink:hover {
            background: var(--ink);
            color: var(--cream);
        }

        /* ── Hero ── */
        .hero {
            padding-top: 80px;
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            border-bottom: 1px solid var(--ink);
        }

        .hero-left {
            border-right: 1px solid var(--ink);
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .hero-right {
            padding: 0;
            overflow: hidden;
            position: relative;
        }

        .hero-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: sepia(15%) contrast(1.05);
            transition: transform 8s ease;
        }

        .hero-right:hover img {
            transform: scale(1.04);
        }

        .issue-tag {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--terracotta);
            border: 1px solid var(--terracotta);
            display: inline-block;
            padding: 4px 10px;
            margin-bottom: 1.5rem;
        }

        .hero-tagline {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 300;
            font-style: italic;
            font-size: clamp(1.1rem, 2.5vw, 1.5rem);
            color: #5a5047;
            line-height: 1.6;
            max-width: 480px;
        }

        /* ── Vertical rule label ── */
        .vertical-label {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #9a8e82;
        }

        /* ── Grid section ── */
        .section-rule {
            border-top: 1px solid var(--ink);
            padding-top: 3rem;
        }

        .collection-card {
            border: 1px solid #d4c5a9;
            background: #fff;
            overflow: hidden;
            transition: border-color 0.3s;
            cursor: pointer;
        }

        .collection-card:hover { border-color: var(--terracotta); }

        .collection-card img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            display: block;
            filter: sepia(10%) brightness(0.97);
            transition: transform 0.6s ease, filter 0.4s;
        }

        .collection-card:hover img {
            transform: scale(1.05);
            filter: sepia(0%) brightness(1);
        }

        .card-label {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid #d4c5a9;
        }

        .card-num {
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            color: #9a8e82;
            letter-spacing: 0.2em;
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--ink);
            margin: 0.25rem 0 0.1rem;
        }

        /* ── Marquee band ── */
        .marquee-band {
            background: var(--ink);
            padding: 14px 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-track {
            display: inline-flex;
            animation: marquee 22s linear infinite;
        }

        .marquee-track span {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--warm-mid);
            padding: 0 2.5rem;
        }

        .marquee-track span.dot {
            color: var(--terracotta);
            font-style: normal;
            font-family: 'DM Mono', monospace;
            font-size: 0.6rem;
            align-self: center;
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        /* ── Process ── */
        .process-step {
            border-left: 2px solid var(--warm-mid);
            padding-left: 1.5rem;
            margin-bottom: 2.5rem;
            transition: border-color 0.3s;
        }

        .process-step:hover { border-color: var(--terracotta); }

        .step-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            line-height: 1;
            color: var(--warm-mid);
        }

        /* ── Testimonial ── */
        .testimonial-block {
            background: var(--ink);
            color: var(--cream);
            padding: 5rem 4rem;
        }

        .testimonial-text {
            font-size: clamp(1.4rem, 3vw, 2.2rem);
            font-style: italic;
            font-weight: 300;
            line-height: 1.5;
        }

        .testimonial-attr {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            color: var(--sage);
            text-transform: uppercase;
        }

        /* ── Stats ── */
        .stat-col {
            border-right: 1px solid #d4c5a9;
        }

        .stat-col:last-child { border-right: none; }

        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            line-height: 1;
            color: var(--terracotta);
        }

        /* ── Footer ── */
        .site-footer {
            background: var(--ink);
            color: var(--cream);
            border-top: 3px solid var(--terracotta);
        }

        .footer-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 4px;
            color: var(--cream);
        }

        .footer-link {
            font-family: 'DM Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #9a8e82;
            text-decoration: none;
            display: block;
            margin-bottom: 0.75rem;
            transition: color 0.2s;
        }

        .footer-link:hover { color: var(--terracotta); }

        /* ── Animations ── */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .hero-left { border-right: none; border-bottom: 1px solid var(--ink); }
            .stat-col { border-right: none; border-bottom: 1px solid #d4c5a9; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
            .testimonial-block { padding: 3rem 1.5rem; }
            .hero { min-height: auto; flex-direction: column; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">INVITE</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav mx-auto gap-lg-5 gap-3">
                    <li class="nav-item"><a class="nav-link" href="#">Collections</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Atelier</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Journal</a></li>
                </ul>
                <a href="#" class="btn btn-ink">Client Portal</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero" style="margin-top: 57px;">
        <div class="row g-0 w-100">
            <div class="col-lg-7 hero-left">
                <div>
                    <span class="issue-tag">Est. 2019 — Vol. VII</span>
                    <div class="display-editorial">
                        INVITE YOUR <span id="dynamic-subject" class="fade-in">FRIEND</span>
                    </div>
                </div>
                <div>
                    <p class="hero-tagline mb-4">
                        Every celebration deserves a first impression worthy of framing. We craft invitation suites that begin the story before you arrive.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#collections" class="btn btn-ink">View Collections</a>
                        <a href="#" class="btn btn-outline-ink">Book Consultation</a>
                    </div>
                    <div class="mt-5 pt-3 border-top" style="border-color: var(--warm-mid) !important;">
                        <span class="mono" style="color: #9a8e82;">500+ celebrations curated &nbsp;·&nbsp; Worldwide delivery &nbsp;·&nbsp; Bespoke atelier</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 hero-right d-flex" style="min-height: 500px;">
                <div class="d-flex align-items-center px-3 py-4" style="border-right: 1px solid var(--ink); background-color: var(--page-bg); z-index: 2;">
                    <span class="vertical-label">Invitation Atelier — 2026</span>
                </div>

                <div class="card-stage d-flex align-items-center justify-content-center p-4" style="flex:1; overflow:hidden; background: radial-gradient(circle at center, #ffffff 0%, #ffffff 100%); position: relative;">

                    <div class="floating-elements">
                        <div class="star star-1"></div>
                        <div class="star star-2"></div>
                        <div class="star star-3"></div>
                    </div>

                    <div class="vows-wedding-card shadow-lg">

                        <div class="card-border-overlay"></div>

                        <div class="card-content-wrapper p-4 text-center">

                            <div class="couple-art-container mb-3">
                                <div class="anime-silhouette"></div>
                                <div class="circ-accent circ-1"></div>
                                <div class="circ-accent circ-2"></div>
                            </div>

                            <div class="card-header-suite">
                                <p class="text-uppercase ls-2 small mb-1 gold-text opacity-75">Walimatul Urus</p>
                                <h3 class="serif couple-names mb-3">He & She</h3>
                                <p class="text-muted small mb-4">Request the honor of your presence to celebrate their union</p>
                            </div>

                            <div class="card-details border-top border-bottom border-secondary py-3 mb-4">
                                <div class="row g-0 align-items-center">
                                    <div class="col-4 border-right border-secondary">
                                        <p class="text-uppercase small mb-0 fw-bold"><?= date('l')?></p>
                                        <h4 class="mb-0 serif"><?= date('d')?></h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-uppercase small mb-0"><?= date('F')?></p>
                                        <p class="small text-muted mb-0"><?= date('Y')?></p>
                                    </div>
                                    <div class="col-4 border-left border-secondary">
                                        <p class="text-uppercase small mb-0 fw-bold">At</p>
                                        <h4 class="mb-0 serif"><?= date('h:i')?></h4>
                                        <p class="small text-muted mb-0"><?= date('A')?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer-suite">
                                <p class="text-uppercase small mb-1 fw-bold">Venue</p>
                                <p class="text-muted small mb-0">City, State</p>
                            </div>
                        </div>

<div class="card-group">
  <div class="card">
    <img src="https://i.ytimg.com/vi/m7D14RD5kdo/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAk4i1cmR5hRG8Cv8GZecgjMKOrTg" class="card-img-top" alt="...">
  </div>
  {{-- <div class="card">
    <img src="..." class="card-img-top" alt="...">
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
  </div> --}}
</div>

                    </div>


                </div>
            </div>
        </div>
    </header>

    <!-- Marquee -->
    <div class="marquee-band">
        <div class="marquee-track">
            <span>The Wedding Suite</span><span class="dot">✦</span>
            <span>Gala Invitations</span><span class="dot">✦</span>
            <span>Custom Typography</span><span class="dot">✦</span>
            <span>Gold Foil Printing</span><span class="dot">✦</span>
            <span>Letterpress Edition</span><span class="dot">✦</span>
            <span>Digital E-Invites</span><span class="dot">✦</span>
            <span>Bespoke Monograms</span><span class="dot">✦</span>
            <span>The Wedding Suite</span><span class="dot">✦</span>
            <span>Gala Invitations</span><span class="dot">✦</span>
            <span>Custom Typography</span><span class="dot">✦</span>
            <span>Gold Foil Printing</span><span class="dot">✦</span>
            <span>Letterpress Edition</span><span class="dot">✦</span>
            <span>Digital E-Invites</span><span class="dot">✦</span>
            <span>Bespoke Monograms</span><span class="dot">✦</span>
        </div>
    </div>

    <!-- Collections -->
    <section id="collections" class="py-5 px-4">
        <div class="container-fluid">
            <div class="row mb-4 section-rule fade-up">
                <div class="col-6">
                    <p class="mono" style="color: #9a8e82;">02 — Collections</p>
                    <h2 class="cormorant-italic" style="font-size: clamp(2rem, 4vw, 3rem);">Curated for every occasion</h2>
                </div>
                <div class="col-6 d-flex align-items-end justify-content-end">
                    <a href="#" class="btn btn-outline-ink">All Collections</a>
                </div>
            </div>
            <div class="row g-0 fade-up" style="transition-delay: 0.15s;">
                <div class="col-md-5">
                    <div class="collection-card h-100">
                        <div style="overflow:hidden;">
                            <img src="https://images.unsplash.com/photo-1607190074257-dd4b7af0309f?q=80&w=1000&auto=format&fit=crop" alt="Wedding Suite" style="height: 460px;">
                        </div>
                        <div class="card-label">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="card-num mb-0">No. 001</p>
                                    <h3 class="card-title">The Wedding Suite</h3>
                                    <p class="mono" style="color: #9a8e82;">Letterpress · Gold Foil · Vellum</p>
                                </div>
                                <a href="#" class="mono" style="color: var(--terracotta);">Explore →</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row g-0 h-100">
                        <div class="col-12">
                            <div class="collection-card">
                                <div style="overflow:hidden;">
                                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1200&auto=format&fit=crop" alt="Gala" style="height: 220px;">
                                </div>
                                <div class="card-label">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="card-num mb-0">No. 002</p>
                                            <h3 class="card-title" style="font-size: 1.3rem;">Gala & Corporate Events</h3>
                                        </div>
                                        <a href="#" class="mono" style="color: var(--terracotta);">Explore →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="collection-card h-100">
                                <div style="overflow:hidden;">
                                    <img src="https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?q=80&w=800&auto=format&fit=crop" alt="Digital" style="height: 200px;">
                                </div>
                                <div class="card-label">
                                    <p class="card-num mb-0">No. 003</p>
                                    <h3 class="card-title" style="font-size: 1.2rem;">Modern E-Invites</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="collection-card h-100">
                                <div style="overflow:hidden;">
                                    <img src="https://images.unsplash.com/photo-1550005809-91ad75fb315f?q=80&w=800&auto=format&fit=crop" alt="Birthday" style="height: 200px;">
                                </div>
                                <div class="card-label">
                                    <p class="card-num mb-0">No. 004</p>
                                    <h3 class="card-title" style="font-size: 1.2rem;">Milestone Celebrations</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <div class="testimonial-block fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-1 d-none d-md-flex align-items-center">
                    <span class="vertical-label" style="color: var(--terracotta);">Client Story</span>
                </div>
                <div class="col-md-10">
                    <p class="mono mb-4" style="color: var(--sage);">— Amara & James, married June 2025</p>
                    <p class="testimonial-text mb-4">
                        "When guests received our invitations, three of them called us before the wedding just to say how beautiful they were. INVITE didn't just design an invite — they set the tone for our entire day."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Process -->
    <section class="py-5 px-4">
        <div class="container-fluid">
            <div class="row section-rule fade-up">
                <div class="col-lg-4 mb-5">
                    <p class="mono" style="color: #9a8e82;">03 — Our Process</p>
                    <h2 class="cormorant-italic mb-4" style="font-size: clamp(2rem, 4vw, 3rem);">Crafted with intention at every step</h2>
                    <a href="#" class="btn btn-ink">Start Your Project</a>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="process-step fade-up" style="transition-delay: 0.1s;">
                                <div class="step-num">01</div>
                                <h4 class="cormorant-italic" style="font-size: 1.4rem;">Consultation</h4>
                                <p class="mono" style="color: #9a8e82; font-size: 0.7rem; line-height: 1.8;">We begin with a discovery call to understand your story, aesthetic, and vision for the event.</p>
                            </div>
                            <div class="process-step fade-up" style="transition-delay: 0.2s;">
                                <div class="step-num">02</div>
                                <h4 class="cormorant-italic" style="font-size: 1.4rem;">Design Development</h4>
                                <p class="mono" style="color: #9a8e82; font-size: 0.7rem; line-height: 1.8;">Our atelier presents three bespoke concepts tailored to your brief, refining until perfect.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="process-step fade-up" style="transition-delay: 0.3s;">
                                <div class="step-num">03</div>
                                <h4 class="cormorant-italic" style="font-size: 1.4rem;">Print Production</h4>
                                <p class="mono" style="color: #9a8e82; font-size: 0.7rem; line-height: 1.8;">Handcrafted using letterpress, foil stamping, or archival digital print — your choice of finish.</p>
                            </div>
                            <div class="process-step fade-up" style="transition-delay: 0.4s;">
                                <div class="step-num">04</div>
                                <h4 class="cormorant-italic" style="font-size: 1.4rem;">Global Delivery</h4>
                                <p class="mono" style="color: #9a8e82; font-size: 0.7rem; line-height: 1.8;">White-glove packaging and worldwide express shipping, tracked from atelier to your door.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-5" style="border-top: 1px solid var(--ink); border-bottom: 1px solid var(--ink);">
        <div class="container-fluid px-4">
            <div class="row text-center fade-up">
                <div class="col-md-4 stat-col py-4">
                    <div class="stat-num">500+</div>
                    <p class="mono" style="color: #9a8e82;">Celebrations Designed</p>
                </div>
                <div class="col-md-4 stat-col py-4">
                    <div class="stat-num">24hr</div>
                    <p class="mono" style="color: #9a8e82;">Designer Response Time</p>
                </div>
                <div class="col-md-4 py-4">
                    <div class="stat-num">40+</div>
                    <p class="mono" style="color: #9a8e82;">Countries Shipped To</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer py-5 px-4">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand mb-3">INVITE</div>
                    <p class="cormorant-italic" style="color: #9a8e82; font-size: 1.1rem; max-width: 280px;">
                        An invitation atelier for life's most beautiful moments.
                    </p>
                </div>
                <div class="col-6 col-lg-2 mb-4">
                    <p class="mono mb-3" style="color: var(--terracotta);">Studio</p>
                    <a href="#" class="footer-link">Collections</a>
                    <a href="#" class="footer-link">Custom Work</a>
                    <a href="#" class="footer-link">Our Story</a>
                    <a href="#" class="footer-link">Journal</a>
                </div>
                <div class="col-6 col-lg-2 mb-4">
                    <p class="mono mb-3" style="color: var(--terracotta);">Client</p>
                    <a href="#" class="footer-link">Portal Login</a>
                    <a href="#" class="footer-link">Book Consult</a>
                    <a href="#" class="footer-link">Order Status</a>
                    <a href="#" class="footer-link">FAQs</a>
                </div>
                <div class="col-lg-4 mb-4">
                    <p class="mono mb-3" style="color: var(--terracotta);">Stay in Touch</p>
                    <p class="mono mb-3" style="color: #9a8e82;">Join the atelier newsletter for seasonal lookbooks and early access.</p>
                    <div class="d-flex gap-2">
                        <input type="email" placeholder="your@email.com" class="form-control rounded-0" style="background: transparent; border: 1px solid #4a4540; color: var(--cream); font-family: 'DM Mono', monospace; font-size: 0.7rem;">
                        <button class="btn btn-ink flex-shrink-0">Join</button>
                    </div>
                </div>
            </div>
            <div class="row" style="border-top: 1px solid #2e2a26; padding-top: 1.5rem;">
                <div class="col-md-6">
                    <span class="mono" style="color: #4a4540;">© 2026 INVITE Studio. All rights reserved.</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="mono" style="color: #4a4540;">Privacy &nbsp;·&nbsp; Terms &nbsp;·&nbsp; Instagram</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Intersection Observer for fade-up
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

        const subjects = [
            "FRIEND",
            "FAMILY",
            "COMRADE",
            "PARTNER",
            "LOVE"
        ];

        let currentIndex = 0;
        const subjectElement = document.getElementById("dynamic-subject");

        function updateSubject() {
            // 1. Start Fade Out
            subjectElement.classList.add("fade-out");

            setTimeout(() => {
                // 2. Change the text after it's invisible
                currentIndex = (currentIndex + 1) % subjects.length;
                subjectElement.textContent = subjects[currentIndex];

                // 3. Fade back in
                subjectElement.classList.remove("fade-out");
            }, 500); // This matches the 0.5s CSS transition
        }

        // Change every 2.5 seconds
        setInterval(updateSubject, 2000);
    </script>
</body>
</html>
