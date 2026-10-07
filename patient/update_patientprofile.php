<?php
session_start(); 
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';


if (!isset($_SESSION['p_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
exit();
}


$p_id = $_SESSION['p_id'];

// Fetching logged in patient's data 
$sql = "SELECT p_id,password,email,name,dob,weight,gender,
        gl_b_breakfast,gl_a_breakfast,gl_b_lunch,gl_b_dinner 
        FROM patient WHERE p_id = $p_id";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $dob = $row['dob'];
    $weight = $row['weight'];
    $gender = $row['gender'];
    $gl_b_breakfast = $row['gl_b_breakfast'];
    $gl_a_breakfast = $row['gl_a_breakfast'];
    $gl_b_lunch = $row['gl_b_lunch'];
    $gl_b_dinner = $row['gl_b_dinner'];
} else {
    echo "No data found for this patient.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
	    .content {
            padding-left: 20px;
        }
		
	
 
        .sidebar-sticky {
            padding-top: 20px;
            height: 100vh;
            background-color: #f8f9fa; 
        }
		
		.container-fluid {
            background: linear-gradient(to right, rgba(173, 216, 230, 0.6) 20%, rgba(255, 255, 255, 0.0) 80%);
        }

        .sidebar-sticky .nav-link {
            font-size: 15px;
            font-weight: bold;
            padding: 10px 20px;
            margin-bottom: 10px;
            color: #333;
            background-color: #fff;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar-sticky .nav-link:hover {
            background-color: #007bff;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-sticky .nav-link.active {
            background-color: #007bff;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-sticky .nav-link i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
					    <p class="space-between"></p>
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
						<p class="space-between"></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="update_patientprofile.php">
                            <i class="bi bi-person-fill"></i> Update Profile
                        </a>
						<p class="space-between"></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="verified_doctor_list.php">
                            <i class="bi bi-list-nested"></i> Doctor List
                        </a>
						<p class="space-between"></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_prescription.php">
                            <i class="bi bi-file-text-fill"></i> My Prescriptions
                        </a>
						<p class="space-between"></p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_appointment.php">
                            <i class="bi bi-calendar-check-fill"></i>Appointments
                        </a>
						<p class="space-between"></p>
                    </li>
					
					<li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i>Logout
                        </a>
						<p class="space-between"></p>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h2>Update Profile</h2>
            </div>
            <form action="update_patientprofile_process.php" method="POST"> 
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="<?php echo htmlspecialchars($weight); ?>">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gl_b_breakfast" class="form-label">Glucose Before Breakfast</label>
                    <input type="number" step="0.01" class="form-control" id="gl_b_breakfast" name="gl_b_breakfast" value="<?php echo htmlspecialchars($gl_b_breakfast); ?>">
                </div>
                <div class="mb-3">
                    <label for="gl_a_breakfast" class="form-label">Glucose After Breakfast</label>
                    <input type="number" step="0.01" class="form-control" id="gl_a_breakfast" name="gl_a_breakfast" value="<?php echo htmlspecialchars($gl_a_breakfast); ?>">
                </div>
                <div class="mb-3">
                    <label for="gl_b_lunch" class="form-label">Glucose Before Lunch</label>
                    <input type="number" step="0.01" class="form-control" id="gl_b_lunch" name="gl_b_lunch" value="<?php echo htmlspecialchars($gl_b_lunch); ?>">
                </div>
                <div class="mb-3">
                    <label for="gl_b_dinner" class="form-label">Glucose Before Dinner</label>
                    <input type="number" step="0.01" class="form-control" id="gl_b_dinner" name="gl_b_dinner" value="<?php echo htmlspecialchars($gl_b_dinner); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </main>
    </div>
</div>

</body>
</html>
