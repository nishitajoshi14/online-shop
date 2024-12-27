<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }

        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #7c3aed;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5b21b6;
        }

        .message {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Verification</h1>
        @if (session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p class="message error">{{ session('error') }}</p>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            @error('otp')
                <p class="message error">{{ $message }}</p>
            @enderror

            <button type="submit">Verify Account</button>
        </form>
        <br>
        <a href="{{route('register')}}" class="resend-link">Didn't receive code? Resend</a>

    </div>
</body>
</html>
