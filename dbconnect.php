<?php
$servername="localhost";
$username="root";
$password="";
$dbname="dms";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
	die("Not connected");
}
?>