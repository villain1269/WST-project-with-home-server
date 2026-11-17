@extends('layouts.app')

@section('title', 'About — TFA7')

@section('content')
    <h1>About</h1>
    <p>
        This application is the TFA7 technical formative assessment for
        IT0049 (Web System Technologies): <em>Making It Editable in
        Laravel</em>.
    </p>
    <p>
        It extends the TFA6 POS with full create and edit workflows:
        validated forms that redisplay with errors and old input, edit
        pages pre-filled from the database, and an avatar upload on the
        user edit form. Uploaded avatars are validated by type and size,
        prepared as display-ready 256×256 thumbnails with Intervention
        Image, stored via the Storage facade on the public disk, and only
        the resulting path is saved in the users table.
    </p>
    <h2>Pages</h2>
    <ul class="feature-list">
        <li><a href="{{ route('customers.index') }}">Customer Accounts</a> — list + create/edit links</li>
        <li><a href="{{ route('users.index') }}">User Accounts</a> — list with avatars + create/edit links</li>
        <li><a href="{{ route('about') }}">About</a></li>
    </ul>
@endsection
