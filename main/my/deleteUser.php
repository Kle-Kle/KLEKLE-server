<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "DELETE FROM user WHERE userid=?");
mysqli_stmt_bind_param($statement, "s", $userid);
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