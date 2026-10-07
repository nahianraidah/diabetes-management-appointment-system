<?php
//---------------------PAGE DESCRIPTION -----------------
//Conditions for inserting data in Table: "appointment"
//appointment day --> within -->day= [sun,mon,tues,wed,thurs]
//appointment time--> within -->time= 3pm - 5pm 


//user input will be inserted into 
//Table: appointment , in our dms database

//-----------------------IMPLEMENTATION-----------------------------------
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start(); 

// Checking if the patient is logged in
if (!isset($_SESSION['p_id'])) {
    header("Location: ../login.php");
    exit();
}

$p_id = $_SESSION['p_id'];  

// Retrieving info from the submitted data
$d_id = $_POST['d_id'];
$p_id = $_POST['p_id'];
$date = $_POST['date'];
$time = $_POST['time'];


$d_id = mysqli_real_escape_string($conn, $d_id);
$p_id = mysqli_real_escape_string($conn, $p_id);
$date = mysqli_real_escape_string($conn, $date);
$time = mysqli_real_escape_string($conn, $time);

// Initializing an array to store error messages
$error = [];

// Converting date to check the day of the week
$day= date('l', strtotime($date)); 


// Checking if the day is within the valid weekday range
$valid_day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
if (!in_array($day, $valid_day)) {
    $error['day'] = "Appointment must be on a weekday (Sunday to Thursday).";
}


// Checking if the time is within 3 PM to 7 PM
$time_formatted =  date("H:i:s", strtotime($time));
$start_time = date("H:i:s", strtotime('15:00')); // 3 PM
$end_time = date("H:i:s", strtotime('19:00')); // 7 PM

if ($time_formatted < $start_time || $time_formatted > $end_time) {
	$error['time'] = "Appointment time must be between 3 PM and 7 PM.";
}


// Checking if the patient already has an appointment on the same day
$multi_app_sql = "SELECT * FROM appointment WHERE p_id = '$p_id' AND date = '$date'";
$result = $conn->query($multi_app_sql);

if ($result && $result->num_rows > 0) {
    $error['appointment'] = "You cannot make more than 1 appointment on the same day.";
}


// If there are error, store them in session and redirect back to the form
if (!empty($error)) {
    $_SESSION['error'] = $error;
    $_SESSION['post_data'] = $_POST; // To retain form data
    header("Location: make_appointment.php?d_id=$d_id"); // Redirect back to the form
    exit();
}

// If both conditions are fulfilled, insert the appointment into the database
$sql = "INSERT INTO appointment (d_id, p_id, date, time) 
        VALUES ('$d_id', '$p_id', '$date', '$time')";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Request Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .message-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            text-align: center;
        }
        .message-container h1 {
            font-size: 36px; 
            color: #4CAF50; 
        }
    </style>
</head>

<body>
    <div class="message-container">
        <?php
        // Displaying the success or error message
        if ($conn->query($sql) === TRUE) {
            echo '<h1>Appointment requested successfully!</h1>';
			// Redirect after 3 seconds
            header("refresh:3; url=dashboard.php"); 
        } else {
            echo '<h1>Error in appointment requesting process: ' . $conn->error . '</h1>';
			header("refresh:3; url=verified_doctor_list.php");
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

