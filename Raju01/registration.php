<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<style>
		#filename {
			position: relative;
			top: 20px;
			left: 300px;
			font-weight: bolder;
		}
	</style>
</head>
<body>

	<?php 
	
		$firstname = "";
		$firstnameErrMsg = "";
		$lastname="";
		$lastnameErrMsg="";
		$gender="";
		$genderErrMsg="";
		$email="";
		$emailErrMsg="";
		$address="";
		$addressErrMsg="";
		$cntry="";
		$mobileErrMsg="";
		$mobileno="";
		$username="";
		$usernameErrMsg="";
		$password="";
		$passwordErrMsg="";
		$arr1=array();
        $d=array();
		if ($_SERVER['REQUEST_METHOD'] === "POST") {

			function test_input($data) {
				$data = htmlspecialchars($data);
				return $data;
			}	
			$flag=0;
			$firstname = test_input($_POST['firstname']);
			$lastname = test_input($_POST['lastname']);
			$gender = isset($_POST['gender']) ? test_input($_POST['gender']) : "";
			$email = test_input($_POST['email']);
			$mobileno = test_input($_POST['mobileno']);
			$address = test_input($_POST['address']);
			$country = isset($_POST['country']) ? test_input($_POST['country']) : "";
			$username = test_input($_POST['username']);
			$password = test_input($_POST['password']);

			$message = "";
			if (empty($firstname)) {
				$firstnameErrMsg = "First Name is Empty";
				$flag=1;
			}
			else {
				if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
				$firstnameErrMsg = "Only letters and spaces allowed.";
				$flag=1;
				}
			}
			if (empty($lastname)) {
				$lastnameErrMsg= "Last Name is Empty";
				$flag=1;
				
			}

			else {
				if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
				$lastnameErrMsg = "Only letters and spaces allowed.";
				$flag=1;
				}
			}


			if (empty($username)) {
				$usernameErrMsg= "Username is Empty";
				$flag=1;
				
			}

			else {
				$flag=0;
			}

			if (empty($password)) {
				$passwordErrMsg= "Password is not set";
				$flag=1;
				
			}

			else {
				$flag=0;
			}


			if (empty($gender)) {
				$genderErrMsg="  Gender is not selected ";
				$flag=1;

			}
			
			if (empty($email)) {
				$emailErrMsg="Email is empty";
				$flag=1;
			}
			else {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErrMsg= "Please correct email.";
					$flag=1;
					
				}
			}
			if (empty($mobileno)) {
				$mobileErrMsg= "Mobile no is Empty";
				$flag=1;
				
			}
			 else 
			 {
				 if(!preg_match("/^[0-9]{11}+$/", $mobileno))
			{
				$mobileErrMsg="Invalid Phone Number";
				$flag=1;
			}
		}

			if (empty($address)) {
				$addr= "Address  is Empty";
				$flag=1;
				
			}
			if (!isset($country) or empty($country)) {
				$cntry= "Country not Seletect";
				$flag=1;
				
			}

			if($flag===0) {
				echo "Registration Successful";
				echo "<br>";

				$arr=array('firstname'=> $firstname,'lastname'=>$lastname,'gender'=>$gender,'email'=>$email,'mobile'=>$mobileno,'address'=>$address,'country'=>$country,'username'=>$username,'password'=>$password);
				$dataFile=fopen("data.json",'r');
				$fileRead=fread($dataFile,filesize("data.json"));
				
                $arr1=json_decode($fileRead);
				fclose($dataFile);
				$dataFile=fopen("data.json",'w');
				if($arr1===NULL)
				{
					$arr=array($arr);
					$arr=json_encode($arr);
				}
				else{
					$arr1[]=$arr;
					$arr=json_encode($arr1);
				}
				$dataFile=fwrite($dataFile,$arr);
				fclose($dataFile);

			}
			if($flag===1) {
				echo "Registration Failed";
			}
			
		
		}

	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
		<fieldset>
			<legend>General</legend>

			<label for="fname">First Name</label>
			<input type="text" name="firstname" id="fname" value="<?php echo $firstname; ?>">

			<span><?php echo $firstnameErrMsg; ?></span>

			<br><br>

			<label for="lname">Last Name</label>
			<input type="text" name="lastname" id="lname" value="<?php echo $lastname; ?>" >
			<span><?php echo $lastnameErrMsg; ?></span>


			<br><br><br>

			<label>Gender</label>
			<input type="radio" name="gender" id="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>
			value="male">
			<label for="male">Male</label>
			<input type="radio" name="gender" id="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>
			value="female">
			<label for="female">Female</label>
		
			<span><?php echo $genderErrMsg; ?></span>

			
			<br><br><br>

			

		</fieldset>


		<fieldset>
			<legend>Contact</legend>

			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?php echo $email; ?>">
			<span><?php echo $emailErrMsg; ?></span>


			<br><br>

			<label for="mobileno">Mobile No</label>
			<input type="number" name="mobileno" id="mobileno" value="<?php echo $mobileno; ?>">
			<span><?php echo $mobileErrMsg; ?></span>


			<br><br><br>

		</fieldset>

		<fieldset>
			<legend>Address</legend>

			<label for="address">Street/House/Road</label>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>">
			<span><?php echo $addressErrMsg; ?></span>


			<br><br>

			<label for="country">Country</label>
			<select name="country" id="country" >
			<option value="Bangladesh">Bangladesh</option>
				<option value="India">India</option>
			</select>

			<br><br><br>

		</fieldset>
		<fieldset>
			<legend>Login Details</legend>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" value="<?php echo $username; ?>">

			<span><?php echo $usernameErrMsg; ?></span>

			<br><br>

			<label for="password">Password:</label>
			<input type="password" name="password" id="password" value="<?php echo $password; ?>" >
			<span><?php echo $passwordErrMsg; ?></span>

		</fieldset>

		<input type="submit" name="submit" value="Register">

		
	</form>

	<a href="Login.php">Go to log-in</a>

</body>
</html>
