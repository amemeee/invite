<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses — {{ $card->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; min-height: 100vh; }
        .blob { position: fixed; border-radius: 50%; filter: blur(130px); z-index: 0; pointer-events: none; }
        .blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%); top: -200px; left: -150px; }
        .blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(236,72,153,0.1) 0%, transparent 70%); bottom: -150px; right: -100px; }

        header { position: sticky; top: 0; z-index: 100; background: rgba(10,10,15,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.07); }
        .header-inner { max-width: 1200px; margin: 0 auto; padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 9px; text-decoration: none; font-weight: 800; font-size: 1rem; color: #fff; }
        .logo-icon { width: 30px; height: 30px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .back-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 9px; color: rgba(226,232,240,0.65); text-decoration: none; font-size: 0.83rem; transition: all 0.2s; }
        .back-btn:hover { background: rgba(255,255,255,0.09); color: #fff; }

        .page { max-width: 1200px; margin: 0 auto; padding: 2.5rem 2rem 5rem; position: relative; z-index: 1; }
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
        .page-title { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.03em; color: #f1f5f9; }
        .page-sub { font-size: 0.875rem; color: rgba(226,232,240,0.4); margin-top: 0.25rem; }

        .btn-export { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: linear-gradient(135deg, #10b981, #059669); color: #fff; text-decoration: none; border-radius: 10px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; box-shadow: 0 0 16px rgba(16,185,129,0.25); }
        .btn-export:hover { transform: translateY(-1px); box-shadow: 0 4px 20px rgba(16,185,129,0.4); color: #fff; }

        /* Stats */
        .stats-row { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .stat-box { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 1.25rem 1.5rem; min-width: 140px; }
        .stat-num { font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; line-height: 1; }
        .stat-label { font-size: 0.78rem; color: rgba(226,232,240,0.4); margin-top: 4px; font-weight: 500; }
        .stat-purple .stat-num { color: #a5b4fc; }
        .stat-green  .stat-num { color: #34d399; }
        .stat-pink   .stat-num { color: #f9a8d4; }

        /* Table */
        .table-wrap { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 16px; overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        thead tr { background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.08); }
        thead th { padding: 0.875rem 1.25rem; font-size: 0.72rem; font-weight: 700; color: rgba(226,232,240,0.4); text-transform: uppercase; letter-spacing: 0.08em; white-space: nowrap; }
        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.025); }
        tbody td { padding: 0.875rem 1.25rem; font-size: 0.875rem; color: rgba(226,232,240,0.7); vertical-align: top; }
        .td-id { color: rgba(226,232,240,0.3); font-size: 0.78rem; font-weight: 600; }
        .td-date { color: rgba(226,232,240,0.35); font-size: 0.78rem; white-space: nowrap; }
        .td-val { max-width: 220px; word-break: break-word; }

        /* Empty */
        .empty-state { text-align: center; padding: 5rem 1rem; }
        .empty-icon { font-size: 3rem; opacity: 0.25; margin-bottom: 1rem; }
        .empty-state h3 { font-weight: 600; color: rgba(226,232,240,0.45); margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.9rem; color: rgba(226,232,240,0.28); }

        /* No fields notice */
        .notice { background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.2); border-radius: 12px; padding: 1rem 1.5rem; font-size: 0.875rem; color: #fbbf24; display: flex; align-items: center; gap: 10px; margin-bottom: 2rem; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <header>
        <div class="header-inner">
            <a href="{{ route('cards.index') }}" class="logo">
                <div class="logo-icon">✦</div> InviteMe
            </a>
            <a href="{{ route('cards.manage', $card) }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back to Manage
            </a>
        </div>
    </header>

    <div class="page">
        <div class="page-header">
            <div>
                <h1 class="page-title">Responses — {{ $card->title }}</h1>
                <p class="page-sub">All guest submissions for this invitation card.</p>
            </div>
            @if($card->submissions->count())
            <a href="{{ route('cards.responses.export', $card) }}" class="btn-export">
                <i class="bi bi-download"></i> Export CSV
            </a>
            @endif
        </div>

        @if($card->fields->isEmpty())
        <div class="notice">
            <i class="bi bi-exclamation-triangle-fill"></i>
            No form fields defined yet. <a href="{{ route('cards.manage', $card) }}" style="color:#fbbf24;margin-left:4px">Add fields in Manage</a> to start collecting responses.
        </div>
        @endif

        {{-- Stats --}}
        @php $today = $card->submissions->filter(fn($s) => $s->created_at->isToday())->count(); @endphp
        <div class="stats-row">
            <div class="stat-box stat-purple">
                <div class="stat-num">{{ $card->submissions->count() }}</div>
                <div class="stat-label">Total Responses</div>
            </div>
            <div class="stat-box stat-green">
                <div class="stat-num">{{ $today }}</div>
                <div class="stat-label">Today</div>
            </div>
            <div class="stat-box stat-pink">
                <div class="stat-num">{{ $card->fields->count() }}</div>
                <div class="stat-label">Form Fields</div>
            </div>
        </div>

        {{-- Table --}}
        @if($card->submissions->count())
        <div class="table-wrap">
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Submitted</th>
                            @foreach($card->fields as $field)
                            <th>{{ $field->label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($card->submissions as $submission)
                        @php $valueMap = $submission->values->keyBy('field_id'); @endphp
                        <tr>
                            <td class="td-id">#{{ $submission->id }}</td>
                            <td class="td-date">{{ $submission->created_at->format('d M Y') }}<br><span style="color:rgba(226,232,240,0.25)">{{ $submission->created_at->format('H:i') }}</span></td>
                            @foreach($card->fields as $field)
                            <td class="td-val">{{ $valueMap->get($field->id)?->value ?? '—' }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="table-wrap">
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                <h3>No responses yet</h3>
                <p>Share the invite link to start collecting responses.</p>
            </div>
        </div>
        @endif
    </div>
</body>
</html>
