<?php
include_once '../../dbconfig.php';

$currentDate = $_POST["currentDate"];
$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT userid, published FROM view_article_preview WHERE published LIKE ? HAVING userid=?");
mysqli_stmt_bind_param($statement, "ss", $currentDate, $userid);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $userId, $published);

$response = array();
$response["success"] = false;
$response["result"] = array();

$count = 0;

while(mysqli_stmt_fetch($statement)) {
	$response["success"] = true;
	$response["result"][$count]["userId"]=$userId;
	$response["result"][$count]["published"]=$published;

	$count++;
}

header('Content-type: text/javascript');
echo json_encode($response, JSON_PRETTY_PRINT);
mysqli_close($conn);
?>