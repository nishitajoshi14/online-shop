<!-- resources/views/user/settings.blade.php -->

@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        
        <div class="col-md-3 col-lg-2">
            @include('user.sidebar') <!-- Include sidebar here -->
        </div>

        <!-- Settings Content (Main Area) -->
        <div class="col-md-9 col-lg-10">
            <h2 class="mb-4">Settings</h2>
            
            <!-- Settings Form or Details -->
            <div class="card">
                <div class="card-body">
                    <h4>User Settings</h4>
                    <p>Here you can change your account settings, like email, password, etc.</p>
                    <!-- Example form or display settings here -->
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ session('user')->email }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
