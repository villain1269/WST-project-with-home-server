@extends('layouts.app')

@section('title', 'Home — TFA5')

@section('content')
    <h1>Welcome to the POS</h1>
    <p class="lead">
        TFA5 — a first Laravel application: four pages wired through routes,
        controllers, and Blade views, with static PHP arrays serving as a
        temporary data source for the account listings.
    </p>
    <ul class="feature-list">
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> — sample customers from a static array</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> — sample users from a static array</li>
        <li><a href="{{ route('about') }}">About</a> — what this assessment covers</li>
    </ul>
@endsection
