<?php
include_once '../dbconfig.php';

$userid = $_POST["userid"];
$email = $_POST["email"];
$userpw = $_POST["userpw"];
$nickname = $_POST["nickname"];


$statement = mysqli_prepare($conn, "SELECT userid, email, nickname FROM user WHERE userid = ? AND userpw = sha2(?,256)");
mysqli_stmt_bind_param($statement, "ss", $userid, $userpw);
mysqli_stmt_execute($statement);


mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userid, $email, $nickname);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["userid"] = $userid;
	$response["email"] = $email;
	$response["nickname"] = $nickname;
}

echo json_encode($response);
mysqli_close($conn);
?>