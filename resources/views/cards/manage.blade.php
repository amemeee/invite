<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage — {{ $card->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; min-height: 100vh; }
        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); top: -200px; left: -150px; }
        .blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(236,72,153,0.1) 0%, transparent 70%); bottom: -150px; right: -100px; }

        /* Header */
        header { position: sticky; top: 0; z-index: 100; background: rgba(10,10,15,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.07); }
        .header-inner { max-width: 1100px; margin: 0 auto; padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; font-weight: 800; font-size: 1rem; color: #fff; }
        .logo-icon { width: 30px; height: 30px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .back-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 9px; color: rgba(226,232,240,0.65); text-decoration: none; font-size: 0.83rem; transition: all 0.2s; }
        .back-btn:hover { background: rgba(255,255,255,0.09); color: #fff; }

        /* Page */
        .page { max-width: 1100px; margin: 0 auto; padding: 2.5rem 2rem 5rem; position: relative; z-index: 1; }
        .page-title { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; }
        .page-sub { font-size: 0.875rem; color: rgba(226,232,240,0.4); margin-top: 0.25rem; }
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2.5rem; }

        /* Preview link */
        .preview-link { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; text-decoration: none; border-radius: 10px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; box-shadow: 0 0 16px rgba(99,102,241,0.3); }
        .preview-link:hover { transform: translateY(-1px); box-shadow: 0 4px 22px rgba(99,102,241,0.5); color: #fff; }

        /* Feature grid */
        .features-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(480px, 1fr)); gap: 1.25rem; }

        /* Feature card */
        .feat-card { background: rgba(255,255,255,0.035); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; overflow: hidden; }
        .feat-card.active { border-color: rgba(99,102,241,0.35); background: rgba(99,102,241,0.04); }
        .feat-header { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; cursor: pointer; user-select: none; }
        .feat-title-row { display: flex; align-items: center; gap: 12px; }
        .feat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .icon-purple { background: rgba(99,102,241,0.18); }
        .icon-pink   { background: rgba(236,72,153,0.18); }
        .icon-cyan   { background: rgba(6,182,212,0.18); }
        .icon-amber  { background: rgba(245,158,11,0.18); }
        .icon-green  { background: rgba(16,185,129,0.18); }
        .icon-rose   { background: rgba(244,63,94,0.18); }
        .feat-name { font-size: 0.95rem; font-weight: 700; color: #f1f5f9; }
        .feat-desc { font-size: 0.78rem; color: rgba(226,232,240,0.4); margin-top: 2px; }
        .feat-status { font-size: 0.72rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; }
        .status-active   { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.25); }
        .status-inactive { background: rgba(255,255,255,0.04); color: rgba(226,232,240,0.3); border: 1px solid rgba(255,255,255,0.07); }

        /* Feat body */
        .feat-body { padding: 0 1.5rem 1.5rem; display: none; }
        .feat-body.open { display: block; }
        .feat-divider { height: 1px; background: rgba(255,255,255,0.06); margin-bottom: 1.25rem; }

        /* Form elements */
        label { font-size: 0.78rem; font-weight: 600; color: rgba(226,232,240,0.5); text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 0.4rem; }
        .form-ctrl { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 9px 14px; font-size: 0.875rem; color: #e2e8f0; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.2s; }
        .form-ctrl:focus { border-color: rgba(99,102,241,0.5); background: rgba(255,255,255,0.07); }
        .form-ctrl::placeholder { color: rgba(226,232,240,0.25); }
        textarea.form-ctrl { resize: vertical; min-height: 80px; }
        select.form-ctrl option { background: #1a1a2e; }
        .form-check-input { background-color: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.2); }
        .form-check-input:checked { background-color: #6366f1; border-color: #6366f1; }
        .form-row { display: grid; gap: 0.75rem; margin-bottom: 0.75rem; }
        .form-row-2 { grid-template-columns: 1fr 1fr; }
        .form-group { margin-bottom: 0.75rem; }

        /* Action buttons */
        .btn-save { display: inline-flex; align-items: center; gap: 6px; padding: 8px 20px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; border: none; border-radius: 9px; font-size: 0.83rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 18px rgba(99,102,241,0.4); }
        .btn-remove { display: inline-flex; align-items: center; gap: 5px; padding: 7px 14px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #f87171; border-radius: 9px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .btn-remove:hover { background: rgba(239,68,68,0.18); border-color: rgba(239,68,68,0.4); }
        .btn-row { display: flex; align-items: center; gap: 0.75rem; margin-top: 1rem; flex-wrap: wrap; }

        /* Gallery grid */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 0.5rem; margin-bottom: 1rem; }
        .gallery-thumb { position: relative; aspect-ratio: 1; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08); }
        .gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .gallery-thumb .del-btn { position: absolute; top: 4px; right: 4px; width: 22px; height: 22px; background: rgba(239,68,68,0.85); color: #fff; border: none; border-radius: 50%; font-size: 11px; cursor: pointer; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s; }
        .gallery-thumb:hover .del-btn { opacity: 1; }

        /* RSVP list */
        .rsvp-list { display: flex; flex-direction: column; gap: 0.5rem; max-height: 240px; overflow-y: auto; padding-right: 4px; }
        .rsvp-item { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07); border-radius: 10px; padding: 0.75rem 1rem; display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; }
        .rsvp-name { font-size: 0.875rem; font-weight: 600; color: #f1f5f9; }
        .rsvp-note { font-size: 0.78rem; color: rgba(226,232,240,0.4); margin-top: 2px; }
        .badge-attending     { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.25); }
        .badge-not_attending { background: rgba(239,68,68,0.12); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .badge-maybe         { background: rgba(245,158,11,0.12); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .rsvp-badge { font-size: 0.7rem; font-weight: 600; padding: 3px 10px; border-radius: 50px; white-space: nowrap; }

        /* Wishes list */
        .wish-list { display: flex; flex-direction: column; gap: 0.5rem; max-height: 240px; overflow-y: auto; }
        .wish-item { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07); border-radius: 10px; padding: 0.75rem 1rem; }
        .wish-name { font-size: 0.78rem; font-weight: 700; color: #a5b4fc; margin-bottom: 0.25rem; }
        .wish-msg  { font-size: 0.875rem; color: rgba(226,232,240,0.6); line-height: 1.6; }
        .empty-msg { font-size: 0.83rem; color: rgba(226,232,240,0.3); text-align: center; padding: 1.5rem; }

        /* Toast */
        .toast-wrap { position: fixed; top: 1.25rem; right: 1.25rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; }
        .toast-item { background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.3); color: #34d399; border-radius: 10px; padding: 10px 18px; font-size: 0.85rem; font-weight: 500; backdrop-filter: blur(10px); animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { transform: translateX(60px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; } ::-webkit-scrollbar-track { background: transparent; } ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- Toast -->
    @if(session('success'))
    <div class="toast-wrap"><div class="toast-item"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div></div>
    @endif

    <!-- Header -->
    <header>
        <div class="header-inner">
            <a href="{{ route('cards.index') }}" class="logo">
                <div class="logo-icon">✦</div> InviteMe
            </a>
            <a href="{{ route('cards.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back to Cards
            </a>
        </div>
    </header>

    <div class="page">
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ $card->title }}</h1>
                <p class="page-sub">Manage features for this invitation card.</p>
            </div>
            <a href="{{ route('cards.invite', $card->share_token) }}" target="_blank" class="preview-link">
                <i class="bi bi-eye"></i> Preview Invite
            </a>
        </div>

        {{-- ── FORM FIELDS (full width) ── --}}
        <div class="feat-card {{ $card->fields->count() ? 'active' : '' }}" style="margin-bottom:1.25rem">
            <div class="feat-header" onclick="toggle('fields')">
                <div class="feat-title-row">
                    <div class="feat-icon icon-purple">📋</div>
                    <div>
                        <div class="feat-name">Form Fields</div>
                        <div class="feat-desc">Define what guests fill in when they submit a response</div>
                    </div>
                </div>
                <span class="feat-status {{ $card->fields->count() ? 'status-active' : 'status-inactive' }}">
                    {{ $card->fields->count() }} field{{ $card->fields->count() !== 1 ? 's' : '' }}
                </span>
            </div>
            <div class="feat-body open" id="body-fields">
                <div class="feat-divider"></div>

                {{-- Existing fields --}}
                @if($card->fields->count())
                <div style="display:flex;flex-direction:column;gap:0.5rem;margin-bottom:1.25rem">
                    @foreach($card->fields as $field)
                    <div style="display:flex;align-items:center;gap:0.75rem;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:0.65rem 1rem;">
                        <div style="flex:1;min-width:0">
                            <span style="font-size:0.875rem;font-weight:600;color:#f1f5f9">{{ $field->label }}</span>
                            <span style="font-size:0.72rem;color:rgba(226,232,240,0.35);margin-left:8px;background:rgba(255,255,255,0.05);border-radius:4px;padding:2px 7px">{{ $field->type }}</span>
                            @if($field->required)<span style="font-size:0.7rem;color:#f87171;margin-left:4px">required</span>@endif
                        </div>
                        <div style="display:flex;gap:0.3rem;flex-shrink:0">
                            <form action="{{ route('cards.fields.up', [$card, $field]) }}" method="POST">
                                @csrf <button type="submit" class="btn-ghost" style="padding:4px 8px;font-size:0.75rem" title="Move up">↑</button>
                            </form>
                            <form action="{{ route('cards.fields.down', [$card, $field]) }}" method="POST">
                                @csrf <button type="submit" class="btn-ghost" style="padding:4px 8px;font-size:0.75rem" title="Move down">↓</button>
                            </form>
                            <form action="{{ route('cards.fields.destroy', [$card, $field]) }}" method="POST" onsubmit="return confirm('Delete this field?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-remove" style="padding:4px 10px;font-size:0.75rem"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Add field form --}}
                <form action="{{ route('cards.fields.store', $card) }}" method="POST" id="addFieldForm">
                    @csrf
                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label>Field Label</label>
                            <input class="form-ctrl" type="text" name="label" placeholder="e.g. Full Name, Attendance..." required>
                        </div>
                        <div class="form-group">
                            <label>Field Type</label>
                            <select class="form-ctrl" name="type" id="fieldType" onchange="toggleOptions()">
                                <option value="text">Short Text</option>
                                <option value="textarea">Long Text</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="number">Number</option>
                                <option value="select">Dropdown (Select)</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="checkbox">Checkboxes</option>
                            </select>
                        </div>
                    </div>
                    <div id="optionsWrap" class="form-group" style="display:none">
                        <label>Options <span style="font-weight:400;text-transform:none;letter-spacing:0">(one per line)</span></label>
                        <textarea class="form-ctrl" name="options" rows="3" placeholder="Yes&#10;No&#10;Maybe"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="required" id="fieldRequired" value="1">
                            <label for="fieldRequired" style="text-transform:none;letter-spacing:0;font-size:0.875rem;color:rgba(226,232,240,0.6)">Required field</label>
                        </div>
                    </div>
                    <div class="btn-row">
                        <button type="submit" class="btn-save"><i class="bi bi-plus-lg"></i> Add Field</button>
                        @if($card->fields->count())
                        <a href="{{ route('cards.responses', $card) }}" class="btn-save" style="background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 0 16px rgba(16,185,129,0.3)">
                            <i class="bi bi-table"></i> View Responses ({{ $card->submissions()->count() }})
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="features-grid">

            {{-- ── COUNTDOWN ── --}}
            <div class="feat-card {{ $card->countdown ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('countdown')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-purple">⏳</div>
                        <div>
                            <div class="feat-name">Countdown</div>
                            <div class="feat-desc">Show a live countdown to your event date</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->countdown ? 'status-active' : 'status-inactive' }}">
                        {{ $card->countdown ? 'Active' : 'Not set' }}
                    </span>
                </div>
                <div class="feat-body" id="body-countdown">
                    <div class="feat-divider"></div>
                    <form action="{{ route('cards.countdown.store', $card) }}" method="POST">
                        @csrf
                        <div class="form-row form-row-2">
                            <div class="form-group">
                                <label>Label</label>
                                <input class="form-ctrl" type="text" name="label" value="{{ $card->countdown?->label ?? 'Event starts in' }}" placeholder="e.g. Wedding starts in">
                            </div>
                            <div class="form-group">
                                <label>Event Date & Time</label>
                                <input class="form-ctrl" type="datetime-local" name="event_date" value="{{ $card->countdown?->event_date?->format('Y-m-d\TH:i') }}">
                            </div>
                        </div>
                        <div class="btn-row">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                            @if($card->countdown)
                            <form action="{{ route('cards.countdown.destroy', $card) }}" method="POST" style="display:inline" onsubmit="return confirm('Remove countdown?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-remove"><i class="bi bi-trash3"></i> Remove</button>
                            </form>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── LOCATION ── --}}
            <div class="feat-card {{ $card->location ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('location')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-pink">📍</div>
                        <div>
                            <div class="feat-name">Location</div>
                            <div class="feat-desc">Add venue address and Google Maps embed</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->location ? 'status-active' : 'status-inactive' }}">
                        {{ $card->location ? 'Active' : 'Not set' }}
                    </span>
                </div>
                <div class="feat-body" id="body-location">
                    <div class="feat-divider"></div>
                    <form action="{{ route('cards.location.store', $card) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Venue Name</label>
                            <input class="form-ctrl" type="text" name="venue_name" value="{{ $card->location?->venue_name }}" placeholder="e.g. Grand Ballroom Hotel">
                        </div>
                        <div class="form-group">
                            <label>Full Address</label>
                            <textarea class="form-ctrl" name="address" rows="2" placeholder="Street, City, State">{{ $card->location?->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Google Maps Embed URL <span style="font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
                            <input class="form-ctrl" type="url" name="embed_url" value="{{ $card->location?->embed_url }}" placeholder="https://www.google.com/maps/embed?pb=...">
                            <div style="font-size:0.74rem;color:rgba(226,232,240,0.3);margin-top:5px">Google Maps → Share → Embed a map → copy the src URL only</div>
                        </div>
                        <div class="btn-row">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                            @if($card->location)
                            <form action="{{ route('cards.location.destroy', $card) }}" method="POST" style="display:inline" onsubmit="return confirm('Remove location?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-remove"><i class="bi bi-trash3"></i> Remove</button>
                            </form>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── MUSIC ── --}}
            <div class="feat-card {{ $card->music ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('music')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-cyan">🎵</div>
                        <div>
                            <div class="feat-name">Background Music</div>
                            <div class="feat-desc">Add a song to play on the invite page</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->music ? 'status-active' : 'status-inactive' }}">
                        {{ $card->music ? 'Active' : 'Not set' }}
                    </span>
                </div>
                <div class="feat-body" id="body-music">
                    <div class="feat-divider"></div>
                    <form action="{{ route('cards.music.store', $card) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Song Title</label>
                            <input class="form-ctrl" type="text" name="title" value="{{ $card->music?->title }}" placeholder="e.g. A Thousand Years">
                        </div>
                        <div class="form-group">
                            <label>Source Type</label>
                            <select class="form-ctrl" name="source_type" id="musicType" onchange="toggleMusicInput()">
                                <option value="url" {{ $card->music?->source_type === 'url' ? 'selected' : '' }}>URL (YouTube / direct audio link)</option>
                                <option value="file" {{ $card->music?->source_type === 'file' ? 'selected' : '' }}>Upload MP3 file</option>
                            </select>
                        </div>
                        <div id="music-url-input" class="form-group">
                            <label>Audio URL</label>
                            <input class="form-ctrl" type="url" name="source_url" value="{{ $card->music?->source_type === 'url' ? $card->music?->source_value : '' }}" placeholder="https://...">
                        </div>
                        <div id="music-file-input" class="form-group" style="display:none">
                            <label>MP3 File (max 10MB)</label>
                            <input class="form-ctrl" type="file" name="source_file" accept=".mp3,.ogg,.wav">
                            @if($card->music?->source_type === 'file')
                            <div style="font-size:0.75rem;color:#a5b4fc;margin-top:5px"><i class="bi bi-music-note"></i> Current: {{ basename($card->music->source_value) }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="autoplay" id="autoplay" value="1" {{ $card->music?->autoplay ? 'checked' : '' }}>
                                <label for="autoplay" style="text-transform:none;letter-spacing:0;font-size:0.875rem;color:rgba(226,232,240,0.6)">Autoplay when guest opens the invite</label>
                            </div>
                        </div>
                        <div class="btn-row">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                            @if($card->music)
                            <form action="{{ route('cards.music.destroy', $card) }}" method="POST" style="display:inline" onsubmit="return confirm('Remove music?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-remove"><i class="bi bi-trash3"></i> Remove</button>
                            </form>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── GALLERY ── --}}
            <div class="feat-card {{ $card->galleries->count() ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('gallery')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-amber">🖼️</div>
                        <div>
                            <div class="feat-name">Gallery</div>
                            <div class="feat-desc">Upload photos to display on the invite</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->galleries->count() ? 'status-active' : 'status-inactive' }}">
                        {{ $card->galleries->count() ? $card->galleries->count().' photo'.($card->galleries->count()>1?'s':'') : 'No photos' }}
                    </span>
                </div>
                <div class="feat-body" id="body-gallery">
                    <div class="feat-divider"></div>
                    @if($card->galleries->count())
                    <div class="gallery-grid">
                        @foreach($card->galleries as $photo)
                        <div class="gallery-thumb">
                            <img src="{{ Storage::url($photo->image_path) }}" alt="">
                            <form action="{{ route('cards.gallery.destroy', [$card, $photo]) }}" method="POST" onsubmit="return confirm('Delete photo?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="del-btn"><i class="bi bi-x"></i></button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('cards.gallery.store', $card) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload Photos</label>
                            <input class="form-ctrl" type="file" name="images[]" multiple accept="image/*">
                            <div style="font-size:0.74rem;color:rgba(226,232,240,0.3);margin-top:5px">Max 4MB per image. You can select multiple files.</div>
                        </div>
                        <div class="btn-row">
                            <button type="submit" class="btn-save"><i class="bi bi-upload"></i> Upload</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── RSVP ── --}}
            <div class="feat-card {{ $card->rsvps->count() ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('rsvp')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-green">✅</div>
                        <div>
                            <div class="feat-name">RSVP Responses</div>
                            <div class="feat-desc">Guest responses from the public invite page</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->rsvps->count() ? 'status-active' : 'status-inactive' }}">
                        {{ $card->rsvps->count() }} response{{ $card->rsvps->count() !== 1 ? 's' : '' }}
                    </span>
                </div>
                <div class="feat-body" id="body-rsvp">
                    <div class="feat-divider"></div>
                    @php
                        $attending     = $card->rsvps->where('status','attending')->count();
                        $notAttending  = $card->rsvps->where('status','not_attending')->count();
                        $maybe         = $card->rsvps->where('status','maybe')->count();
                    @endphp
                    <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap">
                        <div style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);border-radius:10px;padding:8px 16px;text-align:center;min-width:80px">
                            <div style="font-size:1.3rem;font-weight:800;color:#34d399">{{ $attending }}</div>
                            <div style="font-size:0.72rem;color:rgba(226,232,240,0.4)">Attending</div>
                        </div>
                        <div style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.18);border-radius:10px;padding:8px 16px;text-align:center;min-width:80px">
                            <div style="font-size:1.3rem;font-weight:800;color:#f87171">{{ $notAttending }}</div>
                            <div style="font-size:0.72rem;color:rgba(226,232,240,0.4)">Not Attending</div>
                        </div>
                        <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.18);border-radius:10px;padding:8px 16px;text-align:center;min-width:80px">
                            <div style="font-size:1.3rem;font-weight:800;color:#fbbf24">{{ $maybe }}</div>
                            <div style="font-size:0.72rem;color:rgba(226,232,240,0.4)">Maybe</div>
                        </div>
                    </div>
                    @if($card->rsvps->count())
                    <div class="rsvp-list">
                        @foreach($card->rsvps as $rsvp)
                        <div class="rsvp-item">
                            <div>
                                <div class="rsvp-name">{{ $rsvp->guest_name }}</div>
                                @if($rsvp->note)<div class="rsvp-note">{{ $rsvp->note }}</div>@endif
                            </div>
                            <span class="rsvp-badge badge-{{ $rsvp->status }}">{{ str_replace('_',' ', ucfirst($rsvp->status)) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-msg">No RSVPs yet. Share the invite link with your guests.</div>
                    @endif
                </div>
            </div>

            {{-- ── WISHES ── --}}
            <div class="feat-card {{ $card->wishes->count() ? 'active' : '' }}">
                <div class="feat-header" onclick="toggle('wishes')">
                    <div class="feat-title-row">
                        <div class="feat-icon icon-rose">💌</div>
                        <div>
                            <div class="feat-name">Guest Wishes</div>
                            <div class="feat-desc">Messages left by guests on the invite page</div>
                        </div>
                    </div>
                    <span class="feat-status {{ $card->wishes->count() ? 'status-active' : 'status-inactive' }}">
                        {{ $card->wishes->count() }} wish{{ $card->wishes->count() !== 1 ? 'es' : '' }}
                    </span>
                </div>
                <div class="feat-body" id="body-wishes">
                    <div class="feat-divider"></div>
                    @if($card->wishes->count())
                    <div class="wish-list">
                        @foreach($card->wishes as $wish)
                        <div class="wish-item">
                            <div class="wish-name">{{ $wish->guest_name }} · <span style="font-weight:400;color:rgba(226,232,240,0.3)">{{ $wish->created_at->diffForHumans() }}</span></div>
                            <div class="wish-msg">{{ $wish->message }}</div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-msg">No wishes yet. Guests can leave wishes on the invite page.</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggle(id) {
            const body = document.getElementById('body-' + id);
            body.classList.toggle('open');
        }

        function toggleOptions() {
            const type = document.getElementById('fieldType').value;
            document.getElementById('optionsWrap').style.display = ['select','radio','checkbox'].includes(type) ? 'block' : 'none';
        }

        function toggleMusicInput() {
            const type = document.getElementById('musicType').value;
            document.getElementById('music-url-input').style.display  = type === 'url'  ? 'block' : 'none';
            document.getElementById('music-file-input').style.display = type === 'file' ? 'block' : 'none';
        }

        // Auto-open active features
        @if($card->countdown)  toggle('countdown'); @endif
        @if($card->location)   toggle('location');  @endif
        @if($card->music)      toggle('music'); toggleMusicInput(); @endif
        @if($card->galleries->count()) toggle('gallery'); @endif
        @if($card->rsvps->count())     toggle('rsvp');    @endif
        @if($card->wishes->count())    toggle('wishes');  @endif

        // Auto-dismiss toast
        setTimeout(() => { document.querySelectorAll('.toast-item').forEach(el => el.remove()); }, 3500);
    </script>
</body>
</html>
