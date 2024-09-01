<?php 
session_start(); 
include "../includes/conn.php";

if (isset($_POST['un']) && isset($_POST['pass'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$un = validate($_POST['un']);
	$pass = validate($_POST['pass']);

    $sql = "SELECT * FROM user WHERE username='$un' AND password='$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $un && $row['password'] === $pass) {
            $_SESSION['un'] = $row['username'];
            $_SESSION['pass'] = $row['password'];
            $_SESSION['id'] = $row['userid'];
            header("Location: home.php");
            exit();
        }else{
            header("Location: index.php?error=user not found");
            exit();
        }
    }else{
        header("Location: index.php?error=user not found");
        exit();
}
	
}else{
	header("Location: index.php");
	exit();
}