<?php
$servername = "localhost";
$username = "akileng";
$password = "ikelloi";
$dbname = "analysis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $position = $_POST["position"];

    // Check if the employee exists
    $sql = "SELECT * FROM employees WHERE name = '$name' AND position = '$position'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        echo "Login successful. Welcome, " . $name . "!";
    } else {
        // Login failed
        echo "Employee not found. Please check your credentials or <a href='index.php'>register here</a>.";
    }
}

$conn->close();
?>
