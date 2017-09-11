<?php
require 'database.php'; 
ini_set("session.cookie_httponly", 1);
header("Content-Type: application/json"); 
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = $mysqli->prepare("SELECT password FROM calendar_users WHERE user_name=?");
	  if(!$stmt){
			echo json_encode(array(
				"success" => false,
				"message" => "login failed"
			));
			exit;
		}
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($pwd);
	$stmt->fetch();
	$stmt->close();
	if( crypt($password, $pwd)==$pwd ) {

		$previous_ua = @$_SESSION['useragent'];
	    $current_ua = $_SERVER['HTTP_USER_AGENT'];
	    if(isset($_SESSION['useragent']) && $previous_ua !== $current_ua){
		     die("Session hijack detected");
	    }else{
		$_SESSION['useragent'] = $current_ua;
	    }

		$_SESSION['username'] = $username;
		$_SESSION['token'] = substr(md5(rand()), 0, 10);
		$token = $_SESSION['token'];
		echo json_encode(array(
			"success" => true,
			"token" => $token
		));
		exit;
	}
	else {
		echo json_encode(array(
			"success" => false,
			"message" => "Login failed. Please check your input."
		));
		exit;
	}
}
?>