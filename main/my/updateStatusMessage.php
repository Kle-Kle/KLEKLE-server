<?php
include_once '../../dbconfig.php';

$newStatusMessage = $_POST["newStatusMessage"];
$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "UPDATE user SET message=? WHERE userid=?");
mysqli_stmt_bind_param($statement, "ss", $newStatusMessage, $userid);
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
mysqli_close($conn);
?>  