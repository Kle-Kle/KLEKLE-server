<?php
include_once '../../dbconfig.php';

$article_no = $_POST["articleNo"];

$statement = mysqli_prepare($conn, "select * from view_comment_with_user where articleNo=?");
mysqli_stmt_bind_param($statement, "s", $article_no);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userNickname, $userid, $userProfile, $commentNo, $commentContent, $commented, $isEdited, $articleNum);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["userNickname"]=$userNickname;
	$response["result"][$count]["userid"]=$userid;
	$response["result"][$count]["userProfile"]=$userProfile;
	$response["result"][$count]["commentNo"]=$commentNo;
	$response["result"][$count]["commentContent"]=$commentContent;
	$response["result"][$count]["commented"]=$commented;
	$response["result"][$count]["articleNo"]=$articleNum;
	$response["result"][$count]["isEdited"]=$isEdited;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>