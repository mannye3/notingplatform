<?php
	class Utility {
		private $db;

		public function __construct(){
			$this->db = new Database();
		}


		public function getRoles(){
			$this->db->query('SELECT  * FROM roles');

			$results = $this->db->resultSet();

			return $results;
		}

	}
?>