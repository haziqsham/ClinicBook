<!DOCTYPE html>
<html>
<?php
session_start();
$ID = $_SESSION["ID"];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='shortcut icon' type='image/x-icon' href='Clinic.png'/>
    <title>ClinicBook</title>
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
<br><br>
<br><br>
<div id="sidebar">
    <a href="booking.php">Appointment Booking</a>
    <a href="status.php" class="active">Appointment Status</a>
    <a href="userprofile.php">Profile</a>
</div>

<div id="content">
    <h2>Appointment Status</h2>
    <table class="table table-hover mt-4">
        <thead>
        <tr>
            <th>Appointment Approval</th>
            <th>Date</th>
            <th>Time</th>
            <th>Email</th>
            <th>Appointment Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "blood_web";

        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryView = "SELECT * FROM booking WHERE ID = '$ID'";
            $resultView = $conn->query($queryView);

            if ($resultView->num_rows > 0) {
                while ($row = $resultView->fetch_assoc()) {
                    $queryUser = "SELECT * FROM users WHERE ID = " . $row["ID"];
                    $resultUser = $conn->query($queryUser);
                    $rowUser = $resultUser->fetch_assoc();

                    echo "<tr>";
                    echo $row["Appstatus"] == "Approve" ? '<td class="table-success"> ' . $row["Appstatus"] . '</td>' : '<td class="table-danger"> ' . $row["Appstatus"] . '</td>';
                    echo '<td> ' . $row["date"] . '</td>';
                    echo '<td> ' . $row["time"] . '</td>';
                    echo '<td>' . $rowUser["Email"] . '</td>';
                    echo $row["statusComp"] == "Successful" ? '<td class="table-success"> ' . $row["statusComp"] . '</td>' : '<td class="table-danger"> ' . $row["statusComp"] . '</td>';
                    echo '<td>
                            <form method="post" id="cancel-form-' . $row['bookingID'] . '">
                                <input type="hidden" name="cancelAppointment" value="' . $row['bookingID'] . '">
                                <button type="button" class="btn btn-danger cancel-btn" onclick="cancelBooking(' . $row['bookingID'] . ')">Cancel</button>
                            </form>
                        </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr>
                        <td colspan='7' class='text-danger text-center'>No Appointments</td>
                      </tr>";
            }
        }

        // Handle appointment cancellation
        if (isset($_POST['cancelAppointment'])) {
            $cancelID = $_POST['cancelAppointment'];
            $queryCancel = "DELETE FROM booking WHERE bookingID = '$cancelID' AND ID = '$ID'";
            if ($conn->query($queryCancel) === TRUE) {
                echo "<script>alert('Appointment Cancelled');</script>";
                // Reload the page to reflect the changes
                echo "<script>window.location.href = 'status.php';</script>";
            } else {
                echo "Error cancelling appointment: " . $conn->error;
            }
        }
        ?>
        </tbody>
    </table>
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

    function cancelBooking(bookingID) {
        if (confirm("Are you sure you want to cancel the booking?")) {
            document.getElementById("cancel-form-" + bookingID).submit();
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
