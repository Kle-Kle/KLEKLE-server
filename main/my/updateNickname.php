<?php
include_once '../../dbconfig.php';

$newNickname = $_POST["newNickname"];
$nickname = $_POST["nickname"];

$statement = mysqli_prepare($conn, "UPDATE user SET nickname=? WHERE nickname=?");
mysqli_stmt_bind_param($statement, "ss", $newNickname, $nickname);
mysqli_stmt_execute($statement);

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