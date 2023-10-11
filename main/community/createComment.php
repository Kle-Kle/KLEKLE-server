<?php
include_once '../../dbconfig.php';

$content = $_POST["content"];
$userid = $_POST["userid"];
$article_no = $_POST["article_no"];

$statement = mysqli_prepare($conn, "INSERT INTO comment VALUES (null, ?, NOW(), ?, ?, 0)");
mysqli_stmt_bind_param($statement, "sss", $content, $userid, $article_no);
mysqli_stmt_execute($statement);

// select 해서 이 comment의 comment id를 가지고 싶다
$statement2 = mysqli_prepare($conn, "SELECT comment_no FROM view_comment_with_user WHERE articleNo=? ORDER BY commented DESC LIMIT 1");
mysqli_stmt_bind_param($statement2, "s", $article_no);
mysqli_stmt_execute($statement2);
mysqli_stmt_store_result($statement2);
mysqli_stmt_bind_result($statement2, $comment_no);
$temp = 0;
while(mysqli_stmt_fetch($statement2)){
	$temp = $comment_no;
}

$statement3 = mysqli_prepare($conn, "INSERT INTO notification VALUES (null, ?, ?, 0)"); // 마지막 인자의 정체: is_read
mysqli_stmt_bind_param($statement3, "ss", $article_no, $temp);
mysqli_stmt_execute($statement3);

$response = array();
$response["success"] = true;
echo json_encode($response);
?>