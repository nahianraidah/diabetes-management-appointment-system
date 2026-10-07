<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="registration.css">
	<title>Diabetes Management and Appointment System </title>
	<link rel="stylesheet" href="registration.css">
</head>

<body>
	<div class="background">

	</div>

	<div class="login-box">
		<div class="login-header">
			<header>Diabetes Management and Appointment System</header>
		</div>
		<form action="registration.php" method="post">
			<div class="input-box">
				<input class="input-field" type="text" name="username" placeholder="Enter your username" required> <br>
			</div>
			<!-- Password on off part  -->
			<div class="input-box password-wrapper">
				<input class="input-field" type="password" id="password" name="password" placeholder="Enter your password" required>
				<i class="toggle-password" onclick="togglePassword()">👁️</i> <!-- Eye icon -->
			</div>

			<div class="input-box">
				<input class="input-field" type="email" name="email" placeholder="Enter your email" required> <br>
			</div>

			<div class="dropdown-container">
				<select name="user" id="user" required>
					<option value="" disabled selected>Register As</option>
					<option value="Doctor">Doctor</option>
					<option value="Patient">Patient</option>
					
				</select>
			</div>
   
   
			<div class="input-submit">
				<input class="submit-btn" type="submit" name="register" value="Register">
				
			</div>
		</form>

		<div class="sign-up-link">
			Already have an account? <a href="login.php">Login </a>
		</div>
	</div>




	<script>
		function togglePassword() {
			const passwordField = document.getElementById("password");
			const icon = document.querySelector(".toggle-password");
			if (passwordField.type === "password") {
				passwordField.type = "text"; // Show password
				icon.textContent = "🙈"; // Change eye icon to "closed-eye"
			} else {
				passwordField.type = "password"; // Hide password
				icon.textContent = "👁️"; // Change back to "eye" icon
			}
		}
	</script>


</body>

</html>
<?php
session_start();
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_POST['user'])) {
	$user = $_POST["user"];
	$_SESSION['user_type'] = $user;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {


	if (empty($username)) {
		echo "Your Username is missing.";
	} elseif (empty($password)) {
		echo "Your Password is missing.";
	} elseif (empty($email)) {
		echo "Your Email address is empty.";
	} elseif (empty($_POST["user"])) {
		echo "You need to fill this field.";
	} else {
		if ($_POST["user"] == "Doctor") {

			//$hash=password_hash($password,PASSWORD_DEFAULT);           //Will give hash in real life use.
			$check1 = "SELECT *FROM `doctor`WHERE Email='$email' AND name='$username' AND password='$password'";
			$result1 = mysqli_query($conn, $check1);

			if (mysqli_num_rows($result1) == 1) {
				echo "The User is already registered. Please Login or register with another email.";
				exit();
			} else {

				$sql1 = "INSERT INTO `doctor`(`password`,`email`,`name`,`verified`) VALUES('$password','$email','$username','0')";
				mysqli_query($conn, $sql1);
				echo "You are Successfully Registered.";
				header("Location: login.php");        //Location
			}
		} elseif ($_POST["user"] == "Patient") {

			$check2 = "SELECT *FROM `patient`WHERE Email='$email' AND name='$username'AND password='$password'";
			$result2 = mysqli_query($conn, $check2);
		}
		
		if (mysqli_num_rows($result2) == 1) {
			echo "There is User is already registered. Please Login or register with another email.";
			exit();
		} else {

			$sql2 = "INSERT INTO `patient`(`password`,`email`,`name`) VALUES('$password','$email','$username')";
			mysqli_query($conn, $sql2);
			echo "You are Successfully Registered.";
			header("Location: login.php");   
		}
	}
}
if (isset($_POST['login'])) {
	header("Location: login.php");
}
mysqli_close($conn);
?>