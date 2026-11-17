@extends('layouts.app')

@section('title', 'About — TFA6')

@section('content')
    <h1>About</h1>
    <p>
        This application is the TFA6 technical formative assessment for
        IT0049 (Web System Technologies): <em>From Arrays to Eloquent</em>.
    </p>
    <p>
        It keeps TFA5's pages and structure, but replaces the static PHP
        arrays with a real MySQL database: migrations in
        <code>database/migrations</code> describe the customers (full_name,
        email, phone) and users (username, full_name) schema, seeders fill
        each table with five realistic records, and the controllers now
        retrieve records through Eloquent models instead of arrays.
    </p>
    <h2>Pages</h2>
    <ul class="feature-list">
        <li><a href="{{ route('landing') }}">Landing page</a> (<code>/</code>)</li>
        <li><a href="{{ route('about') }}">About page</a> (<code>/about</code>)</li>
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> (<code>/customers</code>)</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> (<code>/users</code>)</li>
    </ul>
@endsection
