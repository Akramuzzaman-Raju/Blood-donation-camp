
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="">
</head>
<body>
	
	<h1>Please Login to Continue</h1>
	<form action="loginaction.php" method="POST" novalidate >
		
			<label for="username">Username:</label>
			<input type="text" name="username" id="username"  >
			<br><br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" >
			<br><br>
			<input type="submit" name="login" value="Login">
		
		<br>
		<P>New here?</P>
		<a href="registration.php"><input type="button" name="Registerbtn" value="Sign-up"></a>
		</a>
		<br>
		<br>
		
		<a href="forgotpassword.php"><input type="button" name="forgotp" value="Forgot password"></a>
		</a>
	</form>
</body>
<?php include('footer.php');?>
</html>

	