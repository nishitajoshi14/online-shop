@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header') <!-- Include the header file -->

            <h2 style="font-weight: bold; font-size: 1.5rem; text-align: left;">All Products</h2>


            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Card wrapper for the table without a header -->
            <div class="card mt-4">
                <div class="card-body">
                    <!-- Search Form with Add New Button -->
                    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3 d-flex align-items-center" style="justify-content: space-between;">
                        <div class="d-flex align-items-center" style="flex-grow: 1;">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" style="margin-right: 10px; max-width: 250px;">
                            <button type="submit" class="btn btn-secondary" style="width: 100px;">Search</button>
                        </div>
                        <a href="{{ route('admin.products.create') }}" class="btn" style="border: 1px solid black; color: blue; margin-left: 10px;">+ Add New</a>
                    </form>

                    <!-- Table -->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th> 
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Stock</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100" height="100">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" width="100" height="100">
                                        @endif
                                        {{ $product->name }}
                                    </td>
                                    
                                    
                                    <td>{{ $product->slug }}</td> <!-- Display the slug -->
                                    <td>${{ number_format($product->regular_price, 2) }}</td>
                                    <td>${{ number_format($product->sale_price, 2) }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                    <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                                    <td>{{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-warning mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger" style="border: none; background: none; padding: 0;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
