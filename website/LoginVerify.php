<?php

//these codes is for login process
//check userid & pwd is matched

$Email = $_POST['Email'];
$Pass = $_POST['Pass'];

//declare DB connection variables 

$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_web";
// please write your DB name 
//create connections with DB

$link = mysqli_connect($host, $username, $password, $dbname);
 if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error); 
}
else 
{
//connect successfully
//check userID is exist

$queryCheck = "select * from users where Email = '".$Email."'";
$resultCheck = $link->query($queryCheck);
       if ($resultCheck->num_rows == 0) {
               echo "Email does not exists";
        } 
       else 
        {
        $row = $resultCheck->fetch_assoc(); 
        if( $row["Pass"] == $Pass ) 
        {
            if ($row["usersType"] == "Admin") {
                header("Location: AdminDashboard.php");
                exit();
            } else {
                session_start();
                $_SESSION["ID"] = $row["ID"];
                $_SESSION["Name"] = $row["Name"];
                $_SESSION["Email"] = $row["Email"];
                $_SESSION["Age"] = $row["Age"];
                $_SESSION["Pass"] = $row["Pass"];

                header("Location: booking.php");
            }

        }   
        else 
        {
        echo "Wrong Username or Password <br><br>";
        echo "Click <a href='login.html'> here </a> to login again ";
        }
        }
}
mysqli_close($link);
?>