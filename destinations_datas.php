
<?php
require_once 'db_connect.php';

function sInWishlist($place_id, $user_id) {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND place_id = ?");
        $stmt->execute([$user_id, $place_id]);
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    } catch(Exception $e) {
        return false;
    }
}

// Array of destinations with detailed information
$destinations = [
    // You can keep your static hardcoded destinations as "default" here,
    // or you could leave it empty if you ONLY want database items.
    // For demonstration, we leave it empty and will fill from DB.
];

// Get all places from the database and add to $destinations array
try {
    $stmt = $conn->prepare("SELECT id, name, description, image, category, maplink FROM places");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $destinations[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'category' => $row['category'],
            // Use the same structure as in your original array: map_link (underscore)
            'map_link' => $row['maplink']
        ];
    }
} catch (Exception $e) {
    // Handle error as needed
    error_log("Error fetching places: " . $e->getMessage());
}

// Now $destinations contains all database destinations + any hardcoded above.

?>
