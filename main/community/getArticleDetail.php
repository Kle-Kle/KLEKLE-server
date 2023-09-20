<?php
include_once '../../dbconfig.php';

$statement = mysqli_prepare($conn, "SELECT * from view_article_detail");
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($user_nickname, $user_id, $user_profile, $article_no, $article_content, $comment_count, $article_image);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["user_nickname"]=$user_nickname;
	$response["result"][$count]["user_id"]=$user_id;
	$response["result"][$count]["user_profile"]=$user_profile;
	$response["result"][$count]["article_no"]=$article_no;
	$response["result"][$count]["article_content"]=$article_content;
	$response["result"][$count]["comment_count"]=$comment_count;
	$response["result"][$count]["article_image"]=$article_image;

	$count++;
}

echo json_encode($response);
?>