@extends('layouts.app')

@section('title', 'Create User — TFA7')

@section('content')
    <h1>Create User</h1>

    <form class="form" method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @error('username')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}">
            @error('full_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Save User</button>
            <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancel</a>
        </div>
    </form>
@endsection
