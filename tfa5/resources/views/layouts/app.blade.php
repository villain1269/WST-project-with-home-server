<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'TFA5'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a class="nav-brand" href="{{ route('landing') }}">TFA5 POS</a>
            <div class="nav-links">
                <a href="{{ route('landing') }}">Home</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('customers.index') }}">Customers</a>
                <a href="{{ route('users.index') }}">Users</a>
            </div>
            {{-- Back to the Caddy landing page. A plain root-relative href="/"
                 resolves to the origin root (the landing page), NOT the app
                 root, which is exactly what the multi-project setup needs. --}}
            <a class="back-main" href="/">&larr; Back to Main</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>TFA5 — IT0049 Web System Technologies · Laravel POS Foundations</p>
    </footer>
</body>
</html>
