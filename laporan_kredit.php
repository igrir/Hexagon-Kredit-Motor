<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Kredit.class.php");

	$kredit_db = new Kredit();

	$head = new Template("view/template/head.html");
	$content = new Template("view/laporan_kredit.html");
	$foot = new Template("view/template/foot.html");

	$tabel_content = "";

	$tabel_open = "<table border=1 width='100%'>
						<tr class='top'>
							<td>No</td>
							<td>id_kredit</td>
							<td>tanggal mulai</td>
							<td>lama kredit (bulan)</td>
							<td>bunga</td>
							<td>nama pelanggan</td>
							<td>nama motor</td>
							<td>merk motor</td>
							<td>dp</td>
							<td>status lunas</td>
						</tr>";
	$tabel_close = "</table>";

	$tabel_content .= $tabel_open;

	$counter = 1;

	$kredit_db->getKredit();
	while($i = $kredit_db->getResult()){

		$kredit2_db = new Kredit();		
		$status_lunas = $kredit2_db->isLunas($i['id_kredit']);;
		$lunas = "";

		if ($status_lunas == true) {
			$lunas = "Lunas";
		}else{
			$lunas = "Belum Lunas";
		}

		$tabel_content .= "<tr>";

			$tabel_content .= 	"<td>".
									$counter.
								"</td>".
								"<td>".
							  		$i['id_kredit'].
							  	"</td>".
							  	"<td>".
							  		$i['tanggal_mulai'].
							  	"</td>".
							  	"<td>".
							  		$i['lama_tahun_kredit'].
							  	"</td>".
							  	"<td>".
							  		$i['bunga']."%".
							  	"</td>".
							  	"<td>".
							  		$i['nama'].
							  	"</td>".
							  	"<td>".
							  		$i['nama_motor'].
							  	"</td>".
							  	"<td>".
							  		$i['merk_motor'].
							  	"</td>".
							  	"<td>".
							  		$i['dp'].
							  	"</td>".
							  	"<td>".
							  		$lunas.
							  	"</td>";

		$tabel_content .= "</tr>";
		$counter++;
	}

	$tabel_content .= $tabel_close;


	$content->replaces(array("DATA_KREDIT"=>$tabel_content));


	$head->write();
	$content->write();
	$foot->write();

?>
