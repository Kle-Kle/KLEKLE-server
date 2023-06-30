<?php
include_once '../../dbconfig.php';

$newNickname = $_POST["newNickname"];
$nickname = $_POST["nickname"];

$statement = mysqli_prepare($conn, "UPDATE user SET nickname=? WHERE nickname=?");
mysqli_stmt_bind_param($statement, "ss", $newNickname, $nickname);
mysqli_stmt_execute($statement);    

$response = array();
$response["success"] = true;

echo json_encode($response);
?>  