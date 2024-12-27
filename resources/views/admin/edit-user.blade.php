@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            <!-- Header -->
            @include('admin.header')

            <!-- Title Section -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Edit User</h2>
            </div>

            <!-- Edit User Form -->
            <div class="card mt-3 p-4">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
