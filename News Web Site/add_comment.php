<?php
	session_start();
	require 'database.php';
    	$user_id = $_SESSION['user_id'];
		$story_id =$_POST['story_id'];
    	$comment = $_POST['comment'];
    	//Check if it is signed in

        $stmt = $mysqli->prepare("INSERT into comments (user_id, story_id, comment_content) values (?, ?, ?)");
   		if(!$stmt){
       		printf("Query Prep Failed: %s\n", $mysqli->error);
        	exit;
    	}  
		// Bind the parameter

    	$stmt->bind_param('iis', $user_id, $story_id, $comment);
    	$stmt->execute();
    	$stmt->close();
    	header("Location: home.php?id=$story_id");
	

?>
