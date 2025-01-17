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

// Fetch genres from the database
$sql = "SELECT * FROM genres";
$result = $conn->query($sql);

$genres = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $genres[] = array(
            "id" => $row["id"],
            "name" => $row["name"]
        );
    }
}

// Return genres as JSON
header('Content-Type: application/json');
echo json_encode($genres);

$conn->close();
?>