@extends('layouts.admin')

@section('title', 'Edit Coupon')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            @include('admin.header')

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h2 style="font-weight: bold; font-size: 1.5rem;">Edit Coupon</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Coupons</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
                    </ol>
                </nav>
            </div>

            @if(session('status'))
                <div class="alert alert-success mt-2">{{ session('status') }}</div>
            @endif

            <div class="card mt-3" style="padding: 20px;">
                <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Coupon Code Field -->
                    <div class="form-group row">
                        <label for="coupon_code" class="col-sm-3 col-form-label font-weight-bold text-black">
                            Coupon Code <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ $coupon->coupon_code }}" required>
                        </div>
                    </div>

                    <!-- Coupon Type Field -->
                    <div class="form-group row">
                        <label for="coupon_type" class="col-sm-3 col-form-label font-weight-bold text-black">
                            Coupon Type <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="coupon_type" name="coupon_type" required>
                                <option value="percentage" {{ $coupon->coupon_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ $coupon->coupon_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                        </div>
                    </div>

                    <!-- Value Field -->
                    <div class="form-group row">
                        <label for="value" class="col-sm-3 col-form-label font-weight-bold text-black">
                            Value <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="value" name="value" value="{{ $coupon->value }}" required>
                        </div>
                    </div>

                    <!-- Cart Value Field -->
                    <div class="form-group row">
                        <label for="cart_value" class="col-sm-3 col-form-label font-weight-bold text-black">
                            Cart Value <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="cart_value" name="cart_value" value="{{ $coupon->cart_value }}" required>
                        </div>
                    </div>

                    <!-- Expiry Date Field -->
                    <div class="form-group row">
                        <label for="expiry_date" class="col-sm-3 col-form-label font-weight-bold text-black">
                            Expiry Date <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $coupon->expiry_date }}" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row">
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
@endsection
