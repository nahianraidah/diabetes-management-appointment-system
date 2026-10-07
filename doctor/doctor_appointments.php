<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        
        /* table making */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
        }
        
        
        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: center; /* Centers the contents of table cells */
        }

        /* table header */
        th {
            background-color: #f2f2f2;
        }
        
        /* Styling form buttons */
        form button {
            margin: 2px;
        }
    </style>
</head>



<body>     
    <div class="container mt-4">
        <h2 class="mb-4">Doctor Appointments</h2>

<?php
//fetching the appointments for the particular doctor in the frontend

include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';



session_start();

$d_id = $_SESSION['d_id'];

//the appointment table that the doctor will view will not have the rows that have been cancelled and the ones that have already been checked
//using JOIN to get info of that patient id
$query = "SELECT appointment.*, patient.name, patient.weight, patient.gender, patient.dob, patient.gl_b_breakfast, gl_a_breakfast, gl_b_lunch, gl_b_dinner 
          FROM appointment
          JOIN patient ON appointment.p_id = patient.p_id
          WHERE appointment.d_id = $d_id 
          AND (appointment.confirmation = 0 OR appointment.confirmation = 1) 
          AND appointment.checked = 0";

$result = $conn->query($query);

function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime('today');
    $age = $dob->diff($today)->y; //y-years
    return $age;
}

//$result_num_rows has to be greater than 0 otherwise doc has no appointment
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>                
                <th>Appointment ID</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Weight (kg)</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Glucose Before Breakfast</th>
                <th>Glucose After Breakfast</th>
                <th>Glucose Before Lunch</th>
                <th>Glucose Before Dinner</th>
                <th>Day</th>
                <th>Time</th>
                <th>Confirmed</th>
                <th>Checked</th>
				</tr>";
	
// fetching data from each row
while ($row = $result->fetch_assoc()) { //result has the sql query
	echo "<tr>";
	    echo "<td>" . $row['app_id'] . "</td>";
        echo "<td>" . $row['p_id'] . "</td>";  // Patient ID
        echo "<td>" . $row['name'] . "</td>";  // Patient name
    	echo "<td>" . $row['weight'] . " kg</td>";  // Patient Weight
        echo "<td>" . $row['gender'] . "</td>";  

        $age = calculateAge($row['dob']); 
        echo "<td>" . $age . "</td>";  
        echo "<td>" . $row['gl_b_breakfast'] . " mg/dL</td>";  // Glucose Before Breakfast
        echo "<td>" . $row['gl_a_breakfast'] . " mg/dL</td>";  // Glucose After Breakfast
        echo "<td>" . $row['gl_b_lunch'] . " mg/dL</td>";  // Glucose Before Lunch
        echo "<td>" . $row['gl_b_dinner'] . " mg/dL</td>";  // Glucose Before Dinner

        echo "<td>" . $row['date'] . "</td>";   // Appointment Date
        echo "<td>" . $row['time'] . "</td>";   // Appointment Time

        // Display status based on the 'confirmation' value, with action buttons in the same column
        echo "<td>";
        if ($row['confirmation'] == 0) {
            echo "<button type='button' class='btn btn-warning' disabled>Pending</button><br>"; //pending button has no action bc disabled
            echo "<form action='update_doctor_appointment.php' method='post'>
                    <input type='hidden' name='app_id' value='" . $row['app_id'] . "' />
                    <button type='submit' name='action' value='Confirm' class='btn btn-primary btn-sm'>Confirm</button>
                    <button type='submit' name='action' value='Cancel' class='btn btn-primary btn-sm'>Cancel</button>
                  </form>";
        } elseif ($row['confirmation'] == 1) {
            echo "<button type='button' class='btn btn-success'>Confirmed</button>";
        } elseif ($row['confirmation'] == 2) {
            echo "<button type='button' class='btn btn-secondary'>Cancelled</button>";
        }
        echo "</td>";
            

		// Display the "Mark as checked" button under "checked" column only if the appointment is confirmed (confirmation == 1)
		echo "<td>";
        if ($row['confirmation'] == 1) {
			echo "<form action='update_doctor_appointment.php' method='post'>
					<input type='hidden' name='app_id' value='" . $row['app_id'] . "' />
					<button type='submit' name='action' value='Checked' class='btn btn-primary btn-sm'>Mark as checked</button>
				  </form>";
		} else {
            echo "<button type='button' class='btn btn-secondary' disabled>Not Confirmed</button>";
        }
		echo "</td>";

      echo "</tr>";
    }
	
    echo "</table>";

} else {
    echo "No appointments found";
}


$conn->close();
?>

    
  <div class="mb-3 mt-5 text-center">
            <a href="doctor_dashboard.php" class="btn btn-secondary">Go Back to Dashboard</a>
  </div>  
		
</body>
</html>