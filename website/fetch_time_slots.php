<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_web";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['booking_date'])) {
    $selected_date = $_POST['booking_date'];

    // Fetch already booked time slots for the selected date
    $query = "SELECT time FROM booking WHERE date = '$selected_date'";
    $result = $conn->query($query);
    $booked_slots = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $booked_slots[] = $row['time'];
        }
    }

    // Fetch all time slots and filter out the booked ones
    $query = "SELECT id, slot_time FROM time_slots";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (!in_array($row['slot_time'], $booked_slots)) {
                echo '<input type="radio" class="btn-check" name="time" id="btn-check-' . str_replace(':', '-', $row['slot_time']) . '" value="' . $row['slot_time'] . '" autocomplete="off">';
                echo '<label class="btn btn-outline-success" for="btn-check-' . str_replace(':', '-', $row['slot_time']) . '">' . date("g:i a", strtotime($row['slot_time'])) . '</label>';
            }
        }
    } else {
        echo "<p>No available slots for the selected date.</p>";
    }
}

$conn->close();
?>
