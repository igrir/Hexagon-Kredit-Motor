<?php
	/*****
	 *
		Filename: Motor.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk data di tabel Motor
	 *
	 *****/

	class Motor extends DB{
		function getMotor(){
			$query = "SELECT * FROM Motor";
			return $this->execute($query);
		}

		function getMotorTersedia(){
			$query = "SELECT * FROM Motor WHERE tersedia=1";
			return $this->execute($query);	
		}

		function getMotorTidakTersedia(){
			$query = "SELECT * FROM Motor WHERE tersedia=0";
			return $this->execute($query);	
		}

		function getMotorWithId($id_motor){
			$query = "SELECT * FROM Motor WHERE id_motor = $id_motor";
			return $this->execute($query);
		}

		function addMotor($merk_motor, $nama_motor, $tahun, $no_rangka, $no_mesin, $harga) {
			$query = "INSERT INTO Motor(merk_motor,
											nama_motor,
											tahun,
											no_rangka,
											no_mesin,
											harga)
								  VALUES(UPPER('$merk_motor'),
								  		 '$nama_motor',
								  		 $tahun,
								  		 '$no_rangka',
								  		 '$no_mesin', 
								  		 $harga)";

			return $this->execute($query);
		}

		function setTersediaWhereId($tersedia, $id_motor){
			$query = "UPDATE Motor set tersedia = $tersedia WHERE id_motor = $id_motor";
			return $this->execute($query);
		}

		function isTersedia($id_motor){
			$query = "SELECT * FROM Motor WHERE id_motor = $id_motor";
			$this->execute($query);

			$result = $this->getResult();

			if ($result['tersedia'] == 1) {
				return true;
			}else{
				return false;
			}
		}

		function getMotorWithIdKredit($id_kredit){
			$query = "SELECT * FROM Kredit as k, Motor as m WHERE k.id_kredit = $id_kredit AND
															      k.id_motor  = m.id_motor";
			return $this->execute($query);
		}

		function getMerkMotor(){
			$query = "SELECT merk_motor FROM Motor GROUP BY merk_motor";
			return $this->execute($query);
		}


		//mendapatkan nama motor yang bisa dibeli dari merek tertentu
		function getAvailableNamaMotorWhereMerk($merk_motor){
			$query = "SELECT * FROM Motor WHERE merk_motor = '$merk_motor' AND
												tersedia = 1
												GROUP BY nama_motor";
			return $this->execute($query);
		}

		function getMotorWithMerkAndNama($merk_motor, $nama_motor){
			$query = "SELECT * FROM Motor WHERE merk_motor = '$merk_motor' AND
												nama_motor = '$nama_motor' AND
												tersedia = 1
												LIMIT 1";
			return $this->execute($query);
		}

	}
