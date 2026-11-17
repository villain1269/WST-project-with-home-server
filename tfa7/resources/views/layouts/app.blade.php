<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'TFA7'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a class="nav-brand" href="{{ route('landing') }}">TFA7 POS</a>
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
        @if (session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <p>TFA7 — IT0049 Web System Technologies · Making It Editable</p>
    </footer>
</body>
</html>
