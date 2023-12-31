<?php
include_once '../../dbconfig.php';

$limit = 10;
$last_date = $_POST['last_date'];
$userid = $_POST["userid"];
// $last_date = '2023-10-02 00:45:03';

$statement = mysqli_prepare($conn, "SELECT user_nickname, userid, user_profile, article_no, published, article_content, comment_count, article_image, is_edited FROM view_article_preview WHERE published < ? HAVING userid = ? LIMIT ?");
mysqli_stmt_bind_param($statement, "sss", $last_date, $userid, $limit);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $user_nickname, $user_id, $user_profile, $article_no, $published, $article_content, $comment_count, $article_image, $isEdited);

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
	$response["result"][$count]["published"]=$published;
	$response["result"][$count]["article_content"]=$article_content;
	$response["result"][$count]["comment_count"]=$comment_count;
	$response["result"][$count]["article_image"]=$article_image;
	$response["result"][$count]["isEdited"]=$isEdited;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>