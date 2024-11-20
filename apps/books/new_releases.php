<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "bcapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch new releases from the database
$sql = "SELECT * FROM books ORDER BY release_date DESC LIMIT 9";
$result = $conn->query($sql);

$newReleases = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $newReleases[] = array(
            "title" => $row["title"],
            "author" => $row["author"],
            "cover_image" => $row["cover_image"]
        );
    }
}

// Return new releases as JSON
header('Content-Type: application/json');
echo json_encode($newReleases);

$conn->close();
?>