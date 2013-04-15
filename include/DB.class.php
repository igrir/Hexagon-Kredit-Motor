<?php
	/*****
	 *
		Filename: DB.class.php
		Peran: Model
		Programmer: Giri Prahasta Putra
		Date: 2013

	 *
	 *****/

	class DB{
		var $db_host = 'localhost';
		var $db_user = 'root';
		var $db_password = '';
		var $db_name = 'hexagon';
		var $db_link = '';			//menampung db yang dibuat
		var $result = '';

		//konstruktor
		function DB($db_host='', $db_user='', $db_password='', $db_name=''){
			// $this->db_host = $db_host;
			// $this->db_user = $db_user;
			// $this->db_password = $db_password;
			// $this->db_name = $db_name;
		}

		function open(){
			$this->db_link = mysql_connect($this->db_host, $this->db_user, $this->db_password );
			mysql_select_db($this->db_name, $this->db_link);
		}

		function execute($query=''){

			$this->open();

			$this->result = mysql_query($query);
			if ($this->result) {
				return $this->result;
			}else{
				echo mysql_error();
			}
			
			$this->close();

		}

		function getResult(){
			return mysql_fetch_array($this->result);
		}

		function getLastInsertedId(){
			$id = mysql_insert_id();
			return $id;	
		}

		// function getResultObj(){
		// 	//return mysql_fetch_row($this->result);
		// 	return mysql_fetch_object($this->result);
		// }


		function close(){
			mysql_close($this->db_link);
		}
	}
?>