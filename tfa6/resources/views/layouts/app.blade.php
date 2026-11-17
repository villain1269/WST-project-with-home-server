<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'TFA6'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a class="nav-brand" href="{{ route('landing') }}">TFA6 POS</a>
            <div class="nav-links">
                <a href="{{ route('landing') }}">Home</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('customers.index') }}">Customers</a>
                <a href="{{ route('users.index') }}">Users</a>
            </div>
            {{-- Back to the Caddy landing page (origin root), not the app root. --}}
            <a class="back-main" href="/">&larr; Back to Main</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>TFA6 — IT0049 Web System Technologies · From Arrays to Eloquent</p>
    </footer>
</body>
</html>
