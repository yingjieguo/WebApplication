<?php 
require 'database.php';
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();
 // check the HTTP User Agent between requests 
$previous_ua = @$_SESSION['useragent'];
$current_ua = $_SERVER['HTTP_USER_AGENT'];
if(isset($_SESSION['useragent']) && $previous_ua !== $current_ua){
	die("Session hijack detected");
}else{
	$_SESSION['useragent'] = $current_ua;
}

$username = htmlentities($_SESSION['username']);
$token = $_SESSION['token'];
// $token_post = $_POST['token_post'];
$title = htmlentities($_POST['title']);
$year = (int) htmlentities($_POST['eventYear']);
$month = (int) htmlentities($_POST['eventMonth']);
$day = (int) htmlentities($_POST['eventDay']);
$time = htmlentities($_POST['eventTime']);

if (($_SESSION['token'] != $token) || (empty($_SESSION['username']))){
    echo json_encode(array(
        "success" => false,
        "message" => "Sorry, te token is wrong."
    ));
    exit;
}

// Delete the event
$stmt=$mysqli->prepare("DELETE FROM events WHERE event_username =? AND event_year = ? AND event_month = ? AND event_day = ? AND event_title = ? AND event_time = ?");

if(!$stmt){
	echo json_encode(array(
	"success" => false,
	"message" => "Sorry,Maybe your info is wrong.Query prepare failed."
	));
	exit;
}
   
$stmt->bind_param('siiiss', $username, $year, $month, $day, $title ,$time);
if ($stmt->execute()) {
    echo json_encode(array(
        "success" => true,
        "message" => "Event has deleted."
    ));
	exit;
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Sorry,Event delete is failed."
    ));	
	exit;
}
$stmt->close();


?>