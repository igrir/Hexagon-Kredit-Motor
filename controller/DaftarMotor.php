<?php
	/*****
	 *
		Filename: DaftarMotor.class.php
		Peran: Controller
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Mengontrol pendaftaran motor
	 *
	 *****/

	include('../config.php');
	include('../include/DB.class.php');
	include('../include/Motor.class.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//tambah user ke database
		$motor = new Motor();

		$merk_motor		= $_POST['merk_motor'];
		$nama_motor		= $_POST['nama_motor'];
		$tahun			= $_POST['tahun'];		
		$no_rangka		= $_POST['no_rangka'];
		$no_mesin		= $_POST['no_mesin'];	
		$harga			= $_POST['harga'];		

		$motor->open();

			$action = $motor->addMotor($merk_motor, $nama_motor, $tahun, $no_rangka, $no_mesin, $harga);

		$motor->close();

		if ($action) {
			header("Location: ../index.php");
		}

	}
