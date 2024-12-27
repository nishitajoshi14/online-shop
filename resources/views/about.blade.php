<!-- resources/views/about.blade.php -->
@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container">

    <!-- Inline CSS for styling the page -->
    <style>
        /* Importing a custom font from Google Fonts for an attractive style */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* About Us Section with Background Image, Centered Text, and 70% Height */
        .about-us-section {
            background-image: url('{{ asset('assets/images/about.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 70vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .about-us-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin: 0;
        }

        .about-us-section p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        /* General Styling for Other Sections */
        section {
            margin-top: 40px;
            padding: 20px 0;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        p, ul {
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        /* Our Story Section with Background Color and Custom Font */
        .our-story-section {
            background-color: #e3ecf5; /* Light grey background color */
            padding: 40px 20px;
            text-align: center;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif; /* Custom font for attractive text */
            color: #333;
        }

        .our-story-section .image-content {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .our-story-section img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .our-story-section .text-content {
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.6;
            font-weight: 300; /* Light font weight for elegance */
        }

        /* Styling for Values Card Section */
        .values-section {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            text-align: center;
            justify-content: center;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
            color: #333;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card p {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Hover effect on cards */
        .card:hover {
            transform: translateY(-10px); /* Raises the card slightly */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
        }
    </style>

    <!-- About Us Section with Background Image -->
    <section class="about-us-section">
        <div class="section-content">
            <h1>About Us</h1>
            <p>We are a team of passionate individuals dedicated to bringing the best products to you.</p>
            <p>Our mission is to deliver quality and satisfaction with every purchase.</p>
            <p>Join us on our journey to make shopping easier, enjoyable, and accessible for everyone.</p>
        </div>
    </section>

    <!-- Our Story Section with Background Color and Custom Font -->
    <section class="our-story-section">
        <div class="image-content">
            <img src="{{ asset('assets/images/ourstory.webp') }}" alt="Our Story Image">
        </div>
        <div class="text-content">
            <p>Our journey began with a simple idea to provide high-quality products at affordable prices.</p>
            <p>Over the years, we have grown into a brand that you can trust for all your shopping needs.</p>
            <p>We believe in building lasting relationships with our customers.</p>
            <p>Through our products, we aim to bring comfort, style, and joy into your life.</p>
        </div>
    </section>

    <!-- Values Section with Cards for Quality, Customer Satisfaction, and Integrity -->
    <section class="values-section">
        <div class="card">
            <h3>Quality</h3>
            <p>We believe in providing top-notch products to our customers, ensuring excellence with every item.</p>
            <p>Our team constantly monitors and improves our products to maintain the highest standards.</p>
        </div>
        <div class="card">
            <h3>Customer Satisfaction</h3>
            <p>Your satisfaction is our priority, and we strive to meet your expectations with our exceptional service.</p>
            <p>We are always here to listen and improve based on your valuable feedback.</p>
        </div>
        <div class="card">
            <h3>Integrity</h3>
            <p>Transparency and honesty guide everything we do, building trust with every interaction.</p>
            <p>We believe in open and respectful communication with our customers and partners.</p>
        </div>
    </section>

    <!-- Additional sections (like Contact Us, Follow Us, etc.) remain unchanged -->
    <section class="contact-us-section">
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to reach out to us at <a href="mailto:support@ourstore.com">support@ourstore.com</a>.</p>
    </section>

    
    <section class="store-in-pictures-section">
        <h2>Our Store in Pictures</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('assets/images/store1.avif') }}" class="img-fluid" alt="Store Image 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('assets/images/store2.jpg') }}" class="img-fluid" alt="Store Image 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('assets/images/store3.png') }}" class="img-fluid" alt="Store Image 3">
            </div>
        </div>
    </section>


    <section class="follow-us-section">
        <h2>Follow Us</h2>
        <p>Stay connected with us on social media:</p>
        <ul>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Twitter</a></li>
        </ul>
    </section>

</div>
@endsection
