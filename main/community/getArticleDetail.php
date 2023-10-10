<?php
include_once '../../dbconfig.php';

$article_no = $_POST["article_no"];

$statement = mysqli_prepare($conn, "SELECT * FROM view_article_preview WHERE article_no = ?");
mysqli_stmt_bind_param($statement, "s", $article_no);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userNickname, $userId, $userProfile, $userFcmToken, $articleNo, $published, $articleContent, $commentCount, $articleImage, $isEdited);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["userNickname"]=$userNickname;
	$response["result"][$count]["userId"]=$userId;
	$response["result"][$count]["userProfile"]=$userProfile;
	$response["result"][$count]["userFcmToken"]=$userFcmToken;
	$response["result"][$count]["articleNo"]=$articleNo;
	$response["result"][$count]["published"]=$published;
	$response["result"][$count]["articleContent"]=$articleContent;
	$response["result"][$count]["commentCount"]=$commentCount;
	$response["result"][$count]["articleImage"]=$articleImage;
	$response["result"][$count]["isEdited"]=$isEdited;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
?>