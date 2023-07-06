<?php
include_once '../dbconfig.php';

$userid = $_POST["userid"];
$userpw = $_POST["userpw"];


$statement = mysqli_prepare($conn, "SELECT userid, email, nickname, profile FROM user WHERE userid = ? AND userpw = sha2(?,256)");
mysqli_stmt_bind_param($statement, "ss", $userid, $userpw);
mysqli_stmt_execute($statement);


mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userid, $email, $nickname, $profile);

$response = array();
if(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["userid"] = $userid;
	$response["email"] = $email;
	$response["nickname"] = $nickname;
	$response["profile"] = $profile;
}
else {
	$response["success"] = false;
}

echo json_encode($response);
mysqli_close($conn);
?>