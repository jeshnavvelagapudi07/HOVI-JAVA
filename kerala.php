
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerala Experience - God's Own Country</title>
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
            background: linear-gradient(109.6deg, rgba(223,234,247,1) 11.2%, rgba(244,248,252,1) 91.1%);
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
            color: #0EA5E9;
            margin-bottom: 15px;
        }

        .package-price {
            font-size: 1.8em;
            color: #2E8B57;
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
            background: #F2FCE2;
            border-radius: 8px;
        }

        .features-list li {
            margin-bottom: 15px;
            padding-left: 30px;
            position: relative;
        }

        .features-list li:before {
            content: "✔";
            color: #2E8B57;
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
            border-left: 4px solid #0EA5E9;
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
            background: linear-gradient(90deg, #D3E4FD 0%, #F2FCE2 100%);
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
            color: #0EA5E9;
            border: 2px solid #0EA5E9;
            background: transparent;
        }

        .btn-outline:hover {
            background: #0EA5E9;
            color: white;
        }

        .btn-primary {
            background: #2E8B57;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #226741;
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
            <div class="package-icon">🏝️</div>
            <h1 class="package-title">Kerala Experience</h1>
            <p class="package-price">From ₹35,000 per person</p>
        </div>

        <!-- Main Description -->
        <div class="package-description">
            <p>Immerse yourself in the serene beauty of Kerala, also known as God's Own Country. This 7-day experience offers a blend of lush greenery, backwater cruises, and rejuvenating Ayurveda.</p>
            <ul class="features-list">
                <li>7 Days, 6 Nights</li>
                <li>Houseboat stay in Alleppey</li>
                <li>Munnar tea garden tour and wildlife experience in Thekkady</li>
                <li>Beach relaxation at Kovalam and Ayurvedic massage</li>
                <li>All transfers in air-conditioned vehicles</li>
                <li>Professional English-speaking guide</li>
            </ul>
        </div>

        <!-- Highlights Section -->
        <div class="highlights-section">
            <div class="highlight-card">
                <div class="highlight-icon">🛥️</div>
                <h3>Backwater Cruise</h3>
                <p>Traditional houseboat experience through Kerala's famous backwaters</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">🌿</div>
                <h3>Tea Gardens</h3>
                <p>Visit the lush tea plantations of Munnar</p>
            </div>
            <div class="highlight-card">
                <div class="highlight-icon">🧘‍♀️</div>
                <h3>Ayurveda</h3>
                <p>Traditional wellness treatments and massages</p>
            </div>
        </div>

        <!-- Itinerary Section -->
        <div class="itinerary-section">
            <h2>Tour Itinerary</h2>
            <div class="day-card">
                <h3>Day 1-2: Cochin & Munnar</h3>
                <p>Arrive in Cochin, transfer to Munnar. Explore tea gardens and spice plantations.</p>
            </div>
            <div class="day-card">
                <h3>Day 3: Thekkady</h3>
                <p>Wildlife sanctuary visit, spice plantation tour, and cultural shows.</p>
            </div>
            <div class="day-card">
                <h3>Day 4-5: Alleppey</h3>
                <p>Houseboat cruise through backwaters, village experiences, and local cuisine.</p>
            </div>
            <div class="day-card">
                <h3>Day 6-7: Kovalam</h3>
                <p>Beach relaxation, Ayurvedic treatments, and departure from Trivandrum.</p>
            </div>
        </div>


        <!-- Booking Section -->
        <div class="booking-section">
            <h2>Ready to Experience God's Own Country?</h2>
            <p>Book now to secure your spot on this serene journey through Kerala's most beautiful destinations.</p>
            <div style="margin-top: 20px;">
              
                <a href="index.php#packages" class="btn btn-outline">← Back to Packages</a>
            </div>
        </div>
    </div>
</body>
</html>