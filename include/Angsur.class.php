<?php
	/*****
	 *
		Filename: Angsur.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk mengambil data di tabel angsur
	 *
	 *****/

	class Angsur extends DB{
		function getAngsurWithId($id_angsuran){
			$query = "SELECT * FROM Angsur WHERE id_angsuran = $id_angsuran ORDER BY tgl_tenggat ASC";
			return $this->execute($query);
		}

		function getAngsurWithIdPelangganAndIdKredit($id_pelanggan,$id_kredit){
			$query = "SELECT * FROM Angsur as a, Kredit as k WHERE k.id_pelanggan = $id_pelanggan
															   AND k.id_kredit = $id_kredit
															   AND a.id_kredit = k.id_kredit
															   ORDER BY tgl_tenggat ASC";
			return $this->execute($query);
		}

		function getAngsurWithIdKreditAndPembayaranKe($id_kredit,$pembayaran_ke){
			$query = "SELECT * FROM Angsur WHERE id_kredit = $id_kredit 
												 AND pembayaran_ke = $pembayaran_ke
												 ORDER BY tgl_tenggat ASC";
			return $this->execute($query);
		}

		function getAngsurWithIdKredit($id_kredit){
			$query = "SELECT * FROM Angsur WHERE id_kredit = $id_kredit";
			return $this->execute($query);
		}

		function getNextAngsurWithIdKredit($id_kredit){
			$query = "SELECT * FROM Angsur WHERE id_kredit = $id_kredit
												 AND sudah_bayar = 0
												 ORDER BY pembayaran_ke ASC
												 LIMIT 1";
			return $this->execute($query);
		}

		function addAngsur($pembayaran_ke, $tgl_bayar, $tgl_tenggat, $biaya, $denda, $id_kredit, $penerima, $sudah_bayar){
			$query = "INSERT INTO Angsur(pembayaran_ke,
										 tgl_bayar,
										 tgl_tenggat,
										 biaya,
										 denda,
										 id_kredit,
										 penerima,
										 sudah_bayar)
								  VALUES($pembayaran_ke,
								  		 '$tgl_bayar',
								  		 '$tgl_tenggat',
								  		 $biaya,
								  		 $denda,
								  		 $id_kredit,
								  		 '$penerima',
								  		 $sudah_bayar)";
			return $this->execute($query);
		}


		function updateAngsurWhereIdKredit($id_kredit, $pembayaran_ke, $tgl_bayar, $denda, $penerima){
			$query = "";

			if ($denda == "") {
				$query = "UPDATE Angsur SET tgl_bayar     = '$tgl_bayar',
										denda 	      =  0,
										penerima      = '$penerima',
										sudah_bayar   = 1
									WHERE pembayaran_ke = $pembayaran_ke AND
										  id_kredit     = $id_kredit";
			}else{
				$query = "UPDATE Angsur SET tgl_bayar     = '$tgl_bayar',
										denda 	      =  $denda,
										penerima      = '$penerima',
										sudah_bayar   = 1
									WHERE pembayaran_ke = $pembayaran_ke AND
										  id_kredit     = $id_kredit";
			}

			return $this->execute($query);							
		}

		function isAngsurWithIdKreditAndPembayaranKeExist($id_kredit, $pembayaran_ke){
			$query = "SELECT COUNT(*) FROM Angsur WHERE id_kredit = $id_kredit AND	
														pembayaran_ke = $pembayaran_ke";
			$this->execute($query);

			$count = $this->getResult();
			
			if ($count['COUNT(*)'] == 1) {
				return true;
			}else{
				return false;
			}
		}

		function getAngsuranBelumDibayarFromKredit($id_kredit){
			$query = "SELECT pembayaran_ke FROM Angsur WHERE id_kredit = $id_kredit AND
															 sudah_bayar = 0 ORDER BY tgl_tenggat ASC";
			
			$keluaran = array();
			$index = 0;

			$this->execute($query);

			while ($i = $this->getResult()) {
				$keluaran[$index] = $i['pembayaran_ke'];
				$index++;
			}

			return $keluaran;
		}


		//angsuran yang belum dibayar
		function getAngsuranBulanIni(){

			$counter = 0;
			$hasil = array();


			$query = "SELECT * FROM Angsur as a, Kredit as k, Pelanggan as p WHERE 
															   a.id_kredit = k.id_kredit
															   AND a.sudah_bayar = 0
															   AND a.id_kredit = k.id_kredit
															   AND k.id_pelanggan = p.id_pelanggan
															   ORDER BY tgl_tenggat ASC";
			$this->execute($query);

			$tanggal_sekarang = time();
			while ($i = $this->getResult()) {
				$tanggal_tenggat = strtotime($i['tgl_tenggat']);

				$perbedaan_tanggal = $tanggal_sekarang - $tanggal_tenggat;
				$perbedaan_hari = floor($perbedaan_tanggal/(60*60*24));

				//kalau perbedaan harinya positif berarti telat
				if ($perbedaan_hari > -30) {
					$hasil[$counter] = $i;
					$counter++;
				}
				
			}

			return $hasil;

		}

	}	