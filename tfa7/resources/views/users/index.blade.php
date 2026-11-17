@extends('layouts.app')

@section('title', 'User Accounts — TFA7')

@section('content')
    <h1>User Accounts</h1>
    <p class="lead">
        <a class="btn" href="{{ route('users.create') }}">+ Create User</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img
                            class="avatar"
                            src="{{ $user->avatar
                                ? asset('storage/' . $user->avatar)
                                : asset('images/placeholder-avatar.png') }}"
                            alt="Avatar of {{ $user->full_name }}"
                            width="48"
                            height="48"
                        >
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td><a href="{{ route('users.edit', $user) }}">Edit</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No users yet — create the first one.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
