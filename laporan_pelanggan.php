<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Pelanggan.class.php");

	$pelanggan = new Pelanggan();

	$head = new Template("view/template/head.html");
	$content = new Template("view/laporan_pelanggan.html");
	$foot = new Template("view/template/foot.html");

	$tabel_content = "";

	$tabel_open = "<table border=1 width='100%'>
						<tr class='top'>
							<td>no</td>
							<td>id pelanggan</td>
							<td>nama</td>
							<td>alamat</td>
							<td>nomor telepon</td>
							<td>alamat</td>
						</tr>";
	$tabel_close = "</table>";

	$tabel_content .= $tabel_open;

	$pelanggan->getPelanggan();

	$counter = 1;
	while($i = $pelanggan->getResult()){
		$tabel_content .= "<tr>";

			$tabel_content .= 	"<td>".
									$counter.
								"</td>".
								"<td>".
							  		$i['id_pelanggan'].
							  	"</td>".
							  	"<td> <a href='pelanggan.php?id=".$i['id_pelanggan']."'>".
							  		$i['nama'].
							  	"</a></td>".
							  	"<td>".
							  		$i['alamat'].
							  	"</td>".
							  	"<td>".
							  		$i['no_telp'].
							  	"</td>".
							  	"<td>".
							  		$i['pekerjaan'].
							  	"</td>";

		$tabel_content .= "</tr>";
		$counter++;
	}

	$tabel_content .= $tabel_close;


	$content->replaces(array("DATA_PELANGGAN"=>$tabel_content));


	$head->write();
	$content->write();
	$foot->write();

?>
