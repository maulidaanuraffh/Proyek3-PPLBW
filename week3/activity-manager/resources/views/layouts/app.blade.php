<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Manager – @yield('title', 'Daftar Kegiatan')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: #1f2937;
            background: #f3f4f6;
        }

        /* ── Nav ── */
        .site-nav {
            background: #1e3a5f;
            padding: .75rem 1.5rem;
        }
        .site-nav a {
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .site-nav a:hover { color: #fff; }

        /* ── Wrapper ── */
        .container {
            width: min(100% - 2rem, 900px);
            margin-inline: auto;
            padding-block: 2rem;
        }

        /* ── Flash message ── */
        .flash {
            padding: .75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .flash-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .flash-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ── Card ── */
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1rem;
        }
        .card h2 { margin: 0 0 .4rem; font-size: 1.1rem; }
        .card h2 a { color: #1e3a5f; text-decoration: none; }
        .card h2 a:hover { text-decoration: underline; }
        .card p  { margin: .25rem 0; color: #6b7280; font-size: .95rem; }

        /* ── Badge status ── */
        .badge {
            display: inline-block;
            padding: .2rem .6rem;
            border-radius: 4px;
            font-size: .8rem;
            font-weight: 600;
        }
        .badge-planned  { background: #dbeafe; color: #1d4ed8; }
        .badge-ongoing  { background: #fef9c3; color: #854d0e; }
        .badge-done     { background: #dcfce7; color: #166534; }

        /* ── Detail section ── */
        .detail-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 2rem;
        }
        .detail-card h1 { margin: 0 0 1rem; font-size: 1.5rem; }
        .detail-label {
            font-size: .85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #9ca3af;
        }
        .detail-value { margin: .25rem 0 1.25rem; color: #374151; }

        /* ── Back link ── */
        .back-link {
            display: inline-block;
            margin-bottom: 1rem;
            color: #1e3a5f;
            font-size: .95rem;
        }

        /* ── Empty state ── */
        .empty { 
            color: #6b7280; 
            font-style: italic; 
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: .35rem;
            font-size: .95rem;
            color: #374151;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            display: block;
            width: 100%;
            padding: .6rem .8rem;
            font-family: inherit;
            font-size: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: #fff;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #1e3a5f;
        }
        .error {
            margin: .3rem 0 0;
            font-size: .875rem;
            color: #b91c1c;
        }

        /* ── Buttons ── */
        .btn-submit {
            display: inline-block;
            padding: .6rem 1.2rem;
            background: #1e3a5f;
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: .5rem;
        }
        .btn-submit:hover { background: #162d4a; }
        .btn-danger {
            padding: .6rem 1.2rem;
            background: #b91c1c;
            color: #fff;
            font-weight: 600;
            font-size: .95rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-danger:hover { background: #991b1b; }
    </style>
</head>
<body>

    <nav class="site-nav">
        <a href="{{ route('activities.index') }}">Activity Manager</a>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

</body>
</html>