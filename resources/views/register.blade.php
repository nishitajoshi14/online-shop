@extends('layouts.app') <!-- Extending the main layout -->

@section('title', 'Register')

@push('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="register-container">
        <h2>Register</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration form -->
        <form action="{{ route('register.post') }}" method="POST">
            @csrf <!-- Add this for security -->

            <!-- Name input -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
            </div>

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

            <!-- Confirm Password input -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
            </div>

            <!-- Register button -->
            <button type="submit" class="btn btn-primary register-btn">Register</button>

            <!-- Optional links for login -->
            <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </form>
    </div>
@endsection
