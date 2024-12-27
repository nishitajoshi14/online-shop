@extends('layouts.app')

@section('title', 'CHECKOUT')

@section('content')
<div class="container">
    <h1 style="font-size: 2rem; font-weight: bold;">SHIPPING DETAILS</h1>

    <div class="row mt-5">
        <!-- Left Side: Shipping Details -->
        <div class="col-md-6">
            <div class="card" style="padding: 20px; border: 1px solid black; background-color: white; border-radius: 2px;">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <!-- Full Name and Phone Number -->
                    <div class="form-row d-flex justify-content-between">
                        <div class="form-group col-md-6">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        </div>
                    </div>

                    <!-- Pincode, State, and City -->
                    <div class="form-row d-flex justify-content-between">
                        <div class="form-group col-md-4">
                            <label for="pincode">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>

                    <!-- House Number/Building Name and Road Name -->
                    <div class="form-group">
                        <label for="address1">House No./Building Name</label>
                        <input type="text" class="form-control" id="address1" name="address1" required>
                    </div>
                    <div class="form-group">
                        <label for="address2">Road Name/Area</label>
                        <input type="text" class="form-control" id="address2" name="address2" required>
                    </div>

                    <!-- Landmark -->
                    <div class="form-group">
                        <label for="landmark">Landmark</label>
                        <input type="text" class="form-control" id="landmark" name="landmark">
                    </div>
            </div>
        </div>

        <!-- Right Side: Order Summary -->
        <div class="col-md-6">
            <div class="card" style="width: 80%; padding: 20px; border: 1px solid black; background-color: white; border-radius: 2px;">
                <h3 style="font-weight: bold; font-size: 1rem; text-align: left;">CART TOTALS</h3>
                <hr>
                <div class="checkout-summary">
                    <!-- Subtotal -->
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <hr>
                    <!-- Discount -->
                    @if($discount > 0)
                        <div class="d-flex justify-content-between">
                            <span style="font-weight: bold; color: green;">Discount</span>
                            <span style="font-weight: bold; color: green;">₹{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif
                    <hr>
                    
                    <!-- Shipping -->
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <hr>
                    
                    <!-- VAT -->
                    <div class="d-flex justify-content-between">
                        <span>VAT</span>
                        <span>₹{{ number_format($vat, 2) }}</span>
                    </div>
                    <hr>

                    <!-- Total -->
                    <div class="d-flex justify-content-between">
                        <span style="font-weight: bold;">Total</span>
                        <span style="font-weight: bold;">₹{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Options Box -->
            <div class="card mt-4" style="padding: 20px; border:0.5px solid rgb(107, 106, 106); background-color: white; border-radius: 2px; width:80%;">
                <h3 style="font-weight: bold; font-size: 1rem; text-align: left;">PAYMENT OPTIONS</h3>
                <hr>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1" value="bank_transfer" required>
                        <label class="form-check-label" for="paymentMethod1">
                            Direct Bank Transfer
                        </label>
                        <div id="bank_transfer_info" class="payment-info" style="display: none;">
                            <p>Please transfer the total amount to the following bank account.</p>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" value="check_payment" required>
                        <label class="form-check-label" for="paymentMethod2">
                            Check Payments
                        </label>
                        <div id="check_payment_info" class="payment-info" style="display: none;">
                            <p>Please send a check to our office address.</p>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod3" value="cash_on_delivery" required>
                        <label class="form-check-label" for="paymentMethod3">
                            Cash on Delivery
                        </label>
                        <div id="cash_on_delivery_info" class="payment-info" style="display: none;">
                            <p>You can pay cash when the product is delivered to your address.</p>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod4" value="paypal" required>
                        <label class="form-check-label" for="paymentMethod4">
                            PayPal
                        </label>
                        <div id="paypal_info" class="payment-info" style="display: none;">
                            <p>Use your PayPal account to complete the payment.</p>
                        </div>
                    </div>
                </div>

                <!-- Proceed to Payment Button -->
                <button type="submit" class="btn btn-primary mt-3" style="width: 100%; border-radius: 1px; height:50px; background-color:black; border:none;">
                    PLACE ORDER
                </button>
            </div>
        </div>
    </div>
</form>
</div>

<script>
    document.querySelectorAll('input[name="paymentMethod"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            // Hide all payment info sections
            document.querySelectorAll('.payment-info').forEach((info) => {
                info.style.display = 'none';
            });

            // Show the selected payment info section
            const selectedPaymentInfo = document.getElementById(this.value + '_info');
            if (selectedPaymentInfo) {
                selectedPaymentInfo.style.display = 'block';
            }
        });
    });
</script>

@endsection


        