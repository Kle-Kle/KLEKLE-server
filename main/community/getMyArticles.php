<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT * FROM view_article_preview WHERE userid = ? ");
mysqli_stmt_bind_param($statement, "s", $userid);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userNickname, $userId, $userProfile, $articleNo, $articleContent, $commentCount, $articleImage);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["userNickname"]=$userNickname;
	$response["result"][$count]["userId"]=$userId;
	$response["result"][$count]["userProfile"]=$userProfile;
	$response["result"][$count]["articleNo"]=$articleNo;
	$response["result"][$count]["articleContent"]=$articleContent;
	$response["result"][$count]["commentCount"]=$commentCount;
	$response["result"][$count]["articleImage"]=$articleImage;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
?>