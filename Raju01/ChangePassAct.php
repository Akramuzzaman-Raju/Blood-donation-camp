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
	<title>Change Password</title>
</head>
<body>
	<h1 >Change Password </h1>	
	
	<?php

		function test($user)	
		{
			$user = trim($user);
			$user = stripslashes($user);
			$user = htmlspecialchars($user);
			return $user;
		}		
	?>		
	<?php 
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{	
			$username = $_SESSION['username'];
			$password = test($_POST['password']);
			if (empty($_POST['password']))
			{
				echo "Fill up the password properly";			
				?>
				<br>
				<p><b>Password is not changed</b></p>
				<?php				
			}
			else
			{						
				$handle = fopen("data.json", "r");
		        $fr = fread($handle, filesize("data.json"));  
		        $arr1 = json_decode($fr);		        
		        fclose($handle);

		        $handle = fopen("data.json", "w");

		        for ($i=0; $i < count($arr1); $i++) { 
		        	if ($username == $arr1[$i]->username) 
		        	{
						
		        		$arr1[$i]->password = $password;
		        		
						
		        	}		        	
		        }
		        $user = json_encode($arr1);
            	$fw = fwrite($handle, $user);
            	$fc = fclose($handle);

            	if ($fw) 
				{
					echo "Password changed succesfully";
				}
			}				
		}
		else
		{
			echo "Can not process GET REQUEST METHOD";
		}	        
	?>
	<br><br>
	<a href="homepage.php">Go Back</a>
</body>
</html>