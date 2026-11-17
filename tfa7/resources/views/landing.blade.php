@extends('layouts.app')

@section('title', 'Home — TFA7')

@section('content')
    <h1>Welcome to the POS</h1>
    <p class="lead">
        TFA7 — the Laravel POS made editable: create and edit forms for
        customer and user accounts, server-side validation with old-input
        redisplay, and avatar upload with display-ready image preparation.
    </p>
    <ul class="feature-list">
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> — list, create, and edit customers</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> — list, create, and edit users, with avatars</li>
        <li><a href="{{ route('customers.create') }}">Create a customer</a> · <a href="{{ route('users.create') }}">Create a user</a></li>
        <li><a href="{{ route('about') }}">About</a> — what changed since TFA6</li>
    </ul>
@endsection
