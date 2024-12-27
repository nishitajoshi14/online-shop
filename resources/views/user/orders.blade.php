@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2">
            @include('user.sidebar')
        </div>

        <!-- Orders Table -->
        <div class="col-md-9 col-lg-10">
            <h2 class="mb-4">My Orders</h2>
            
            @if($orders->isEmpty())
                <p>No orders found for this account.</p>
            @else
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order No</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Subtotal</th>
                                        <th>VAT</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->fullName }}</td>
                                            <td>{{ $order->phoneNumber }}</td>
                                            <td>₹{{ number_format($order->subtotal, 2) }}</td>
                                            <td>₹{{ number_format($order->vat, 2) }}</td>
                                            <td>₹{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                @if($order->order_status === 'pending')
                                                    <span class="btn btn-info btn-sm">Pending</span>
                                                @elseif($order->order_status === 'canceled')
                                                    <span class="btn btn-danger btn-sm">Canceled</span>
                                                @else
                                                    {{ ucfirst($order->order_status) }}
                                                @endif
                                            </td>
                                                                                        
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('user.viewOrder', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
