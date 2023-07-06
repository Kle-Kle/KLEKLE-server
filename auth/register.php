<?php
include_once '../dbconfig.php';
include_once './initProfile.php';

$userid = $_POST["userid"];
$email = $_POST["email"];
$userpw = $_POST["userpw"];
$nickname = $_POST["nickname"];

$height = $_POST["height"];
$weight = $_POST["weight"];
$reach = $_POST["reach"];

$statement = mysqli_prepare($conn, "INSERT INTO user VALUES (?,?,sha2(?,256),?,?)");
$statement2 = mysqli_prepare($conn, "INSERT INTO bodyinfo VALUES (?,?,?,?)");

mysqli_stmt_bind_param($statement, "sssss", $userid, $email, $userpw, $nickname, $profile);
mysqli_stmt_execute($statement);

mysqli_stmt_bind_param($statement2, "ssss", $userid, $height, $weight, $reach);
mysqli_stmt_execute($statement2);

$response = array();
$response["success"] = true;

echo json_encode($response);
?>