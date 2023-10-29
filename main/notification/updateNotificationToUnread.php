<?php
include_once '../../dbconfig.php';

$notificationNo = $_POST["notification_no"];

$statement = mysqli_prepare($conn, "UPDATE notification SET is_read=0 WHERE notification_no=?");
mysqli_stmt_bind_param($statement, "s", $notificationNo);

$response = array();
if(mysqli_stmt_execute($statement)) {
	$response["success"] = true;
}
else {
	$response["success"] = false;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>