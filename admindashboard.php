<?php
session_start();
require_once 'db_connect.php';

// Load guide list (static or from DB)
$guides = ['Arjun', 'Sneha', 'Mohan', 'Anita'];
// Message and error handling
$message = "";
$error = "";

// ===============================
// HANDLE PLACES MANAGEMENT FORMS
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle: Add Place
    if (isset($_POST['add_place'])) {
        // Get all fields from POST and trim
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $maplink = trim($_POST['maplink'] ?? '');

        // Validate: All fields required
        if ($name === '' || $description === '' || $image === '' || $category === '' || $maplink === '') {
            $error = "All fields are required to add a place.";
        } else {
            // Insert into DB
            $sql = "INSERT INTO places (name, description, image, category, maplink) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                $error = "DB Error: Could not prepare place insert.";
            } else {
                $stmt->bind_param("sssss", $name, $description, $image, $category, $maplink);
                if ($stmt->execute()) {
                    $message = "Place '$name' added successfully.";
                } else {
                    $error = "Failed to add place: " . htmlspecialchars($stmt->error);
                }
                $stmt->close();
            }
        }
    }

    // Handle: Delete Place
    if (isset($_POST['delete_place'])) {
        $place_id = intval($_POST['place_id']);
        if ($place_id > 0) {
            $stmt = $conn->prepare("DELETE FROM places WHERE id = ?");
            if ($stmt === false) {
                $error = "DB Error: Could not prepare place delete.";
            } else {
                $stmt->bind_param("i", $place_id);
                if ($stmt->execute()) {
                    $message = "Place deleted successfully.";
                } else {
                    $error = "Failed to delete place.";
                }
                $stmt->close();
            }
        } else {
            $error = "Invalid place selected for deletion.";
        }
    }

    // Handle assigning travel guide (existing functionality)
    if (isset($_POST['assign_guide'])) {
        $trip_id = intval($_POST['trip_id']);
        $guide = $_POST['guide'];

        $stmt = $conn->prepare("UPDATE trips SET assigned_guide = ? WHERE id = ?");
        if ($stmt === false) {
            $error = "DB Error: Could not prepare guide assign update.";
        } else {
            $stmt->bind_param("si", $guide, $trip_id);
            if ($stmt->execute()) {
                $message = "Guide '$guide' assigned successfully.";
            } else {
                $error = "Failed to assign guide.";
            }
            $stmt->close();
        }
    }
}

// Fetch places for display
$places = [];
$placesResult = $conn->query("SELECT * FROM places ORDER BY id DESC");
if ($placesResult) {
    while ($row = $placesResult->fetch_assoc()) {
        $places[] = $row;
    }
}

