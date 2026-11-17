@extends('layouts.app')

@section('title', 'Edit User — TFA7')

@section('content')
    <h1>Edit User</h1>

    <form class="form" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
            @error('username')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}">
            @error('full_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="avatar">Avatar (image, max 2MB)</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
            @error('avatar')
                <p class="error">{{ $message }}</p>
            @enderror
            @if ($user->avatar)
                <p class="hint">Current: <img class="avatar avatar-small" src="{{ asset('storage/' . $user->avatar) }}" alt="Current avatar" width="32" height="32"> — uploading a new one replaces it.</p>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Update User</button>
            <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancel</a>
        </div>
    </form>
@endsection
