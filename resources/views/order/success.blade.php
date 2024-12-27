<!-- resources/views/order/success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin-top: 50px;
        }

        .logo {
            width: 100px; /* Adjust size as needed */
            height: auto;
            margin-bottom: 20px;
        }

        .title {
            font-size: 2.5em;
            font-weight: bold;
        }

        .subtitle {
            font-size: 1.5em;
            font-weight: normal;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Success Logo -->
        <img src="{{ asset('assets/images/success_logo.png') }}" alt="Success Logo" class="logo">

        <!-- Title -->
        <div class="title">Your order is completed!</div>

        <!-- Subtitle -->
        <div class="subtitle">Thank you, Your order has been received!</div>
    </div>
</body>
</html>
