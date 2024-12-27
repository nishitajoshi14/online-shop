@extends('layouts.app') <!-- Extending the main layout -->

@section('title', 'Login')

@push('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="login-container">
        <h2>Login</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Login form -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf <!-- Add this for security -->

            <!-- Email input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Password input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <!-- Login button -->
            <button type="submit" class="btn btn-primary login-btn">Login</button>

            <!-- Optional links for registration or password reset -->
            <div class="mt-3 text-center">
                <a href="{{ route('password.forgot') }}">Forgot Password?</a> |
                <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>
@endsection
