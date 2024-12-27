<!-- resources/views/profile.blade.php -->

@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <div class="col-md-3">
                @include('user.sidebar')  <!-- This will include the sidebar.blade.php file -->
            </div>

            <div class="col-md-9">
                <div class="profile-container">
                    <h2>My Account</h2>

                    <!-- Check if the user is logged in -->
                    @if (session('user'))
                        <div class="user-info">
                             <!-- Display user's full name -->
                            <p><strong>Email:</strong> {{ session('user')->email }}</p> <!-- Display user's email -->
                            <p><strong>Username:</strong> {{ session('username') }}</p> <!-- Display username (part before @) -->
                            <p><strong>Account Created:</strong> {{ session('user')->created_at->format('d M Y') }}</p> <!-- Display account creation date -->
                            
                            <!-- Add other user-related information -->
                        </div>
                    @else
                        <p>You are not logged in.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
