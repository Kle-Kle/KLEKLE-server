<?php
include_once '../dbconfig.php';

$fcmToken = $_POST["fcmToken"];
$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "UPDATE user SET fcm_token = ? WHERE userid = ?");
mysqli_stmt_bind_param($statement, "ss", $fcmToken, $userid);

$response = array();
if(mysqli_stmt_execute($statement)) {
	$response["success"] = true;
}
else {
	$response["success"] = false;
}

header('Content-type: text/javascript');
echo json_encode($response);
mysqli_close($conn);
?>