<?php
	$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error($conn));
	mysqli_select_db($conn,"cybercafe_management_system") or die(mysqli_error($conn));
?>