<?php
	include("config.php");
	include("include/Template.class.php");

	include("include/DB.class.php");
	include("include/Pelanggan.class.php");
	include("include/Kredit.class.php");
	include("include/Angsur.class.php");
	include("include/Kwitansi.class.php");

	//dapat id dari GET
	$id_pelanggan = $_GET['id'];

	/********** Dapat info pelanggan **********/
	$db_pelanggan = new Pelanggan();
	$db_pelanggan->open();

	$db_pelanggan->getPelangganWithId($id_pelanggan);
	$pelanggan = $db_pelanggan->getResult();
	$pelanggan_nama 		= $pelanggan['nama'];
	$pelanggan_alamat 		= $pelanggan['alamat'];
	$pelanggan_no_telp 		= $pelanggan['no_telp'];
	$pelanggan_pekerjaan	= $pelanggan['pekerjaan'];
	$pelanggan_no_ktp		= $pelanggan['no_ktp'];

	/********** Akhir dapat info pelanggan **********/

	$ha = date_default_timezone_set("Jakarta");

	$now_date = strval(date("Y-m-d")); //tanggal sekarang
	

	/********** Dapat info kredit **********/
	
	$db_kredit   = new Kredit();
	$db_angsur 	 = new Angsur();
	$db_kwitansi = new Kwitansi();

	$db_kredit->getKreditWithIdPelanggan($id_pelanggan);
	
	$table_buka = "
	
					<table border='1' width='100%'>
						<tr class='top'>
							<td>
								No. 
							</td>
							<td>
								No. Angsuran

							</td>
							<td>
								Tenggat
							</td>
							<td>
								Dibayar
							</td>
							<td>
								Biaya
							</td>
							<td width='15%'>
								Denda
							</td>
							<td>
								Bayar
							</td>
						</tr>";

	$table_tutup = "</table></div><div class='paper full'></div><br/><br/>";
	$data_kredit = "";

	while ($i = $db_kredit->getResult()) {
		
		$data_kredit .= "<div class='lap-kredit'>";

		$data_kredit .= "<div class='left'>";
			$data_kredit .= "<b class='judul_kredit'>ID Kredit: ".$i['id_kredit']."</b><br/>";
			$data_kredit .= "<span class='small_text'>Tanggal mulai: ".$i['tanggal_mulai']."</span><br/>";
			$data_kredit .= "<span class='small_text'>Id motor: ".$i['id_motor']."</span><br/>";
			$data_kredit .= "<span class='small_text'>DP: ".$i['dp']."</span><br/>";
		$data_kredit .= "</div>";
		$data_kredit .= "<div class='right'>";

		//mengecek kalau sudah lunas tidak usah ditampilkan tombol membayar
		$lunas = new Kredit();
		if ($lunas->isLunas($i['id_kredit'])) {
			$data_kredit .= "<img src='img/lunas.png'/>";
		}else{
			$data_kredit .= "<a href='bayar.php?id_pelanggan=$id_pelanggan&id_kredit=".$i['id_kredit']."'>
								<div class='button-link small'>
									BAYAR KREDIT
								</div>
							</a>";
		}
			
		$data_kredit .= "</div>";
		$data_kredit .= "<div class='clear'></div>";

		$db_angsur->getAngsurWithIdPelangganAndIdKredit($id_pelanggan,$i['id_kredit']);
		//isi dari kredit pembayarannya
		$data_kredit .= $table_buka;

		$counter = 1;

		$sisa_kredit = 0;
		
		while ($j = $db_angsur->getResult()) {
			
			$tanggal_tenggat = strtotime($j['tgl_tenggat']);
			//$tanggal_bayar = strtotime($j['tgl_bayar']);
			$tanggal_sekarang = time();

			$perbedaan_tanggal = $tanggal_sekarang - $tanggal_tenggat;
			$perbedaan_hari = floor($perbedaan_tanggal/(60*60*24));



			if ($j['sudah_bayar'] == 0) {
			//kalau belum dibayar
				//kalau ada denda warna beda
				if ($perbedaan_hari > 0) {
					$data_kredit .= "<tr style='background-color:yellow'>";
				}else{
				//biasa
					$data_kredit .= "<tr>";
				}
				$sisa_kredit += $j['biaya'];
			}else{
			//sudah dibayar
				$data_kredit .= "<tr style='background-color:green'>";
			}

			

			
				$data_kredit .= "<td width='5%'>".$counter."</td>";
				$data_kredit .= "<td width='5%'>".$j['id_angsur']."</td>";
				$data_kredit .= "<td width='15%'>".$j['tgl_tenggat']."</td>";

				if ($j['tgl_bayar'] > 0) {
					$data_kredit .= "<td width='15%'>".$j['tgl_bayar']."</td>";
				}else{
					$data_kredit .= "<td width='15%'></td>";
				}
				
				$data_kredit .= "<td style='text-align:right' width='15%'>".$j['biaya']."</td>";
				$data_kredit .= "<td width='15%'>".$j['denda']."</td>";

				if ($j['sudah_bayar'] == 0) {
					// $data_kredit .= "<td>"."<a href='bayar.php?id_kredit=".$i['id_kredit']."&pembayaran_ke=".$counter."&id_pelanggan=$id_pelanggan'>Bayar</a>"."</td>";
					if ($perbedaan_hari > 0) {
						$data_kredit .= "<td width='15%'>Terlambat</td>";
					}else{
						$data_kredit .= "<td width='15%'> as</td>";
					}
				}else{
					$data_kredit .= "<td width='15%'>Lunas</td>";
				}

				

				//$data_kredit .= "<td>".$perbedaan_hari."</td>";
					
			$data_kredit .= "</tr>";



			$counter++;
		}
		$data_kredit .= "<tr>
							<td colspan='4'>
								Sisa kredit
							</td>
							<td style='text-align:right'>
								$sisa_kredit";
		$data_kredit .= "	</td>
						</tr>";

		$data_kredit .= $table_tutup;
		
	}


	//$data_kredit = var_dump($kredit_pelanggan);

	/********** Akhir dapat info kredit **********/	

	$header = new Template('view/template/head.html');
	$content = new Template('view/pelanggan.html');
	$footer = new Template('view/template/foot.html');
						


	//ganti data-data dalam template
	$header->replace('DATA_TITLE', 'pelanggan');

	$content->replaces(array('DATA_ID' => $id_pelanggan,
							 'DATA_NAMA' => $pelanggan_nama,
							 'DATA_ALAMAT' => $pelanggan_alamat,
							 'DATA_NO_TELP' => $pelanggan_no_telp,
							 'DATA_PEKERJAAN' => $pelanggan_pekerjaan,
							 'DATA_NO_KTP' => $pelanggan_no_ktp,
							 'DATA_KREDIT' => $data_kredit));

	//tuliskan
	$header->write();
	$content->write();
	$footer->write();

?>