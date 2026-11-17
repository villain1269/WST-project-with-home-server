@extends('layouts.app')

@section('title', 'Profile — TSA3')

@section('content')
    <h1>Profile</h1>

    @if ($user === null)
        <p>No user record found — run the seeder: <code>php artisan db:seed</code></p>
    @else
        <table>
            <tbody>
                <tr><th>Username</th><td>{{ $user->username }}</td></tr>
                <tr><th>Full Name</th><td>{{ $user->full_name }}</td></tr>
                <tr><th>Email</th><td>{{ $user->email }}</td></tr>
            </tbody>
        </table>
    @endif
@endsection
