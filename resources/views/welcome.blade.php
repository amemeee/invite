<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVITE - Invitation Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple: #6366f1;
            --pink: #ec4899;
            --cyan: #06b6d4;
            --violet: #8b5cf6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Ambient blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(130px);
            z-index: 0;
            pointer-events: none;
        }
        .blob-1 { width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.16) 0%, transparent 70%); top: -250px; left: -200px; }
        .blob-2 { width: 550px; height: 550px; background: radial-gradient(circle, rgba(236,72,153,0.12) 0%, transparent 70%); bottom: -200px; right: -150px; }
        .blob-3 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(6,182,212,0.1) 0%, transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); }

        /* ── HEADER ── */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10,10,15,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1.1rem;
            color: #fff;
            letter-spacing: -0.02em;
        }
        .logo-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--purple), var(--pink));
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }
        .nav-links a {
            color: rgba(226,232,240,0.55);
            text-decoration: none;
            font-size: 0.875rem;
            padding: 6px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-links a:hover { color: #fff; background: rgba(255,255,255,0.07); }

        .header-actions { display: flex; align-items: center; gap: 0.6rem; }
        .btn-ghost-sm {
            padding: 7px 16px;
            border-radius: 9px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.12);
            background: transparent;
            color: rgba(226,232,240,0.75);
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-ghost-sm:hover { background: rgba(255,255,255,0.07); color: #fff; border-color: rgba(255,255,255,0.2); }
        .btn-primary-sm {
            padding: 7px 18px;
            border-radius: 9px;
            font-size: 0.85rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            color: #fff;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            box-shadow: 0 0 18px rgba(99,102,241,0.3);
        }
        .btn-primary-sm:hover { transform: translateY(-1px); box-shadow: 0 4px 24px rgba(99,102,241,0.5); color: #fff; }

        /* ── MAIN ── */
        main { flex: 1; position: relative; z-index: 1; }

        /* ── HERO ── */
        .hero {
            text-align: center;
            padding: 7rem 1.5rem 5rem;
            max-width: 820px;
            margin: 0 auto;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #a5b4fc;
            margin-bottom: 2rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .hero-badge span { width: 6px; height: 6px; background: #6366f1; border-radius: 50%; display: inline-block; }
        .hero h1 {
            font-size: clamp(2.4rem, 6vw, 4rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }
        .hero h1 .line-1 { display: block; color: #f8fafc; }
        .hero h1 .line-2 {
            display: block;
            background: linear-gradient(135deg, var(--purple), var(--pink) 50%, var(--cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            color: rgba(226,232,240,0.45);
            font-size: 1.05rem;
            line-height: 1.75;
            max-width: 500px;
            margin: 0 auto 2.5rem;
        }
        .hero-ctas {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 0 30px rgba(99,102,241,0.4);
        }
        .btn-cta-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 36px rgba(99,102,241,0.55); color: #fff; }
        .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            background: rgba(255,255,255,0.05);
            color: rgba(226,232,240,0.75);
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s;
        }
        .btn-cta-secondary:hover { background: rgba(255,255,255,0.09); color: #fff; border-color: rgba(255,255,255,0.2); }

        /* ── FEATURES ── */
        .features {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }
        .section-eyebrow {
            text-align: center;
            font-size: 0.78rem;
            font-weight: 600;
            color: rgba(226,232,240,0.35);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }
        .section-title {
            text-align: center;
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #f1f5f9;
            margin-bottom: 0.75rem;
        }
        .section-sub {
            text-align: center;
            font-size: 0.95rem;
            color: rgba(226,232,240,0.4);
            max-width: 440px;
            margin: 0 auto 3rem;
            line-height: 1.7;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }
        .feature-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 1.75rem;
            transition: all 0.3s;
        }
        .feature-card:hover {
            border-color: rgba(99,102,241,0.3);
            background: rgba(99,102,241,0.04);
            transform: translateY(-3px);
        }
        .feature-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 1.25rem;
        }
        .icon-purple { background: rgba(99,102,241,0.15); }
        .icon-pink   { background: rgba(236,72,153,0.15); }
        .icon-cyan   { background: rgba(6,182,212,0.15);  }
        .feature-card h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
        }
        .feature-card p {
            font-size: 0.875rem;
            color: rgba(226,232,240,0.45);
            line-height: 1.65;
        }

        /* ── PREVIEW CARDS ── */
        .preview {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 2rem 5rem;
        }
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }
        .card-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .card-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99,102,241,0.06) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .card-card:hover { transform: translateY(-5px); border-color: rgba(99,102,241,0.35); box-shadow: 0 10px 45px rgba(99,102,241,0.15); }
        .card-card:hover::before { opacity: 1; }
        .card-accent { position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 16px 16px 0 0; }
        .accent-purple { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
        .accent-pink   { background: linear-gradient(90deg, #ec4899, #f43f5e); }
        .accent-cyan   { background: linear-gradient(90deg, #06b6d4, #3b82f6); }
        .card-header-row { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1rem; padding-top: 0.5rem; }
        .card-avatar { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
        .avatar-purple { background: rgba(99,102,241,0.2); }
        .avatar-pink   { background: rgba(236,72,153,0.2); }
        .avatar-cyan   { background: rgba(6,182,212,0.2);  }
        .card-tag { font-size: 0.7rem; font-weight: 600; color: rgba(226,232,240,0.35); letter-spacing: 0.06em; background: rgba(255,255,255,0.05); padding: 3px 10px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.07); }
        .card-title { font-size: 1.1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.5rem; letter-spacing: -0.01em; }
        .card-message { font-size: 0.875rem; color: rgba(226,232,240,0.48); line-height: 1.65; margin-bottom: 1.25rem; }
        .card-footer-row { display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06); }
        .card-user { font-size: 0.75rem; color: rgba(226,232,240,0.3); display: flex; align-items: center; gap: 5px; }
        .card-cta {
            font-size: 0.75rem; font-weight: 600;
            color: #a5b4fc;
            text-decoration: none;
            display: flex; align-items: center; gap: 4px;
            transition: gap 0.2s;
        }
        .card-cta:hover { gap: 8px; color: #818cf8; }

        /* ── CTA BANNER ── */
        .cta-banner {
            max-width: 1200px;
            margin: 0 auto 5rem;
            padding: 0 2rem;
        }
        .cta-inner {
            background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(236,72,153,0.1));
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 20px;
            padding: 3.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-inner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%, rgba(99,102,241,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .cta-inner h2 { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 800; letter-spacing: -0.03em; color: #f8fafc; margin-bottom: 0.75rem; }
        .cta-inner p { color: rgba(226,232,240,0.45); font-size: 0.95rem; margin-bottom: 2rem; }

        /* ── FOOTER ── */
        footer {
            position: relative; z-index: 1;
            background: rgba(255,255,255,0.02);
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto; padding: 2rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
        }
        .footer-brand { display: flex; align-items: center; gap: 8px; text-decoration: none; font-weight: 600; color: rgba(226,232,240,0.45); font-size: 0.875rem; }
        .footer-brand .logo-icon { width: 24px; height: 24px; font-size: 12px; }
        .footer-copy { font-size: 0.8rem; color: rgba(226,232,240,0.22); }
        .footer-links { display: flex; gap: 1.25rem; }
        .footer-links a { font-size: 0.8rem; color: rgba(226,232,240,0.32); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: rgba(226,232,240,0.65); }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- ── HEADER ── -->
    <header>
        <div class="header-inner">
            <a href="/" class="logo">
                <div class="logo-icon">✦</div>
                INVITE
            </a>

            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#preview">Preview</a></li>
            </ul>

            <div class="header-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary-sm">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost-sm">Log in</a>
                    <a href="{{ route('register') }}" class="btn-primary-sm">Get Started</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ── MAIN ── -->
    <main>

        <!-- Hero -->
        <section class="hero">
            <div class="hero-badge">
                <span></span> Now in Beta — Free to use
            </div>
            <h1>
                <span class="line-1">Create Your Card</span>
                <span class="line-2">Invite Them</span>
            </h1>
            <p>Design and share personalised card-themed invitation cards for any occasion — events, parties, or just because.</p>
            <div class="hero-ctas">
                @auth
                    <a href="{{ route('cards.index') }}" class="btn-cta-primary">
                        <i class="bi bi-collection-fill"></i> My Cards
                    </a>
                    <a href="{{ route('cards.create') }}" class="btn-cta-secondary">
                        <i class="bi bi-plus-lg"></i> New Card
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-cta-primary">
                        <i class="bi bi-stars"></i> Start for Free
                    </a>
                    <a href="{{ route('login') }}" class="btn-cta-secondary">
                        <i class="bi bi-box-arrow-in-right"></i> Log in
                    </a>
                @endauth
            </div>
        </section>

        <!-- Features -->
        <section class="features" id="features">
            <p class="section-eyebrow">Why InviteMe</p>
            <h2 class="section-title">Everything you need</h2>
            <p class="section-sub">A simple, beautiful platform to create and manage anime invitation cards.</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon icon-purple">🎴</div>
                    <h3>Themed Cards</h3>
                    <p>Choose from a variety of inspired styles and themes to make your invitations stand out.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-pink">✍️</div>
                    <h3>Custom Messages</h3>
                    <p>Write personalised messages for each card. Every invitation tells a unique story.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon icon-cyan">🔗</div>
                    <h3>Easy Sharing</h3>
                    <p>Share your cards instantly. Perfect for events, gatherings, or just sending love to friends.</p>
                </div>
            </div>
        </section>

        <!-- Preview -->
        <section class="preview" id="preview">
            <p class="section-eyebrow">Card Preview</p>
            <h2 class="section-title">See what's possible</h2>
            <p class="section-sub">A glimpse of the cards you can create with InviteMe.</p>

            <div class="cards-grid">
                <!-- Card 1 -->
                <div class="card-card">
                    <div class="card-accent accent-purple"></div>
                    <div class="card-header-row">
                        <div class="card-avatar avatar-purple">🌸</div>
                        <span class="card-tag">INVITATION</span>
                    </div>
                    <div class="card-title">Sakura Festival Night</div>
                    <div class="card-message">You're invited to join us under the cherry blossoms for an unforgettable evening of music and lantern lights.</div>
                    <div class="card-footer-row">
                        <span class="card-user"><i class="bi bi-person-fill"></i> by Hana</span>
                        <a href="{{ route('register') }}" class="card-cta">Create yours <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="card-card">
                    <div class="card-accent accent-pink"></div>
                    <div class="card-header-row">
                        <div class="card-avatar avatar-pink">⚔️</div>
                        <span class="card-tag">EVENT</span>
                    </div>
                    <div class="card-title">Tournament Arc: Finals</div>
                    <div class="card-message">The final battle is here. Join us for the ultimate showdown — only the strongest will claim the title.</div>
                    <div class="card-footer-row">
                        <span class="card-user"><i class="bi bi-person-fill"></i> by Kurokami</span>
                        <a href="{{ route('register') }}" class="card-cta">Create yours <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="card-card">
                    <div class="card-accent accent-cyan"></div>
                    <div class="card-header-row">
                        <div class="card-avatar avatar-cyan">🌙</div>
                        <span class="card-tag">PARTY</span>
                    </div>
                    <div class="card-title">Moonlight Garden Party</div>
                    <div class="card-message">A magical night awaits beneath the stars. Dress in your finest yukata and celebrate with us.</div>
                    <div class="card-footer-row">
                        <span class="card-user"><i class="bi bi-person-fill"></i> by Tsuki</span>
                        <a href="{{ route('register') }}" class="card-cta">Create yours <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Banner -->
        @guest
        <div class="cta-banner">
            <div class="cta-inner">
                <h2>Ready to create your card?</h2>
                <p>Join InviteMe and start designing beautiful anime invitation cards today.</p>
                <a href="{{ route('register') }}" class="btn-cta-primary" style="display:inline-flex;">
                    <i class="bi bi-stars"></i> Get Started — It's Free
                </a>
            </div>
        </div>
        @endguest

    </main>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="footer-inner">
            <a href="/" class="footer-brand">
                <div class="logo-icon">✦</div>
                InviteMe
            </a>
            <span class="footer-copy">© {{ date('Y') }} InviteMe. All rights reserved.</span>
            <div class="footer-links">
                <a href="#features">Features</a>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
