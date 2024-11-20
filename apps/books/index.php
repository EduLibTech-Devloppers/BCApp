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

// Fetch books based on genre
$genreId = $_GET['genre'];
$sql = "SELECT * FROM books WHERE genre_id = $genreId";
$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "author" => $row["author"],
            "cover_image" => $row["cover_image"],
            "genre" => $row["genre_id"]
        );
    }
}

// Return books as JSON
header('Content-Type: application/json');
echo json_encode($books);

$conn->close();
?>