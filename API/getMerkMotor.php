<?php
	
	include("../include/DB.class.php");
	include("../include/Motor.class.php");


	$db_motor = new Motor();

	$motor = array();

	$i = 0;
	$db_motor->getMerkMotor();
	while ($j = $db_motor->getResult()){
	 	$motor[$i] = $j;
	 	$i++;
	}

	echo json_encode($motor);

	
?>