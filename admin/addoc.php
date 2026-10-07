<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';


$doctors = [];
$sql = "SELECT * FROM doctor"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            /* font-family: Arial, sans-serif; */
            font-family: var(--bs-body-font-family);
            display: flex;
            min-height: 100vh;
            background-color: #ecf0f1;

        }



        .sidebar {
            background-color: #f7f9fc;
            /* Light background */
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            color: #34495e;
            display: block;
            font-size: 16px;
            border-radius: 10px;
            margin: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Active tab (dashboard) style */
        .sidebar a.active {
            background-color: #007bff;
            /* Blue highlight */
            color: white;
            /* White text */
            font-weight: bold;
        }

        /* Hover style for other tabs */
        .sidebar a:hover {
            background-color: #007bff;
            /* White background on hover */
            color: white;
            /* Blue text */
            border: 1px solid #007bff;
            /* Blue border on hover */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #ecf0f1;
            width: 100%;
            flex: 1;
        }

        h1 {
            color: #2c3e50;
        }

        .doctor-blocks {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .doctor-block {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 40px);
            box-sizing: border-box;
            transition: transform 0.3s;
            /* Added word wrapping properties */
            word-wrap: break-word; /* Ensures long text breaks onto the next line */
            overflow-wrap: break-word;
        }

        .doctor-block:hover {
            transform: scale(1.05);
        }

        .doctor-block h2 {
            margin: 0 0 10px;
            color: #34495e;
        }

        .doctor-block p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        footer {
            padding: 10px;
            text-align: center;
            background-color: #34495e;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .doctor-block {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 480px) {
            .doctor-block {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div>
            <a href="admin.php">Dashboard</a>
            <a href="addoc.php" class="active">Doctors</a>
            <a href="adverify.php">Verify</a>
            <a href="adappoin.php">Appointments</a>
            <a href="../logout.php">Log Out</a>
        </div>
    </div>

    <div class="content">
        <h2>Doctors</h2>

  
        <div class="doctor-blocks">
            <?php foreach ($doctors as $doctor): ?>
                <div class="doctor-block">
                    <h2>Name: <?php echo htmlspecialchars($doctor['name']); ?></h2>
                    <p><strong>Designation:</strong> <?php echo htmlspecialchars($doctor['designation']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($doctor['email']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
    </div>

    <footer>
        &copy; 2024 Manage Doctors
    </footer>

</body>

</html>
