<?php
include 'C:\xampp\htdocs\project_ Diabetes Management and Appointment Booking System\dbconnect.php';
      
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>

</head>
<body>
    <div class="background">
        
    </div>
    <div class="login-box">
        <div class="login-header">
            <header>Diabetes Management and Appointment System </header>
        </div>
        <form action="login.php" method="post">
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username" name="username" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" name="password" required>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" placeholder="Email" name="email" required>
            </div>

            <div class="form-container">        
                <label for="user-role"></label>
                <div class="dropdown-container">
                    <select id="user-role" name="user" required>
                        <option value="" disabled selected>Login As</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Patient">Patient</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            <div class="input-submit">
                <!--<button class="submit-btn" name="login"></button> 
                <label for="submit">Login</label>    -->
				<input class="submit-btn" type="submit" name="login" value="Login">
            </div>
            <div class="sign-up-link">
                <p>Don't have an acount? <a href="registration.php">Signup</a></p>
            </div>
        </form>
        

    </div>

    
</body>
</html>
<?php   
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(!empty($_POST["username"]) &&
        !empty($_POST["password"]) && !empty($_POST["email"])){
            $_username=$_POST["username"];
            $_password=$_POST["password"] ;
            $_email=$_POST["email"];
            $type=$_POST["user"];
            
            
                
        if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])){
            echo"Credintials missing";
        }
        if($type == "Admin"){
			echo "$type";
            $_SESSION['name'] = $_username;
            $sql="SELECT *FROM `admin` WHERE password='$_password' AND email='$_email'";
            $result= mysqli_query($conn,$sql);

            if(mysqli_num_rows($result) == 1){

                header("Location: admin/admin.php");
            }
            else{
                echo"You are not authorized to enter.";
            }
        }

        elseif( $type=="Doctor"){
            $sql1="SELECT *FROM `doctor` where email = '$_email' AND  password='$_password' AND `name`='$_username'";
            $result1= mysqli_query($conn,$sql1);
            $row = mysqli_fetch_assoc($result1);
			

            if(mysqli_num_rows($result1) == 1){
                
                
                if($row['verified'] == 0){
                     echo "You are not verified as a Doctor yet";
                }
				
                else{
					$_SESSION['d_id'] = $row['d_id'];
                    header("Location: doctor/doctor_dashboard.php");    //Location
                }
            }
			else{
				echo "You are not registered as a Doctor. ";
			}
        }  
        elseif( $type=="Patient"){
            $sql2="SELECT *FROM `patient` where email = '$_email' AND  password='$_password' AND name='$_username'";
            $result2= mysqli_query($conn,$sql2);
            $row = mysqli_fetch_assoc($result2);
			
			

            if(mysqli_num_rows($result2) == 1){
                $_SESSION['p_id'] = $row['p_id'];
                header("Location: patient/dashboard.php");      

                }
            else{
                echo "Your credintials don't match.Please make sure you are registered or try again.";
            }
            }
        }
        
        
        
            
    }
    mysqli_close($conn);
?>

