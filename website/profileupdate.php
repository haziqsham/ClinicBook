<?php
session_start();

// Check if user ID is set in the session
if (!isset($_SESSION["ID"])) {
    die("User not logged in.");
}

// Retrieve user ID from session
$ID = $_SESSION["ID"];

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the form
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $PhoneNo = $_POST['PhoneNo'];
    $Pass = $_POST['Pass'];
    $ConfirmPass = $_POST['ConfirmPass'];

    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_web";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE users SET Name = ?, Email = ?, Address = ?, PhoneNo = ?, Pass = ? , ConfirmPass = ? WHERE ID = ?");
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("ssssssi", $Name, $Email, $Address, $PhoneNo, $Pass, $ConfirmPass, $ID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location.href = 'userprofile.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
