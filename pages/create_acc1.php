<?php
	include "../includes/conn.php";

	$un = $_POST['un'];
	$pass = $_POST['pass'];

	mysqli_query($conn,"INSERT INTO user
                        (userid, username, password)
                        VALUES (NULL, '{$un}', '{$pass}')");

	header('location:index.php');

?>