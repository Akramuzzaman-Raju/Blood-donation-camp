<?php 
session_start();
$Username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
	header("Location: Login.php");
}
?>
<!DOCTYPE html>  
<title>Home Page</title>
<?php include('header.php')  ?> 
<h1>Home Page</h1>  
    <a href="viewprofile.php">My Profile</a> <br><br> 
    <a href="apply.php">Become a Donor</a> <br><br> 
	<a href="search.php">Search For Recever</a> <br><br> 
	<a href="viewevents.php">View Donation Event</a> <br><br> 
	<a href="viewrequest.php">View Reciver List</a> <br><br> 
	<a href="feedback.php">Give Feedbacks </a> <br><br>
	<a href="Logout.php">Logout</a> <br><br> 
<?php include('footer.php') ?> 
</html>