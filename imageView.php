<?php
    require_once "db.php";
    if(isset($_GET['image_id'])) {
        $sql = "SELECT imagetype, image FROM image WHERE id=" . $_GET['image_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imagetype"]);
        echo $row["image"];
	}
	mysqli_close($conn);
?>