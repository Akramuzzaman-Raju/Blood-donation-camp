<?php 
session_start();
$Username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
	header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Application for Doner</title>
	<?php include('header.php')  ?> 
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
		$mobileErrMsg="";
		$mobileno="";
		$age="";
		$ageErrMsg="";
		$bloodgroup="";
		$bloodgroupErrMsg="";
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
			$age = test_input($_POST['age']);
			$bloodgroup = test_input($_POST['bloodgroup']);

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
			if (empty($age)) {
				$ageErrMsg= "Age is Empty";
				$flag=1;
				
			}
			 else 
			 {
				 if(!preg_match("/^[0-9]+$/", $age))
			{
				$mobileErrMsg="Invalid Age (Enter digits)";
				$flag=1;
			}
		}
			if($flag===0) {
				echo "Registration Successful";
				echo "<br>";

				$arr=array('firstname'=> $firstname,'lastname'=>$lastname,'gender'=>$gender,'email'=>$email,'mobile'=>$mobileno,'address'=>$address,'age'=>$age,'bloodgroup'=>$bloodgroup);
				$dataFile=fopen("apply.json",'r');
				$fileRead=fread($dataFile,filesize("apply.json"));
				
                $arr1=json_decode($fileRead);
				fclose($dataFile);
				$dataFile=fopen("apply.json",'w');
				if($arr1===NULL)
				{
					$arr=array($arr);
					$arr=json_encode($arr);
				}
				else{
					$arr1[]=$arr;
					$arr=json_encode($arr1);
				}
				$dj=fwrite($dataFile,$arr);
				fclose($dataFile);

			}
			if($flag===1) {
				echo "Registration Failed";
			}
			
		
		}

	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
		<fieldset>
			<legend>Applicant Information</legend>

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

			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?php echo $email; ?>">
			<span><?php echo $emailErrMsg; ?></span>


			<br><br>

			<label for="mobileno">Mobile No</label>
			<input type="number" name="mobileno" id="mobileno" value="<?php echo $mobileno; ?>">
			<span><?php echo $mobileErrMsg; ?></span>


			<br><br><br>


			<label for="address">Street/House/Road</label>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>">
			<span><?php echo $addressErrMsg; ?></span>


			<br><br><br>

	
			<label for="age">Age:</label>
			<input type="number" name="age" id="age" min="18" max="55" value="<?php echo $age; ?>">

			<span><?php echo $ageErrMsg; ?></span>

			<br><br>

			<label for="bloodgroup">Blood Group:</label>
			<input type="text" name="bloodgroup" id="bloodgroup" value="<?php echo $bloodgroup; ?>" >
			<span><?php echo $bloodgroupErrMsg; ?></span>

		</fieldset>

		<input type="Submit" name="submit" value="Register">

		
	</form>

</body>
<?php include('footer.php') ?> 
</html>
