<?php

	//contoh
	//$tanggal_str = "2000-2-31";
	//hitung_tenggat($tanggal_str, 3);
	function hitung_tenggat($tanggal_YMD, $banyak_bulan) {
		$array = array();

		$tanggal_date = date_parse_from_format("Y-m-d", $tanggal_YMD);

		$tahun = $tanggal_date['year'];
		$bulan = $tanggal_date['month'];
		$tanggal = $tanggal_date['day'];

		$tanggal_awal = $tanggal_date['day'];

		$index = 0;

		for ($i = 1; $i <= ($banyak_bulan); $i++) {		

			//kalau bulan februari
			if ($bulan == 2) {

				//kalau kabisat
				if (is_kabisat($tahun)) {
					//kalau tanggal > 29
					if ($tanggal_awal > 29) {
						$tanggal = 29;
					}else{
						$tanggal = $tanggal_awal;
					}
				}else{
					//kalau tanggal > 28

					if ($tanggal_awal > 28) {
						$tanggal = 28;
					}else{
						$tanggal = $tanggal_awal;
					}
				}

			//bulan januari, maret, mei, juli, agustus, oktober, desember
			}else if ($bulan == 1  ||
					  $bulan == 3  ||
					  $bulan == 5  ||
					  $bulan == 7  ||
					  $bulan == 8  ||
					  $bulan == 10 ||
					  $bulan == 12) {

				$tanggal = $tanggal_awal;

			//bulan april, juni, september, november
			}else{

				if ($tanggal_awal > 30) {
					$tanggal = 30;
				}else{
					$tanggal = $tanggal_awal;
				}
			}

			$array[$index] = $tahun."-".$bulan."-".$tanggal;

			

			$bulan++;

			//iterasi berikutnya
			if ($bulan > 12) {
				$tahun += 1;
				$bulan = 1;
			}



			$index++;
		}

		return $array;
	}

	function is_kabisat($tahun){
		return ((($tahun%4) == 0) && ((($tahun%100) != 0) || (($tahun%400) == 0)));
	}

?>