<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Account') | Proxiora</title>
    <style>
        :root { color-scheme: light; font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; color: #172033; background: linear-gradient(135deg, #eef4ff, #f8fafc 55%, #e7f8f4); }
        .card { width: min(100%, 430px); padding: 36px; background: #fff; border: 1px solid #e5e7eb; border-radius: 18px; box-shadow: 0 24px 70px rgb(15 23 42 / 12%); }
        .brand { display: block; color: #2563eb; font-weight: 800; font-size: 1.15rem; letter-spacing: .04em; text-decoration: none; margin-bottom: 28px; }
        h1 { margin: 0 0 8px; font-size: 1.7rem; } p { color: #667085; line-height: 1.5; }
        label { display: block; margin: 18px 0 7px; color: #344054; font-weight: 600; font-size: .9rem; }
        input { width: 100%; padding: 12px 13px; border: 1px solid #d0d5dd; border-radius: 9px; font: inherit; }
        input:focus { outline: 3px solid #bfdbfe; border-color: #2563eb; }
        .check { display: flex; gap: 8px; align-items: center; margin-top: 18px; font-size: .9rem; color: #475467; }.check input { width: auto; }
        button { width: 100%; margin-top: 24px; padding: 12px 16px; color: white; border: 0; border-radius: 9px; background: #2563eb; cursor: pointer; font: inherit; font-weight: 700; } button:hover { background: #1d4ed8; }
        .error { margin: 12px 0 0; color: #b42318; font-size: .875rem; }.notice { padding: 10px 12px; color: #067647; background: #ecfdf3; border-radius: 8px; font-size: .9rem; }
        .footer { margin: 24px 0 0; text-align: center; font-size: .9rem; }.footer a { color: #2563eb; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <main class="card">
        <a class="brand" href="{{ route('home') }}">PROXIORA</a>
        @yield('content')
    </main>
</body>
</html>
