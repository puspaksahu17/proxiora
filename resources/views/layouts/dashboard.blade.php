<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Proxiora</title>
    <style>
        * { box-sizing: border-box; } body { margin: 0; font-family: Inter, ui-sans-serif, system-ui, sans-serif; color: #172033; background: #f6f8fc; }
        header { display:flex; justify-content:space-between; align-items:center; padding:18px max(24px, calc((100vw - 1180px)/2)); background:#fff; border-bottom:1px solid #e8ecf3; }.brand { color:#2563eb; font-weight:800; letter-spacing:.07em; text-decoration:none; } .user { color:#667085; font-size:.9rem; }
        main { max-width:1180px; margin:40px auto; padding:0 24px; } h1 { margin:0 0 8px; } .lead { margin:0 0 28px; color:#667085; }.grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:18px; }.card { padding:22px; border:1px solid #e8ecf3; border-radius:14px; background:#fff; box-shadow:0 5px 20px rgb(15 23 42 / 4%); } .stat { font-size:2rem; color:#2563eb; font-weight:800; }
        table { width:100%; border-collapse:collapse; background:white; border:1px solid #e8ecf3; border-radius:14px; overflow:hidden; } th,td { padding:14px; text-align:left; border-bottom:1px solid #edf0f5; } th { background:#f8fafc; color:#475467; font-size:.8rem; text-transform:uppercase; letter-spacing:.04em; } tr:last-child td { border-bottom:0; }.button { display:inline-block; padding:10px 14px; color:#fff; background:#2563eb; border:0; border-radius:8px; text-decoration:none; font:inherit; cursor:pointer; }.button.secondary { color:#2563eb; background:#eff6ff; }.notice { padding:12px 14px; margin:0 0 22px; color:#067647; background:#ecfdf3; border-radius:8px; }.error { color:#b42318; font-size:.875rem; }.logout { color:#475467; border:0; background:none; cursor:pointer; font:inherit; }.form-control { width:100%; padding:11px; border:1px solid #d0d5dd; border-radius:8px; font:inherit; } label { display:block; margin:17px 0 7px; font-weight:600; }
        @media (max-width:680px) { header { align-items:flex-start; gap:14px; flex-direction:column; } table { display:block; overflow-x:auto; } }
    </style>
</head>
<body>
    <header><a class="brand" href="{{ route('dashboard') }}">PROXIORA</a><div class="user">{{ auth()->user()->name }} · {{ ucfirst(auth()->user()->role) }} <form style="display:inline" method="POST" action="{{ route('logout') }}">@csrf <button class="logout">Sign out</button></form></div></header>
    <main>
        @if (auth()->user()->role !== 'admin')
            <p style="text-align:right;margin-top:0"><a class="button secondary" href="{{ route('profile.edit') }}">My profile</a></p>
        @endif
        @if (session('status')) <div class="notice">{{ session('status') }}</div> @endif
        @yield('content')
    </main>
</body>
</html>
