
<?php
$username = $mobile = $inval ='';

if ($_SERVER['REQUEST_METHOD'] === "POST"){
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$username = test_input($_POST['username']);
	$mobile = test_input($_POST['mobileno']);
	

	$filename = 'data.json';
	$data = file_get_contents($filename);
	$users = json_decode($data);

	foreach ($users as $user) {
		if ($username == $user-> username && $mobile == $user -> mobile ){
			session_start();
			$_SESSION['username'] = $username;
			header("Location: homepage.php");
		}
	}
	$inval= "Empty or Not Valid";

}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forgot Password</title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
		<fieldset>
			<legend>Confirm Your Information</legend>
			<label for="uname">Username</label>
			<input type="text" autocomplete="on" name="username" id="username" value="<?php echo $username; ?>"><br><br>

			<label for="mobileno">Mobile No</label>
			<input type="number" name="mobileno" id="mobileno" value="<?php echo $firstname; ?>"><br><br>


			
		</fieldset>
		<input type="submit" name="submit" value="Enter">
		<p>
			<?php echo $inval; ?>
		</p>
	</form>
</body>
</html>