<?php
	print_r($_POST);


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$errors = [];

	foreach ($_POST as $key => $value) {
		if (empty($value)) {
			$errors[] = "Pole $key jest wymagane!";
		}
	}

	if (!empty($errors)) {
		$_SESSION["error"] = implode("<br>", $errors);
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./connect.php";

	try {
		$stmt = $conn->prepare("");

		$stmt->bind_param("", );

		$stmt->execute();

		if ($stmt->affected_rows) {
			echo "ok";
		} else {
			echo "error";
		}

	} catch (mysqli_sql_exception $e) {
		$_SESSION["error"] = $e->getMessage();

		echo "<script>history.back();</script>";
	}

} else {
	$_SESSION["error"] = "Wypełnij wszystkie dane";
	echo "<script>history.back();</script>";
}