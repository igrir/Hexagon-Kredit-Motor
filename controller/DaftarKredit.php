<?php
	/*****
	 *
		Filename: DaftarKredit.php
		Peran: Controller
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas yang mengontrol view tambah kredit
	 *
	 *****/

	include('../config.php');

	include('../include/hitung_tenggat.php');

	include('../include/DB.class.php');
	include('../include/Kredit.class.php');
	include('../include/Angsur.class.php');
	include('../include/Motor.class.php');
	include('../include/Kwitansi.class.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//tambah user ke database
		$kredit = new Kredit();
		$angsur = new Angsur();
		$motor = new Motor();
		$kwitansi = new Kwitansi();

		$tanggal_mulai		= $_POST['tanggal_mulai'];
		$lama_tahun_kredit	= $_POST['lama_tahun_kredit'];
		$bunga				= $_POST['bunga'];
		$id_pelanggan		= $_POST['id_pelanggan'];
		$id_motor			= $_POST['id_motor'];
		$dp 				= $_POST['dp'];

		$motor->getMotorWithId($id_motor);
		$keterangan_motor = $motor->getResult();
		
		//cek ketersediaan motor
		$tersedia = $motor->isTersedia($id_motor);

		if ($tersedia) {
			$action = $kredit->addKredit($tanggal_mulai,
									 $lama_tahun_kredit,
									 floatval($bunga),
									 $id_pelanggan,
									 $id_motor,
									 doubleval($dp));
			$id_kredit = $kredit->getLastInsertedId();

			if ($action) {

				//tambah angsur sebanyak 12 x tahun
				$hitung_tenggat = hitung_tenggat($tanggal_mulai,$lama_tahun_kredit);

				//for ($i = 1 ;$i <= ($lama_tahun_kredit*12); $i++) {
				for ($i = 1 ;$i <= ($lama_tahun_kredit); $i++) {
					//disini dihitung tanggal per bulannya
					$tgl_tenggat = $hitung_tenggat[$i-1];
					
					//biaya
					//didapat dari:
					// (harga motor - dp)/(lama_tahun_kredit*12)+((harga motor - dp)/(lama_tahun_kredit*12)*bunga/100)
					$biaya = ($keterangan_motor['harga'] - $dp)/($lama_tahun_kredit*12)+(($keterangan_motor['harga'] - $dp)/($lama_tahun_kredit*12)*$bunga/100);

					//KALAU ANGSURAN PERTAMA LANGSUNG DITAMBAHKAN
					if ($i == 1) {
						$now_date = strval(date("Y-m-d")); //tanggal sekarang
						$action = $angsur->addAngsur(1, $now_date, $tgl_tenggat, $biaya, 0, $id_kredit, '', 1);

						$id_angsur = $angsur->getLastInsertedId();

						$kwitansi_action = $kwitansi->addKwitansiWithIdAngsur($id_angsur);

					}else{
						$action = $angsur->addAngsur($i, NULL, $tgl_tenggat, $biaya, 0, $id_kredit, '', 0);	
					}

					
				}


				if ($action) {


					$action = $motor->setTersediaWhereId(0, $id_motor);

					if ($action) {
						header("Location: ../pelanggan.php?id=$id_pelanggan");
					}
					
				}
			}
		}else{
			header("Location: ../pelanggan.php?id=$id_pelanggan");
		}
	}
