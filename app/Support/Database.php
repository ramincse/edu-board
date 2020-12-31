<?php 
	/**
	 * Include config file
	 */
	require_once "../../config.php";

	namespace Edu\Board\Support;  
	use PDO;

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
			$connection = new PDO("mysql:host=" . $this -> host . ";db_name=" . $this -> db, $this -> user, $this -> pass);
		}
	}
?>