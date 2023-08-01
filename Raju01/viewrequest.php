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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Requests</title>

</head>
<body>
<?php include('header.php')  ?> 
<?php 

$handle = fopen("request.json", "r");
$fr = fread($handle, filesize("request.json"));
$arr1 = json_decode($fr);	

    
	echo "<table border=1>";
	echo "<tr>";
		echo "<th>Fist Name </th>";
		echo "<th>Last Name</th>";
        echo "<th>Gender</th>";
        echo "<th>Email</th>";
        echo "<th>Mobile</th>";
        echo "<th>Address</th>";
        echo "<th>Bloodgroup</th>";
        echo "<th>Age</th>";
		echo "</tr>";
		for ($i=0; $i < count($arr1) ; $i++) {
		echo "<tr>";
			echo "<td>" . $arr1[$i]->firstname . "</td>";
			echo "<td>" . $arr1[$i]->lastname . "</td>";
            echo "<td>" . $arr1[$i]->gender . "</td>";
            echo "<td>" . $arr1[$i]->email . "</td>";
            echo "<td>" . $arr1[$i]->mobile . "</td>";
            echo "<td>" . $arr1[$i]->address . "</td>";
            echo "<td>" . $arr1[$i]->bloodgroup . "</td>";
            echo "<td>" . $arr1[$i]->age . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	fclose($handle);
?>
<br>
<?php include('footer.php') ?> 

</html>