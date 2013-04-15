<?php
	/*****
	 *
		Filename: Kwitansi.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk mengambil data di kwitansi
	 *
	 *****/

	class Kwitansi extends DB{
		function addKwitansiWithIdAngsur($id_angsur){
			$query = "INSERT INTO Kwitansi(id_angsur) VALUES($id_angsur)";
			return $this->execute($query);
		}
	}	