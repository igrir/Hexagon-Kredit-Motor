<?php
	/*****
	 *
		Filename: Template.class.php
		Peran: View
		Programmer: Giri Prahasta Putra
		Date: 2013
		Deskripsi: Kelas untuk mengambil data di tabel angsur
	 *
	 *****/

	class Template {

		var $filename = "";
		var $content  = "";

		function Template ($filename = ''){
			$this->filename = $filename;
			$this->content = implode('', @file($filename));
		}

		function write(){
			$this->clear();
			print $this->content;
		}

		function clear() {
			$this->content = preg_replace("/DATA_[A-Z|_|0-9]+/", "", $this->content);
		}

		function replace($old = "", $new = "") {
			$value = $new;

			$this->content = preg_replace("/$old/", $value, $this->content);
		}

		function replaces($array){
			$len = count($array);
			$array_keys = array_keys($array);

			$i = 0;
			foreach ($array_keys as $key) {
				$old = $key;
				$new = $array[$key];

				$this->content = preg_replace("/$old/", $new, $this->content);

				$i++;
			}
		}

	}


?>