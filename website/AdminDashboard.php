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
                    margin-left: 200px; /* Same as the width of the sidenav */
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
                .logo-container img{
                    width: 15%;
                    box-sizing:border-box;
                    margin-left: -15px;
                }
                .login-link {
                    align-self: flex-end; /* Align the login link to the end (right) */
                }
                .h3{
                    margin-left : -420px;
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

                    #table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                        }
                    #td, th {
                        border: solid 0.1rem #d1d5db;
                            text-align: left;
                            padding: 8px;
                            }
                    #tr:nth-child(even) {
                        background-color: #dddddd;
                        }
                    section.card {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    section.card h2 {
                        margin: 0;
                        font-size: 20px;
                        padding-bottom: 10px;
                        border-bottom: 1px solid #ddd;
                    }

                    .data-row {
                        display: flex;
                        justify-content: space-between;
                    }

                    .data-item {
                        flex: 1;
                        text-align: center;
                        padding: 10px;
                    }

                    .data-item h3 {
                        margin: 0;
                        font-size: 16px;
                        padding-bottom: 5px;
                    }

                    .data-item span {
                        font-size: 24px;
                        font-weight: bold;
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
            

            <nav>
                <div id="sidebar">
                    <br><br><br>
                    <a href="AdminDashboard.php">Dashboard</a>
                    <a href="AdminPatient.php">Patient</a>
                    <a href="AdminApp.php">Application</a>
                    <a id="logout-btn" onclick="showLogoutPopup()">LOGOUT</a>
                </div>
            </nav>
            
            <main>
            <br><br><br><br>
                <div id=content>
                    <h2>Dashboard</h2>

                    <section class="card">
                        
                        <?php
                            $host = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "Blood_Web";

                            $conn = new mysqli($host, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } else {
                                $pending = "SELECT COUNT(Appstatus) FROM booking WHERE Appstatus = 'Pending'";
                                $success = "SELECT COUNT(Appstatus) FROM booking WHERE Appstatus = 'Approve'";
                                $successful = "SELECT COUNT(statusComp) FROM booking WHERE statusComp = 'Successful'";
                                $resultPending = $conn->query($pending);
                                $resultSuccess = $conn->query($success);
                                $resultSuccessful = $conn->query($successful);


                                if ($resultPending->num_rows > 0 || $resultSuccess->num_rows > 0| $resultSuccessful->num_rows > 0){
                                    $rowPending = $resultPending->fetch_assoc();
                                    $rowSuccess = $resultSuccess->fetch_assoc();
                                    $rowSuccessful = $resultSuccessful->fetch_assoc();
                                    $Pending = isset($rowPending['COUNT(Appstatus)'])? $rowPending['COUNT(Appstatus)'] : 0; 
                                    $Success = isset($rowSuccess['COUNT(Appstatus)'])? $rowSuccess['COUNT(Appstatus)'] : 0;
                                    $Successful = isset($rowSuccessful['COUNT(statusComp)'])? $rowSuccessful['COUNT(statusComp)'] : 0;

                                    echo"<div class='data-row'>";
                                        echo"<div class='data-item'>";
                                            echo"<h3>Pending</h3>";
                                            echo"<span> <a href='AdminApp.php' >$Pending</a></span>";
                                        echo"</div>";

                                        echo"<div class='data-item'>";
                                            echo"<h3>Booking Approved</h3>";
                                            echo"<span> <a href='AdminApp.php' >$Success</a></span>";
                                        echo"</div>";
                                    echo"</div>";
                                } else {
                                    echo "<tr><th colspan='7' style='color:red;'>No Data Selected</th></tr>";
                                    }
                            }
                        ?>

                    </section>
                </div>
            </main>

            <footer>
            </footer>
            
            <script>
                function showLogoutPopup() {
                    document.getElementById("logout-popup").style.display = "block";
                }

                function logout() {
                    // Add your logout logic here
                    alert("User logged out!");
                    //document.getElementById("logout-popup").style.display = "none";
                    window.location.href = "login.html";
                }

                function cancelLogout() {
                    document.getElementById("logout-popup").style.display = "none";
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        </body>

    </html>

