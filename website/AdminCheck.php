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
            height: 50px;
            width: 100%;
            position: fixed;
            z-index: 2;
            top: 0;
            left: 0;
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding-left: 20px;
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
            <h3>Klinik Hasnida</h3>
        </div>

    <div id="sidebar">
        <br><br><br>
        <a href="AdminDashboard.php">Dashboard</a>
        <a href="AdminPatient.php">Patient</a>
        <a href="AdminApp.php">Application</a>
        <a id="logout-btn" onclick="showLogoutPopup()">LOGOUT</a>
    </div>

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