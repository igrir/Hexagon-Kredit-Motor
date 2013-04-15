<?php
	/*****
	 *
		Filename: DaftarPelanggan.class.php
		Peran: Controller
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas yang mengontrol view daftar pelanggan
	 *
	 *****/

	include('../config.php');
	include('../include/DB.class.php');
	include('../include/Pelanggan.class.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//tambah user ke database
		$pelanggan = new Pelanggan();

		$nama 		= $_POST['nama'];
		$alamat 	= $_POST['alamat'];
		$no_telp 	= $_POST['no_telp'];
		$pekerjaan  = $_POST['pekerjaan'];
		$no_ktp  = $_POST['no_ktp'];

		$action = $pelanggan->addPelanggan($nama, $alamat, $no_telp, $pekerjaan, $no_ktp);

		if ($action) {
			header("Location: ../index.php");
		}
	}
