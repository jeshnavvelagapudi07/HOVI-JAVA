<?php
// golden.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Triangle Tour - Discover India</title>
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
            background: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
            padding: 40px 0;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .package-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .package-title {
            font-size: 2.5em;
            color: #2c1810;
            margin-bottom: 15px;
        }

        .package-price {
            font-size: 1.8em;
            color: #d35400;
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
        }

        .features-list {
            list-style: none;
            padding: 20px;
        }

        .features-list li {
            margin-bottom: 15px;
            padding-left: 30px;
            position: relative;
        }

        .features-list li:before {
            content: "✔";
            color: #27ae60;
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
            border-left: 4px solid #e67e22;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff9f5;
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

        .btn {
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: bold;
        }

        .btn-outline {
            color: #2c1810;
            border: 2px solid #2c1810;
            background: transparent;
        }

        .btn-outline:hover {
            background: #2c1810;
            color: white;
        }

        .btn-primary {
            background: #e67e22;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #d35400;
            transform: translateY(-2px);
        }

        .booking-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Package Header -->
        <div class="package-header">
            <div class="package-icon">🏯</div>
            <h1 class="package-title">Golden Triangle Tour</h1>
            <p class="package-price">From ₹25,000 per person</p>
        </div>

        <!-- Main Description -->
        <div class="package-description">
            <p>Explore Delhi, Agra, and Jaipur on this classic 6-day cultural tour through India's most iconic cities. Witness the majestic Taj Mahal, marvel at the pink hues of Jaipur, and soak in the rich heritage of Delhi.</p>
            <ul class="features-list">
                <li>6 Days, 5 Nights</li>
                <li>Includes transportation and 3-star accommodation</li>
                <li>Visit Qutub Minar, Taj Mahal, Amber Fort, Hawa Mahal, and more</li>
                <li>Daily breakfast and guided city tours</li>
            </ul>
        </div>

        <!-- Itinerary Section -->
        <div class="itinerary-section">
            <h2>Tour Itinerary</h2>
            <div class="day-card">
                <h3>Day 1-2: Delhi</h3>
                <p>Explore Old Delhi, visit Jama Masjid, Red Fort, and enjoy a rickshaw ride through Chandni Chowk.</p>
            </div>
            <div class="day-card">
                <h3>Day 3-4: Agra</h3>
                <p>Visit the iconic Taj Mahal at sunrise, explore Agra Fort, and the local markets.</p>
            </div>
            <div class="day-card">
                <h3>Day 5-6: Jaipur</h3>
                <p>Experience the Pink City, visit Amber Fort, City Palace, and the colorful bazaars.</p>
            </div>
        </div>


        <!-- Booking Section -->
        <div class="booking-section">
            <h2>Ready to Experience the Golden Triangle?</h2>
            <p>Book now to secure your spot on this amazing journey through India's most iconic destinations.</p>
            <div style="margin-top: 20px;">
                
                <a href="index.php#packages" class="btn btn-outline">← Back to Packages</a>
            </div>
        </div>
    </div>
    
</body>
</html>
