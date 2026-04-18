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

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.18) 0%, transparent 70%); top: -200px; left: -150px; }
        .blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(236,72,153,0.13) 0%, transparent 70%); bottom: -150px; right: -100px; }

        .page-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 520px;
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        /* Branding */
        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1rem;
            color: rgba(226,232,240,0.5);
        }
        .logo-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
        }

        /* Card envelope */
        .invite-card {
            width: 100%;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05);
        }

        /* Accent banner */
        .card-banner {
            height: 120px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 40%, #ec4899 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .card-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(255,255,255,0.15) 0%, transparent 60%);
        }
        .banner-emoji {
            font-size: 3.5rem;
            filter: drop-shadow(0 4px 16px rgba(0,0,0,0.4));
            position: relative;
            z-index: 1;
        }

        /* Card body */
        .card-body-wrap {
            padding: 2rem;
        }
        .invite-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: rgba(165,180,252,0.7);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
        }
        .invite-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.2;
            color: #f8fafc;
            margin-bottom: 1.25rem;
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(99,102,241,0.4), rgba(236,72,153,0.2), transparent);
            margin-bottom: 1.25rem;
        }
        .invite-message {
            font-size: 0.95rem;
            color: rgba(226,232,240,0.6);
            line-height: 1.8;
            white-space: pre-wrap;
        }

        /* Meta row */
        .card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-top: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.02);
        }
        .meta-date {
            font-size: 0.75rem;
            color: rgba(226,232,240,0.3);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .meta-id {
            font-size: 0.7rem;
            font-weight: 600;
            color: rgba(226,232,240,0.25);
            letter-spacing: 0.05em;
        }

        /* Copy link box */
        .share-box {
            width: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
        }
        .share-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(226,232,240,0.35);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 0.75rem;
        }
        .share-input-row {
            display: flex;
            gap: 0.5rem;
        }
        .share-url {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 9px 14px;
            font-size: 0.8rem;
            color: rgba(226,232,240,0.55);
            font-family: 'Inter', monospace;
            outline: none;
            cursor: text;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .btn-copy {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            box-shadow: 0 0 16px rgba(99,102,241,0.35);
        }
        .btn-copy:hover { transform: translateY(-1px); box-shadow: 0 4px 22px rgba(99,102,241,0.5); }
        .btn-copy.copied { background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 0 16px rgba(16,185,129,0.35); }

        /* Footer link */
        .footer-note {
            font-size: 0.78rem;
            color: rgba(226,232,240,0.22);
            text-align: center;
        }
        .footer-note a { color: rgba(165,180,252,0.5); text-decoration: none; }
        .footer-note a:hover { color: #a5b4fc; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="page-wrap">

        <a href="{{ route('welcome') }}" class="brand">
            <div class="logo-icon">✦</div>
            InviteMe
        </a>

        <!-- Invitation Card -->
        <div class="invite-card">
            <div class="card-banner">
                <span class="banner-emoji">🌸</span>
            </div>

            <div class="card-body-wrap">
                <p class="invite-label"><i class="bi bi-envelope-heart-fill"></i> You're Invited</p>
                <h1 class="invite-title">{{ $card->title }}</h1>
                <div class="divider"></div>
                <p class="invite-message">{{ $card->message }}</p>
            </div>

            <div class="card-meta">
                <span class="meta-date">
                    <i class="bi bi-clock"></i>
                    {{ $card->created_at->format('d M Y') }}
                </span>
                <span class="meta-id">#{{ str_pad($card->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <!-- Share box -->
        <div class="share-box">
            <p class="share-label"><i class="bi bi-share-fill"></i> Share this invitation</p>
            <div class="share-input-row">
                <input
                    id="shareUrl"
                    class="share-url"
                    type="text"
                    readonly
                    value="{{ route('cards.invite', $card->share_token) }}"
                >
                <button class="btn-copy" id="copyBtn" onclick="copyLink()">
                    <i class="bi bi-clipboard" id="copyIcon"></i>
                    <span id="copyText">Copy</span>
                </button>
            </div>
        </div>

        <p class="footer-note">
            Made with <a href="{{ route('welcome') }}">InviteMe</a> &mdash;
            <a href="{{ route('register') }}">Create your own card</a>
        </p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyLink() {
            const url   = document.getElementById('shareUrl').value;
            const btn   = document.getElementById('copyBtn');
            const icon  = document.getElementById('copyIcon');
            const text  = document.getElementById('copyText');

            navigator.clipboard.writeText(url).then(() => {
                btn.classList.add('copied');
                icon.className = 'bi bi-clipboard-check';
                text.textContent = 'Copied!';

                setTimeout(() => {
                    btn.classList.remove('copied');
                    icon.className = 'bi bi-clipboard';
                    text.textContent = 'Copy';
                }, 2500);
            });
        }
    </script>
</body>
</html>
