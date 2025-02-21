<?php
session_start();

// Check if user ID is set in the session
if (!isset($_SESSION["ID"])) {
    die("User not logged in.");
}

// Retrieve user ID from session
$ID = $_SESSION["ID"];

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_date']) && isset($_POST['time'])) {
    // Retrieve input values from the form
    $booking_date = $_POST['booking_date'];
    $time = $_POST['time'];

    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_Web";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_date']) && isset($_POST['time']) && isset($_POST['reason']) && isset($_POST['doctors'])) {
    // Retrieve input values from the form
    $booking_date = $_POST['booking_date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];
    $doctors = $_POST['doctors'];

    // Check if the time slot already exists for the given date and user
    $stmt = $conn->prepare("SELECT * FROM booking WHERE ID = ? AND date = ? AND time = ?");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("iss", $ID, $booking_date, $time);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('This time slot is already booked. Please choose another slot.'); window.location.href = 'booking.php';</script>";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO booking (ID, date, time, reason, doctors, Appstatus ,availability) VALUES (?, ?, ?, ?, ?, 'Pending',0)");
        if (!$stmt) {
            die("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param("issss", $ID, $booking_date, $time, $reason, $doctors);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('New booking created successfully'); window.location.href = 'booking.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
}?>