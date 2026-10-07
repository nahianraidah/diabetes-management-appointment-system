<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();

if (!isset($_SESSION['p_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
exit();
}

$p_id = $_SESSION['p_id']; 


// Fetching patient info for showcasing on dashboard
$p_sql = "SELECT name, gl_b_breakfast, gl_a_breakfast, gl_b_lunch, gl_b_dinner, updated_on 
          FROM patient WHERE p_id = '$p_id'";
$p_result = $conn->query($p_sql);
$p_data = $p_result->fetch_assoc();
$name = $p_data['name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
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

        .card-body-custom {
            background-color: rgba(0, 123, 255, 0.1); /* Light transparent blue */
        }

        .bar-chart-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .chart-wrapper {
            width: 70%;
        }

        .last-updated {
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            width: 30%;
            text-align: center;
            font-weight: bold;
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
					    <p class="space-between"></p>
                        <a class="nav-link active" href="#">
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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Welcome, <?= $name; ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <p class="patient-id text-center"><strong>Your ID: <?= $p_id; ?> </strong></p> 
                </div>
            </div>

            <!-- Directionaries for this website -->
            <div class="card mb-3">
                <div class="card-body card-body-custom">
                    <h4>How to use this website:</h4>
                    <ul>
                        <li>Update your profile from the "Update Profile" section.</li>
                        <li>You need to fulfill your glucose level portion and the whole profile to make a succesful appointment</li>
                        <li>Use glucometer to measure your glucose level 4 times before your appointment day.</li>
                        <li>4 times : before breakfast, after breakfast, before lunch, before dinner</li>
						<li><a href="https://www.apollo247.com/blog/article/how-to-use-a-glucose-monitor">Step by step guidance to use a glucometer</a></li>
                    </ul>
                </div>
            </div>

            <!-- Glucose Levels Bar Chart -->
            <div class="bar-chart-container">
                <div class="chart-wrapper">
                    <canvas id="glucoseChart"></canvas>
                </div>
                <div class="last-updated">
                    Last Updated: <?php echo $p_data['updated_on']; ?>  
                </div>
            </div>
        </main>
    </div>
</div>

<!-- JavaScript for Bar Chart -->
<script>
    var ctx = document.getElementById('glucoseChart').getContext('2d');
    var glucoseChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Before Breakfast', 'After Breakfast', 'Before Lunch', 'Before Dinner'],
            datasets: [{
                label: 'Glucose Levels (mmol/L)',
                data: [
                    <?= $p_data['gl_b_breakfast']; ?>,
                    <?= $p_data['gl_a_breakfast']; ?>,
                    <?= $p_data['gl_b_lunch']; ?>,
                    <?= $p_data['gl_b_dinner']; ?>
                ],
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0'
                ],
                borderColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0'
                ],
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `Glucose Level: ${tooltipItem.raw} mmol/L`;
                        }
                    }
                },
                annotation: {
                    annotations: {
                        line1: {
                            type: 'line',
                            borderColor: 'red',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            value: 7, // Standard glucose level
                            scaleID: 'y',
                            label: {
                                content: 'Standard Level (7 mmol/L)',
                                enabled: true,
                                position: 'center'
                            }
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 30,
                    ticks: {
                        stepSize: 5,
                        callback: function(value) {
                            return value + ' mmol/L';
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>

<?php $conn->close(); ?>
