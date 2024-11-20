<?php
require_once '../config.php';

// Database connection details
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Generate a new username and password for the database
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*\$!?&#,./\\";
    $newUsername = substr(str_shuffle($chars), 0, 16);
    $newPassword = substr(str_shuffle($chars), 0, 16);

    // Update the config.php file
    $configContent = <<<EOT
<?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'bcapp');
    define('DB_USER', '$newUsername');
    define('DB_PASS', '$newPassword');
?>
EOT;

    file_put_contents('../config.php', $configContent);

    echo "Database connection failed. Updated database credentials in config.php.\n";
    echo "New username: $newUsername\n";
    echo "New password: $newPassword\n";
    exit;
}

// Perform CLI tasks here
// ...

$conn->close();
?>