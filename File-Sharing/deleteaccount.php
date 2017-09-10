<?php
session_start();

//delete this username from username.txt
$username = $_SESSION['username'];
$dir = "/home/joecz/FileSystem/username.txt";
$contents = file_get_contents($dir);
$contents = str_replace($username,'',$contents);
file_put_contents($dir, $contents);


$full_path = sprintf("/home/joecz/FileSystem/%s",$username);

if(is_dir($full_path)){
	$files = array_diff(scandir($full_path), array('.','..'));
	foreach($files as $file){
		$new_path = sprintf("/home/joecz/FileSystem/%s/%s",$username,$file);
		unlink($new_path);
	}

	if(rmdir($full_path)){
		header("Location:start.php");
	}else{
		echo "Oops, delete failed";
	}
}


?>

