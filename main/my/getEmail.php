<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT email FROM user WHERE userid = ?");
mysqli_stmt_bind_param($statement, "s", $userid);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $email);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=true;
	$response["email"]=$email;
}

echo json_encode($response);
mysqli_close($conn);
?>  