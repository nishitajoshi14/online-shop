@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mt-5">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <!-- Add any additional product details as needed -->
</div>
@endsection
