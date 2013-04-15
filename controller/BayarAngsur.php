<?php
	/*****
	 *
		Filename: BayarAngsur.php
		Peran: Controller
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Mengontrol pembayaran angsuran
	 *
	 *****/

	include('../config.php');
	include('../include/DB.class.php');
	include('../include/Angsur.class.php');
	include('../include/Kwitansi.class.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$angsur   = new Angsur();
		$kwitansi = new Kwitansi();

		$tgl_bayar 	 	= $_POST['tgl_bayar'];
		$denda		 	= $_POST['denda'];
		$penerima		= $_POST['penerima'];
		$id_kredit	 	= $_POST['id_kredit'];	
		$pembayaran_ke	= $_POST['pembayaran_ke'];
		$id_pelanggan 	= $_POST['id_pelanggan'];  	
			
		//cek dulu ada di dalam database
		$cek_exist = $angsur->isAngsurWithIdKreditAndPembayaranKeExist($id_kredit, $pembayaran_ke);
		if ($cek_exist) {
			$action = $angsur->updateAngsurWhereIdKredit($id_kredit, $pembayaran_ke, $tgl_bayar, $denda, $penerima);
			if ($action) {
				$angsur->getAngsurWithIdKreditAndPembayaranKe($id_kredit,$pembayaran_ke);
				$result = $angsur->getResult();

				$id_angsur = $result['id_angsur'];

				$kwitansi_action = $kwitansi->addKwitansiWithIdAngsur($id_angsur);

				if ($kwitansi_action) {
					header("Location: ../pelanggan.php?id=$id_pelanggan");
				}else{
					echo "tak bisa memasukkan kwitansi:".mysql_error();
				}
				
			}else{
				echo "tak bisa update angsur :".mysql_error();
			}

		}


		

	}