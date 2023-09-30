<?php
include_once '../../dbconfig.php';

$content = $_POST["content"];
$userid = $_POST["userid"];
$article_no = $_POST["article_no"];

$statement = mysqli_prepare($conn, "INSERT INTO comment VALUES (null, ?, NOW(), ?, ?)");
mysqli_stmt_bind_param($statement, "sss", $content, $userid, $article_no);
// mysqli_stmt_execute($statement); // 이렇게 해 두니까, 쿼리가 두 번 실행되면서 값이 두 번 insert 되더라구요

$response = array();
// mysqli_stmt_execute(): 성공하면 true, 실패하면 false를 반환
if (mysqli_stmt_execute($statement)) {
    $response["success"] = true;
}
else {
    $response["success"] = false;
}

echo json_encode($response);
?>