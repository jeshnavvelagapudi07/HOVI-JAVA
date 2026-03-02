
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himalayan Adventure - Mountain Explorer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .package-header {
            background: linear-gradient(to right, #243949 0%, #517fa4 100%);
            padding: 40px 0;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .package-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .package-title {
            font-size: 2.5em;
            margin-bottom: 15px;
        }

        .package-price {
            font-size: 1.8em;
            color: #accbee;
            margin-bottom: 20px;
        }

        .package-description {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .package-description p {
            font-size: 1.1em;
            margin-bottom: 20px;
            color: #444;
        }

        .features-list {
            list-style: none;
            padding: 20px;
            background: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);
            border-radius: 8px;
        }

        .features-list li {
            margin-bottom: 15px;
            padding-left: 30px;
            position: relative;
        }

        .features-list li:before {
            content: "✔";
            color: #517fa4;
            position: absolute;
            left: 0;
        }

        .itinerary-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .day-card {
            border-left: 4px solid #517fa4;
            padding: 20px;
            margin-bottom: 20px;
            background: #f8f9fa;
            transition: transform 0.3s ease;
        }

        .day-card:hover {
            transform: translateX(10px);
        }

        .highlights-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .highlight-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .highlight-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .gallery-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        .booking-section {
            background: linear-gradient(to top, #accbee 0%, #e7f0fd 100%);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: bold;
            margin: 10px;
        }

        .btn-outline {
            color: #243949;
            border: 2px solid #243949;
            background: transparent;
        }

        .btn-outline:hover {
            background: #243949;
            color: white;
        }

        .btn-primary {
            background: #517fa4;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #243949;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .package-header {
                padding: 20px;
            }

            .gallery-section {
                grid-template-columns: 1fr;
            }

            .highlights-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Package Header -->
        <div class="package-header">
            <div class="package-icon">🏔️</div>
            <h1 class="package-title">Himalayan Adventure</h1>
            <p class="package-price">From ₹45,000 per person</p>
        </div>

        <!-- Main Description -->
        <div class="package-description">
            <p>Take on the ultimate adventure in the Himalayas. This 8-day journey is perfect for thrill-seekers who want to trek breathtaking trails and experience local mountain cultures.</p>
            <ul class="features-list">
                <li>8 Days, 7 Nights</li>
                <li>Guided treks and camping under the stars</li>
                <li>Explore Manali, Kasol, and surrounding villages</li>
                <li>Meals, gear, and expert guides included</li>
                <li>Professional photography services</li>
                <li>Emergency medical support and insurance</li>
            </ul>
        </div>

        <!-- Highlights Section -->
        <div class="highlights-section">
            <div class="highlight-card">
                <div class="highlight-icon">⛺</div>
                <h3>Camping Experience</h3>
                <p>Camp under the stars with full camping gear provided</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">🏃</div>
                <h3>Guided Treks</h3>
                <p>Professional guides lead you through scenic trails</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">🍲</div>
                <h3>Local Cuisine</h3>
                <p>Authentic mountain dishes and camping meals</p>
            </div>
        </div>

        <!-- Itinerary Section -->
        <div class="itinerary-section">
            <h2>Trek Itinerary</h2>
            <div class="day-card">
                <h3>Day 1-2: Manali Acclimatization</h3>
                <p>Arrive in Manali, acclimatize to the altitude, and prepare for the trek.</p>
            </div>
            <div class="day-card">
                <h3>Day 3-4: Base Camp Trek</h3>
                <p>Trek to the base camp, experiencing stunning mountain views and local villages.</p>
            </div>
            <div class="day-card">
                <h3>Day 5-6: Highland Adventure</h3>
                <p>Explore high-altitude trails and camp in scenic locations.</p>
            </div>
            <div class="day-card">
                <h3>Day 7-8: Descent & Departure</h3>
                <p>Return trek to Manali and departure with lifetime memories.</p>
            </div>
        </div>

      

        <!-- Booking Section -->
        <div class="booking-section">
            <h2>Ready for Your Mountain Adventure?</h2>
            <p>Book now to secure your spot on this unforgettable Himalayan journey.</p>
            <div style="margin-top: 20px;">
                
                <a href="index.php#packages" class="btn btn-outline">← Back to Packages</a>
            </div>
        </div>
    </div>
</body>
</html>