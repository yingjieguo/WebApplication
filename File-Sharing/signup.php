<?php
    session_start();
?>

<?php
    $newuser = $_GET['newuser'];
    //the sign up username has to follow the rule
    if(!preg_match('/^[\w_\-]{3,15}+$/', $newuser)){
    	echo "<p>Invalid username! Please choose another one or login</p>";
    	header("Location:start.php");
    	exit;
    }
    else{
    	   $namearray = array();
           // check if the user name has already been in username.txt
           $name_file = fopen("/home/joecz/FileSystem/username.txt", "r");
           while(!feof($name_file)){
        	   $line = trim(fgets($name_file));
        	   $namearray[]=$line;
           }
           fclose($name_file);


            if(in_array($newuser, $namearray)){
            	echo "<p>This username exists, please choose another one or login</p>";
                echo "<br><a href=\"start.php\">Home</a>";
              }
           else{
            	$_SESSION['username'] = $newuser;
              	$username = $newuser;
                	/*Code from http://php.net/manual/en/function.file-put-contents.php */
                  // add this new user name into username.txt
               file_put_contents("/home/joecz/FileSystem/username.txt", $username . "\n", FILE_APPEND | LOCK_EX);
               // add a dictionary for new user, and change the permission to 0777
               $oldmask = umask(0);
               mkdir("/home/joecz/FileSystem/$newuser", 0777);
               umask($oldmask);
               header("Location:process.php?user = $username");
              	exit;


              }

      }

?>

