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

try{
	$conn = new mysqli("localhost", "root", "", "cdv_gr_4_register1");

	//rejestracja użytkownika (dokończyć)
	//https://www.php.net/manual/en/mysqli-stmt.bind-param.php
}catch(mysqli_sql_exception $e){
	echo $e->getMessage();
}


echo "ok";