<?php 
session_start();
$Username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
	header("Location: Login.php");
}
	
	
?>
<!DOCTYPE html>
<html>
	<body>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Profile</title>
	<link rel="stylesheet" href="">
</head>
<?php include('header.php')  ?>
	<?php
	

	
	$Firstname=$Lastname=$Mobile=$Email='';
	$handle = fopen("data.json", "r");
	$fr = fread($handle, filesize("data.json"));
	$decode = json_decode($fr);
	for ($i=0; $i < count($decode) ; $i++)
	{ 		
		if ($Username == $decode[$i]->username)
		{
		
			$Firstname= $decode[$i]->firstname;
			$Lastname= $decode[$i]->lastname;
			$Mobile= $decode[$i]->mobile;
			$username= $decode[$i]->username;
            $Email=$decode[$i]->email;
			
		}
	}
	$fc = fclose($handle);
?>
	<b>Profile Information</b>	
				
	<?php
		echo "<br><br>";
		echo "UserName: " . $Username;
		echo "<br><br>";
		echo "First Name: " . $Firstname;
		echo "<br><br>";
        echo "Last Name: " . $Lastname;		
		echo "<br><br>";				 				
		echo "Phone: " . $Mobile;
		echo "<br><br>";
        echo "Email: " . $Email;
		echo "<br><br>";
	?>
	
	<a href="changePassword.php"><button type="button">ChangePassword</button></a>
</body>
	<?php include('footer.php')  ?>
</html>