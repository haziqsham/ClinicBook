<!DOCTYPE html>
<html>
<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_web";

// Check if user is logged in
if (isset($_SESSION["ID"])) {
    $ID = $_SESSION["ID"];
} else {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$sql = "SELECT * FROM users WHERE ID = '$ID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch the data
    $row = $result->fetch_assoc();
    $Name = $row["Name"];
    $PhoneNo = $row["PhoneNo"];
} else {
    echo "User not found";
}

    $start_time = strtotime('09:00');
    $end_time = strtotime('17:00');
    $interval = 3600; // 1 hour

    // Check if time slots for the current date already exist
$check_date = date('Y-m-d');
$sql_check = "SELECT COUNT(*) AS slot_count FROM time_slots WHERE DATE(slot_time) = '$check_date'";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
$existing_slots_count = $row_check['slot_count'];

if ($existing_slots_count == 0) {

    for ($time = $start_time; $time < $end_time; $time += $interval) {
        $slot_time = date('H:i:s', $time);
        $sql = "INSERT INTO time_slots (slot_time) VALUES ('$slot_time')";
        $conn->query($sql);
    }
}else {
}

?>

<head>
<link rel='shortcut icon' type='x-icon' href='Klinik.png' />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Klinik Hasnida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        #mainnav {
            height: 60px;
            width: 100%;
            position: fixed;
            z-index: 2;
            top: 0;
            left: 0;
            background-color: white;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-left: 30px;
            display: flex;
            align-items: center;
        }
        .logo-container img {
            width: 15%;
            box-sizing: border-box;
            margin-left: -15px;
        }
        .login-link {
            align-self: flex-end;
        }
        .h3 {
            margin-left: -420px;
            margin-top: 9px;
        }
        #sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #343a40;
            position: fixed;
            height: 100%;
            overflow: auto;
            color: white;
        }
        #sidebar a {
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
        }
        #sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }
        #sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }
        #content {
            margin-left: 200px;
            padding: 10px;
            padding-top: 70px;
        }
        #logout-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffff;
            padding: 20px;
            text-align: center;
        }
        #logout-popup button {
            padding: 10px;
            margin: 5px;
        }
        .btn-check {
            display: none;
        }
        .btn-success {
            margin: 5px;
        }
        .btn-success:not(:checked) {
            background-color: lightgreen;
        }
        .btn-success:checked {
            background-color: #198754;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="Klinik.png" alt="" style="max-width: 200px; max-height: 150px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="showLogoutPopup()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="logout-popup">
        <p>Click logout to exit session</p>
        <button class="btn btn-danger" onclick="logout()">Logout</button>
        <button class="btn btn-secondary" onclick="cancelLogout()">Cancel</button>
    </div>
    <div id="sidebar">
        <br><br><br>
        <a href="booking.php" class="active">Appointment Booking</a>
        <a href="status.php">Appointment Status</a>
        <a href="userprofile.php">Profile</a>
    </div>
    <div id="content">
        <h2></i>Appointment Booking</h2>
        <form id="booking-form" method="post" action="bookingverify.php" class="row g-3">
    <div class="mb-3">
        <label for="booking_date" class="form-label">Booking Date</label>
        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
    </div>
    <div id="timeSlotsContainer" class="mb-3">
        <label class="form-label">Available Time</label>
        <div id="available_time_slots" class="btn-group" role="group" aria-label="Available Time Slots">
            <!-- Time slot buttons will be dynamically added here -->
        </div>
    </div>
    <div class="mb-3">
        <label for="reason" class="form-label">Reason for Visit</label>
        <select class="form-select" name="reason" id="reason" required>
            <option value="" disabled selected>Select Reason</option>
            <option value="General Health Check-ups">General Health Check-ups</option>
            <option value="Diagnostic Tests">Diagnostic Tests</option>
            <option value="Vaccinations">Vaccinations</option>
            <option value="other">Other</option>
        </select>
    </div>
    <div class="mb-3" id="other_reason_field" style="display: none;">
        <label for="other_reason" class="form-label">Other Reason</label>
        <input class="form-control" type="text" name="other_reason" id="other_reason" placeholder="Enter Other Reason">
    </div>
    <div class="mb-3">
        <label for="doctors" class="form-label">Preferred Doctor</label>
        <select class="form-select" name="doctors" id="doctors" required>
            <option value="" disabled selected>Select Doctor</option>
            <option value="Dr. Hasnida">Dr. Hasnida</option>
            <option value="Dr. Siti">Dr. Siti</option>
        </select>
    </div>
    <div class="mb-3">
    <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('booking_date').addEventListener('change', fetchTimeSlots);

            function fetchTimeSlots() {
                var selectedDate = document.getElementById('booking_date').value;
                if (!selectedDate) return;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_time_slots.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('available_time_slots').innerHTML = xhr.responseText;
                    }
                };
                xhr.send('booking_date=' + selectedDate);
            }
        });

        function cancelBooking() {
            if (confirm("Are you sure you want to cancel this booking?")) {
                alert("Booking cancelled successfully!");
            }
        }

        function showLogoutPopup() {
            document.getElementById("logout-popup").style.display = "block";
        }

        function logout() {
            alert("User logged out!");
            window.location.href = "home.php";
        }

        function cancelLogout() {
            document.getElementById("logout-popup").style.display = "none";
        }

        // Show or hide the "Other Reason" field
        document.getElementById('reason').addEventListener('change', function() {
            var otherReasonField = document.getElementById('other_reason_field');
            if (this.value === 'other') {
                otherReasonField.style.display = 'block';
            } else {
                otherReasonField.style.display = 'none';
                document.getElementById('other_reason').value = '';
            }
        });
    </script>
</body>
</html>
