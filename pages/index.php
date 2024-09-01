<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="../css/login.css?V=p<?php echo time(); ?>">
	<style>
		body {
			background-color: #f1f1f1;
			font-family: Arial, sans-serif;
		}

		.container {
			max-width: 400px;
			margin: 0 auto;
			padding: 20px;
			background-color: #green;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			text-align: center;
			margin-top: 1px;
		}

		.loginHeader h3 {
			color: #333;
			font-size: 24px;
			margin: 10px 0;
		}

		.loginBody form div {
			margin-bottom: 20px;
		}

		.loginBody label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
			color: #555;
		}

		.loginBody input[type="text"],
		.loginBody input[type="password"] {
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}

		.loginBody .login {
			display: flex;
			justify-content: justify;
		}

		.loginBody .login button {
			width: 60%;
			padding: 10px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-weight: bold;
		}

		.loginBody .login button:hover {
			background-color: #45a049;
		}

		.loginBody a {
			color: #red;
			margin-top: 10px;
			display: block;
			text-decoration: none;
		}

		.loginBody a:hover {
			color: #333;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="loginHeader">
			<h3>Cybercafe Reservation System</h3>
			<h3>Log In</h3>
		</div>
		<div class="loginBody">
			<form action="login.php" method="POST">
				<div>
					<label for="">Username</label>
					<input type="text" name="un" autocomplete="off" placeholder="Enter your username" />
				</div>
				<div>
					<label for="">Password</label>
					<input type="password" name="pass" placeholder="Enter your password" />
				</div>
				<div class="login">
					<button>Login</button>
				</div>
				<a href="#">Forgot password?</a>
				<a href="create_acc.php">Create account</a>
			</form>
		</div>
	</div>
</body>
</html>
