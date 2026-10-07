<?php

include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") { //checking if the html form method=post
    $app_id = $_POST['app_id'];
    $action = $_POST['action'];

    // 0=pending, 1=confirmed, 2=cancelled
    if ($action == "Confirm") {
        $query = "UPDATE appointment SET confirmation = 1 WHERE app_id = $app_id";
    } elseif ($action == "Cancel") {
        $query = "UPDATE appointment SET confirmation = 2 WHERE app_id = $app_id";
    } elseif ($action == "Checked") { //0=not checked, 1=checked
        $query = "UPDATE appointment SET checked = 1 WHERE app_id = $app_id";
    }

    if ($conn->query($query) === TRUE) {
        // back to appointment page after update
        header("Location: doctor_appointments.php"); //refreshes view and shows updated table
        exit();
    } else {
        echo "Error updating appointment: " . $conn->error; //returns false if query isnt executed
    }
}

// Close the connection
$conn->close();
?>
