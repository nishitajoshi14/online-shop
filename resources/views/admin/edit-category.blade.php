@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center">
                <h2 style="font-weight: bold; font-size: 1.5rem; text-align: left;">Edit Category</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card" style="border: 1px solid #ddd; padding: 20px;">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Category Name
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="slug" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Category Slug
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}" required>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <label for="images" class="col-sm-3 col-form-label" style="font-weight: bold; color: black; margin-top: 35px;">
                            Upload Images
                        </label>
                        <div class="col-sm-9">
                            <div id="upload-area">
                                <label for="images" id="upload-label" style="color: black; cursor: pointer; display: flex; justify-content: center; align-items: center; text-align: center; padding: 30px; border: 1px dashed #ccc; border-radius: 5px; height: 250px;">
                                    @if($category->category_image)
                                        <img src="{{ asset('storage/' . $category->category_image) }}" alt="{{ $category->name }}" style="max-width: 100%; max-height: 100%;"/>
                                    @else
                                        <div>
                                            Drop your images here or select
                                            <span style="color: blue;">(click to browse)</span>
                                        </div>
                                    @endif
                                </label>
                            </div>
                            <input type="file" class="form-control-file" id="images" name="category_image" style="display: none;" onchange="displayImage(this)">
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 15px;">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary" style="width: 200px;">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<script>
function displayImage(input) {
    const uploadArea = document.getElementById('upload-area');
    uploadArea.innerHTML = ''; // Clear previous content

    if (input.files && input.files[0]) {
        // Create the image preview and the instruction square
        const preview = document.createElement('div');
        preview.style.width = '250px';
        preview.style.height = '250px';
        preview.style.overflow = 'hidden';
        preview.style.position = 'relative';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(input.files[0]);
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
        img.style.position = 'absolute';
        img.style.top = '50%';
        img.style.left = '50%';
        img.style.transform = 'translate(-50%, -50%)';

        preview.appendChild(img);
        uploadArea.appendChild(preview);
    } else {
        uploadArea.innerHTML = 'Drop your images here or select <span style="color: blue;">(click to browse)</span>';
    }
}
</script>
@endsection
