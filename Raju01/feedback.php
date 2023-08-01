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
    <title>Feedback</title>
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
    
        $username = "";
        $usernameErrMsg = "";
        $email="";
        $emailErrMsg="";
        $arr1=array();
        $d=array();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            function test_input($data) {
                $data = htmlspecialchars($data);
                return $data;
            }   
            $flag=0;
            $username = test_input($_POST['username']);
            $email = test_input($_POST['email']);

            $message = "";
            if (empty($username)) {
                $usernameErrMsg = "User Name is Empty";
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

            if($flag===0) {
                echo "Feedback Sent";
                echo "<br>";

                $arr=array('username'=> $username,'email'=>$email,);
                $dataFile=fopen("feedback.json",'r');
                $fileRead=fread($dataFile,filesize("feedback.json"));
                
                $arr1=json_decode($fileRead);
                fclose($dataFile);
                $dataFile=fopen("feedback.json",'w');
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
                echo "Failed to Send Feedback";
            }
            
        }

    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
        <fieldset>
            <legend>Feedback</legend>

            <label for="username">Username Name</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">

            <span><?php echo $usernameErrMsg; ?></span>

            <br><br><br>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            <span><?php echo $emailErrMsg; ?></span>

            <br><br><br>

            <h3>Write Feedback </h3>
            <textarea name=" feedback" rows="8" cols="40"></textarea>
            
            <br><br><br>

            <h3>Suggestion </h3>
            <textarea name=" suggestion" rows="8" cols="40"></textarea>

        </fieldset>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
<?php include('footer.php')  ?>
</html>

