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
    $employee_id = $conn->real_escape_string($_POST["employee_id"]);
    $hours_worked = $conn->real_escape_string($_POST["hours_worked"]);
    $event_type = $conn->real_escape_string($_POST["event_type"]);
    $date = $conn->real_escape_string($_POST["date"]);

    // Check if employee_id exists in employees table
    $check_employee = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
    $result = $conn->query($check_employee);

    if ($result === FALSE) {
        die("Error checking if employee exists: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Employee exists, proceed with the claim submission
        $sql = "INSERT INTO claims (employee_id, hours_worked, event_type, date) VALUES ('$employee_id', '$hours_worked', '$event_type', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "Claim submitted successfully.";
        } else {
            die("Error inserting new claim: " . $conn->error);
        }
    } else {
        echo "Error: Employee ID does not exist.";
    }

    $conn->close();
}
?>

