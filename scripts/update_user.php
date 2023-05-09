<?php
	session_start();
	foreach ($_POST as $key => $value){
		if (empty($value)){
			echo "$key<br>";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	require_once "./connect.php";
//	$sql = "INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `birthday`) VALUES ('$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
	$sql = "UPDATE `users` SET `city_id` = '$_POST[city_id]', `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `birthday` = '$_POST[birthday]' WHERE `users`.`id` = $_SESSION[userUpdateId];";
	$conn->query($sql);

	if ($conn->affected_rows == 1){
		$_SESSION["error"] = "Prawidłowo zaktualizowano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie zaktualizowano użytkownika!";
	}

	header("location: ../3_db/4_db_delete_add_update.php");