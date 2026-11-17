@extends('layouts.app')

@section('title', 'User Accounts — TFA6')

@section('content')
    <h1>User Accounts</h1>
    <p class="lead">Users retrieved through the User Eloquent model.</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
