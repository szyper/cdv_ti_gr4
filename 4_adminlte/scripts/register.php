<?php
session_start();
//	echo "<pre>";
//		print_r($_POST);
//	echo "</pre>";

foreach ($_POST as $key => $value){
	//echo "$key: $value<br>";
	if (empty($value)){
		//echo "$key<br>";
		$_SESSION["error"] = "Wypełnij wszystkie pola!";
		echo "<script>history.back();</script>";
		exit();
	}
}

//mysqli_report(MYSQLI_REPORT_ERROR);
mysqli_report(MYSQLI_REPORT_STRICT);

//https://www.php.net/manual/en/mysqli-stmt.bind-param.php
require_once "./connect.php";

$stmt = $conn->prepare("INSERT INTO `users` (`city_id`, `email`, `firstName`, `lastName`, `birthday`, `password`) VALUES (?, ?, ?, ?, ?, ?);");

$stmt->bind_param("isssss", $_POST["city_id"], $_POST["email"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["pass"]);

$stmt->execute();
//echo $stmt->affected_rows;


if ($stmt->affected_rows){
	$_SESSION["success"] = "Prawidłowo dodano użytkownika "." ".$_POST["firstName"]." ".$_POST["lastName"];
	header("location: ../views/pages/index.php");;
}else{
	$_SESSION["error"] = "Nie dodano dodano użytkownika!";
	echo "<script>history.back();</script>";
}
