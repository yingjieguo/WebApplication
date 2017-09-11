<?php
    session_start();
    require 'database.php';
    $story_id = $_POST['story_id'];
    //Check if it is signed in

        //delete comments
        $stmt = $mysqli->prepare("DELETE from comments where story_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
        }
        $stmt->bind_param('i', $story_id);
        $stmt->execute();
        $stmt->close();
        //delete story
        $stmt1 = $mysqli->prepare("DELETE from stories where id=?");
        if(!$stmt1){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }  
        $stmt1->bind_param('i', $story_id);
        $stmt1->execute();
        $stmt1->close();
        header("Location: home.php");

?>
   