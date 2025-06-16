<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "capstone_db";

//connection
$conn = new mysqli($hostname, $username, $password, $dbname);
if($conn ->connect_error){
	die("Connection Failed: ".$conn->connect_error);
}
// else{
// 	echo "<script>alert('Successfully Connected.')</script>";
// }

?>