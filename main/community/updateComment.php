<?php
include_once '../../dbconfig.php';

$commentNo = $_POST["comment_no"];
$content = $_POST["content"];

$statement = mysqli_prepare($conn, "UPDATE comment SET content=?, is_edited=1 WHERE comment_no=?");
mysqli_stmt_bind_param($statement, "ss", $content, $commentNo);

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