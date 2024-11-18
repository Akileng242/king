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
    $pay_date = $conn->real_escape_string($_POST["pay_date"]);
    $gross_pay = $conn->real_escape_string($_POST["gross_pay"]);
    $net_pay = $conn->real_escape_string($_POST["net_pay"]);
    $deductions = $conn->real_escape_string($_POST["deductions"]);

    // Insert the data into the payroll table
    $sql = "INSERT INTO payroll (employee_id, pay_date, gross_pay, net_pay, deductions)
            VALUES ('$employee_id', '$pay_date', '$gross_pay', '$net_pay', '$deductions')";

    if ($conn->query($sql) === TRUE) {
        echo "Payroll data loaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
