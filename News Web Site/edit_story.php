<?php
    session_start();
    require 'database.php';
    $story_id = $_POST['story_id'];
    $title = $_POST['title'];
    $story_content= $_POST['story'];
    $story_link = $_POST['link'];
  

        $stmt = $mysqli->prepare("UPDATE stories Set title=?, story_content=?, story_link=? where id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('sssi', $title, $story_content, $story_link, $story_id);
        $stmt->execute();
        $stmt->close();
        header("Location: home.php?id=$story_id");

?>