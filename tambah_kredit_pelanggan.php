<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Pelanggan.class.php");

	//dapat id dari GET
	$id_pelanggan = $_GET['id'];

	$db_pelanggan = new Pelanggan();
	$db_pelanggan->open();

	$db_pelanggan->getPelangganWithId($id_pelanggan);
	$pelanggan = $db_pelanggan->getResult();

	$pelanggan_nama = $pelanggan['nama'];

	$content = new Template('view/tambah_kredit.html');
	$header  = new Template('view/template/head.html');
	$footer  = new Template('view/template/foot.html');

	//ganti data-data dalam template
	$header->replace('DATA_TITLE', 'pelanggan');

	$content->replaces(array('DATA_NAMA_PELANGGAN'=>$pelanggan_nama,
							 'DATA_ID_PELANGGAN'=>$pelanggan['id_pelanggan'])
					  );


	//tuliskan
	$header->write();
	$content->write();
	$footer->write();

	$db_pelanggan->close();

?>