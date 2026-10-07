<?php

include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();
$d_id = $_SESSION['d_id']; 

$sql = "SELECT name FROM doctor WHERE d_id = '$d_id'"; //name for "welcome"
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$name = $data['name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar-sticky {
            padding-top: 20px;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar-sticky .nav-link {
            font-size: 16px;
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

        .main-content {
            background-color: rgba(0, 123, 255, 0.1); /* Light transparent blue */
            padding: 20px;
        }

        .white-box {
            background-color: white;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_doctor_profile_frontend.php">
                            <i class="bi bi-person-fill"></i> Update Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_appointments.php">
                            <i class="bi bi-calendar-check-fill"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor_prescription.php">
                            <i class="bi bi-file-text-fill"></i> Write Prescription
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- page content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Welcome, Dr. <?= $name; ?></h1>
				<p class="doctor-id text-center">Your ID: <?= $d_id; ?></p> <!-- doc ID in a corner -->
            </div>

            <!-- instructions -->
            <div class="main-content">
                <h4>How to Use This Dashboard</h4>
                <ul>
                    <li>Update your profile from the "Update Profile" section.</li>
                    <li>View and manage your appointments under "Appointments".</li>
                    <li>Write patient prescriptions under "Write Prescription".</li>
                    <li>Logout when you're done.</li>
                </ul>
            </div>
        </main>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
