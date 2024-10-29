@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Categories</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Card with Search Bar, Add New Button, and Categories Table -->
            <div class="card" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Search Bar -->
                    <form action="{{ route('categories.index') }}" method="GET" class="form-inline">
                        <div class="input-group" style="width: 400px;">
                            <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit" style="border: 1px solid black; font-size: 0.8rem; padding: 5px 10px;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Add New Button -->
                    <a href="{{ route('categories.create') }}" class="btn" style="border: 1px solid black; color: blue; width: 120px;">
                        +Add New
                    </a>
                </div>

                <!-- Categories Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Products</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ count($category->products ?? []) }} Products</td>
                            <td>
                                @if($category->category_image)
                                    <img src="{{ asset('storage/' . $category->category_image) }}" alt="{{ $category->name }}" width="50" height="50">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" width="50" height="50">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn" style="color: green;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="color: red; border: none; background: none;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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
