@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Edit Product</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background: transparent; padding: 0; margin: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
            
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Unified Form Spanning Two Cards -->
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" style="margin-top: 20px;">
                    
                    <!-- Left Card -->
                    <div class="col-md-6">
                        <div class="card" style="padding: 20px; border-radius: 8px; height: 100%;">
                            <!-- Product Name -->
                            <div class="form-group">
                                <label for="name" style="font-weight: bold; color: black;">Product Name <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                <small class="form-text text-muted">Do not exceed 100 characters.</small>
                            </div>

                            <!-- Slug -->
                            <div class="form-group">
                                <label for="slug" style="font-weight: bold; color: black;">Product Slug <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required readonly>
                            </div>

                            <!-- Category and Brand Dropdowns -->
                            <div class="form-group row">
                                <!-- Category Dropdown -->
                                <div class="col-md-6">
                                    <label style="font-weight: bold; color: black;">Category <span style="color: red;">*</span></label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="" disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Brand Dropdown -->
                                <div class="col-md-6">
                                    <label style="font-weight: bold; color: black;">Brand <span style="color: red;">*</span></label>
                                    <select class="form-control" name="brand_id" required>
                                        <option value="" disabled>Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div class="form-group">
                                <label for="short_description" style="font-weight: bold; color: black;">Short Description</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="4" placeholder="Enter short description">{{ old('short_description', $product->short_description) }}</textarea>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description" style="font-weight: bold; color: black;">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right Card -->
                    <div class="col-md-6">
                        <div class="card" style="padding: 20px; border-radius: 8px; height: 100%;">
                            <!-- Upload Images Section -->
                            <h5 class="card-title" style="font-weight: bold; color: black;">Upload Images</h5>
                            <div class="form-group">
                                <div class="upload-area" style="border: 2px dashed lightblue; padding: 40px; text-align: center; height: 200px; border-radius: 8px;">
                                    <p style="color: black;">Drop your images here or select</p>
                                    <p><a href="#" style="color: blue;" onclick="document.getElementById('upload').click(); return false;">click to browse</a></p>
                                    <input type="file" id="upload" name="product_image" style="display: none;" onchange="previewImages(this, 'image-preview')">
                                </div>
                                <div id="image-preview" style="margin-top: 10px; display: flex; justify-content: center;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100" height="100" class="mt-2">
                                    @endif
                                </div>
                            </div>

                            <!-- Regular Price, Sale Price, SKU, and Quantity -->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="regular_price" style="font-weight: bold; color: black;">Regular Price <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sale_price" style="font-weight: bold; color: black;">Sale Price</label>
                                    <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="sku" style="font-weight: bold; color: black;">SKU <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" style="font-weight: bold; color: black;">Quantity <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                                </div>
                            </div>

                            <!-- In Stock and Featured -->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label style="font-weight: bold; color: black;">In Stock?</label>
                                    <select class="form-control" name="in_stock">
                                        <option value="1" {{ $product->in_stock ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$product->in_stock ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label style="font-weight: bold; color: black;">Featured?</label>
                                    <select class="form-control" name="featured">
                                        <option value="1" {{ $product->featured ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$product->featured ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Update Product</button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="margin-top: 20px;">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    function previewImages(input, previewContainerId) {
        const previewContainer = document.getElementById(previewContainerId);
        previewContainer.innerHTML = ''; // Clear previous images
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.width = 100;
                img.height = 100;
                img.classList.add('mt-2');
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