// Fetch trips with guide assignment info
$result = $conn->query("SELECT * FROM trips");
$trips = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $trips[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Trip Applications & Place Management</title>
    <style>
        :root {
            --primary: #8B5CF6;
            --primary-hover: #7C3AED;
            --secondary: #0EA5E9;
            --bg-gradient-start: #F1F0FB;
            --bg-gradient-end: #D6BCFA;
            --success: #22c55e;
            --error: #e11d48;
            --text-primary: #2D2248;
            --text-secondary: #564587;
            --border-color: #ede9fe;
            --card-shadow: 0 8px 32px rgba(100, 70, 180, 0.09);
            --transition-speed: 0.2s;
        }

        /* Base Styles */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(130deg, var(--bg-gradient-start) 60%, var(--bg-gradient-end) 100%);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            border-radius: 16px;
            border: 2px solid var(--border-color);
            animation: fadeIn 0.3s ease-out;
        }

        /* Typography */
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 800;
            font-size: 2.5rem;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        h2 {
            color: var(--text-secondary);
            font-size: 1.5rem;
            margin: 1.5rem 0;
            letter-spacing: -0.3px;
        }

        /* Forms */
        .place-form {
            background: #f8fafc;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform var(--transition-speed);
        }

        .place-form:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .place-form label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
        }

        .place-form input,
        .place-form textarea,
        .place-form select {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            border: 2px solid var(--border-color);
            font-size: 0.95rem;
            background: white;
            color: var(--text-primary);
            transition: all var(--transition-speed);
        }

        .place-form input:focus,
        .place-form textarea:focus,
        .place-form select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        /* Tables */
        .places-list-table,
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        th {
            background: linear-gradient(90deg, #f5f3ff 0%, #ede9fe 100%);
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            text-align: left;
        }

        td {
            padding: 1rem;
            background: white;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: background-color var(--transition-speed);
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Buttons */
        .nav-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .nav-button {
            padding: 1rem 2rem;
            font-size: 1rem;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }

        .nav-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
        }

        .nav-button:hover::after {
            transform: translateX(100%);
            transition: transform 0.5s;
        }

        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.3);
        }

        .nav-button.active {
            background: var(--primary);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            transform: translateY(1px);
        }

        /* Status Indicators */
        .status {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status.assigned {
            background: #dcfce7;
            color: #166534;
        }

        .status.processing {
            background: #fef9c3;
            color: #854d0e;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section {
            display: none;
            animation: fadeIn 0.3s ease-out;
        }

        .section.active {
            display: block;
        }

        /* Messages */
        .message, .error {
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            border-radius: 8px;
            padding: 1rem;
            animation: slideIn 0.3s ease-out;
        }

        .message {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 1100px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            h1 { font-size: 2rem; }

            .nav-button {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 768px) {
            .nav-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }

            .places-list-table, table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            th, td {
                white-space: nowrap;
                font-size: 0.85rem;
                padding: 0.75rem;
            }

            .place-form {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Admin Dashboard</h1>

<?php if (!empty($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
   <!-- Main Navigation Buttons -->
   <div class="nav-buttons">
            <button class="nav-button" onclick="showSection('manage-destinations')">Manage Destinations</button>
            <button class="nav-button" onclick="showSection('assign-guides')">Assign Guides</button>
        </div>

        <!-- Manage Destinations Section -->
        <div id="manage-destinations" class="section">
            <h2>Manage Destinations</h2>
            
            <!-- Add Place Form -->
            <form class="place-form" method="POST" autocomplete="off">
                <label for="place-name">Place Name<span style="color:#e11d48;">*</span></label>
                <input type="text" id="place-name" name="name" required maxlength="100" placeholder="e.g., Red Fort, Delhi">

                <label for="place-desc">Description<span style="color:#e11d48;">*</span></label>
                <textarea id="place-desc" name="description" required rows="2" maxlength="1000" placeholder="Brief description"></textarea>

                <label for="place-image">Image URL<span style="color:#e11d48;">*</span></label>
                <input type="url" id="place-image" name="image" required placeholder="https://">

                <label for="place-category">Category<span style="color:#e11d48;">*</span></label>
                <select id="place-category" name="category" required>
                    <option value="">Select category</option>
                    <option>Heritage</option>
                    <option>Nature</option>
                    <option>Spiritual</option>
                    <option>Adventure</option>
                    <option>Beach</option>
                </select>

                <label for="place-maplink">Map Link<span style="color:#e11d48;">*</span></label>
                <input type="url" id="place-maplink" name="maplink" required placeholder="https://www.google.com/maps/...">

                <button type="submit" name="add_place" style="margin-left:0">Add Place</button>
            </form>

            <!-- Places List Table -->
            <table class="places-list-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Map Link</th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($places)): ?>
                    <tr><td colspan="6" style="color:#a1a1aa;"><em>No places found.</em></td></tr>
                    <?php else: ?>
                    <?php foreach($places as $place): ?>
                        <tr>
                            <td><?= htmlspecialchars($place['name']) ?></td>
                            <td><?= htmlspecialchars($place['description']) ?></td>
                            <td><?= htmlspecialchars($place['category']) ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($place['maplink']) ?>" target="_blank" style="color:#0EA5E9;">Open Map</a>
                            </td>
                            <td>
                                <img src="<?= htmlspecialchars($place['image']) ?>" alt="" style="max-width: 46px;border-radius:6px;box-shadow:0 1px 6px #ccc2;border:1px solid #bda6eb;">
                            </td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Delete this place?');">
                                    <input type="hidden" name="place_id" value="<?= intval($place['id']) ?>">
                                    <button type="submit" name="delete_place">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Assign Guides Section -->
        <div id="assign-guides" class="section">
            <h2>Assign Guides to Trips</h2>
            <!-- Trip Applications Table -->
            <?php if (count($trips) === 0): ?>
                <p>No trip applications found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Destination</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Travelers</th>
                            <th>Accommodation</th>
                            <th>Transportation</th>
                            <th>Activities</th>
                            <th>Special Requirements</th>
                            <th>Budget Range</th>
                            <th>Guide Assigned</th>
                            <th>Status</th>
                            <th>Assign Guide</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trips as $trip): ?>
                            <?php
                            // Get guide assigned (or empty string if none)
                            $assigned_guide = isset($trip['assigned_guide']) ? trim($trip['assigned_guide']) : '';
                            // Determine status text and css class
                            if ($assigned_guide !== '') {
                                $status = 'Assigned';
                                $status_class = 'assigned';
                            } else {
                                // Not assigned - check if admin has reacted (assign form submitted before)
                                // Since no explicit flag, treat empty assigned_guide as processing by default
                                $status = 'Processing';
                                $status_class = 'processing';
                            }
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($trip['user_name']) ?></td>
                                <td><?= htmlspecialchars($trip['email']) ?></td>
                                <td><?= htmlspecialchars($trip['destination']) ?></td>
                                <td><?= htmlspecialchars($trip['start_date']) ?></td>
                                <td><?= htmlspecialchars($trip['end_date']) ?></td>
                                <td><?= intval($trip['num_travelers']) ?></td>
                                <td><?= htmlspecialchars($trip['accommodation_type']) ?></td>
                                <td><?= htmlspecialchars($trip['transportation_type']) ?></td>
                                <td><?= nl2br(htmlspecialchars($trip['activities'] ?? '')) ?></td>
                                <td><?= nl2br(htmlspecialchars($trip['special_requirements'] ?? '')) ?></td>
                                <td><?= htmlspecialchars($trip['budget_range']) ?></td>
                                <td><?= $assigned_guide !== '' ? htmlspecialchars($assigned_guide) : '<em>Not Assigned</em>' ?></td>
                                <td><span class="status <?= $status_class ?>"><?= $status ?></span></td>
                                <td>
                                    <form method="POST" class="inline-form" onsubmit="return confirm('Assign guide to this trip?');">
                                        <input type="hidden" name="trip_id" value="<?= intval($trip['id']) ?>">
                                        <select name="guide" required>
                                            <option value="">Select guide</option>
                                            <?php foreach ($guides as $guide): ?>
                                                <option value="<?= htmlspecialchars($guide) ?>" <?= ($assigned_guide === $guide) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($guide) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" name="assign_guide">Assign</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script>
         // Show the main buttons by default, no section active initially
    document.addEventListener('DOMContentLoaded', function() {
            // Hide all sections initially
            document.querySelectorAll('.section').forEach(section => {
            section.classList.remove('active');
        });
    });

    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Remove active class from all buttons
        document.querySelectorAll('.nav-button').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show the selected section
        document.getElementById(sectionId).classList.add('active');
        
        // Add active class to the clicked button
        const activeButton = Array.from(document.querySelectorAll('.nav-button'))
            .find(button => button.textContent.toLowerCase().includes(sectionId.replace('-', ' ')));
        if (activeButton) {
            activeButton.classList.add('active');
        }
    }
    </script>
</body>
</html>