<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"], #card-element {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .payment-result {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Stripe Payment</h1>
        <form id="payment-form">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="{{ session('order_id') ? \App\Models\Order::find(session('order_id'))->total : 0 }}" readonly>

            <label for="card-element">Card Details:</label>
            <div id="card-element"></div>

            <button type="submit">Pay Now</button>
        </form>
        <div id="payment-result" class="payment-result"></div>
    </div>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');
    
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
    
            const amount = document.getElementById('amount').value;
    
            try {
                const response = await fetch('{{ route('payment.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ amount })
                });
    
                const { clientSecret, error } = await response.json();
                if (error) throw new Error(error);
    
                const { paymentIntent, error: stripeError } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: { card: card }
                });
    
                if (stripeError) {
                    document.getElementById('payment-result').innerText = `Error: ${stripeError.message}`;
                } else {
                    document.getElementById('payment-result').innerText = `Payment succeeded! Payment ID: ${paymentIntent.id}`;
    
                    await fetch('{{ route('payment.payNow') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            payment_id: paymentIntent.id
                        })
                    });
                }
            } catch (err) {
                document.getElementById('payment-result').innerText = `Error: ${err.message}`;
            }
        });
    </script>
    
    </script>
</body>
</html>
