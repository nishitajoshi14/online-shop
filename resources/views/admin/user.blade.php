@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Users</h2>
            </div>

            <div class="card mt-3" style="padding: 10px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm" style="color:blue;">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="color:red;" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm" style="color:{{ $user->status ? 'red' : 'green' }};">
                                                {{ $user->status ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
