<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Angsur.class.php");
	include("include/Pelanggan.class.php");
	include("include/Motor.class.php");


	$id_kredit = $_GET['id_kredit'];
	//$pembayaran_ke = $_GET['pembayaran_ke'];
	$id_pelanggan = $_GET['id_pelanggan'];

	$header = new Template('view/template/head.html');
	$footer = new Template('view/template/foot.html');	

	$db_angsur = new Angsur();
	$db_pelanggan = new Pelanggan();
	$db_motor = new Motor();
	
	$belum_dibayar_txt .= "";

	//---------------- mendapatkan informasi pelanggan ----------------//
	$db_pelanggan->getPelangganWithId($id_pelanggan);
	$pelanggan = $db_pelanggan->getResult();

	$nama_pelanggan = $pelanggan['nama'];

	//---------------- akhir mendapatkan informasi pelanggan ----------------//


	//---------------- mendapatkan informasi motor ----------------//
	$db_motor->getMotorWithIdKredit($id_kredit);
	$motor =$db_motor->getResult();

	$nama_motor = $motor['nama_motor'];
	//---------------- akhir mendapatkan informasi motor ----------------//

	//---------------- menghitung denda ----------------//
	//denda sehari tidak bayar 5%
	$denda = 0;

	//$db_angsur->getAngsurWithIdKreditAndPembayaranKe($id_kredit,$pembayaran_ke);
	$db_angsur->getNextAngsurWithIdKredit($id_kredit);
	$angsuran = $db_angsur->getResult();

	//var_dump($angsuran);

	$pembayaran_ke =$angsuran['pembayaran_ke'];

	$tanggal_tenggat = strtotime($angsuran['tgl_tenggat']);
	$tanggal_sekarang = time();

	$perbedaan_tanggal = $tanggal_sekarang - $tanggal_tenggat;
	$perbedaan_hari = floor($perbedaan_tanggal/(60*60*24));

	//kalau perbedaan harinya positif berarti telat
	if ($perbedaan_hari > 0) {

		//denda sebesar 0.2%
		$denda = (2/100)*$angsuran['biaya'];
	}
	//---------------- akhir menghitung denda ----------------//


	$biaya = $angsuran['biaya'];
	$date = date('Y-m-d');
	
	$content = new Template('view/bayar.html');

	$content->replaces(array("DATA_ID_KREDIT"=>$id_kredit,
							 "DATA_PEMBAYARAN_KE"=>$pembayaran_ke,
							 "DATA_BIAYA"=>$biaya,
							 "DATA_DENDA"=>$denda,
							 "DATA_ID_PELANGGAN"=>$id_pelanggan,
							 "DATA_NAMA_PELANGGAN"=>$nama_pelanggan,
							 "DATA_NAMA_MOTOR"=>$nama_motor,
							 "DATA_DATE"=>$date,
							 "DATA_TANGGAL_TENGGAT"=>$angsuran['tgl_tenggat']));



	$header->write();
	$content->write();
	$footer->write();
?>