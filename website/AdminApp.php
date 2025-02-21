<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='shortcut icon' type='image/x-icon' href='Klinik.png' />
    <title>Klinik Hasnida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #main {
            margin-top: 65px;
            margin-left: 200px;
            padding: 0px 10px;
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
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        #sidebar a {
            display: block;
            color: black;
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
            padding: 16px;
        }

        #logout-popup {
            display: none;
            position: fixed;
            top: 50%;
            right: 50%;
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

        #form {
            background-color: #f3f4f6;
            border: solid 0.1rem #d1d5db;
            border-radius: 0.5rem;
            box-sizing: border-box;
            color: #9ca3af;
            font-family: Poppins, 'Source Sans Pro';
            font-size: 0.8rem;
            font-weight: 1000;
            height: 200%;
            line-height: 0.5;
            padding: 0.5rem 1.0rem;
            white-space: nowrap;
            width: 50%;
        }

        #forma {
            background-color: #f3f4f6;
            border: solid 0.1rem #d1d5db;
            border-radius: 0.5rem;
            box-sizing: border-box;
            color: #9ca3af;
            font-family: Poppins, 'Source Sans Pro';
            font-size: 0.8rem;
            font-weight: 1000;
            height: 200%;
            line-height: 0.5;
            padding: 0.5rem 1.0rem;
            white-space: nowrap;
            width: 10%;
        }
    </style>
</head>

<body>

    <div id="logout-popup">
        <p>Click logout to exit session</p>
        <button onclick="logout()">Logout</button>
        <button onclick="cancelLogout()">Cancel</button>
    </div>

    <div id="mainnav">
        <div class="logo-container">
            <img src="Klinik.png">
        </div>
    </div>
    <div id="sidebar">
        <br><br><br>
        <a href="AdminDashboard.php">Dashboard</a>
        <a href="AdminPatient.php">Patient</a>
        <a href="AdminApp.php">Application</a>
        <a id="logout-btn" onclick="showLogoutPopup()">LOGOUT</a>
    </div>

    <div id="content">
        <br><br><br>
        <h2>Application</h2>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Appointment Request</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                    $queryView = "SELECT * FROM booking";
                    $resultView = $conn->query($queryView);

                    if ($resultView->num_rows > 0) {
                        while ($row = $resultView->fetch_assoc()) {
                            $queryUser = "SELECT * FROM users WHERE ID = " . $row["ID"];
                            $resultUser = $conn->query($queryUser);
                            $rowUser = $resultUser->fetch_assoc();

                            echo "<tr>";
                            echo '<td> ' . $row["ID"] . '</td>';
                            echo '<td> ' . $rowUser["Name"] . '</td>';
                            echo '<td>' . $row["time"] . '</td>';
                            echo '<td> ' . $row["date"] . '</td>';

                            echo '<td' . ($row["Appstatus"] == "Approve" ? ' class="table-success"' : ' class="table-danger"') . '> ' . $row["Appstatus"] . '</td>';

                            if ($row["statusComp"] == 'Successful') {
                                echo '<td class="table-success"> ' . $row["statusComp"] . '</td>';
                            } else {
                                echo '<td class="table-danger">
                                        <form action="" method="post" class="row g-2">
                                            <div class="col-auto">  
                                                <select class="form-select" name="statusComp" id="statusComp">
                                                    <option value="Unsuccessful">Unsuccessful</option>
                                                    <option value="Successful">Successful</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="bookingID" value="' . $row["bookingID"] . '">
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <button type="submit" name="delete" class="btn btn-danger">Cancel</button>
                                            </div>
                                        </form>
                                    </td>';
                            }

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><th colspan='7' style='color:red;'>No Data Selected</th></tr>";
                    }
                }

                if (isset($_POST['statusComp']) && isset($_POST['bookingID'])) {
                    $statusComp = $_POST['statusComp'];
                    $bookingID = $_POST['bookingID'];

                    UpdatestatusComp($conn, $statusComp, $bookingID);
                }

                if (isset($_POST['delete']) && isset($_POST['bookingID'])) {
                    $bookingID = $_POST['bookingID'];
                    DeleteBooking($conn, $bookingID);
                }

                function UpdatestatusComp($conn, $statusComp, $bookingID)
                {
                    $appStatus = $statusComp == 'Successful' ? 'Approve' : 'Pending';
                    $queryUpdate = "UPDATE booking SET `statusComp` = '$statusComp', `Appstatus` = '$appStatus' WHERE `bookingID` = '$bookingID'";
                    if ($conn->query($queryUpdate) === TRUE) {
                        echo "<script>
                            alert('Status updated successfully');
                            window.location.href = 'AdminApp.php';
                          </script>";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                function DeleteBooking($conn, $bookingID)
                {
                    $queryDelete = "DELETE FROM booking WHERE `bookingID` = '$bookingID'";
                    if ($conn->query($queryDelete) === TRUE) {
                        echo "<script>
                            alert('Booking cancelled successfully');
                            window.location.href = 'AdminApp.php';
                          </script>";
                    } else {
                        echo "Error cancelling booking: " . $conn->error;
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
