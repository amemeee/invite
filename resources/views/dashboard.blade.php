<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — InviteMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --purple: #6366f1; --pink: #ec4899; --cyan: #06b6d4; --violet: #8b5cf6; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; min-height: 100vh; overflow-x: hidden; }

        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 700px; height: 700px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); top: -250px; left: -200px; }
        .blob-2 { width: 550px; height: 550px; background: radial-gradient(circle, rgba(236,72,153,0.1) 0%, transparent 70%); bottom: -200px; right: -150px; }

        /* Header */
        header { position: sticky; top: 0; z-index: 100; background: rgba(10,10,15,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.07); }
        .header-inner { max-width: 1200px; margin: 0 auto; padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; font-weight: 800; font-size: 1.1rem; color: #fff; letter-spacing: -0.02em; }
        .logo-icon { width: 32px; height: 32px; background: linear-gradient(135deg, var(--purple), var(--pink)); border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 15px; }
        .nav-links { display: flex; align-items: center; gap: 0.25rem; list-style: none; }
        .nav-links a { color: rgba(226,232,240,0.55); text-decoration: none; font-size: 0.875rem; padding: 6px 14px; border-radius: 8px; transition: all 0.2s; }
        .nav-links a:hover, .nav-links a.active { color: #fff; background: rgba(255,255,255,0.08); }
        .header-right { display: flex; align-items: center; gap: 0.75rem; }
        .user-chip { display: flex; align-items: center; gap: 8px; padding: 6px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.09); border-radius: 50px; font-size: 0.82rem; color: rgba(226,232,240,0.65); }
        .user-chip i { font-size: 0.9rem; }
        .btn-logout { padding: 7px 14px; border-radius: 9px; font-size: 0.82rem; font-weight: 500; border: 1px solid rgba(255,255,255,0.1); background: transparent; color: rgba(226,232,240,0.5); cursor: pointer; transition: all 0.2s; }
        .btn-logout:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.3); color: #f87171; }
        .btn-new { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: linear-gradient(135deg, var(--purple), var(--violet)); color: #fff; border: none; border-radius: 10px; font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: all 0.2s; box-shadow: 0 0 18px rgba(99,102,241,0.3); }
        .btn-new:hover { transform: translateY(-1px); box-shadow: 0 4px 24px rgba(99,102,241,0.5); color: #fff; }

        /* Page */
        .page { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem 5rem; position: relative; z-index: 1; }
        .welcome-text { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; margin-bottom: 0.35rem; }
        .welcome-sub { font-size: 0.9rem; color: rgba(226,232,240,0.4); margin-bottom: 2.5rem; }

        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem; }
        .stat-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: all 0.2s; }
        .stat-card:hover { border-color: rgba(99,102,241,0.3); background: rgba(99,102,241,0.04); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .si-purple { background: rgba(99,102,241,0.18); }
        .si-green  { background: rgba(16,185,129,0.18); }
        .si-pink   { background: rgba(236,72,153,0.18); }
        .stat-num { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; line-height: 1; }
        .stat-label { font-size: 0.78rem; color: rgba(226,232,240,0.4); margin-top: 3px; font-weight: 500; }

        /* Sections */
        .section-title { font-size: 0.78rem; font-weight: 700; color: rgba(226,232,240,0.35); text-transform: uppercase; letter-spacing: 0.09em; margin-bottom: 1rem; }
        .glass-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; overflow: hidden; margin-bottom: 1.5rem; }

        /* Quick actions */
        .actions-wrap { padding: 1.5rem; display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .action-btn { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border-radius: 10px; font-size: 0.85rem; font-weight: 500; text-decoration: none; transition: all 0.2s; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: rgba(226,232,240,0.7); }
        .action-btn:hover { background: rgba(255,255,255,0.09); color: #fff; }
        .action-btn.primary { background: linear-gradient(135deg, var(--purple), var(--violet)); border-color: transparent; color: #fff; box-shadow: 0 0 16px rgba(99,102,241,0.3); }
        .action-btn.primary:hover { transform: translateY(-1px); box-shadow: 0 4px 22px rgba(99,102,241,0.45); }

        /* Recent cards list */
        .recent-item { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); gap: 1rem; }
        .recent-item:last-child { border-bottom: none; }
        .recent-title { font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin-bottom: 3px; }
        .recent-date  { font-size: 0.75rem; color: rgba(226,232,240,0.3); }
        .recent-actions { display: flex; gap: 0.4rem; flex-shrink: 0; }
        .mini-btn { font-size: 0.75rem; font-weight: 600; padding: 4px 12px; border-radius: 7px; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); color: rgba(226,232,240,0.55); transition: all 0.2s; }
        .mini-btn:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .empty-recent { text-align: center; padding: 3rem 1rem; color: rgba(226,232,240,0.3); font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <header>
        <div class="header-inner">
            <a href="{{ route('dashboard') }}" class="logo">
                <div class="logo-icon">✦</div> InviteMe
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
                <li><a href="{{ route('cards.index') }}">Cards</a></li>
            </ul>
            <div class="header-right">
                <div class="user-chip"><i class="bi bi-person-fill"></i> {{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
                <a href="{{ route('cards.create') }}" class="btn-new"><i class="bi bi-plus-lg"></i> New Card</a>
            </div>
        </div>
    </header>

    <div class="page">
        <div class="welcome-text">Welcome back, {{ auth()->user()->name }} 👋</div>
        <p class="welcome-sub">Here's a summary of your invitation cards.</p>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon si-purple">🎴</div>
                <div>
                    <div class="stat-num">{{ $totalCards }}</div>
                    <div class="stat-label">Total Cards</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-green">📅</div>
                <div>
                    <div class="stat-num">{{ $thisMonth }}</div>
                    <div class="stat-label">Created This Month</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon si-pink">✉️</div>
                <div>
                    <div class="stat-num" style="font-size:0.9rem;margin-top:2px">{{ auth()->user()->email }}</div>
                    <div class="stat-label">Account</div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <p class="section-title">Quick Actions</p>
        <div class="glass-card">
            <div class="actions-wrap">
                <a href="{{ route('cards.create') }}" class="action-btn primary"><i class="bi bi-plus-lg"></i> New Card</a>
                <a href="{{ route('cards.index') }}" class="action-btn"><i class="bi bi-collection"></i> All Cards</a>
                <a href="{{ route('profile.edit') }}" class="action-btn"><i class="bi bi-person-gear"></i> Edit Profile</a>
            </div>
        </div>

        {{-- Recent Cards --}}
        <p class="section-title">Recent Cards</p>
        <div class="glass-card">
            @forelse($recentCards as $card)
            <div class="recent-item">
                <div>
                    <div class="recent-title">{{ $card->title }}</div>
                    <div class="recent-date"><i class="bi bi-clock" style="font-size:0.7rem"></i> {{ $card->created_at->diffForHumans() }}</div>
                </div>
                <div class="recent-actions">
                    <a href="{{ route('cards.show', $card) }}" class="mini-btn">View</a>
                    <a href="{{ route('cards.manage', $card) }}" class="mini-btn" style="color:#a5b4fc;border-color:rgba(99,102,241,0.25)">Manage</a>
                    <a href="{{ route('cards.responses', $card) }}" class="mini-btn" style="color:#34d399;border-color:rgba(16,185,129,0.25)">Responses</a>
                </div>
            </div>
            @empty
            <div class="empty-recent">No cards yet. <a href="{{ route('cards.create') }}" style="color:#a5b4fc">Create your first one →</a></div>
            @endforelse

            @if($totalCards > 5)
            <div style="padding:1rem 1.5rem;border-top:1px solid rgba(255,255,255,0.05)">
                <a href="{{ route('cards.index') }}" style="font-size:0.82rem;color:#a5b4fc;text-decoration:none">View all {{ $totalCards }} cards →</a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>
