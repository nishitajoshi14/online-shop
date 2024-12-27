@extends('layouts.admin')

@section('title', 'Add Coupon')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem; text-align: left;">Coupon Information</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Coupons</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Coupon</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success mt-2">{{ session('status') }}</div>
            @endif

            <div class="card mt-3" style="padding: 20px;">
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf

                    <!-- Coupon Code Field -->
                    <div class="form-group row">
                        <label for="coupon_code" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Coupon Code <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code" required>
                        </div>
                    </div>

                    <!-- Coupon Type Field -->
                    <div class="form-group row">
                        <label for="coupon_type" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Coupon Type <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="coupon_type" name="coupon_type" required>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                        </div>
                    </div>

                    <!-- Value Field -->
                    <div class="form-group row">
                        <label for="value" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Value <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="value" name="value" placeholder="Enter discount value" required>
                        </div>
                    </div>

                    <!-- Cart Value Field -->
                    <div class="form-group row">
                        <label for="cart_value" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Cart Value <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="cart_value" name="cart_value" placeholder="Minimum cart value to apply coupon" required>
                        </div>
                    </div>

                    <!-- Expiry Date Field -->
                    <div class="form-group row">
                        <label for="expiry_date" class="col-sm-3 col-form-label" style="font-weight: bold; color: black;">
                            Expiry Date <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row">
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
@endsection
