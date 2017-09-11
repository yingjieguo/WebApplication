<?php
    session_start();
        // Get the username and make sure it is valid
        $username = $_SESSION['username'];
        if( !preg_match('/^[\w_\-]+$/', $username) ){
            echo "Invalid username";
            exit;
        }

        $filename = $_GET['filename'];
        
        $action = $_GET['action'];
        if ( $action == "view") {
         
             if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                   echo "Invalid filename";
                   exit;
                 } 
        
              $full_path = sprintf("/home/joecz/FileSystem/%s/%s", $username, $filename);
            
             // Get the MIME type (e.g., image/jpeg).  
               $finfo = new finfo(FILEINFO_MIME_TYPE);
               $mime = $finfo->file($full_path);
           
                header("Content-Type: ".$mime);
                readfile($full_path);
        }

        else if ($action == "delete") {
                 $full_path = sprintf("/home/joecz/FileSystem/%s/%s", $username, $filename);
                 //unlink($full_path);
                 if (!unlink($full_path)){
                    echo ("Opps! Deleted failed.");
                }
                 else {
                    echo ("Delete Successful!");
                    echo "<br><a href=\"process.php?user=$username\">Back</a>";
                }
        }

?>
   