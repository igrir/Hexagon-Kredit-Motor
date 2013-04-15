<?php
	/*****
	 *
		Filename: Kredit.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk data di tabel Kredit
	 *
	 *****/

	class Kredit extends DB{

		function addKredit($tanggal_mulai, $lama_tahun_kredit, $bunga, $id_pelanggan, $id_motor, $dp) {
			$query = "INSERT INTO Kredit(tanggal_mulai,
										 lama_tahun_kredit,
										 bunga,
										 id_pelanggan,
										 id_motor,
										 dp)
								  VALUES('$tanggal_mulai',
								  		 $lama_tahun_kredit,
								  		 $bunga,
								  		 $id_pelanggan,
								  		 $id_motor,
								  		 $dp)";
			return $this->execute($query);
		}

		function getKredit(){
			$query = "SELECT * FROM Kredit as k, Pelanggan as p, Motor as m WHERE k.id_motor = m.id_motor AND
																				  k.id_pelanggan = p.id_pelanggan";
			return $this->execute($query);
		}

		function getKreditWithId($id_kredit){
			$query = "SELECT * FROM Kredit WHERE id_kredit = $id_kredit";
			return $this->execute($query);
		}

		function getKreditWithIdPelanggan($id_pelanggan){
			$query = "SELECT * FROM Kredit WHERE id_pelanggan = $id_pelanggan";
			return $this->execute($query);
		}

		function isLunas($id_kredit){

			$query = "SELECT COUNT(*) FROM Angsur WHERE id_kredit = $id_kredit";
			$this->execute($query);

			$result = $this->getResult();
			$banyak_angsur = $result['COUNT(*)'];

			$query = "SELECT COUNT(*) FROM Angsur WHERE id_kredit = $id_kredit AND sudah_bayar = 1";
			$this->execute($query);

			$result = $this->getResult();
			$banyak_lunas = $result['COUNT(*)'];

			if ($banyak_angsur == $banyak_lunas) {
				return true;
			}else{
				return false;
			}
		}

	}
