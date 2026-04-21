<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->title }} — InviteMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --purple: #6366f1; --pink: #ec4899; --violet: #8b5cf6; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; min-height: 100vh; overflow-x: hidden; }

        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); top: -200px; left: -150px; }
        .blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(236,72,153,0.1) 0%, transparent 70%); bottom: -150px; right: -100px; }

        header { position: sticky; top: 0; z-index: 100; background: rgba(10,10,15,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.07); }
        .header-inner { max-width: 1200px; margin: 0 auto; padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; font-weight: 800; font-size: 1.1rem; color: #fff; letter-spacing: -0.02em; }
        .logo-icon { width: 32px; height: 32px; background: linear-gradient(135deg, var(--purple), var(--pink)); border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 15px; }
        .header-right { display: flex; align-items: center; gap: 0.6rem; }
        .back-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 9px; color: rgba(226,232,240,0.65); text-decoration: none; font-size: 0.83rem; transition: all 0.2s; }
        .back-btn:hover { background: rgba(255,255,255,0.09); color: #fff; }
        .btn-action { display: inline-flex; align-items: center; gap: 6px; padding: 7px 16px; border-radius: 9px; font-size: 0.83rem; font-weight: 500; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: rgba(226,232,240,0.7); cursor: pointer; transition: all 0.2s; }
        .btn-action:hover { background: rgba(255,255,255,0.09); color: #fff; }
        .btn-primary-grad { background: linear-gradient(135deg, var(--purple), var(--violet)); border-color: transparent; color: #fff; box-shadow: 0 0 16px rgba(99,102,241,0.3); }
        .btn-primary-grad:hover { transform: translateY(-1px); box-shadow: 0 4px 22px rgba(99,102,241,0.45); color: #fff; }

        .page { max-width: 900px; margin: 0 auto; padding: 3rem 2rem 5rem; position: relative; z-index: 1; }
        .page-title { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; margin-bottom: 0.3rem; }
        .page-sub { font-size: 0.875rem; color: rgba(226,232,240,0.35); margin-bottom: 2rem; }

        .glass-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; padding: 2rem; margin-bottom: 1.5rem; }

        .card-title-display { font-size: 1.4rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.5rem; }
        .card-date-badge { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.25); border-radius: 20px; font-size: 0.78rem; color: #a5b4fc; margin-bottom: 1.5rem; }
        .divider { border: none; border-top: 1px solid rgba(255,255,255,0.07); margin: 1.5rem 0; }

        .message-content { color: rgba(226,232,240,0.8); line-height: 1.8; font-size: 0.95rem; }
        .message-content p { margin-bottom: 0.75rem; }
        .message-content p:last-child { margin-bottom: 0; }

        .share-box { display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; }
        .share-url { flex: 1; min-width: 200px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; padding: 10px 14px; font-size: 0.82rem; color: rgba(226,232,240,0.5); font-family: monospace; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

        .meta-row { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.25rem; }
        .meta-item { font-size: 0.8rem; color: rgba(226,232,240,0.35); display: flex; align-items: center; gap: 5px; }
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
            <div class="header-right">
                <a href="{{ route('cards.index') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Cards</a>
                <button onclick="copyShareLink()" class="btn-action" id="shareCopyBtn">
                    <i class="bi bi-clipboard" id="shareIcon"></i> Copy Link
                </button>
                <a href="{{ route('cards.invite', $card->share_token) }}" target="_blank" class="btn-action">
                    <i class="bi bi-eye"></i> Preview
                </a>
                <a href="{{ route('cards.manage', $card) }}" class="btn-action btn-primary-grad">
                    <i class="bi bi-sliders"></i> Manage
                </a>
            </div>
        </div>
    </header>

    <div class="page">
        <div class="page-title">{{ $card->title }}</div>
        <p class="page-sub">Card #{{ $card->id }} &mdash; created {{ $card->created_at->diffForHumans() }}</p>

        <div class="glass-card">
            <div class="card-title-display">{{ $card->title }}</div>
            @if($card->event_date)
            <div class="card-date-badge">
                <i class="bi bi-calendar-event"></i>
                {{ $card->event_date->format('d M Y, H:i') }}
            </div>
            @endif
            <hr class="divider">
            <div class="message-content">{!! $card->message !!}</div>
            <div class="meta-row">
                <span class="meta-item"><i class="bi bi-clock"></i> Created {{ $card->created_at->format('d M Y') }}</span>
                @if($card->event_date)
                <span class="meta-item"><i class="bi bi-calendar2-event"></i> Event {{ $card->event_date->format('d M Y') }}</span>
                @endif
                <span class="meta-item"><i class="bi bi-envelope"></i> {{ $card->submissions()->count() }} responses</span>
            </div>
        </div>

        <p style="font-size:0.78rem;font-weight:700;color:rgba(226,232,240,0.35);text-transform:uppercase;letter-spacing:0.09em;margin-bottom:0.75rem">Share Link</p>
        <div class="glass-card" style="padding:1.25rem 1.5rem">
            <div class="share-box">
                <div class="share-url">{{ route('cards.invite', $card->share_token) }}</div>
                <button onclick="copyShareLink()" class="btn-action" id="shareCopyBtn2">
                    <i class="bi bi-clipboard" id="shareIcon2"></i> Copy
                </button>
                <a href="{{ route('cards.invite', $card->share_token) }}" target="_blank" class="btn-action">
                    <i class="bi bi-box-arrow-up-right"></i> Open
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyShareLink() {
            const url = '{{ route('cards.invite', $card->share_token) }}';
            navigator.clipboard.writeText(url).then(() => {
                ['shareCopyBtn', 'shareCopyBtn2'].forEach(id => {
                    const btn = document.getElementById(id);
                    if (btn) btn.innerHTML = '<i class="bi bi-clipboard-check"></i> Copied!';
                });
                setTimeout(() => {
                    document.getElementById('shareCopyBtn').innerHTML = '<i class="bi bi-clipboard"></i> Copy Link';
                    document.getElementById('shareCopyBtn2').innerHTML = '<i class="bi bi-clipboard"></i> Copy';
                }, 2500);
            });
        }

        const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @if(session('success'))
            Toast.fire({ icon: 'success', title: '{{ session("success") }}' });
        @elseif(session('error'))
            Toast.fire({ icon: 'error', title: '{{ session("error") }}' });
        @endif
    </script>
</body>
</html>
