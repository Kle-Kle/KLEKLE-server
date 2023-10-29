<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"]; // userid 대신 nickname을 써봤는데, 문제 예상될 시 수정하도록
$profile = $_POST["profile"];

$statement = mysqli_prepare($conn, "UPDATE user SET profile=? WHERE userid=?");
mysqli_stmt_bind_param($statement, "ss", $profile, $userid);
mysqli_stmt_execute($statement);

$response = array();
if (mysqli_stmt_execute($statement)) {
    $response["success"] = true;
}
else {
    $response["success"] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>