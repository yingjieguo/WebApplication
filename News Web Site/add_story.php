<?php
session_start();
require 'database.php';
if(isset($_SESSION['user_id'])&&isset($_POST['title'])){
$stmt = $mysqli->prepare("INSERT into stories (user_id,title,story_content,story_link) values(?,?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
if($_SESSION['token'] != $_POST['token']){
		die("Request forgery detected");
}

$stmt->bind_param('isss',$user_id,$title,$story_content,$story_link);
$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$story_content = $_POST['story_info'];
$story_link = $_POST['link'];

$stmt->execute();
$stmt->close();

}
header("Location:home.php");
?>


