@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <!-- Flex Container for Title and Breadcrumb -->
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold; font-size: 1.5rem; text-align: left;">Category Information</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Category</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Cart-like box structure -->
            <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Category Name
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required oninput="generateSlug()">
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="slug" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Category Slug
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug will be generated" readonly>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="images" class="col-sm-3 col-form-label" style="font-weight: bold; color: black; margin-top: 35px;">
                            Upload Images
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <!-- Container for Image Preview and Upload Area -->
                            <div id="upload-area">
                                <!-- Initial Upload Area -->
                                <label for="images" id="upload-label" style="color: black; cursor: pointer; display: flex; justify-content: center; align-items: center; text-align: center; padding: 30px; border: 1px dashed #ccc; border-radius: 5px; height: 250px;">
                                    <div>
                                        Drop your images here or select
                                        <span style="color: blue;">(click to browse)</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Hidden file input -->
                            <input type="file" class="form-control-file" id="images" name="category_image" required style="display: none;" onchange="displayImage(this)">
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <div class="col-sm-3"></div> <!-- Empty div for alignment -->
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

    // Convert to lowercase and replace spaces with hyphens
    const slug = nameInput.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');

    slugInput.value = slug; // Set the slug input value
}

function displayImage(input) {
    const uploadArea = document.getElementById('upload-area');
    uploadArea.innerHTML = ''; // Clear previous content

    if (input.files && input.files[0]) {
        // Create the image preview and the instruction square
        const preview = document.createElement('div');
        preview.style.width = '250px';
        preview.style.height = '250px';
        preview.style.border = '1px solid #ccc';
        preview.style.borderRadius = '5px';
        preview.style.display = 'flex';
        preview.style.justifyContent = 'center';
        preview.style.alignItems = 'center';
        preview.style.backgroundColor = '#f7f7f7';

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%'; // Make image fit the container
            img.style.maxHeight = '100%'; // Maintain the aspect ratio
            preview.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);

        uploadArea.appendChild(preview);
    }
}
</script>
@endsection
