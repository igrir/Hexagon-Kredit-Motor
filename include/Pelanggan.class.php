<?php
	/*****
	 *
		Filename: Pelanggan.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk data di tabel Pelanggan
	 *
	 *****/

	class Pelanggan extends DB{
		function getPelanggan(){
			$query = "SELECT * FROM Pelanggan";
			return $this->execute($query);
		}

		function getPelangganWithId($id_pelanggan){
			$query = "SELECT * FROM Pelanggan WHERE id_pelanggan = $id_pelanggan";
			return $this->execute($query);
		}

		function addPelanggan($nama, $alamat, $no_telp, $pekerjaan, $no_ktp) {
			$query = "INSERT INTO Pelanggan(nama, alamat, no_telp, pekerjaan, no_ktp) VALUES('$nama', '$alamat', '$no_telp', '$pekerjaan', '$no_ktp')";
			return $this->execute($query);
		}
	}
