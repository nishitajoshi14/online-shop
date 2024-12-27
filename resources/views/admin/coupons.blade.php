@extends('layouts.admin')

@section('title', 'Coupons')

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
                <h2 style="font-weight: bold; font-size: 1.5rem;">Coupons</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                    </ol>
                </nav>
            </div>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success mt-2">{{ session('status') }}</div>
            @endif

            <div class="card mt-3" style="padding: 20px;">
                <!-- Search Bar and Add New Button -->
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <!-- Search Bar -->
                    <form action="{{ route('coupons.index') }}" method="POST" class="form-inline w-100 w-md-auto">
                        @csrf
                        <div class="input-group" style="width: 100%; max-width: 300px;">
                            <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Search coupons..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit" style="border: 1px solid black;">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Add New Button -->
                    <a href="{{ route('coupons.create') }}" class="btn btn-outline-primary ml-auto mt-3 mt-md-0" style="width: 120px;">
                        +Add New
                    </a>
                </div>

                <!-- Coupon Table -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Coupon Code</th>
                            <th>Coupon Type</th>
                            <th>Value</th>
                            <th>Cart Value</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>{{ ucfirst($coupon->coupon_type) }}</td>
                                <td>{{ $coupon->value }}</td>
                                <td>{{ $coupon->cart_value }}</td>
                                <td>{{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('coupons.edit', $coupon->id) }}" class="text-primary mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 text-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $coupons->links() }}
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
