<?php
include_once '../../dbconfig.php';

$article_author_userid = $_POST["article_author_userid"];

$statement = mysqli_prepare($conn, "SELECT count(is_read) FROM view_notification_with_user_and_article_and_comment WHERE (article_author_userid=? AND is_read=0)");
mysqli_stmt_bind_param($statement, "s", $article_author_userid);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $count);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=true;
	$response["count"]=$count;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>