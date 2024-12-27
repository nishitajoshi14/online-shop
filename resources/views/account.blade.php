<!-- resources/views/account.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Account</h1>
        <p>Welcome, {{ Session::get('user') }}!</p>
        <!-- Add more account details here -->
    </div>
@endsection
