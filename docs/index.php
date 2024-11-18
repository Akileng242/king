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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $position = $conn->real_escape_string($_POST["position"]);
    $salary = $conn->real_escape_string($_POST["salary"]);
    $pay_rate = $conn->real_escape_string($_POST["pay_rate"]);

    // Check if employee already exists
    $check_sql = "SELECT * FROM employees WHERE name = '$name' AND position = '$position'";
    $result = $conn->query($check_sql);

    if ($result === FALSE) {
        die("Error: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo "Employee already exists. <a href='login.php'>Please log in here.</a>";
    } else {
        // Insert new employee if they do not already exist
        $sql = "INSERT INTO employees (name, position, salary, pay_rate) VALUES ('$name', '$position', '$salary', '$pay_rate')";

        if ($conn->query($sql) === TRUE) {
            echo "New employee added successfully. <a href='login.php'>Click here to log in.</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>
