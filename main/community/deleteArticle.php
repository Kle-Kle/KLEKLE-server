<?php
include_once '../../dbconfig.php';

$articleNo = $_POST["article_no"];

$statement = mysqli_prepare($conn, "DELETE FROM article WHERE article_no = ?");
mysqli_stmt_bind_param($statement, "s", $articleNo);

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