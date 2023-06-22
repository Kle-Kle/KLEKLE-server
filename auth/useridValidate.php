<?php
include_once '../dbconfig.php';

$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT userid FROM user WHERE userid = ?");
mysqli_stmt_bind_param($statement, "s", $userid);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userid);


$response = array();
$response["success"] = true;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=false;
	$response["userid"]=$userid;
}

echo json_encode($response);
?>