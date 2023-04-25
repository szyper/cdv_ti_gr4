<?php
	//print_r($_GET);
	require_once "./connect.php";
	$sql = "DELETE FROM users WHERE `users`.`id` = $_GET[userDeleteId]";
	//$sql = "DELETE FROM users WHERE `users`.`lastName` = 'Nowak'";
	//$sql = "DELETE FROM users WHERE `users`.`id` = 111111";
	$conn->query($sql);

	//echo $conn->affected_rows;

//error lub ok, komunikat na stronie 2_db.php
	if ($conn->affected_rows == 0){
		//echo "error";
		header("location: ../3_db/3_db_delete_add.php?infoDeleteUser=0");
	}else{
		//echo "ok";
		header("location: ../3_db/3_db_delete_add.php?infoDeleteUser=1");
	}