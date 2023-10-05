<?php
include_once '../../dbconfig.php';

$limit = 20;
$article_author_userid = $_POST["article_author_userid"];

$statement = mysqli_prepare($conn, "SELECT * FROM view_notification_with_user_and_article_and_comment WHERE article_author_userid=? limit ?");
mysqli_stmt_bind_param($statement, "ss", $article_author_userid, $limit);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $notificationNo, $isRead, $articleNo, $articleAuthorUserid, $commentContent, $commented, $commentAuthorUserid, $commentAuthorNickname, $commentAuthorProfile);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["notification_no"]=$notificationNo;
	$response["result"][$count]["is_read"]=$isRead;
	$response["result"][$count]["article_no"]=$articleNo;
	$response["result"][$count]["article_author_userid"]=$articleAuthorUserid;
	$response["result"][$count]["comment_content"]=$commentContent;
	$response["result"][$count]["commented"]=$commented;
	$response["result"][$count]["comment_author_userid"]=$commentAuthorUserid;
	$response["result"][$count]["comment_author_nickname"]=$commentAuthorNickname;
	$response["result"][$count]["comment_author_profile"]=$commentAuthorProfile;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
?>