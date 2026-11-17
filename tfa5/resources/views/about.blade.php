@extends('layouts.app')

@section('title', 'About — TFA5')

@section('content')
    <h1>About</h1>
    <p>
        This application is the TFA5 technical formative assessment for
        IT0049 (Web System Technologies): <em>From Zero to Four Pages, Again —
        Your First Laravel Application</em>.
    </p>
    <p>
        It rebuilds the earlier CodeIgniter POS exercise in Laravel to show
        the same MVC responsibilities with different tooling: a route in
        <code>routes/web.php</code> decides which controller method runs, the
        controller prepares the data, and a Blade template renders the
        response. The Customer Accounts and User Accounts pages currently use
        a static PHP array as a temporary data source; a later assessment
        replaces those arrays with a database.
    </p>
    <h2>Pages</h2>
    <ul class="feature-list">
        <li><a href="{{ route('landing') }}">Landing page</a> (<code>/</code>)</li>
        <li><a href="{{ route('about') }}">About page</a> (<code>/about</code>)</li>
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> (<code>/customers</code>)</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> (<code>/users</code>)</li>
    </ul>
@endsection
