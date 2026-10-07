<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';
session_start();

if (!isset($_SESSION['p_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
exit();
}
$p_id = $_SESSION['p_id'];


// Fetching prescription details for the logged-in patient
$sql = "SELECT pres_id, d_id, detail, date 
        FROM prescription WHERE p_id = '$p_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Prescriptions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: linear-gradient(to right, rgba(211, 211, 211, 0.5) 2%, rgba(255, 255, 255, 0.0) 98%);
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
	
	
	
	    /* Add smooth transition for both transform and background-color */
        .card {
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        /* Bump-up and scale effect on hover */
		/* Bumps up and increases size by 5% */
        .card:hover {
            transform: scale(1.05); 
        }

        /* Change background color on hover */
        .card:hover .card-body {
            background-color: rgba(0, 123, 255, 0.1); 
        }
		
		/* Increase space between paragraphs */
        .space-between {
            margin-bottom: 20px; 
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
                        <a class="nav-link" href="update_patientprofile.php">
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
                        <a class="nav-link active" href="my_prescription.php">
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
                <h1 class="text-center my-4">My Prescriptions</h1>
            </div>
  
            <?php
            if ($result->num_rows > 0) {
                // Loop throuugh each row of prescription table
                while($row = $result->fetch_assoc()) {
                    // Fetch doctor name based on d_id
                    $d_id = $row['d_id'];
                    $d_sql = "SELECT name FROM doctor WHERE d_id = '$d_id'";
                    $d_result = $conn->query($d_sql);
                    $d_name = $d_result->num_rows > 0 ? $d_result->fetch_assoc()['name'] : 'Unknown Doctor';
				
				
				    echo '
                        <div class="card mb-3">
                            <div class="card-body">
                            <h5 class="card-title">Prescription ID: ' . $row["pres_id"] . '</h5>
						    <p class="space-between"></p>
                            <p class="card-text"> <strong>Prescribed By    :</strong> ' . $d_name . '</p>
                            <p class="card-text">Prescribed On    : ' . $row["date"] . '</p>
                            <p class="space-between"></p>
						    <p class="space-between"></p>
                            <p class="card-text"> <strong>Prescription Details:</strong> </p>
						    <p class="card-text">' . $row["detail"] . '</p>
					</div>
                </div>';
            }
        } else {
            echo "<p>No Prescription found.</p>";
        }
        $conn->close();
        ?>
		</main>
    </div>
</div>

    <!-- Bootstrap JS (optional for responsiveness) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
