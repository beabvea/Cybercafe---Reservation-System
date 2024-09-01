<?php
	include "../includes/conn.php";

	$computerNumber = $_POST['computer-number'];
	$computerType = $_POST['computer-type'];
	$computerDescription = $_POST['computer-description'];

	mysqli_query($conn, "INSERT INTO computers (computer_id, comp_number, comp_type, comp_desc)
	                    VALUES (NULL, {$computerNumber}, '{$computerType}', '{$computerDescription}')");

	header('location: computer.php');
?>
