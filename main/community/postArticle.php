<?php
include_once '../../dbconfig.php';
include_once './initProfile.php';

$content = $_POST["content"];
$userid = $_POST["userid"];
$image = $_POST["image"];

$statement = mysqli_prepare($conn, "INSERT INTO article VALUES (null, null, NOW(), ?, ?, ?)"); // 본문 내용, userid, image
mysqli_stmt_bind_param($statement, "sss", $content, $userid, $image);

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