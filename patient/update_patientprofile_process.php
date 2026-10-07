<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start(); 

$p_id = $_SESSION['p_id'];


// Fetching logged in patient's glucose level info
$sql = "SELECT gl_b_breakfast,gl_a_breakfast,gl_b_lunch,gl_b_dinner 
        FROM patient WHERE p_id = $p_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $pre_gl_b_breakfast = $row['gl_b_breakfast'];
    $pre_gl_a_breakfast = $row['gl_a_breakfast'];
    $pre_gl_b_lunch = $row['gl_b_lunch'];
    $pre_gl_b_dinner = $row['gl_b_dinner'];
} else {
    echo "No data found for this patient.";
    exit();
}

// Getting data from POST request
$name = $_POST['name'];
$dob = $_POST['dob'];
$weight = $_POST['weight'];
$gender = $_POST['gender'];
$gl_b_breakfast = $_POST['gl_b_breakfast'];
$gl_a_breakfast = $_POST['gl_a_breakfast'];
$gl_b_lunch = $_POST['gl_b_lunch'];
$gl_b_dinner = $_POST['gl_b_dinner'];






$p_id = $conn->real_escape_string($p_id);
$name = $conn->real_escape_string($name);
$dob = $conn->real_escape_string($dob);
$weight = $conn->real_escape_string($weight);
$gender = $conn->real_escape_string($gender);
$gl_b_breakfast = $conn->real_escape_string($gl_b_breakfast);
$gl_a_breakfast = $conn->real_escape_string($gl_a_breakfast);
$gl_b_lunch = $conn->real_escape_string($gl_b_lunch);
$gl_b_dinner = $conn->real_escape_string($gl_b_dinner);



// Update patient profile
$sql = "UPDATE patient SET 
        name = '$name', 
        dob = '$dob', 
        weight = '$weight', 
        gender = '$gender', 
        gl_b_breakfast = '$gl_b_breakfast', 
        gl_a_breakfast = '$gl_a_breakfast', 
        gl_b_lunch = '$gl_b_lunch', 
        gl_b_dinner = '$gl_b_dinner', 
        updated_on = IF(
            gl_b_breakfast != '$pre_gl_b_breakfast' 
            OR gl_a_breakfast != '$pre_gl_a_breakfast'
            OR gl_b_lunch != '$pre_gl_b_lunch'
            OR gl_b_dinner != '$pre_gl_b_dinner', 
            NOW(), 
            updated_on 
        )
        WHERE p_id = '$p_id'";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .message-container {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100vh; /* Full viewport height */
            text-align: center;
        }
        .message-container h1 {
            font-size: 36px; /* Bigger font size */
            color: #4CAF50; /* Green color for success */
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
        // Displaying the success or error message
        if ($conn->query($sql) === TRUE) {
            echo '<h1>Profile successfully updated!</h1>';
			// Redirect after 3 seconds
            header("refresh:3; url=dashboard.php"); 
        } else {
            echo '<h1>Error updating profile: ' . $conn->error . '</h1>';
			header("refresh:5; url=update_patientprofile.php");
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
