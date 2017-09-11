<?php
	require 'database.php';
	$username = $_POST["username"];
    //see whether the username is exit.
	$stmt = $mysqli->prepare("SELECT COUNT(*),id FROM users WHERE username=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
	 $stmt->bind_param('s', $username);
 	 $stmt->execute();
        // Bind the results
	 $stmt->bind_result($cnt, $user_id);
        // Fetch and close
	 $stmt->fetch();
	 $stmt->close();
 	if($cnt != 1){
		echo "Username doesn't exit; Please sign up";
		echo "<form action=\"Location:login.html\" method=\"POST\">";     
        echo "<input type=\"submit\" value=\"Go to sign up\"/>";
        echo "</form>";
		exit;
 	}
 	//username is exit
    else{
   		$newpassword=$_POST["newpassword"];
        $confirmnewpassword=$_POST["confirmnewpassword"];	
		if ($newpassword == $confirmnewpassword)
		{
			//secure the password
			$newpassword = crypt($newpassword);
			// Update the user's password
			$stmt1 = $mysqli->prepare('UPDATE users SET password = ? WHERE username= ?');
			$stmt1->bind_param('ss', $newpassword, $username);
			$stmt1->execute();
			$stmt1->close();
			//connect the session
			$_SESSION['user_id'] = $user_id;
			echo "Your password has been successfully reset.";
			echo "<form action=\"home.php\" method=\"POST\">";     
            echo "<input type=\"submit\" value=\"Back to homepage\"/>";
            echo "</form>";
		}
		else
			//password is wrong
			{   $_SESSION['user_id'] = $user_id;
				echo "Your two passwords above do not match.";
				echo "<form action=\"login.html\" method=\"POST\">";     
                echo "<input type=\"submit\" value=\"Back to homepage\"/>";
                echo "</form>";
			}
		 
    }
?>