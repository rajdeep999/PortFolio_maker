<html>
<body>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$firstname = $_POST["firstname"];
$email = $_POST["email"];
$pass = $_POST['password'];
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO User (firstname, lastname, email, password)
VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."','".$_POST["password"]."')";

if ($conn->query($sql) === TRUE){
	$sql = "select id from user where email = '$email'";
	$result = mysqli_query($conn,$sql);
	$row = $result->fetch_assoc();
	$_SESSION["userid"] = $row['id'];
	$_SESSION["email"] = $email;
	$_SESSION["password"] = $pass;

    echo "<script> window.location.assign('portfolio.php'); </script>";
}
else {
    echo "<script> alert('Account already exist.'); window.location.assign('index.html'); </script>";
}

$conn->close();
?>
</body>
</html>