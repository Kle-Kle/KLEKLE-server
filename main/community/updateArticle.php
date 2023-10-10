<?php
include_once '../../dbconfig.php';

$articleNo = $_POST["article_no"];
$content = $_POST["content"];
$image = $_POST["image"];

// $statement = mysqli_prepare($conn, "UPDATE article SET published=NOW(), content=?, image=? WHERE article_no=?");
$statement = mysqli_prepare($conn, "UPDATE article SET content=?, image=? WHERE article_no=?"); // published 수정 안 함
mysqli_stmt_bind_param($statement, "sss", $content, $image, $articleNo);

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