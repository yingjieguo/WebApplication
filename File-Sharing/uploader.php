

<?php
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['file']['name']);//string basename ( string $path [, string $suffix ] )

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){//check filename
	echo "Invalid filename";
	exit;
} 

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){//check username
	echo "Invalid username";
	exit;
}
 
$full_path = sprintf("/home/joecz/FileSystem/%s/%s", $username, $filename);
 
if( move_uploaded_file($_FILES['file']['tmp_name'], $full_path) ){ //move file from temporary dir to the path
	echo "File Uploaded Successfully";
	echo "<br><a href=\"process.php?user=$username\">Back</a>";
}
else{//upload failed
	echo "File Upload Failed";
	echo "<br><a href=\"process.php?user=$username\">Back</a>";
}
 

?>