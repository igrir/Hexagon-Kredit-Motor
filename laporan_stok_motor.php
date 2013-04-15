<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Motor.class.php");

	$motor_db = new Motor();

	$head = new Template("view/template/head.html");
	$content = new Template("view/laporan_stok_motor.html");
	$foot = new Template("view/template/foot.html");

	$tabel_content = "";

	$tabel_open = "<table border=1 width='100%'>
						<tr class='top'>
							<td>No</td>
							<td>id motor</td>
							<td>merk motor</td>
							<td>nama motor</td>
							<td>tahun</td>
							<td>no rangka</td>
							<td>no mesin</td>
							<td>harga</td>
						</tr>";
	$tabel_close = "</table>";

	$tabel_content .= $tabel_open;

	$motor_db->getMotorTersedia();
	$counter = 1;
	while($i = $motor_db->getResult()){
		$tabel_content .= "<tr>";

			$tabel_content .= 	"<td>".
									$counter.
								"</td>".
								"<td>".
									$i['id_motor'].
								"</td>".
								"<td>".
							  		$i['merk_motor'].
							  	"</td>".
							  	"<td>".
							  		$i['nama_motor'].
							  	"</td>".
							  	"<td>".
							  		$i['tahun'].
							  	"</td>".
							  	"<td>".
							  		$i['no_rangka'].
							  	"</td>".
							  	"<td>".
							  		$i['no_mesin'].
							  	"</td>".
							  	"<td>".
							  		$i['harga'].
							  	"</td>";

		$tabel_content .= "</tr>";
		$counter++;
	}

	$tabel_content .= $tabel_close;


	$content->replaces(array("DATA_MOTOR_TERSEDIA"=>$tabel_content));


	$head->write();
	$content->write();
	$foot->write();

?>
