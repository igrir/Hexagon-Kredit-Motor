<?php

	//API mendapatkan nama motor dari merek motor
	
	include("../include/DB.class.php");
	include("../include/Motor.class.php");

	$merk = $_GET['merk'];

	$db_motor = new Motor();

	$motor = array();

	if ($merk != "") {
		$i = 0;
		$db_motor->getAvailableNamaMotorWhereMerk($merk);
		while ($j = $db_motor->getResult()){
		 	$motor[$i] = $j;
		 	$i++;
		}
		echo json_encode($motor);
	}else{
		echo 'tidak ada motor tersedia';
	}

	

	

	
?>