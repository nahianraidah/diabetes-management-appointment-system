<?php

include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();
$d_id = $_SESSION['d_id']; //session variable for doctor id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designation = $_POST['designation']; //new designation if updated by doctor
    $phone = $_POST['phone'];
    $location = $_POST['location']; 

    $sql = "UPDATE doctor SET designation='$designation', phone='$phone', location='$location' WHERE d_id='$d_id'";
   
    if (mysqli_query($conn, $sql)) { //returns true if data is inserted into db
        echo "Profile updated successfully!";
		header("Location: update_doctor_profile_frontend.php?success=true");
		
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
	
}
?>