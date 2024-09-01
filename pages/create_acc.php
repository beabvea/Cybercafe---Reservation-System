<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Login </title>

	<link rel="stylesheet" type="text/css" href="../css/login.css?V=1.3">
</head>
<body>
	<div class="container">
		<div class="loginHeader">
			<h1></h1>
			<h3>Cybercafe Management System</h3>
			<h3>Create Account</h3>
		</div>
		<div class="loginBody">
			<form action="create_acc1.php" method="POST">
				<div>
					<label for="">Username</label>
					<input type="text" name="un" />
				</div>
				<div>
					<label for="">Password</label>
					<input type="password" name="pass" />
				</div>
			<div class="login">
				<button>Submit</button>
			</div>
			</form>
		</div>
	</div>
</body>
</html>