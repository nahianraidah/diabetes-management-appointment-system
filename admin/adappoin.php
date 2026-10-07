<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            display: flex;
            min-height: 100vh;
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


        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #ecf0f1;
            width: 100%;
            flex: 1;
        }

        .appointment-table {
            background-color: white;
            border-radius: 8px;
            right: 50%;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        h1 {
            color: #2c3e50;
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
    </style>
</head>

<body>
    <div class="sidebar">
        <div>
            <a href="admin.php">Dashboard</a>
            <a href="addoc.php">Doctors</a>
            <a href="adverify.php">Verify</a>
            <a href="adappoin.php" class="active"> Appointments</a>
            <a href="../logout.php">Log Out</a>
        </div>
    </div>
    <div class="main-content">
        <h1>Appointments Dashboard</h1>

        <div class="appointment-table">
            <table>
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Doctor ID</th>
                        <th>Patient ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql4 = "SELECT * FROM `appointment`";
                        $result1 = mysqli_query($conn, $sql4);

                        if (mysqli_num_rows($result1) > 0) {

                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo "<tr>";
                                echo "<td>" . $row['app_id'] . "</td>";
                                echo "<td>" . $row['d_id'] . "</td>";
                                echo "<td>" . $row['p_id'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                if($row['checked'] == 0){
                                    echo "<td> Not Checked </td>";
                                }
                                else{
                                    echo "<td>  Checked </td>";
                                }
                                
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        &copy; 2024 DMS
    </footer>

    <?php



    mysqli_close($conn);
    ?>
</body>

</html>