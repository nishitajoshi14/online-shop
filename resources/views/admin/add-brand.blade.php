@extends('layouts.admin')

@section('title', 'Add Brand')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold; font-size: 1.5rem; text-align: left;">Brand Information</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/brands') }}">Brands</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Brand</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Brand Name
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter brand name" required oninput="generateSlug()">
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="slug" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Brand Slug
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug will be generated" readonly>
                        </div>
                    </div>

                    <!-- Upload Area -->
                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="brand_image" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Upload Brand Image
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="upload-area" id="upload-area" style="border: 2px dashed #ccc; padding: 40px; text-align: center; border-radius: 10px; width: 100%; height: 250px; position: relative;">
                                <p id="upload-text" style="font-weight: bold; color: black;">Drop your images here or <span style="color: blue; cursor: pointer;">click to browse</span></p>
                                <img id="preview-image" src="#" alt="Image Preview" style="display: none; width: 200px; height: 200px; object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" />
                                <input type="file" class="form-control-file" id="brand_image" name="brand_image" style="display: none;" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
function generateSlug() {
    const nameInput = document.getElementById('name').value;
    const slugInput = document.getElementById('slug');

    const slug = nameInput.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');
    slugInput.value = slug;
}

// Script to trigger file input when clicking on the upload area
document.querySelector('.upload-area').addEventListener('click', function() {
    document.getElementById('brand_image').click();
});

// Display preview of the selected image
document.getElementById('brand_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    if (file) {
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            document.getElementById('preview-image').style.display = 'block';
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('upload-text').style.display = 'none'; // Hide the text once the image is uploaded
        };
    } else {
        document.getElementById('preview-image').style.display = 'none';
        document.getElementById('upload-text').style.display = 'block'; // Show the text if no image is selected
    }
});
</script>
@endsection
