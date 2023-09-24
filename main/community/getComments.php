<?php
include_once '../../dbconfig.php';

$article_no = $_GET["articleNo"];

$statement = mysqli_prepare($conn, "select * from view_comment_with_user where articleNo=?");
mysqli_stmt_bind_param($statement, "s", $article_no);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($user_nickname, $userid, $user_profile, $comment_no, $comment_content, $commented, $userid, $articleNo);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["user_nickname"]=$user_nickname;
	$response["result"][$count]["userid"]=$userid;
	$response["result"][$count]["user_profile"]=$user_profile;
	$response["result"][$count]["comment_no"]=$comment_no;
	$response["result"][$count]["content"]=$content;
	$response["result"][$count]["commented"]=$commented;
	$response["result"][$count]["userid"]=$userid;
	$response["result"][$count]["article_no"]=$articleNo;

	$count++;
}

echo json_encode($response);
?>