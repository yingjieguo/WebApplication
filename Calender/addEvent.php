<?php 
require 'database.php';
header("Content-Type: application/json"); 
ini_set("session.cookie_httponly", 1);
session_start();

 // check the HTTP User Agent
$previous_ua = @$_SESSION['useragent'];
$current_ua = $_SERVER['HTTP_USER_AGENT'];
if(isset($_SESSION['useragent']) && $previous_ua !== $current_ua){
	die("Session hijack detected");
}else{
	$_SESSION['useragent'] = $current_ua;
}

$username=$_SESSION['username'];
$token = $_SESSION['token'];
$title = htmlentities($_POST['title']);
$year = (int) htmlentities($_POST['eventYear']);
$month = (int) htmlentities($_POST['eventMonth']);
$day = (int) htmlentities($_POST['eventDay']);
$time = htmlentities($_POST['time']);
$tag = htmlentities($_POST['tag']);
// share

$share1 = htmlentities($_POST['share1']);
$share2 = htmlentities($_POST['share2']);
if (($_SESSION['token'] != $token) || (empty($_SESSION['username']))){
    echo json_encode(array(
        "success" => false,
        "message" => "Sorry, the token is wrong."
    ));
    exit;
}

if ($share1!= "") {

    $stmt = $mysqli->prepare("INSERT INTO events (event_year, event_month, event_day, event_username, event_title, event_tag,event_time) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if(!$stmt){
        $s = $mysqli->error;
        $failmessage = "Query Prep Failed: ".$s;

        echo json_encode(array(
        "success" => false,
        "message" => $failmessage
        ));
        exit;
    }
    $stmt->bind_param('iiissss', $year, $month, $day, $share1, $title, $tag, $time);
    //$stmt->execute();
    if ($stmt->execute()) {
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Sorry,Share Event failed."
            ));
        exit;
    }
    $stmt->close();

}
if ($share2!= "") {

    $stmt = $mysqli->prepare("INSERT INTO events (event_year, event_month, event_day, event_username, event_title, event_tag,event_time) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if(!$stmt){
        $s = $mysqli->error;
        $failmessage = "Query Prep Failed: ".$s;

        echo json_encode(array(
        "success" => false,
        "message" => $failmessage
        ));
        exit;
    }
    $stmt->bind_param('iiissss', $year, $month, $day, $share2, $title, $tag, $time);
    //$stmt->execute();
    if ($stmt->execute()) {
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Sorry,Share Event failed."
            ));
        exit;
    }
    $stmt->close();

}
// selfevent
$stmt = $mysqli->prepare("INSERT INTO events (event_year,event_month, event_day, event_username, event_title, event_tag, event_time) VALUES (?, ?, ?, ?, ?, ?, ?)");

if(!$stmt){
    echo json_encode(array(
    "success" => false,
    "message" => "Sorry,Query prepare failed."
    ));
    exit;
}
$stmt->bind_param('iiissss', $year,$month,$day,$username, $title, $tag, $time);
if ($stmt->execute()) {
    echo json_encode(array(
       "success" => true,
       "message" => "Event Added Successful."
   ));
   exit;
}  else {
    echo json_encode(array(
        "success" => false,
        "message" => "Sorry,Event added failed."
    ));
    exit;
}
$stmt->close();
?>