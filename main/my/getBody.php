<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];

$statement = mysqli_prepare($conn, "SELECT height, weight, reach FROM bodyinfo WHERE userid = ?");
mysqli_stmt_bind_param($statement, "s", $userid);
mysqli_stmt_execute($statement);

mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $height, $weight, $reach);

$response = array();
$response["success"] = false;

while(mysqli_stmt_fetch($statement)){
	$response["success"]=true;
	$response["height"]=$height;
    $response["weight"]=$weight;
    $response["reach"]=$reach;
}

echo json_encode($response);
?>  