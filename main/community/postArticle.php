<?php
include_once '../dbconfig.php';
include_once './initProfile.php';

$content = $_POST["content"];
$userid = $_POST["userid"];
$image = $_POST["image"];

$statement = mysqli_prepare($conn, "INSERT INTO article VALUES (null, null, NOW(), ?, ?, ?)"); // 본문 내용, userid, image
mysqli_stmt_bind_param($statement, "sss", $content, $userid, $image);
mysqli_stmt_execute($statement);

$response = array();
$response["success"] = true;

echo json_encode($response);
?>