<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet1.css">
    <?php
        $username = $_SESSION['username'];
	    echo"<title>Welcome, $username</title>";
	?>
</head>
<body>
    <?php
        	//Code from http://php.net/manual/en/function.opendir.php
        	$dir = "/home/joecz/FileSystem/" . $_SESSION['username'] . "/";
            //make sure $dir is a directory
        	if(is_dir($dir)){
        		if($dh = opendir($dir)){
        			$nofile = True;
        			echo "<div id=\"files\">";

                    //read all files from that directory
        			while(($file=readdir($dh))!==false){
        				if($file!="."&&$file!=".."){
        					$nofile = False;
        					echo "<form action=\"viewanddelete.php\" method=\"GET\">";
        					echo "<input type=\"text\" name=\"filename\" value=\"$file\" readonly/>";
        					echo "<input type=\"radio\" name=\"action\" value=\"view\"/>Read ";
        					echo "<input type=\"radio\" name=\"action\" value=\"delete\"/>Delete ";
        					echo "<input type=\"submit\" value=\"Submit\" />";
        					echo "</form>";

        				}
        			}

        			echo "</div>";
                    //echo "$nofile";
        			if($nofile){
        				echo "<p>There is no file, please upload some</p>";
        			}
        			closedir($dh);
        		}
        	}
    ?>

        	<!--Code from http://classes.engineering.wustl.edu/cse330/index.php/PHP#Other_PHP_Tips-->
<!--  Upload part, go to uploader.php -->
<form enctype="multipart/form-data" action="uploader.php" method="POST">
    <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
        <label for="uploadfile_input">Choose a file to upload:</label> <input name="file" type="file" id="uploadfile_input" />
    </p>
    <p>
        <input type="submit" value="Upload File" />
    </p>
</form>

<form action = "logout.php" method = "GET">
     <input type = "submit" value = "LOGOUT">
    
</form>

<form action = "deleteaccount.php" method= "GET">
    <input type = 'submit' value="DELETE MY ACOOUNT"/>
</form>



</body>
</html>
