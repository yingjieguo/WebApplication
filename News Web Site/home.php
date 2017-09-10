<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>News Home</title>
	<link rel="stylesheet" type="text/css" href="newsstylesheet.css">
</head>
<body>

    <?php
        $$_SESSION['token'] = substr(md5(rand()), 0, 10);
        echo "<div id = \"login\">";
        if(!isset($_SESSION['user_id'])){
            echo "<form action = \"login.html\" method=\"POST\">";
            echo "<input type=\"submit\" value = \"For Users to Login and SignUp\" name=\"Login\"/>";
            echo "</form>";
        }else{
            echo "<form action = \"logout.php\" method = \"POST\">";
            echo "<input type = \"submit\" value = \"Logout\" name = \"Logout\">";
            echo "</form>";
        }
        echo "</div>";

        require 'database.php';

        $username_stmt = $mysqli->prepare("SELECT username FROM users WHERE id=?");
        if (!$username_stmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
        $username_stmt->bind_param('i', $user_id);
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        }
        $username_stmt->execute();
        $username_stmt->bind_result($username);
        $username_stmt->fetch();
        //$username_stmt->close();

        //for header and function button area

        if(isset($_SESSION['user_id'])){
            echo "<div id = \"header\">";
            $username_stmt->close();
            echo "Welcome, $username";
            echo "</div>";


            echo "<div id = \"function_area1\">";
            //post new story button
            echo "<form action=\"add_story.html\" method=\"POST\">";
            echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
            echo "<input type=\"submit\" value=\"Post New Story\" name=\"Post New Story\"/>";
            echo "</form>";
            echo "</div>";
            //search function button
            echo "<div id = \"function_area2\">";
            echo "<form action=\"search.php\" method=\"POST\">";
            echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
            echo "<input type=\"submit\" value =\"Search News\" name=\"Search News\"/>";
            echo "</form>";

            echo "</div>";


        }
        else{
            echo "<div id = \"header\">";
                echo "Welcome, GUEST";
            echo "</div>";
        }

        $story_stmt = $mysqli->prepare("select stories.id, stories.user_id, title,story_content,story_link,users.username from stories left join users on (stories.user_id=users.id) ");
        //test for correctness

        if (!$story_stmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            // Execute, store, and bind result
        $story_stmt->execute();
        $story_stmt->store_result();
        $story_stmt->bind_result($story_id, $story_user_id, $title, $story_content, $story_link,$story_author);

        echo "<div id=\"main_page\">";

        // while($story_stmt->fetch()){
        //     echo "<h1>" . "<br name=\"$id\">" . htmlspecialchars($title) . "</br>". "<h1>";
        //     echo "Post By: " . htmlspecialchars($story_author);
        //     echo "<br>";
        //     echo htmlspecialchars($story_content);
        //     echo "<br>";
        //     echo "<a href = $story_link>$story_link</a>";
        //     echo "<br>";
            while($story_stmt->fetch()){
            echo"<table class=\"center\">"; 
            echo"<tr>";echo"<th>";
            echo"<br>" . htmlspecialchars($title) . "<br>";
            echo"</th>";echo"</tr>";
            echo"<tr>";echo"<th>";
            echo "Post By: " . htmlspecialchars($story_author);
            echo"</th>";echo"</tr>";
            echo"<tr>";echo"<th>";
            echo "<br>";
            echo"</th>";echo"</tr>";
            echo"<tr>";echo"<th>";
            echo htmlspecialchars($story_content);
            echo "<br>";
            echo"</th>";echo"</tr>";
            echo"<tr>";echo"<th>";
            echo "<a href = $story_link>$story_link</a>";
            echo "<br>";
            echo"</th>";echo"</tr>";
            echo"</table>";

            if(isset($_SESSION['user_id'])&&$_SESSION['user_id']==$story_user_id){
                //edit story
                echo "<div class=\"inner_story\">";
                echo "<form action=\"home.php#$story_id\" method=\"get\">";
                    echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                    echo "<input type=\"hidden\" name=\"edit\" value=true>";
                    echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
                    echo "<input type=\"submit\" value=\"Edit story\">";
                echo "</form>";
                //echo "</div>";

                //delete story
                //echo "<div class=\"inner_story\">";
                echo "<form action=\"delete_story.php\" method=\"post\">";
                    echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                    echo "<input type=\"submit\" value=\"Delete story\">";
                    echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
                echo "</form>";
                echo "</div>";

            }

            //edit function--same user and edit button is clicked
            if(isset($_GET['edit'])&&isset($_GET['story_id'])&&isset($_SESSION['user_id'])&&$_SESSION['user_id'] == $story_user_id&&$_GET['story_id'] == $story_id && $_GET['edit'] == "true"){
                echo "<form action=\"edit_story.php\" method=\"POST\">";
                    echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                    echo "<label>Title: <input type=\"text\" size = 67 name=\"title\" value=\"$title\" /></label><br>";
                    echo "<label>Story text: </label><br><textarea cols=\"65\" rows=\"3\" name=\"story\">$story_content</textarea><br>";
                    echo "<label>Link  (optional): <input type=\"text\" size = 67 name=\"link\" value=\"$story_link\" /></label><br>";
                    echo "<input type=\"submit\" value=\"Submit changes\"/>";
                echo "</form>";

                echo "<div class=\"inner_story\">";
                echo "<form action=\"home.php#$story_id\" method=\"get\">";
                    echo "<input type=\"submit\" value=\"Cancel changes\">";
                    echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
                echo "</form>";
                echo "</div>";

            }


            //show comments for stories

            $comment_stmt = $mysqli->prepare("select id, user_id, story_id, comment_content from comments where story_id=?");
            if (!$comment_stmt) {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $comment_stmt->bind_param('i', $story_id);
            $story_id = $story_id;
            $comment_stmt->execute();
            $comment_stmt->store_result();
            $comment_stmt->bind_result($comment_id, $comment_user_id, $comment_story_id, $comment_content);

            //get comments

            while($comment_stmt->fetch()){
                $comment_user_stmt = $mysqli->prepare("SELECT username FROM users WHERE id=?");
                if (!$comment_user_stmt) {
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $comment_user_stmt->bind_param('i', $comment_user_id);
                $comment_user_stmt->execute();
                $comment_user_stmt->bind_result($comment_username);
                $comment_user_stmt->fetch();
                $comment_user_stmt->close();

                echo htmlspecialchars($comment_username) . ": ";
                echo htmlspecialchars($comment_content);
                echo "<br>";

                //form to edit and delete comment
                if(isset($_SESSION['user_id'])&&$_SESSION['user_id'] == $comment_user_id){
                    echo "<div class = \"inner_comment\">";
                    //edit button
                    echo "<form action =\"home.php#$story_id\" method = \"get\">";
                        echo "<input type=\"hidden\" name=\"commentid\" value=$comment_id>";
                        echo "<input type=\"hidden\" name=\"story_id\" value=\"$story_id\"/>";
                        echo "<input type = \"hidden\" name = \"token\" value=\"<?php echo $_SESSION['token'];?>\">";
                        echo "<input type=\"hidden\" name=\"commentedit\" value=true>";
                        echo "<input type=\"submit\" value=\"Edit comment\">";
                    echo "</form>";
                    //delete button
                    echo "<form action =\"delete_comment.php\" method = \"POST\">";
                        echo "<input type=\"hidden\" name=\"commentid\" value=$comment_id>";
                        echo "<input type=\"hidden\" name=\"story_id\" value=\"$story_id\"/>";
                        echo "<input type=\"submit\" value=\"Delete comment\">";
                    echo "</form>";
                    echo "</div>";


                }

                if(isset($_GET['commentid'])&&isset($_SESSION['user_id'])&&$_SESSION['user_id'] == $comment_user_id&&$_GET['commentid'] == $comment_id && $_GET['commentedit'] == "true"){
                    echo "<div class=\"inner_comment\">";
                    echo "<form action=\"edit_comment.php\" method=\"POST\">";
                        echo "<label>Change comment: </label><br><textarea cols=\"65\" rows=\"3\" name=\"comment\">$comment_content</textarea><br>";
                        echo "<input type=\"hidden\" name=\"commentid\" value=$comment_id>";
                        echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                        echo "<input type=\"submit\" value=\"Submit changes\"/>";
                    echo "</form>";
                                
                    // Button to cancel changes
                    //echo "<div class=\"inner_comment\">"; 
                    echo "<form action=\"home.php#$story_id\" method=\"GET\">";
                        echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                        echo "<input type=\"submit\" value=\"Cancel changes\">";
                    echo "</form>";
                    echo "</div>";
                }
            }

            if(isset($_SESSION['user_id'])){
                echo "<form action=\"add_comment.php\" method=\"POST\">";
                    echo "<label>Add New Comment: </label><br><textarea cols=\"65\" rows=\"5\" name=\"comment\"></textarea><br>";
                    echo "<input type=\"hidden\" name=\"story_id\" value=$story_id>";
                    echo "<input type=\"submit\" value=\"Submit\"/>";
                echo "</form>";
            }

            $comment_stmt->close();

        }
        $story_stmt->close();

        echo "</div>";

    ?>   

</body>
</html>