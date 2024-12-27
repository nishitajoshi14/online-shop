@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            <!-- Header -->
            @include('admin.header')

            <!-- Title Section with Breadcrumb -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Orders</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </nav>
            </div>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success mt-2">{{ session('status') }}</div>
            @endif

            <!-- Search Bar and Add New Button -->
            <div class="card mt-3" style="padding: 10px;">
                <div class="row">
                    <!-- Search Bar -->
                    <div class="col-md-8 col-sm-12 mb-2">
                        <form action="{{ route('orders.index') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="input-group" style="width: 100%;">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="submit" style="border: 1px solid black;">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Add New Button -->
                    <div class="col-md-4 col-sm-12 text-md-right text-sm-left">
                        <a href="#" class="btn btn-outline-primary" style="width: 120px;">
                            +Add New
                        </a>
                    </div>
                </div>

                <!-- Orders Table -->
                <table class="table table-bordered mt-3">
                    <thead>
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
                                <td data-label="Order No">{{ $order->id }}</td>
                                <td data-label="Full Name">{{ $order->fullName }}</td>
                                <td data-label="Phone">{{ $order->phoneNumber }}</td>
                                <td data-label="Subtotal">{{ number_format($order->subtotal, 2) }}</td>
                                <td data-label="VAT">{{ number_format($order->vat ?? 0, 2) }}</td>
                                <td data-label="Total">{{ number_format($order->total, 2) }}</td>
                                <td data-label="Status">
                                    @if($order->order_status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($order->order_status == 'delivered')
                                        <span class="badge badge-success">Delivered</span>
                                    @elseif($order->order_status == 'canceled')
                                        <span class="badge badge-danger">Canceled</span>
                                    @endif
                                </td>
                                <td data-label="Order Date">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                <td data-label="Actions">
                                    <!-- View Icon -->
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
