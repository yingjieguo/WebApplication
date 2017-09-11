<?php
    session_start();
    require 'database.php';
    $story_id = $_POST['story_id'];
    $comment_id = $_POST['commentid'];
    $comment= $_POST['comment'];
    //Check if it is signed in

        $stmt = $mysqli->prepare("UPDATE comments Set comment_content=? where id=?");
         if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('si', $comment, $comment_id);
        $stmt->execute();
        $stmt->close();
        header("Location: home.php?id=$story_id");
    
?>