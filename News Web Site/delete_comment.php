<?php
    session_start();
    require 'database.php';
    $story_id = $_POST['story_id'];
    $comment_id = $_POST['commentid'];

        $stmt = $mysqli->prepare("DELETE from comments where id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $comment_id);
        $stmt->execute();
        $stmt->close();
        header("Location: home.php?id=$story_id");
?>