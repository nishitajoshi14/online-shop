@extends('layouts.admin')

@section('title', 'Brands')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Brands</h2>
                <nav aria-label="breadcrumb" class="mt-2 mt-md-0">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brands</li>
                    </ol>
                </nav>
            </div>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success mt-3">{{ session('status') }}</div>
            @endif

            <!-- Card Section -->
            <div class="card mt-3" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <!-- Search Bar -->
                    <form action="{{ route('brands.index') }}" method="GET" class="form-inline w-100 w-md-auto mb-2 mb-md-0">
                        <div class="input-group" style="width: 100%; max-width: 300px;">
                            <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search brands..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit" style="border: 1px solid black; font-size: 0.8rem; padding: 5px 10px;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Add New Button -->
                    <a href="{{ route('brands.create') }}" class="btn btn-outline-primary ml-auto mt-2 mt-md-0" style="width: 120px;">
                        +Add New
                    </a>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand Name</th>
                                <th>Slug</th>
                                <th>Brand Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    @if ($brand->brand_image)
                                        <img src="{{ asset('storage/' . $brand->brand_image) }}" alt="{{ $brand->name }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="text-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" title="Delete" style="color: red;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
</div>
@endsection
