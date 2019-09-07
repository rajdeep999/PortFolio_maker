<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$email = $_POST["email"];
$pass = $_POST["password"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//if(!empty($_SESSION['email']) && !empty($_SESSION['password'])  && !empty($_SESSION['userid'])){
$sql = "SELECT * FROM user WHERE email='$email' AND password='$pass'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)) {
	$row =  $result->fetch_assoc();
	$_SESSION["userid"] = $row['id'];
	$_SESSION["email"] = $email;
	$_SESSION["password"] = $pass;
	echo "<script> window.location.assign('portfolio.php'); </script>";
}
else{
	echo "<script> alert('Account does not exist.'); window.location.assign('index.html'); </script>";
}
$conn->close();
?>