<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="newsstylesheet.css">
</head>
<body>
<div class = "main">
<form action = "search.php" method="GET">
	<label>Search:</label>
    <input type="text" name="search" >
    <input type = "submit" value = "search">
</form>
</div>



<?php


if(isset($_GET['search'])){
	require 'database.php';
$search = $_GET['search'];

$search_story_stmt = $mysqli->prepare("select COUNT(*), stories.user_id, title,story_content,story_link,users.username from stories left join users on (stories.user_id=users.id) where title like '%$search%'");

if(!$search_story_stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$search_story_stmt->execute();
$search_story_stmt->bind_result($count,$story_user_id,$title,$story_content,$story_link,$story_author);


echo "<div id = \"main_page\">";


while($search_story_stmt->fetch()){
	if($count==0){
		echo '<br><br><br><br><br><br><br><br><br><br>This query returned no results';
	}
	else{
		echo '<br><br>Here are your search results:';
		echo "<br>";
		echo htmlspecialchars($title) ;
        echo "Post By: " . htmlspecialchars($story_author);
        echo "<br>";
        echo htmlspecialchars($story_content);
        echo "<br>";
        echo "<a href = $story_link>$story_link</a>";
        echo "<br>";
	}
}
echo "<form action = \"home.php\" method=\"GET\">";
echo "<input type = \"submit\" value = \"Back\">";
echo "</form>";

echo "</div>";

}








?>



</body>
</html>

