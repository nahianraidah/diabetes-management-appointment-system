<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';


session_start();
$name = $_SESSION['name'];



$sql = "SELECT COUNT(*) AS pending_count FROM `doctor` WHERE verified = '0'";
$result = mysqli_query($conn, $sql);


if ($result) {
    $row = $result->fetch_assoc();
    $pendingCount = $row['pending_count'];
} else {
    $pendingCount = 0;
}

$sql2="SELECT COUNT(*) AS pending_app FROM appointment WHERE DATE(date) = CURDATE()";
$result2=mysqli_query($conn,$sql2);


if ($result2) {
    $row2= $result2->fetch_assoc();
    $pendingapp = $row2['pending_app'];
} else {
    $pendingapp = 0;
}



date_default_timezone_set('Asia/Dhaka');
$timestamp = date('Y-m-d H:i:s');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <a href="admin.php" class="active">Dashboard</a>
            <a href="addoc.php">Doctors</a>
            <a href="adverify.php">Verify</a>
            <a href="adappoin.php">Appointments</a>
            <a href="../logout.php">Log Out</a>
        </div>
    </div>

    <div class="content">
        <h1>Welcome <?php echo "$name"; ?></h1>
        <p>Here you can manage doctors, verify users, and view appointments.</p>

        Logged In :
        <?php echo " $timestamp";      ?>
        <p>Number of Appointments made on the day: <?php echo $pendingapp ; ?></p>
        <p>Number of pending verifications: <?php echo $pendingCount; ?></p>



    </div>

    
    

    </body>

</html>