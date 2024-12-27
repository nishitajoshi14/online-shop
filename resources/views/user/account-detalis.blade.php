<!-- resources/views/user/account-details.blade.php -->

@extends('layouts.app')

@section('title', 'Account Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <div class="col-md-3">
                @include('user.sidebar')  <!-- This will include the sidebar.blade.php file -->
            </div>

            <div class="col-md-9">
                <div class="account-details-container">
                    <h2>Account Details</h2>

                    @if($orders->isEmpty())
                        <p>No orders found for this account.</p>
                    @else
                        @foreach($orders as $order)
                            <form action="{{ route('user.updateAccount', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="order-details row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fullName" class="form-label"><strong>Full Name:</strong></label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" value="{{ $order->fullName }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phoneNumber" class="form-label"><strong>Phone Number:</strong></label>
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $order->phoneNumber }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pincode" class="form-label"><strong>Pincode:</strong></label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" value="{{ $order->pincode }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label"><strong>State:</strong></label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ $order->state }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label"><strong>City:</strong></label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ $order->city }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="address1" class="form-label"><strong>Address 1:</strong></label>
                                        <input type="text" class="form-control" id="address1" name="address1" value="{{ $order->address1 }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="address2" class="form-label"><strong>Address 2:</strong></label>
                                        <input type="text" class="form-control" id="address2" name="address2" value="{{ $order->address2 }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="landmark" class="form-label"><strong>Landmark:</strong></label>
                                        <input type="text" class="form-control" id="landmark" name="landmark" value="{{ $order->landmark }}" required>
                                    </div>
                                </div>

                                <!-- Update Button -->
                                <div class="d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
