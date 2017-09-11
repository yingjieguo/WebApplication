<?php

	session_start(); 
	require 'database.php';

	$user = $mysqli->real_escape_string($_POST['user']);
	$passwd = $mysqli->real_escape_string($_POST['password']);
	$stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");
 
// Bind the parameter
	$stmt->bind_param('s', $user);
	$stmt->execute();
// Bind the results
	$stmt->bind_result($cnt, $user_id, $pwd);
	$stmt->fetch();
	$stmt->close();

// See whether the password is correct
	if( $cnt == 1 && crypt($passwd, $pwd)==$pwd){
			$_SESSION['user_id'] = $user_id;
			//$_SESSION['token'] = substr(md5(rand()), 0, 10);
			header("Location:home.php");
			exit();
     }
//if password is wrong
	else{
		echo "Login failed.....";
		echo "<form action=\"login.html\" method=\"POST\">";     
  	    echo "<input type=\"submit\" value=\"Back to homepage\"/>";
    	echo "</form>";
		exit();
	}
?>