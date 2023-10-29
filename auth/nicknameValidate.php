<?php
include_once '../dbconfig.php';

$nickname = $_POST["nickname"];

$statement = mysqli_prepare($conn, "SELECT nickname FROM user WHERE nickname = ?");
mysqli_stmt_bind_param($statement, "s", $nickname);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $nickname);


$response = array();
$response["success"] = true;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=false;
	$response["nickname"]=$nickname;
}

echo json_encode($response);
mysqli_close($conn);
?>