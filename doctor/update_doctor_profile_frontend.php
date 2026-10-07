<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';


session_start();

$d_id = $_SESSION['d_id']; 

$query = "SELECT * FROM doctor WHERE d_id = $d_id";

$result = $conn->query($query);
$doctor = $result->fetch_assoc(); // Fetch the doctor's data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Update Profile</h2>
		

        <form action="update_doctor_profile_backend.php" method="POST">
            <!-- doc id -cant be edited -->
            <div class="mb-3">
                <label for="d_id" class="form-label">Doctor ID</label>
                <input type="text" class="form-control" id="d_id" name="d_id" value="<?php echo $doctor['d_id']; ?>" readonly>
            </div>

            <!-- doc name -cant be edited -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $doctor['name']; ?>" readonly>
            </div>

            <!-- doc email -cant edit -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $doctor['email']; ?>" readonly>
            </div>

            <!-- doc designation -can edit -->
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo htmlspecialchars($doctor['designation']); ?>" required>
            </div>

            <!-- phone -can edit -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($doctor['phone']); ?>" required>
            </div>

            <!-- loc -can edit -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($doctor['location']); ?>" required>
            </div>

            <!--submit button -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
			
			<!--"Go Back to Dashboard" button -->
            <div class="mb-3 mt-5 text-center">
              <a href="doctor_dashboard.php" class="btn btn-secondary">Go Back to Dashboard</a>
            </div>
		
        </form>
    </div>
</body>
</html>
