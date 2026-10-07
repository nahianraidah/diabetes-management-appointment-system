<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';

session_start();



if (isset($_POST['action']) && isset($_POST['d_id'])) {
    $d_id = $_POST['d_id'];
    $action = $_POST['action'];

   
    if ($action == 'Confirm') {
        $sql6 = "UPDATE doctor SET verified = 1 WHERE d_id = " . $d_id;
    } elseif ($action == 'Cancel') {
        $sql6 = "UPDATE doctor SET verified = 2 WHERE d_id = " . $d_id;
    }

    
    if (mysqli_query($conn, $sql6)) {
       
        header("Location: adverify.php#doctor$d_id");
        exit();  
    } else {
        echo "Error updating doctor status: " . mysqli_error($conn);
    }
}


$sql5 = "SELECT * FROM `doctor`";
$result2 = mysqli_query($conn, $sql5);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Verification</title>
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

        .doctor-block {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .doctor-info {
            width: 70%;
        }

        .doctor-info h2 {
            margin: 0;
            color: #34495e;
        }

        .doctor-info p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        .status {
            font-size: 16px;
            color: green;
            display: none;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .buttons .confirm-btn {
            background-color: #2ecc71;
            color: white;
        }

        .buttons .cancel-btn {
            background-color: #e74c3c;
            color: white;
        }

        .buttons button:hover {
            opacity: 0.9;
        }

        .confirmed {
            color: #27ae60;
            font-weight: bold;
            font-size: 16px;
        }

        .cancelled {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div>
            <a href="admin.php">Dashboard</a>
            <a href="addoc.php">Doctors</a>
            <a href="adverify.php" class="active">Verify</a>
            <a href="adappoin.php">Appointments</a>
            <a href="../logout.php">Log Out</a>
        </div>
    </div>

    <div class="content">
        <h1>Verify Doctors</h1>

        <?php
        if (mysqli_num_rows($result2) > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                echo "<div class='doctor-block' id='doctor{$row1['d_id']}'>
                        <div class='doctor-info'>
                            <h2>{$row1['name']}";

               
                if ($row1['verified'] == 1) {
                    echo " <span class='confirmed'>(Verified)</span>";
                }
                echo "</h2>
                            <p><strong>Designation:</strong> {$row1['designation']}</p>
                            <p><strong>Email:</strong> {$row1['email']}</p>
                        </div>";

                
                if ($row1['verified'] == 0) {
                    echo "<div class='buttons' id='buttons{$row1['d_id']}'>
                            <form action='adverify.php#doctor{$row1['d_id']}' method='post'>      
                                <input type='hidden' name='d_id' value='{$row1['d_id']}'>
                                <button class='confirm-btn' name='action' value='Confirm' type='submit'>Confirm</button>
                                <button class='cancel-btn' name='action' value='Cancel' type='submit'>Cancel</button>
                            </form>
                          </div>";
                } elseif ($row1['verified'] == 1) {
                    echo "<div class='confirmed'>Verified</div>";
                } elseif ($row1['verified'] == 2) {
                    echo "<div class='cancelled'>Cancelled</div>";
                }

                echo "</div>";  
            }
        } else {
            echo "<p>No doctors pending verification.</p>";
        }
        ?>
    </div>
    <script>
        window.onload = function() {
            
            const hash = window.location.hash;
            if (hash) {
                const element = document.querySelector(hash);
                if (element) {
                    
                    element.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        };
    </script>


</body>

</html>