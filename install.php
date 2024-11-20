<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "bcapp";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql = "CREATE DATABASE IF NOT EXISTS bcapp";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Create the tables
$sql = file_get_contents('db/templates.sql');
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully<br>";
} else {
    echo "Error creating tables: " . $conn->error . "<br>";
}

// Generate a random username and password for the database
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*\$!?&#,./\\";
$username = substr(str_shuffle($chars), 0, 16);
$password = substr(str_shuffle($chars), 0, 16);

// Update the config.php file
$configContent = <<<EOT
<?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'bcapp');
    define('DB_USER', '$username');
    define('DB_PASS', '$password');
?>
EOT;

file_put_contents('config.php', $configContent);

echo "Database configuration updated in config.php<br>";
echo "Username: $username<br>";
echo "Password: $password<br>";

$conn->close();
?>