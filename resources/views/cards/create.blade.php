<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Card — InviteMe</title>
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
        .back-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 9px; color: rgba(226,232,240,0.65); text-decoration: none; font-size: 0.83rem; transition: all 0.2s; }
        .back-btn:hover { background: rgba(255,255,255,0.09); color: #fff; }

        .page { max-width: 760px; margin: 0 auto; padding: 3rem 2rem 5rem; position: relative; z-index: 1; }
        .page-title { font-size: 1.6rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; margin-bottom: 0.3rem; }
        .page-sub { font-size: 0.875rem; color: rgba(226,232,240,0.35); margin-bottom: 2.5rem; }

        .glass-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 18px; padding: 2rem; }

        .form-label { font-size: 0.8rem; font-weight: 600; color: rgba(226,232,240,0.55); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 0.5rem; display: block; }
        .form-control { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #f1f5f9; font-size: 0.9rem; padding: 10px 14px; width: 100%; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { outline: none; border-color: rgba(99,102,241,0.5); box-shadow: 0 0 0 3px rgba(99,102,241,0.12); background: rgba(255,255,255,0.06); color: #f1f5f9; }
        .form-control::placeholder { color: rgba(226,232,240,0.2); }
        textarea.form-control { resize: vertical; min-height: 150px; }

        .field-group { margin-bottom: 1.5rem; }
        .field-hint { font-size: 0.78rem; color: rgba(226,232,240,0.3); margin-top: 0.4rem; }

        .error-msg { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); border-radius: 8px; padding: 8px 12px; font-size: 0.8rem; color: #fca5a5; margin-top: 0.5rem; }

        .form-actions { display: flex; gap: 0.75rem; margin-top: 2rem; flex-wrap: wrap; }
        .btn-save { display: inline-flex; align-items: center; gap: 7px; padding: 10px 24px; background: linear-gradient(135deg, var(--purple), var(--violet)); color: #fff; border: none; border-radius: 10px; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 0 18px rgba(99,102,241,0.3); }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 24px rgba(99,102,241,0.5); }
        .btn-reset { display: inline-flex; align-items: center; gap: 7px; padding: 10px 20px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; font-size: 0.9rem; font-weight: 500; color: rgba(226,232,240,0.55); cursor: pointer; transition: all 0.2s; }
        .btn-reset:hover { background: rgba(255,255,255,0.09); color: #fff; }

        /* CKEditor override */
        .cke { border-radius: 10px !important; border-color: rgba(255,255,255,0.1) !important; overflow: hidden; }
        .cke_top { background: rgba(255,255,255,0.06) !important; border-color: rgba(255,255,255,0.08) !important; }
        .cke_bottom { background: rgba(255,255,255,0.04) !important; border-color: rgba(255,255,255,0.06) !important; }
        .cke_editable { background: rgba(255,255,255,0.03) !important; color: #e2e8f0 !important; }
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
            <a href="{{ route('cards.index') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Cards</a>
        </div>
    </header>

    <div class="page">
        <div class="page-title">Create New Card</div>
        <p class="page-sub">Fill in the details for your invitation card.</p>

        <div class="glass-card">
            <form action="{{ route('cards.store') }}" method="POST">
                @csrf

                <div class="field-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="e.g. Sarah & John Wedding">
                    @error('title')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="6" placeholder="Write your invitation message...">{{ old('message') }}</textarea>
                    @error('message')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="form-label">Event Date &amp; Time</label>
                    <input type="datetime-local" class="form-control" name="event_date" value="{{ old('event_date') }}">
                    <p class="field-hint">Optional — used for the countdown timer on your invite page.</p>
                    @error('event_date')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Create Card</button>
                    <button type="reset" class="btn-reset"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('message', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','-','RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList','BulletedList','-','Blockquote'] },
                { name: 'links', items: ['Link','Unlink'] },
                { name: 'styles', items: ['Format'] },
            ],
            height: 200,
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
        @if(session('success'))
            Toast.fire({ icon: 'success', title: '{{ session("success") }}' });
        @elseif(session('error'))
            Toast.fire({ icon: 'error', title: '{{ session("error") }}' });
        @endif
    </script>
</body>
</html>
