<?php
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Address = $_POST["Address"];
    $PhoneNo = $_POST["PhoneNo"];
    $Pass = $_POST["Pass"];
    $ConfirmPass = $_POST["ConfirmPass"];
    
  
    // Replace these variables with your database credentials
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_Web";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    $sql = "SELECT * FROM users WHERE Email='$Email'";
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        echo "Error: Email already exists!";
        echo "<br> Click <a href='signup.html'> here </a> Register Again with a different email address. ";
        exit;
    }
   

    // Check connection
    if (strcmp($Pass, $ConfirmPass) !== 0) {
        echo "Passwords do not match. Please try again.";
        exit;
    }
    
    // ... database connection and query
    
    $queryInsert = "INSERT INTO users (Name, Address,Email, PhoneNo, Pass, ConfirmPass) 
                    VALUES ('$Name','$Address','$Email', '$PhoneNo', '$Pass','$ConfirmPass')";
    
    // ... rest of the PHP code

        if ($conn->query($queryInsert) === TRUE) {
            echo "Account created successfully";
            echo "<script>
            setTimeout(function() {
                window.location.href = 'login.html';
            }, 3000);
          </script>";
        } else {
            echo "Error:Invalid query " . $conn->error;
        }
    

    // Close connection
    $conn->close();
?>