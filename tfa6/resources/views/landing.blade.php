@extends('layouts.app')

@section('title', 'Home — TFA6')

@section('content')
    <h1>Welcome to the POS</h1>
    <p class="lead">
        TFA6 — the Laravel POS rebuilt on a real database: migrations define
        the customers and users tables, a seeder populates sample records,
        and Eloquent models feed the same Blade views TFA5 used.
    </p>
    <ul class="feature-list">
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> — records served by the Customer model</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> — records served by the User model</li>
        <li><a href="{{ route('about') }}">About</a> — what changed since TFA5</li>
    </ul>
@endsection
