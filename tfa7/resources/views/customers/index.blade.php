@extends('layouts.app')

@section('title', 'Customer Accounts — TFA7')

@section('content')
    <h1>Customer Accounts</h1>
    <p class="lead">
        <a class="btn" href="{{ route('customers.create') }}">+ Create Customer</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td><a href="{{ route('customers.edit', $customer) }}">Edit</a></td>
                </tr>
            @empty
                <tr><td colspan="5">No customers yet — create the first one.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
