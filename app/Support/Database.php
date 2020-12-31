<?php 
	namespace Edu\Board\Support;  
	use PDO;

	/**
	 * Include config file
	 */
	//require_once "../config.php";

	/**
	 * Database Management 
	 */
	abstract class Database
	{
		/**
		 * Server Information
		 */	
		private $host 	= HOST;
		private $user 	= USER;
		private $pass 	= PASS;
		private $db 	= DB;

		private $connection;

		/**
		 * Database Connection
		 */
		private function connection()
		{
			return $this -> connection = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this -> db, $this -> user, $this -> pass);
		}

		/**
		 * Data Check
		 */
		public function dataCheck($tbl, $data)
		{
			$stmt = $this -> connection() -> prepare("SELECT * FROM $tbl WHERE email='$data' || uname ='$data' ");
			$stmt -> execute();
			$num = $stmt -> rowCount();

			return [
				'num' 	=> $num,
				'data' 	=> $stmt,
			];
		}

		/**
		 * Single Data Check
		 */
		public function dataCheckPro($tbl, array $data, $condition = 'AND')
		{
			$query_string = '';
			foreach ($data as $key => $val) {
				$query_string .= $key . "='$val' AND ";
			}
			$query_array = explode(' ', $query_string);
			array_pop($query_array);
			array_pop($query_array);

			$final_query_string = implode(' ', $query_array);

			//print_r($query_array);
			$stmt = $this -> connection() -> prepare("SELECT * FROM $tbl WHERE $final_query_string");
			$stmt -> execute();

			echo $stmt -> rowCount();
		}

		/**
		 * Update Method
		 */
		public function update($tbl, $id, array $data)
		{
			$query_string = '';
			foreach ($data as $key => $val) {
				$query_string .= "$key = '$val' , ";
			}

			$query_array = explode(' ', $query_string);
			array_pop($query_array);
			array_pop($query_array);

			$final_query_string = implode(' ', $query_array);

			$stmt = $this -> connection() -> prepare("UPDATE $tbl SET $final_query_string WHERE id='$id'");
			$stmt -> execute();
		}
	} //End of abstract class Database
?>