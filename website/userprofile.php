<!DOCTYPE html>
<html>
<?php
session_start();
$ID = $_SESSION["ID"];

// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_web";

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's booking history from 'booking' table
$query = "SELECT Reason, Date, Time FROM booking WHERE ID = '$ID'";
$result = $conn->query($query);

// Initialize variables to store user's booking history
$bookingHistory = [];

// Fetch user's booking history if the query is successful
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookingHistory[] = $row;
    }
}

// Fetch user's information from 'users' table
$queryUser = "SELECT * FROM users WHERE ID = '$ID'";
$resultUser = $conn->query($queryUser);

// Initialize variables to store user's information
$name = "";
$email = "";
$address = "";
$phoneNo = "";
$pass = "";

// Fetch user's information if the query is successful
if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $name = $rowUser['Name'];
    $email = $rowUser['Email'];
    $address = $rowUser['Address'];
    $phoneNo = $rowUser['PhoneNo'];
    $pass = $rowUser['Pass'];
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicBook - User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="Clinic.png"/>
    <style>
        /* Your existing CSS styles */
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
        .navbar-brand img {
            max-width: 200px;
            max-height: 100px;
        }
        #sidebar {
            margin-top: 60px;
            padding: 0;
            width: 200px;
            background-color: #343a40;
            position: fixed;
            height: 100%;
            overflow: auto;
        }
        #sidebar a {
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
        }
        #sidebar a.active {
            background-color: #04AA6D;
        }
        #sidebar a:hover:not(.active) {
            background-color: #555;
        }
        #content {
            margin-left: 200px;
            padding: 20px;
        }
        #logout-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        #logout-popup button {
            padding: 10px;
            margin: 5px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <img src="Klinik.png" alt="ClinicBook">
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
    <a href="booking.php">Appointment Booking</a>
    <a href="status.php">Appointment Status</a>
    <a href="userprofile.php" class="active">Profile</a>
</div>

<div id="content">
    <h2>User Profile</h2>
    <br><br>
    <!-- Display Appointment History -->
    <div class="mb-4">
        <h4>Appointment History</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookingHistory)): ?>
                    <?php foreach ($bookingHistory as $booking): ?>
                        <tr>
                            <td><?php echo $booking['Reason']; ?></td>
                            <td><?php echo $booking['Date']; ?></td>
                            <td><?php echo $booking['Time']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No appointments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Form to Update User Information -->
    <div>
        <h4>Update User Information</h4>
        <form action="profileupdate.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="Name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="Email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="Address" value="<?php echo $address; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNo" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="phoneNo" name="PhoneNo" value="<?php echo $phoneNo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="Pass" value="<?php echo $pass; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ConfirmPass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="ConfirmPass" name="ConfirmPass" value="" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<script>
    function showLogoutPopup() {
        document.getElementById("logout-popup").style.display = "block";
    }

    function logout() {
        alert("User logged out!");
        window.location.href = "login.html";
    }

    function cancelLogout() {
        document.getElementById("logout-popup").style.display = "none";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
