@extends('layouts.app')

@section('title', 'CART')

@section('content')
<div class="container">
    <h1 style="font-size: 2rem; font-weight: bold;">CART</h1>
    <h2 style="font-size: 1.5rem; font-weight: normal; margin-top: 50px; color: black;">SHOPPING BAG</h2>

    @if(session()->has('cart') && count(session()->get('cart')) > 0)
        <div class="row">
            <!-- Cart Items Table -->
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session()->get('cart') as $index => $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>₹{{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $index) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px; text-align: center;" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $index) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: red; font-weight: bold; cursor: pointer;">X</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cart Totals Summary Box -->
            <div class="col-md-4 d-flex flex-column align-items-center">
                <div class="card" style="width: 100%; height: 500px; padding: 20px; border: 1px solid black; background-color: white; border-radius: 2px;">
                    <h3 style="font-weight: bold; font-size: 1rem; text-align: left;">CART TOTALS</h3>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span style="font-weight: bold;">SUBTOTAL</span>
                        <span style="font-weight: bold;" id="subtotal">₹{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session()->get('cart'))), 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span style="font-weight: bold;">SHIPPING</span>
                        <span style="font-weight: bold;">Free</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-2">
                        <span style="font-weight: bold;">VAT</span>
                        <span style="font-weight: bold;" id="vat">₹{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session()->get('cart'))) * 0.1, 2) }}</span>
                    </div>
                    <hr>
                    
                    <!-- Discount Column (above the total) -->
                    <div id="discountInfo" style="display:none;">
                        <div class="d-flex justify-content-between">
                            <span style="font-weight: bold; color: green;">DISCOUNT</span>
                            <span style="font-weight: bold; color: green;" id="discountAmount">₹0.00</span>
                        </div>
                        <hr>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <span style="font-weight: bold;">TOTAL</span>
                        <span style="font-weight: bold;" id="total">
                            ₹{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session()->get('cart'))) * 1.1, 2) }}
                        </span>
                    </div>
                    <hr>
                    
                    <!-- Coupon Code Section (Below Total, Same Row) -->
                    <div class="d-flex justify-content-between align-items-center mt-3" style="width: 100%;">
                        <input type="text" id="couponCode" placeholder="Enter Coupon Code" style="width: 57%; padding: 6px; border: 1px solid black; border-radius: 2px;">
                        <button id="couponButton" class="btn btn-dark ml-2" style="padding: 4px 8px; font-size: 0.875rem; border-radius: 2px;" onclick="applyCoupon()">APPLY COUPON</button>
                    </div>

                    <!-- Error and Success Messages -->
                    <p id="couponError" style="color: red; font-weight: bold; display: none; margin-top: 10px;">Invalid Coupon Code</p>
                    <p id="couponMessage" style="color: green; font-weight: bold; display: none; margin-top: 10px;">Coupon has been Applied!</p>

                </div>
                <a href="{{ route('checkout.process') }}" 
           class="btn btn-primary mt-4" 
           style="width: 100%; padding: 10px; background-color: black; color: white; border-radius: 4px; text-align: center; font-weight: bold;">
           Proceed to Checkout
        </a>
            </div>
        </div>

    @else
        <p>Your cart is empty.</p>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Continue Shopping Button (Left-Aligned) -->
        <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
    
        <!-- Save Cart to Order History Button (Right-Aligned) -->
        <form action="{{ route('add.to.previous.products') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="btn btn-success">Save Cart to Order History</button>
        </form>
    </div>
        
</div>

<script>

function submitCheckoutForm() {
        // Getting the cart data from the session and assigning it to hidden fields
        const cart = @json(session()->get('cart', []));
        const subtotal = document.getElementById('subtotal').innerText.replace('₹', '').replace(',', '');
        const vat = document.getElementById('vat').innerText.replace('₹', '').replace(',', '');
        const discount = document.getElementById('discountAmount') ? document.getElementById('discountAmount').innerText.replace('₹', '').replace(',', '') : '0';
        const total = document.getElementById('total').innerText.replace('₹', '').replace(',', '');

        document.getElementById('cartData').value = JSON.stringify(cart);
        document.getElementById('subtotalData').value = subtotal;
        document.getElementById('vatData').value = vat;
        document.getElementById('discountData').value = discount;
        document.getElementById('totalData').value = total;

        document.getElementById('checkoutForm').submit();  // Submit the form
    }

    function applyCoupon() {
        const couponCode = document.getElementById('couponCode').value.trim();
        const couponError = document.getElementById('couponError');
        const couponMessage = document.getElementById('couponMessage');
        const couponButton = document.getElementById('couponButton');
        const discountInfo = document.getElementById('discountInfo');
        const subtotal = document.getElementById('subtotal');
        const total = document.getElementById('total');
        const discountAmount = document.getElementById('discountAmount');
        const vat = document.getElementById('vat');

        if (couponCode === "") {
            couponError.style.display = 'none';
            couponMessage.style.display = 'none';
            return;
        }

        // Sending AJAX request to verify coupon code
        fetch("{{ route('coupon.verify') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ coupon_code: couponCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                couponError.style.display = 'none';
                couponMessage.style.display = 'block';
                couponMessage.innerText = 'Coupon has been Applied!';
                
                // Display the discount info
                discountInfo.style.display = 'block';
                
                // Calculate discount
                let discount = data.discount_value;
                let subtotalAmount = parseFloat(subtotal.innerText.replace('₹', '').replace(',', ''));
                let discountValue = subtotalAmount * discount / 100;

                // Update the total
                discountAmount.innerText = `₹${discountValue.toFixed(2)}`;

                // Update the VAT and total
                let vatValue = parseFloat(vat.innerText.replace('₹', '').replace(',', ''));
                let totalValue = subtotalAmount + vatValue - discountValue;

                total.innerText = `₹${totalValue.toFixed(2)}`;

            } else {
                couponMessage.style.display = 'none';
                couponError.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            couponMessage.style.display = 'none';
            couponError.style.display = 'block';
        });
    }
</script>
@endsection
