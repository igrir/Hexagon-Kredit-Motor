<?php
	/*****
	 *
		Filename: CariPelanggan.class.php
		Peran: Controller
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Mencari pelangan diredirect ke pengguna
	 *
	 *****/

	include('../config.php');
	include('../include/DB.class.php');
	include('../include/Pelanggan.class.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//tambah user ke database
		$pelanggan = new Pelanggan();

		$id_pelanggan 	= $_POST['id_pelanggan'];

		if ($id_pelanggan == "" || ! is_numeric($id_pelanggan)) {
			header("Location: ../index.php");
		}

		$pelanggan->open();

			$pelanggan->getPelangganWithId($id_pelanggan);
			$hasil = $pelanggan->getResult();
			if ($hasil) {
				header("Location: ../pelanggan.php?id=".$hasil['id_pelanggan']);
			}else{
				header("Location: ../index.php");
			}
			

		$pelanggan->close();
	}
