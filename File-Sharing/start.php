<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>FILE SHRAING</title>
	<link rel="stylesheet" type="text/css" href="stylesheet1.css">
</head>
<body>
    <div class = "login">
    	<div class = "loginheader">
    		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "GET">
    			<br>
                <h1>Welcome to the File System!<br><br><br> </h1>
                <p >
                   Login :
                   <label ><input type="text" name="user" /></label>
                   <input type="submit" value="Log in"/>
                </p>
            

    		</form>
    	</div>

    	<div class ="signupheader">
    		<form action="signup.php" method = "GET">
    			<p>
                 Sign up:
                 <label><input type="text" name="newuser"/></label>
                 <input type="submit" value="Sign up"/>
                 </p>
                
    		</form>
    	</div>
    </div>

    <?php
        if(isset($_GET['user'])){
            $user = $_GET['user'];
            $namearray = array();
            $valid = False;
            $name_file = fopen("/home/joecz/FileSystem/username.txt", "r") or die("Unable open file");
            //get all the names from uername.txt file
            while(!feof($name_file)){
        	   $line = trim(fgets($name_file));
        	   $namearray[]=$line;
                 //print_r(array_values($namearray));
              }
            fclose($name_file);

              // check if the login user is in the username.txt
             if(in_array($user, $namearray)){
        	       $_SESSION['username'] = $user;
        	       $username = $user;
        	       header("Location: process.php?user = $username");
        	       exit;
            }
            else{
        	       echo "<p>Username not found, please sign up</p>";

                }
        }

    ?>




</body>
</html>