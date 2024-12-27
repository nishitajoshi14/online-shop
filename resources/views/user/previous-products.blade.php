@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Your Previous Products</h1>

    @if($previousProducts->isEmpty())
        <p>No previous products found in your order history.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($previousProducts as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" style="width: 100px; height: auto;">
                        </td>
                        <td>₹{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>₹{{ $product->price * $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</div>
@endsection
