<?php
//---------------------PAGE DESCRIPTION -----------------
//this page will be like an appointment form
// After clicking "make appointment" button patient will be redirected to this page

//In the respect of logged in patient's patient id and the doctor's id (through who's card body patient clicked the "make appointment" button 
//to set an appointment (insertan row in appointment table) "appointment date" , appointment time" these info will be taken through a form



//-----------------------IMPLEMENTATION-----------------------------------
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();

$p_id = $_SESSION['p_id']; 


// Checking if the doctor id is passed via GET method
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];
} else {
    // Redirect to doctor list if no doctor ID is provided
    header('Location: verified_doctor_list.php');
    exit();
}


$d_id = mysqli_real_escape_string($conn, $d_id);
$p_id = mysqli_real_escape_string($conn, $p_id);

// Fetching patient details with completed patient profile
$sql = "SELECT name, dob, weight, gender, 
        gl_b_breakfast, gl_a_breakfast, gl_b_lunch, gl_b_dinner 
		FROM patient WHERE p_id = '$p_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $patient_row = $result->fetch_assoc();
} else {
    echo "Error: Patient not found.";
    exit();
}

// Checking profile's profile's completeness
$is_profile_complete = true;
$required_column = ['name', 'dob', 'weight', 'gender', 
                    'gl_b_breakfast', 'gl_a_breakfast', 
					'gl_b_lunch', 'gl_b_dinner'];
foreach ($required_column as $column_value) {
    if (empty($patient_row[$column_value])|| $patient_row[$column_value] == 0.0) {
        $is_profile_complete = false;
        break;
    }
}

// Checking if there are any error messages from the previous submission
$error = isset($_SESSION['error']) ? $_SESSION['error'] : [];
$post_data = isset($_SESSION['post_data']) ? $_SESSION['post_data'] : [];

// Clear the session after displaying errors
unset($_SESSION['error']);
unset($_SESSION['post_data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
 
        .form-container {
            width: 100%;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-card {
            width: 500px; 
            height: 400px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
		
		 /* Increase space below the heading */
        h2.text-center {
            margin-bottom: 40px; 
        }

        .form-card .btn {
            margin-top: 20px; 
        }

        .form-card .alert {
            margin-top: 20px; 
        }

        /* Align date and time inputs to the left */
        .form-card .left-align { 
            text-align: left; 
            width: 150%; 
        } 
		
		/* Adjust the width of the input fields */
        .form-card .form-control {
            width: 65%; 
            margin-right: auto;
        }
        
        /* Center the button */
        .form-card .btn-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }
		
		/* Add styling for error messages */
        .error {
            color: red;
            font-size: 12px;
    </style>
</head>

<body>

    <div class="form-container">
        <div class="form-card"> 
		    <h2 class="text-center">Request An Appointment</h2>
            <form action="make_appointment_process.php" method="POST">
                <input type="hidden" name="d_id" value="<?php echo htmlspecialchars($d_id); ?>">
                <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($p_id); ?>">

                <!-- Appointment Date -->
                <div class="mb-4 left-align">
                    <label for="date" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
					<?php if (isset($error['day'])): ?>
                        <div class="error"><?php echo $error['day']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Appointment Time -->
                <div class="mb-3 left-align">
                    <label for="time" class="form-label">Appointment Time</label>
                    <input type="time" class="form-control" id="time" name="time" required>
					 <?php if (isset($error['time'])): ?>
                        <div class="error"><?php echo $error['time']; ?></div>
                    <?php endif; ?>
                </div>
				
				
				<!-- Multiple Appointment on same day error -->
                <div class="mb-3 left-align">
					 <?php if (isset($error['appointment'])): ?>
                        <div class="error"><?php echo $error['appointment']; ?></div>
                    <?php endif; ?>
                </div>


                <!-- Request Appointment Button -->
                <div class="btn-container">
                    <button type="submit" class="btn <?php echo $is_profile_complete ? 'btn-success' : 'btn-secondary'; ?>" 
                            <?php echo !$is_profile_complete ? 'disabled' : ''; ?>>
                        Request
                    </button>
                </div>

                <!-- Profile Incomplete Message -->
                <?php if (!$is_profile_complete): ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Please complete your profile to request an appointment.
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
