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
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; min-height: 100vh; overflow-x: hidden; }
        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.18) 0%, transparent 70%); top: -200px; left: -150px; }
        .blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(236,72,153,0.13) 0%, transparent 70%); bottom: -150px; right: -100px; }

        .page-wrap { position: relative; z-index: 1; max-width: 560px; margin: 0 auto; padding: 3rem 1.5rem 5rem; display: flex; flex-direction: column; gap: 1.5rem; align-items: center; }

        /* Brand */
        .brand { display: flex; align-items: center; gap: 8px; text-decoration: none; font-weight: 800; font-size: 0.95rem; color: rgba(226,232,240,0.4); }
        .logo-icon { width: 26px; height: 26px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 12px; }

        /* Section wrapper */
        .section { width: 100%; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; overflow: hidden; }
        .section-label { font-size: 0.7rem; font-weight: 700; color: rgba(226,232,240,0.35); text-transform: uppercase; letter-spacing: 0.1em; display: flex; align-items: center; gap: 6px; margin-bottom: 0.75rem; }

        /* Hero card */
        .card-banner { height: 130px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 45%, #ec4899 100%); position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .card-banner::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse at 30% 50%, rgba(255,255,255,0.15) 0%, transparent 60%); }
        .banner-emoji { font-size: 3.5rem; filter: drop-shadow(0 4px 16px rgba(0,0,0,0.4)); position: relative; z-index: 1; }
        .card-body-wrap { padding: 1.75rem 2rem; }
        .invite-label { font-size: 0.7rem; font-weight: 700; color: rgba(165,180,252,0.7); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.75rem; }
        .invite-title { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.03em; line-height: 1.2; color: #f8fafc; margin-bottom: 1.25rem; }
        .divider { height: 1px; background: linear-gradient(90deg, rgba(99,102,241,0.4), rgba(236,72,153,0.2), transparent); margin-bottom: 1.25rem; }
        .invite-message { font-size: 0.95rem; color: rgba(226,232,240,0.58); line-height: 1.8; white-space: pre-wrap; }
        .card-meta { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; border-top: 1px solid rgba(255,255,255,0.06); background: rgba(255,255,255,0.02); }
        .meta-date { font-size: 0.75rem; color: rgba(226,232,240,0.3); display: flex; align-items: center; gap: 5px; }
        .meta-id { font-size: 0.7rem; font-weight: 600; color: rgba(226,232,240,0.22); letter-spacing: 0.05em; }

        /* Countdown */
        .countdown-wrap { padding: 1.75rem 2rem; text-align: center; }
        .countdown-grid { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; margin-top: 1rem; }
        .cd-box { background: rgba(99,102,241,0.1); border: 1px solid rgba(99,102,241,0.2); border-radius: 14px; padding: 1rem 1.25rem; min-width: 72px; }
        .cd-num { font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; color: #a5b4fc; line-height: 1; }
        .cd-unit { font-size: 0.7rem; font-weight: 600; color: rgba(226,232,240,0.35); text-transform: uppercase; letter-spacing: 0.07em; margin-top: 4px; }
        .cd-label { font-size: 0.85rem; color: rgba(226,232,240,0.5); margin-top: 1.25rem; }

        /* Location */
        .location-wrap { padding: 1.75rem 2rem; }
        .venue-name { font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.4rem; }
        .venue-addr { font-size: 0.875rem; color: rgba(226,232,240,0.5); line-height: 1.6; margin-bottom: 1rem; }
        .map-frame { width: 100%; height: 220px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.08); overflow: hidden; background: rgba(255,255,255,0.03); }
        .map-frame iframe { width: 100%; height: 100%; border: 0; }

        /* Gallery */
        .gallery-wrap { padding: 1.75rem 2rem; }
        .photo-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; margin-top: 0.75rem; }
        .photo-grid img { width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 10px; border: 1px solid rgba(255,255,255,0.07); cursor: pointer; transition: transform 0.2s; }
        .photo-grid img:hover { transform: scale(1.03); }

        /* Music */
        .music-wrap { padding: 1.5rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .music-icon { width: 44px; height: 44px; background: rgba(6,182,212,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .music-info { flex: 1; min-width: 0; }
        .music-title { font-size: 0.9rem; font-weight: 600; color: #f1f5f9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .music-sub { font-size: 0.75rem; color: rgba(226,232,240,0.35); margin-top: 2px; }
        .music-player { width: 100%; margin-top: 0.5rem; }
        audio { width: 100%; height: 36px; accent-color: #6366f1; }

        /* Forms */
        .form-section { padding: 1.75rem 2rem; }
        .form-group { margin-bottom: 0.9rem; }
        label.flabel { font-size: 0.78rem; font-weight: 600; color: rgba(226,232,240,0.45); text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 0.4rem; }
        .form-ctrl { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 9px 14px; font-size: 0.875rem; color: #e2e8f0; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
        .form-ctrl:focus { border-color: rgba(99,102,241,0.5); }
        .form-ctrl::placeholder { color: rgba(226,232,240,0.22); }
        textarea.form-ctrl { resize: vertical; min-height: 80px; }
        select.form-ctrl option { background: #1a1a2e; }
        .btn-submit { display: inline-flex; align-items: center; gap: 6px; padding: 10px 24px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; border-radius: 10px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s; width: 100%; justify-content: center; box-shadow: 0 0 20px rgba(99,102,241,0.25); }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 22px rgba(99,102,241,0.45); }
        .alert-success { background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.25); color: #34d399; border-radius: 10px; padding: 10px 16px; font-size: 0.875rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }

        /* Wishes */
        .wish-list { display: flex; flex-direction: column; gap: 0.65rem; margin-top: 1rem; }
        .wish-item { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 1rem 1.25rem; }
        .wish-name { font-size: 0.78rem; font-weight: 700; color: #a5b4fc; margin-bottom: 0.3rem; }
        .wish-msg  { font-size: 0.875rem; color: rgba(226,232,240,0.58); line-height: 1.65; }

        /* Share */
        .share-wrap { padding: 1.5rem 2rem; }
        .share-row { display: flex; gap: 0.5rem; margin-top: 0.75rem; }
        .share-url { flex: 1; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 9px 14px; font-size: 0.8rem; color: rgba(226,232,240,0.5); outline: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-copy { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; border-radius: 10px; font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap; }
        .btn-copy.copied { background: linear-gradient(135deg, #10b981, #059669); }

        /* Lightbox */
        .lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92); z-index: 9999; align-items: center; justify-content: center; }
        .lightbox.open { display: flex; }
        .lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 12px; }
        .lightbox-close { position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(255,255,255,0.1); border: none; color: #fff; width: 40px; height: 40px; border-radius: 50%; font-size: 1.25rem; cursor: pointer; display: flex; align-items: center; justify-content: center; }

        /* Footer */
        .footer-note { font-size: 0.78rem; color: rgba(226,232,240,0.2); text-align: center; }
        .footer-note a { color: rgba(165,180,252,0.45); text-decoration: none; }
        .footer-note a:hover { color: #a5b4fc; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x"></i></button>
        <img id="lightboxImg" src="" alt="">
    </div>

    <div class="page-wrap">

        <a href="{{ route('welcome') }}" class="brand">
            <div class="logo-icon">✦</div> InviteMe
        </a>

        {{-- ── HERO CARD ── --}}
        <div class="section">
            <div class="card-banner">
                <span class="banner-emoji">🌸</span>
            </div>
            <div class="card-body-wrap">
                <p class="invite-label"><i class="bi bi-envelope-heart-fill"></i> You're Invited</p>
                <h1 class="invite-title">{{ $card->title }}</h1>
                <div class="divider"></div>
                <div class="invite-message">{!! $card->message !!}</div>
            </div>
            @if($card->event_date)
            <div style="display:flex;align-items:center;gap:8px;padding:0.85rem 2rem;border-top:1px solid rgba(255,255,255,0.06);background:rgba(99,102,241,0.06)">
                <i class="bi bi-calendar-event" style="color:#a5b4fc;font-size:0.9rem"></i>
                <span style="font-size:0.85rem;color:#c7d2fe;font-weight:600">{{ $card->event_date->format('l, d F Y — H:i') }}</span>
            </div>
            @endif
            <div class="card-meta">
                <span class="meta-date"><i class="bi bi-clock"></i> {{ $card->created_at->format('d M Y') }}</span>
                <span class="meta-id">#{{ str_pad($card->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        {{-- ── COUNTDOWN ── --}}
        @if($card->countdown)
        <div class="section">
            <div class="countdown-wrap">
                <div class="section-label"><i class="bi bi-hourglass-split"></i> Countdown</div>
                <div class="countdown-grid">
                    <div class="cd-box"><div class="cd-num" id="cd-days">--</div><div class="cd-unit">Days</div></div>
                    <div class="cd-box"><div class="cd-num" id="cd-hours">--</div><div class="cd-unit">Hours</div></div>
                    <div class="cd-box"><div class="cd-num" id="cd-mins">--</div><div class="cd-unit">Minutes</div></div>
                    <div class="cd-box"><div class="cd-num" id="cd-secs">--</div><div class="cd-unit">Seconds</div></div>
                </div>
                <p class="cd-label">{{ $card->countdown->label }}</p>
            </div>
        </div>
        @endif

        {{-- ── LOCATION ── --}}
        @if($card->location)
        <div class="section">
            <div class="location-wrap">
                <div class="section-label"><i class="bi bi-geo-alt-fill"></i> Location</div>
                @if($card->location->venue_name)
                <div class="venue-name">{{ $card->location->venue_name }}</div>
                @endif
                <div class="venue-addr">{{ $card->location->address }}</div>
                @if($card->location->embed_url)
                <div class="map-frame">
                    <iframe src="{{ $card->location->embed_url }}" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ── GALLERY ── --}}
        @if($card->galleries->count())
        <div class="section">
            <div class="gallery-wrap">
                <div class="section-label"><i class="bi bi-images"></i> Gallery</div>
                <div class="photo-grid">
                    @foreach($card->galleries as $photo)
                    <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->caption }}" onclick="openLightbox('{{ Storage::url($photo->image_path) }}')">
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- ── MUSIC ── --}}
        @if($card->music)
        <div class="section">
            <div class="music-wrap">
                <div class="music-icon">🎵</div>
                <div class="music-info">
                    <div class="section-label" style="margin-bottom:2px"><i class="bi bi-music-note-beamed"></i> Background Music</div>
                    <div class="music-title">{{ $card->music->title ?? 'Background Music' }}</div>
                    @if($card->music->source_type === 'file')
                    <audio id="audioPlayer" controls {{ $card->music->autoplay ? 'autoplay' : '' }} class="music-player">
                        <source src="{{ Storage::url($card->music->source_value) }}">
                    </audio>
                    @else
                    <div class="music-sub">{{ $card->music->source_value }}</div>
                    <audio id="audioPlayer" controls {{ $card->music->autoplay ? 'autoplay' : '' }} class="music-player">
                        <source src="{{ $card->music->source_value }}">
                    </audio>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- ── CUSTOM FORM ── --}}
        @if($card->fields->count())
        <div class="section">
            <div class="form-section">
                <div class="section-label"><i class="bi bi-pencil-square"></i> Fill in the Form</div>
                @if(session('submit_success'))
                <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('submit_success') }}</div>
                @endif
                <form action="{{ route('cards.submit', $card->share_token) }}" method="POST">
                    @csrf
                    @foreach($card->fields as $field)
                    <div class="form-group">
                        <label class="flabel">
                            {{ $field->label }}
                            @if($field->required)<span style="color:#f87171">*</span>@endif
                        </label>

                        @if($field->type === 'textarea')
                            <textarea class="form-ctrl" name="field_{{ $field->id }}" rows="3"
                                {{ $field->required ? 'required' : '' }}></textarea>

                        @elseif($field->type === 'select')
                            <select class="form-ctrl" name="field_{{ $field->id }}" {{ $field->required ? 'required' : '' }}>
                                <option value="">— Select —</option>
                                @foreach($field->options ?? [] as $opt)
                                <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>

                        @elseif($field->type === 'radio')
                            <div style="display:flex;flex-direction:column;gap:0.5rem;margin-top:0.25rem">
                                @foreach($field->options ?? [] as $opt)
                                <label style="display:flex;align-items:center;gap:8px;font-size:0.875rem;color:rgba(226,232,240,0.65);text-transform:none;letter-spacing:0;font-weight:400;cursor:pointer">
                                    <input type="radio" name="field_{{ $field->id }}" value="{{ $opt }}" {{ $field->required ? 'required' : '' }}
                                        style="accent-color:#6366f1">
                                    {{ $opt }}
                                </label>
                                @endforeach
                            </div>

                        @elseif($field->type === 'checkbox')
                            <div style="display:flex;flex-direction:column;gap:0.5rem;margin-top:0.25rem">
                                @foreach($field->options ?? [] as $opt)
                                <label style="display:flex;align-items:center;gap:8px;font-size:0.875rem;color:rgba(226,232,240,0.65);text-transform:none;letter-spacing:0;font-weight:400;cursor:pointer">
                                    <input type="checkbox" name="field_{{ $field->id }}[]" value="{{ $opt }}"
                                        style="accent-color:#6366f1">
                                    {{ $opt }}
                                </label>
                                @endforeach
                            </div>

                        @else
                            <input class="form-ctrl"
                                type="{{ $field->type === 'phone' ? 'tel' : $field->type }}"
                                name="field_{{ $field->id }}"
                                {{ $field->required ? 'required' : '' }}>
                        @endif

                        @error("field_{$field->id}")
                            <div style="color:#f87171;font-size:0.78rem;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>
                    @endforeach
                    <button type="submit" class="btn-submit"><i class="bi bi-send-fill"></i> Submit Response</button>
                </form>
            </div>
        </div>
        @endif

        {{-- ── RSVP ── --}}
        <div class="section">
            <div class="form-section">
                <div class="section-label"><i class="bi bi-check2-circle"></i> RSVP</div>
                @if(session('rsvp_success'))
                <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('rsvp_success') }}</div>
                @endif
                <form action="{{ route('cards.rsvp.store', $card->share_token) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="flabel">Your Name</label>
                        <input class="form-ctrl" type="text" name="guest_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label class="flabel">Email <span style="font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
                        <input class="form-ctrl" type="email" name="guest_email" placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label class="flabel">Will you attend?</label>
                        <select class="form-ctrl" name="status">
                            <option value="attending">✅ Yes, I'll be there!</option>
                            <option value="maybe">🤔 Maybe</option>
                            <option value="not_attending">❌ Sorry, can't make it</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="flabel">Note <span style="font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
                        <textarea class="form-ctrl" name="note" rows="2" placeholder="Any message for the host..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit"><i class="bi bi-send-fill"></i> Send RSVP</button>
                </form>
            </div>
        </div>

        {{-- ── WISHES ── --}}
        <div class="section">
            <div class="form-section">
                <div class="section-label"><i class="bi bi-chat-heart-fill"></i> Leave a Wish</div>
                @if(session('wish_success'))
                <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('wish_success') }}</div>
                @endif
                <form action="{{ route('cards.wish.store', $card->share_token) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="flabel">Your Name</label>
                        <input class="form-ctrl" type="text" name="guest_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label class="flabel">Your Wish</label>
                        <textarea class="form-ctrl" name="message" rows="3" placeholder="Write your wishes here..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit"><i class="bi bi-heart-fill"></i> Send Wish</button>
                </form>

                @if($card->wishes->count())
                <div class="wish-list">
                    @foreach($card->wishes as $wish)
                    <div class="wish-item">
                        <div class="wish-name">{{ $wish->guest_name }} · <span style="font-weight:400;color:rgba(226,232,240,0.28)">{{ $wish->created_at->diffForHumans() }}</span></div>
                        <div class="wish-msg">{{ $wish->message }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- ── SHARE ── --}}
        <div class="section">
            <div class="share-wrap">
                <div class="section-label"><i class="bi bi-share-fill"></i> Share this Invitation</div>
                <div class="share-row">
                    <input id="shareUrl" class="share-url" type="text" readonly value="{{ route('cards.invite', $card->share_token) }}">
                    <button class="btn-copy" id="copyBtn" onclick="copyLink()">
                        <i class="bi bi-clipboard" id="copyIcon"></i> <span id="copyText">Copy</span>
                    </button>
                </div>
            </div>
        </div>

        <p class="footer-note">
            Made with <a href="{{ route('welcome') }}">InviteMe</a> &mdash;
            <a href="{{ route('register') }}">Create your own card</a>
        </p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Countdown
        @if($card->countdown)
        const eventDate = new Date('{{ $card->countdown->event_date->toIso8601String() }}');
        function updateCountdown() {
            const now  = new Date();
            const diff = eventDate - now;
            if (diff <= 0) {
                ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(id => document.getElementById(id).textContent = '00');
                return;
            }
            document.getElementById('cd-days').textContent  = String(Math.floor(diff / 86400000)).padStart(2,'0');
            document.getElementById('cd-hours').textContent = String(Math.floor((diff % 86400000) / 3600000)).padStart(2,'0');
            document.getElementById('cd-mins').textContent  = String(Math.floor((diff % 3600000) / 60000)).padStart(2,'0');
            document.getElementById('cd-secs').textContent  = String(Math.floor((diff % 60000) / 1000)).padStart(2,'0');
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
        @endif

        // Copy link
        function copyLink() {
            navigator.clipboard.writeText(document.getElementById('shareUrl').value).then(() => {
                const btn = document.getElementById('copyBtn');
                document.getElementById('copyIcon').className = 'bi bi-clipboard-check';
                document.getElementById('copyText').textContent = 'Copied!';
                btn.classList.add('copied');
                setTimeout(() => {
                    document.getElementById('copyIcon').className = 'bi bi-clipboard';
                    document.getElementById('copyText').textContent = 'Copy';
                    btn.classList.remove('copied');
                }, 2500);
            });
        }

        // Lightbox
        function openLightbox(src) { document.getElementById('lightboxImg').src = src; document.getElementById('lightbox').classList.add('open'); }
        function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); }
    </script>
</body>
</html>
