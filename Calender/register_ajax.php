<?php
#Registers a new user by querying the server

ini_set("session.cookie_httponly", 1);
require 'database.php';
header("Content-Type: application/json");


if(isset($_POST['registername'])&&isset($_POST['password'])){
    $username = $_POST['registername'];
    $password = $_POST['password'];

}


// Check if the username satisfies the regular expression requirement
if(!preg_match('/^[\w_\-]+$/', $username) ){   
	// echo "Invalid Username";
    echo json_encode(array(
        "success" => false,
        "message" => "Invalid Username"
    ));
    exit;
}

$query = "SELECT COUNT(*) FROM calendar_users WHERE user_name = ?";
$stmt = $mysqli->prepare($query);
if(!$stmt){
    echo jason_encode(array(
        "success" => false,
        "message" => "An Error Occured, Please Try Again"
     ));
     exit;
}

$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($cnt);
$stmt->fetch();

if($cnt!=0){
	// echo "Existing username";
    echo json_encode(array(
        "success" => false,
        "message" => "Existing username"
    ));
    exit;
}
$stmt->close();



	$crypted_password=crypt($password);

    // Insert the username and password into the database
    $stmt = $mysqli->prepare("insert into calendar_users (user_name, password) values (?, ?)");
    if(!$stmt){
    $s = $mysqli->error;
    $failmessage = "Query Prep Failed: ".$s;
    echo json_encode(array(
        "success" => false,
        "message" => $failmessage
    ));
    exit;
    }

    $stmt->bind_param('ss', $username, $crypted_password);
    if ( $stmt->execute() ){
        //if insert success, query usern from database
        $stmt = $mysqli->prepare("select COUNT(*) from calendar_users where user_name = ?");
        if(!$stmt){
        $s = $mysqli->error;
        $failmessage = "Query Prep Failed: ".$s;
        echo json_encode(array(
            "success" => false,
            "message" => $failmessage
        ));
        exit;
        }
        $stmt->bind_param('s', $username);
        $user = $_POST['registername'];
        $stmt->execute();
        
        // Bind the results
        $stmt->bind_result($cnt);
        $stmt->fetch();
        $stmt->close();
        
        if( $cnt == 1 ){
            echo json_encode(array(
                "success" => true,
            ));
            exit;	
        }
        else{
            echo json_encode(array(
                "success" => false,
                "message" => "Incorrect Username or Password"
            ));
            exit;
        }
    }
    else{

        echo json_encode(array(
            "success" => false,
            "message" => "Incorrect Username or Password"
        ));
        exit;
    }


?>

