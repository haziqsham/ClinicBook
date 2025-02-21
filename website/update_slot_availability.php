<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_Web";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['booking_date']) && isset($_POST['time']) && isset($_POST['isAvailable'])) {
    $booking_date = $_POST['booking_date'];
    $time = $_POST['time'];
    $isAvailable = $_POST['isAvailable'];

    $sql = "UPDATE booking SET availability = $isAvailable WHERE date = '$booking_date' AND time = '$time'";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating time slot availability: " . $conn->error;
    }
}

$conn->close();
?>
