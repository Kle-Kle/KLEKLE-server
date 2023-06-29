<?php
include_once '../../dbconfig.php';

$userid = $_POST["userid"];
$email = $_POST["email"];
$userpw = $_POST["userpw"];

$statement = mysqli_prepare($conn, "UPDATE user SET email=?, userpw=sha2(?,256) WHERE userid=?");
mysqli_stmt_bind_param($statement, "sss", $email, $userpw, $userid);
mysqli_stmt_execute($statement);    

$response = array();
$response["success"] = true;

echo json_encode($response);
?>  