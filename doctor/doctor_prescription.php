<?php

include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();
$d_id = $_SESSION['d_id']; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_id = $_POST['p_id']; //p_id is added by the doctor into the prescription form
    $detail = $_POST['detail'];
    $date = date('Y-m-d'); // Current date
    
 //check if the patient id exists in the patient table
    $check_patient_sql = "SELECT * FROM patient WHERE p_id = '$p_id'";
    $result = mysqli_query($conn, $check_patient_sql);

    if (mysqli_num_rows($result) > 0) { //patient id is in table means valid patient id added by doc
    
        $sql = "INSERT INTO prescription (p_id, d_id, detail, date) VALUES ('$p_id', '$d_id', '$detail', '$date')";
        
        if (mysqli_query($conn, $sql)) { //returns true if data is inserted into db
            echo "<div class='alert alert-success'>Prescription added successfully !</div>";

            header("refresh:3; url=doctor_dashboard.php"); // Redirect after 3 seconds
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Invalid patient ID
        echo "<div class='alert alert-danger'>Invalid patient ID. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Add Prescription</h2>
		
        <form method="POST">
            <!-- patient id -->
            <div class="mb-3">
                <label for="p_id" class="form-label">Patient ID</label>
                <input type="text" class="form-control" id="p_id" name="p_id" required>
            </div>

            <!-- prescription detail -->
            <div class="mb-3">
                <label for="detail" class="form-label">Prescription Detail</label>
                <textarea class="form-control" id="detail" name="detail" rows="4" required></textarea>
            </div>

            <!-- submit button -->
            <button type="submit" class="btn btn-primary">Submit Prescription</button>
        </form>
    </div>
	
	<!-- "Go Back to Dashboard" button -->
    <div class="mb-3 mt-5 text-center">
            <a href="doctor_dashboard.php" class="btn btn-secondary">Go Back to Dashboard</a>
    </div>
		
</body>
</html>