<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Collections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Background blobs */
        body::before, body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            pointer-events: none;
        }
        body::before {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.18) 0%, transparent 70%);
            top: -200px; left: -150px;
        }
        body::after {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(236,72,153,0.14) 0%, transparent 70%);
            bottom: -150px; right: -100px;
        }

        /* ── HEADER ── */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10,10,15,0.75);
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
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            letter-spacing: -0.01em;
        }
        .logo-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }
        .nav-links a {
            color: rgba(226,232,240,0.6);
            text-decoration: none;
            font-size: 0.875rem;
            padding: 6px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 0 20px rgba(99,102,241,0.35);
        }
        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 28px rgba(99,102,241,0.55);
            color: #fff;
        }

        /* ── MAIN ── */
        main {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        /* Hero section */
        .hero {
            text-align: center;
            padding: 5rem 1rem 3rem;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(99,102,241,0.15);
            border: 1px solid rgba(99,102,241,0.35);
            border-radius: 50px;
            padding: 5px 16px;
            font-size: 0.78rem;
            font-weight: 500;
            color: #a5b4fc;
            margin-bottom: 1.5rem;
            letter-spacing: 0.03em;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.25rem);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.15;
            background: linear-gradient(135deg, #fff 30%, rgba(165,180,252,0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }
        .hero p {
            color: rgba(226,232,240,0.5);
            font-size: 1rem;
            max-width: 480px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Cards grid */
        .cards-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem 5rem;
        }
        .section-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }
        .section-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(226,232,240,0.4);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .card-count {
            font-size: 0.8rem;
            color: rgba(226,232,240,0.35);
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        /* Individual anime card */
        .card-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            cursor: default;
        }
        .card-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99,102,241,0.05) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .card-card:hover {
            transform: translateY(-4px);
            border-color: rgba(99,102,241,0.4);
            background: rgba(255,255,255,0.065);
            box-shadow: 0 8px 40px rgba(99,102,241,0.15);
        }
        .card-card:hover::before { opacity: 1; }

        .card-accent {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 16px 16px 0 0;
        }
        .accent-purple { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
        .accent-pink   { background: linear-gradient(90deg, #ec4899, #f43f5e); }
        .accent-cyan   { background: linear-gradient(90deg, #06b6d4, #3b82f6); }

        .card-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-top: 0.5rem;
        }
        .card-avatar {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .avatar-purple { background: rgba(99,102,241,0.2); }
        .avatar-pink   { background: rgba(236,72,153,0.2); }
        .avatar-cyan   { background: rgba(6,182,212,0.2); }

        .card-id-badge {
            font-size: 0.7rem;
            font-weight: 600;
            color: rgba(226,232,240,0.35);
            letter-spacing: 0.06em;
            background: rgba(255,255,255,0.05);
            padding: 3px 10px;
            border-radius: 50px;
            border: 1px solid rgba(255,255,255,0.07);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
            line-height: 1.3;
        }
        .card-message {
            font-size: 0.875rem;
            color: rgba(226,232,240,0.5);
            line-height: 1.65;
            margin-bottom: 1.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .card-date {
            font-size: 0.75rem;
            color: rgba(226,232,240,0.3);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .card-actions {
            display: flex;
            gap: 0.4rem;
        }
        .btn-ghost {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.1);
            background: transparent;
            color: rgba(226,232,240,0.6);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.08); color: #fff; border-color: rgba(255,255,255,0.2); }
        .btn-ghost-danger:hover { background: rgba(239,68,68,0.12); color: #f87171; border-color: rgba(239,68,68,0.3); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 5rem 1rem;
        }
        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
        .empty-state h3 { font-weight: 600; color: rgba(226,232,240,0.5); margin-bottom: 0.5rem; }
        .empty-state p  { font-size: 0.9rem; color: rgba(226,232,240,0.3); }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            padding: 1rem 0 3rem;
        }
        .pagination-wrap .pagination { --bs-pagination-bg: transparent; --bs-pagination-border-color: rgba(255,255,255,0.1); --bs-pagination-color: rgba(226,232,240,0.6); --bs-pagination-hover-bg: rgba(255,255,255,0.08); --bs-pagination-hover-border-color: rgba(255,255,255,0.2); --bs-pagination-hover-color: #fff; --bs-pagination-active-bg: #6366f1; --bs-pagination-active-border-color: #6366f1; --bs-pagination-disabled-bg: transparent; --bs-pagination-disabled-color: rgba(226,232,240,0.2); --bs-pagination-disabled-border-color: rgba(255,255,255,0.05); }

        /* ── FOOTER ── */
        footer {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.02);
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 600;
            color: rgba(226,232,240,0.5);
            font-size: 0.875rem;
        }
        .footer-brand .logo-icon { width: 24px; height: 24px; font-size: 12px; }
        .footer-copy {
            font-size: 0.8rem;
            color: rgba(226,232,240,0.25);
        }
        .footer-links {
            display: flex;
            gap: 1.25rem;
        }
        .footer-links a {
            font-size: 0.8rem;
            color: rgba(226,232,240,0.35);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: rgba(226,232,240,0.7); }
    </style>
</head>
<body>

    <!-- ── HEADER ── -->
    <header>
        <div class="header-inner">
            <a href="{{ route('dashboard') }}" class="logo">
                <div class="logo-icon">✦</div>
                InviteMe
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('cards.index') }}" class="active">Cards</a></li>
            </ul>

            <div class="header-actions">
                <a href="{{ route('cards.create') }}" class="btn-add">
                    <i class="bi bi-plus-lg"></i> New Card
                </a>
            </div>
        </div>
    </header>

    <!-- ── MAIN ── -->
    <main>
        <!-- Hero -->
        <div class="hero">
            <div class="hero-badge">
                <i class="bi bi-collection-fill"></i>
                Card Collections
            </div>
            <h1>Your Anime Card Library</h1>
            <p>Browse, manage and share your personalised invitation cards.</p>
        </div>

        <!-- Cards -->
        <section class="cards-section">
            <div class="section-meta">
                <span class="section-label">All Cards</span>
                <span class="card-count">{{ $cards->total() }} {{ Str::plural('card', $cards->total()) }}</span>
            </div>

            @php
                $accents  = ['accent-purple', 'accent-pink', 'accent-cyan'];
                $avatars  = ['avatar-purple', 'avatar-cyan', 'avatar-pink'];
                $emojis   = ['🌸', '⚔️', '🌙', '🔥', '✨', '🎴'];
            @endphp

            @if($cards->count())
                <div class="cards-grid">
                    @foreach($cards as $i => $card)
                        @php
                            $accent = $accents[$i % 3];
                            $avatar = $avatars[$i % 3];
                            $emoji  = $emojis[$i % count($emojis)];
                        @endphp
                        <div class="card-card">
                            <div class="card-accent {{ $accent }}"></div>

                            <div class="card-header-row">
                                <div class="card-avatar {{ $avatar }}">{{ $emoji }}</div>
                                <span class="card-id-badge">#{{ str_pad($card->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <div class="card-title">{{ $card->title }}</div>
                            <div class="card-message">{{ $card->message }}</div>

                            <div class="card-footer-row">
                                <span class="card-date">
                                    <i class="bi bi-clock"></i>
                                    {{ $card->created_at->diffForHumans() }}
                                </span>
                                <div class="card-actions">
                                    <a href="{{ route('cards.show', $card->id) }}" class="btn-ghost">View</a>
                                    <a href="{{ route('cards.edit', $card->id) }}" class="btn-ghost">Edit</a>
                                    <form onsubmit="return confirm('Delete this card?');" action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-ghost btn-ghost-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $cards->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="bi bi-collection"></i></div>
                    <h3>No cards yet</h3>
                    <p>Create your first anime card to get started.</p>
                </div>
            @endif
        </section>
    </main>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="footer-inner">
            <a href="{{ route('dashboard') }}" class="footer-brand">
                <div class="logo-icon">✦</div>
                InviteMe
            </a>
            <span class="footer-copy">© {{ date('Y') }} InviteMe. All rights reserved.</span>
            <div class="footer-links">
                <a href="{{ route('cards.index') }}">Cards</a>
                <a href="{{ route('cards.create') }}">New Card</a>
                <a href="{{ route('profile.edit') }}">Profile</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.mixin({ toast:true, position:'top-end', showConfirmButton:false, timer:3000, timerProgressBar:true })
                .fire({ icon:'success', title:'{{ session("success") }}' });
        @elseif(session('error'))
            Swal.mixin({ toast:true, position:'top-end', showConfirmButton:false, timer:3000, timerProgressBar:true })
                .fire({ icon:'error', title:'{{ session("error") }}' });
        @endif
    </script>
</body>
</html>
