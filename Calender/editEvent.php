<?php 

ini_set("session.cookie_httponly", 1);
header("Content-Type: application/json"); 
require 'database.php';
session_start();


$username=$_SESSION['username'];
$token = $_SESSION['token'];

// Check if that's illegal access
if ( (empty($_SESSION['username'])) ) {
	echo json_encode(array(
		"success" => false,
		"message" => "illegal access"
	));
	exit;
}
settype($event_id, "int");
$title = $_POST['title'];
$year = (int) $_POST['eventYear'];
$month = (int) $_POST['eventMonth'];
$day = (int) $_POST['eventDay'];
$time = $_POST['eventTime'];


$stmt=$mysqli->prepare("SELECT event_id FROM events WHERE event_title= ? AND event_year= ? AND event_month= ? AND event_day=? AND event_time= ?");
if(!$stmt){
    $s = $mysqli->error;
    $failmessage = "Query Prep Failed: ".$s;
	echo json_encode(array(
		"success" => false,
		"message" => $failmessage
	));
	exit;
}
$stmt->bind_param('siiis', $title,$year,$month,$day,$time);
$stmt->execute();
$stmt->bind_result($event_id);
$stmt->fetch();
$stmt->close();

settype($event_id, "int");

$newtitle = htmlentities($_POST['newtitle']);
$newyear = (int) htmlentities($_POST['newyear']);
$newmonth = (int) htmlentities($_POST['newmonth']);
$newday = (int) htmlentities($_POST['newday']);
$newtime = htmlentities($_POST['newtime']);
$newtag = htmlentities($_POST['newtag']);

$stmt2=$mysqli->prepare("UPDATE events SET event_title=?,event_year = ? ,event_month=?, event_day=? , event_time=? ,event_tag=? WHERE event_id=? ");

if(!$stmt2){
    $s = $mysqli->error;
    $failmessage = "Query Prep Failed: ".$s;
	echo json_encode(array(
		"success" => false,
		"message" => $failmessage
	));
	exit;
}
$stmt2->bind_param('siiissi', $newtitle,$newyear,$newmonth,$newday,$newtime,$newtag,$event_id);
$stmt2->execute();
$stmt2->close();

echo json_encode(array(
	"success" => true
));
exit;

  
?>