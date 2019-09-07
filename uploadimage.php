<?php 
session_start();
?>
<?php
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "test";

		$conn = new mysqli($servername, $username, $password, $dbname);
        $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
		$userid = $_SESSION['userid'];
		$hashtag = $_POST['hashtag'];
		$imgprop = $imageProperties['mime'];
		
		$sql = "INSERT INTO image(user_id, hashtag, imagetype, image) VALUES($userid, '$hashtag', '$imgprop', '$imgData')";

        $current_id = mysqli_query($conn, $sql);
        if ($current_id) {
            echo "<script> window.location.assign('portfolio.php'); </script>";
        }

    }
}
?>