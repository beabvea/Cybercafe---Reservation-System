<?php
	include "../includes/conn.php";

	$name = $_POST['username'];
	$pass = $_POST['password'];
	$bal = $_POST['balance'];
	$birth = $_POST['birthdate'];
	$contact_num = $_POST['contact-number'];

	mysqli_query($conn, "INSERT INTO customer (customer_id, username, password, balance, birthdate, contact_number)
	                    VALUES (NULL, '{$name}', '{$pass}', {$bal}, '{$birth}', '{$contact_num}')");

	header('location: users.php');
?>
