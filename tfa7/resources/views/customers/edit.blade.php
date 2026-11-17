@extends('layouts.app')

@section('title', 'Edit Customer — TFA7')

@section('content')
    <h1>Edit Customer</h1>

    <form class="form" method="POST" action="{{ route('customers.update', $customer) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}">
            @error('full_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
            @error('phone')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Update Customer</button>
            <a class="btn btn-secondary" href="{{ route('customers.index') }}">Cancel</a>
        </div>
    </form>
@endsection
