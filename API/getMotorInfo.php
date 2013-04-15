<?php
	
	include("../include/DB.class.php");
	include("../include/Motor.class.php");


	//$id_motor = $_GET['id_motor'];

	$merk_motor = $_GET['merk_motor'];
	$nama_motor = $_GET['nama_motor'];


	$db_motor = new Motor();

	$motor = array();

	if ($merk_motor != "" && $nama_motor != "") {
		$db_motor->getMotorWithMerkAndNama($merk_motor, $nama_motor);
		$motor = $db_motor->getResult();
		$result = json_encode($motor);
		echo $result;
	}else{
		echo 'NULL';
	}

	
?>