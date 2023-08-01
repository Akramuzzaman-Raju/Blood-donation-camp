<?php 
session_start();
$Username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
	header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html>
<?php include('header.php')  ?>

    <?php 

    $username = "";
    $password = "";

    if (isset($_SESSION['username'])) 
    {
        $handle = fopen("data.json", "r");
        $fr = fread($handle, filesize("data.json"));

        $arr1 = json_decode($fr);       
        fclose($handle);

        for ($i=0; $i < count($arr1); $i++) 
        { 
            if ($username == $arr1[$i]->username) 
            {
                if($password == NULL )
                {

                }
                else
                {
                    $password = $arr1[$i]->password;
                }

            }
        }
    }
    else
    {   
        die("Invalid REQUEST");
    }
    ?>

    <h1 >Update Password</h1>

    <form action="ChangePassAct.php" method="POST" enctype="application/x-www-form-urlencoded">
        <label for="uname">Username</label>
        <input type="text" name="username" id="uname" value="<?php echo $_SESSION['username'] ?>" size="25" maxlength="5" disabled >            
        <br><br>
        <label for="password"> New Password</label>
        <input type="password" name="password" id="password" >
        <br><br>        
        <input type="submit" name="Update" value="Update">

        <br><br>
        <a href="homepage.php">Go Back</a>
        
    </form>
    <?php include('footer.php')  ?>
</html>
