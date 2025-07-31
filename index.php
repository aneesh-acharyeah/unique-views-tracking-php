<?php
// Database connection settings
$host = 'localhost';
$db = 'your_database';  // Replace with your database name
$user = 'your_user';    // Replace with your database username
$pass = 'your_password';  // Replace with your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the page ID (e.g., for a blog post or product page)
$page_id = 123; // This should be dynamic based on the page you're on (e.g., using $_GET['page_id'])

// Check if the cookie is set for the specific page
if (!isset($_COOKIE["viewed_page_$page_id"])) {
    // Cookie not set, so insert a new view record in the database

    // Get the visitor's IP address (optional, can be useful for logging)
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Insert the view record into the database
    $insert_query = "INSERT INTO page_views (page_id, ip_address) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('is', $page_id, $ip_address);
    $stmt->execute();
    $stmt->close();

    // Set a cookie for this page view (expires in 1 year)
    setcookie("viewed_page_$page_id", "1", time() + 60 * 60 * 24 * 365, "/"); // Expiration in 1 year
}

// Now, count the total unique views for the page
$query = "SELECT COUNT(DISTINCT ip_address) AS unique_views FROM page_views WHERE page_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $page_id);
$stmt->execute();
$stmt->bind_result($unique_views);
$stmt->fetch();
$stmt->close();

// Output the unique views count
echo "Unique Views: " . $unique_views;

$conn->close();
?>
