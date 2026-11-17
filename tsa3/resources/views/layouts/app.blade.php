<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'TSA3'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a class="nav-brand" href="{{ route('landing') }}">TSA3</a>
            <div class="nav-links">
                <a href="{{ route('landing') }}">Welcome</a>
                <a href="{{ route('tasks.index') }}">Task List</a>
                <a href="{{ route('profile') }}">Profile</a>
                <a href="{{ route('about') }}">About</a>
            </div>
            {{-- Back to the Caddy landing page (origin root), not the app root. --}}
            <a class="back-main" href="/">&larr; Back to Main</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>TSA3 — IT0049 Web System Technologies · Tasks for Today Management System (Laravel)</p>
    </footer>
</body>
</html>
