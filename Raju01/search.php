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
	<title>Search</title>
	<link rel="stylesheet" href="">
    </head>
    <?php include('header.php')  ?>
    <br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>


<label for="BloodGroup">Blood Group</label>
        <select name="BloodGroup" id="BloodGroup" >
        <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>

        <input type="submit" name="Search" value="Search">


</form>
  
<br><br><br>

	<?php
	
    function test_input($data) {
        $data = htmlspecialchars($data);
        return $data;
    }	
	
	 $Firstname=$Lastname=$Mobile=$Email='';
	$handle = fopen("request.json", "r");
	$fr = fread($handle, filesize("request.json"));
	$decode = json_decode($fr);
    $BloodGroup = isset($_POST['BloodGroup']) ? test_input($_POST['BloodGroup']) : "";

    echo "<table border=1>";
    echo "<tr>";
        echo "<th>First Name </th>";
        echo "<th>Last Name</th>";
        echo "<th>Email</th>";
        echo "<th>Mobile</th>";
        echo "<th>Blood Group</th>";
        echo "</tr>";

	for ($i=0; $i < count($decode) ; $i++)
	{ 		
		if ($BloodGroup == $decode[$i]->bloodgroup)
		{
            echo "<tr>";
			echo "<td>" . $decode[$i]->firstname . "</td>";
            echo "<td>" . $decode[$i]->lastname . "</td>";
            echo "<td>" . $decode[$i]->email . "</td>";
            echo "<td>" . $decode[$i]->mobile . "</td>";
            echo "<td>" . $decode[$i]->bloodgroup . "</td>";
			
		echo "</tr>";
         
            }	
		}
        echo "</table>";
	
	$fc = fclose($handle);
?>

</body>
	<?php include('footer.php')  ?>
</html>