<!-- resources/views/emails/orderConfirmation.blade.php -->
<html>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for your order. Your total amount is: ${{ $amount }}.</p>
    <p>We will process your order and notify you once it's on its way.</p>
    <p>Best regards,<br>Your Company Name</p>
</body>
</html>
