<?php
    session_start();
        require 'database.php';
        $user = $_POST['newuser'];
        $password = $_POST['newpassword'];
        //Check whether the username is exit;
        $stmt = $mysqli->prepare("SELECT COUNT(*),id, password FROM users WHERE username=?");
        if(!$stmt){
           printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        // Bind the parameter
        $stmt->bind_param('s', $user);
        // Execute
        $stmt->execute();
        // Bind the results
        $stmt->bind_result($cnt, $user_id, $pwd);
        // Fetch and close
        $stmt->fetch();
        $stmt->close();
        
        if($cnt == 1){
            echo "<p>User already exists.Please try another.</p>";
			echo "<form action=\"login.html\" method=\"POST\">";     
  	   	 	echo "<input type=\"submit\" value=\"Back to login\"/>";
    		echo "</form>";
            exit();
        } 
        else{
            //new username check validation
            if( !preg_match('/^[\w_\.\-]{3,15}+$/', $user) ){
               echo "Invalid username, it should be 3-15 characters.";
               exit;
             } 
            else {
                $stmt1 = $mysqli->prepare("INSERT into users (username, password) values (?, ?)");
                if(!$stmt1){
                   printf("Query Prep Failed: %s\n", $mysqli->error);
                   exit;
                }
            // Bind the parameter
                $stmt1->bind_param('ss', $user, $pwd);
                $pwd = crypt($password);
                $stmt1->execute();
                $stmt1->close();
                echo "<p>Creatation Successful</p>";
            }
        }
        //connect session
        $stmt2 = $mysqli->prepare("SELECT id FROM users WHERE username=?");
        if(!$stmt){
           printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        // Bind the parameter
        $stmt2->bind_param('s', $user);
        // Execute
        $stmt2->execute();
        // Bind the results
        $stmt2->bind_result($user_id);
        // Fetch and close
        $stmt2->fetch();
        $stmt2->close();
        $_SESSION['user_id'] = $user_id;
        // Back button to go to home page
        
        echo "<form action=\"home.php\" method=\"POST\">";     
        echo "<input type=\"submit\" value=\"Back to homepage\"/>";
        echo "</form>";
?>