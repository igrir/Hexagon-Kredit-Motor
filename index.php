<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Angsur.class.php");

	$angsur_db = new Angsur();

	$head = new Template('view/template/head.html');
	$body = new Template('view/halaman_utama.html');
	$foot = new Template('view/template/foot.html');


	$pembayar = $angsur_db->getAngsuranBulanIni();

	$head->replace("DATA_TITLE", "halaman_utama");

	$table_open = "<table width='100%' class='small_text'>
					<tr>
						<td width='15px'>id</td>
						<td width='80px'>Nama</td>
						<td width='50px'>Tanggal tenggat</td>
					</tr>";
	$table_close = "</table>";
	$table_content = "";


	$table_content .= $table_open;

	if (count($pembayar) == 0) {
		$table_content .= "<td colspan=3><center><b>Tidak ada pembayaran untuk bulan ini</b></center></td>";
	}

	for ($i = 0; $i < count($pembayar) ; $i++) {
		$table_content .= "<tr>";

		$table_content .= "<td>".$pembayar[$i]['id_pelanggan']."</td>";
		$table_content .= "<td> <a href='pelanggan.php?id=".$pembayar[$i]['id_pelanggan']."''>".$pembayar[$i]['nama']."</a></td>";
		$table_content .= "<td>".$pembayar[$i]['tgl_tenggat']."</td>";

		$table_content .= "</tr>";
	}
	$table_content .= $table_close;
	
	$tanggal = date('Y-m-d');	


	$body->replaces(array('DATA_PEMBAYAR'=>$table_content,
						  'DATA_TANGGAL'=>$tanggal));

	$head->write();
	$body->write();

	$foot->write();

?>