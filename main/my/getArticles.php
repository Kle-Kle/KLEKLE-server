<?php
	include_once '../../dbconfig.php';
	$statement = mysqli_prepare($conn, "SELECT * FROM article");
	mysqli_stmt_execute($statement);

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $article_no, $recommend_result, $published, $content, $userid);

	$response = array();
	$response["success"] = false;
    $response["result"] = array();

	$count = 0;

	while(mysqli_stmt_fetch($statement)) {
		$response["success"] = true;
		$response["result"][$count]["article_no"]=$article_no;
    	$response["result"][$count]["recommend_result"]=$recommend_result;
    	$response["result"][$count]["published"]=$published;
		$response["result"][$count]["content"]=$content;
    	$response["result"][$count]["userid"]=$userid;
		
		$count++;
	}

	echo json_encode($response);
?>