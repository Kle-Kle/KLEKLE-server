<?php
include_once '../../dbconfig.php';

$currentDate = $_POST["currentDate"];
$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT * FROM view_article_preview WHERE published LIKE ? HAVING userid = ? ORDER BY published DESC LIMIT 1");
mysqli_stmt_bind_param($statement, "ss", $currentDate, $userid);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userNickname, $userid, $userProfile, $articleNo, $published, $articleContent, $commentCount, $articleImage);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=true;
	$response["user_nickname"]=$userNickname;
	$response["userid"]=$userid;
	$response["user_profile"]=$userProfile;
	$response["article_no"]=$articleNo;
	$response["published"]=$published;
	$response["article_content"]=$articleContent;
	$response["comment_count"]=$commentCount;
	$response["article_image"]=$articleImage;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
?>  