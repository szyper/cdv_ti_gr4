<?php

try{
	$conn = new mysqli("localhost", "root", "", "cdv_gr_4_register");
}catch(mysqli_sql_exception $e){
	echo $e->getMessage();
}
