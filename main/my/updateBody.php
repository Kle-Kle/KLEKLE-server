<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];
$height = $_POST["height"];
$weight = $_POST["weight"];
$reach = $_POST["reach"];

$statement = mysqli_prepare($conn, "UPDATE bodyinfo SET height=?, weight=?, reach=? WHERE userid=?;");
mysqli_stmt_bind_param($statement, "ssss", $height, $weight, $reach, $userid);
mysqli_stmt_execute($statement);    

$response = array();
$response["success"] = true;

echo json_encode($response);
?>  