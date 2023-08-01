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
	<title>Events</title>

</head>
<body>
<?php include('header.php')  ?> 
<?php 

$handle = fopen("event.json", "r");
$fr = fread($handle, filesize("event.json"));
$arr1 = json_decode($fr);	

    
	echo "<table border=1>";
	echo "<tr>";
		echo "<th>Event Date </th>";
		echo "<th>Event Location</th>";
        echo "<th>Event Time</th>";
		echo "</tr>";
		for ($i=0; $i < count($arr1) ; $i++) {
		echo "<tr>";
			echo "<td>" . $arr1[$i]->EventDate . "</td>";
			echo "<td>" . $arr1[$i]->Location . "</td>";
            echo "<td>" . $arr1[$i]->EvenTime . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	fclose($handle);
?>
<br>
<?php include('footer.php') ?> 

</html>