<?php 
	namespace Edu\Board\Controller;
	use Edu\Board\Support\Database;
	use PDO;

	/**
	 * Result Management 
	 */
	class Result extends Database
	{
		/**
		 * Add student result
		 */
		public function addResult($data)
		{
			$this -> create('results', [
				'student_id' 	=> $data['student_id'],
				'ban' 			=> $data['ban'],
				'eng' 			=> $data['eng'],
				'math' 			=> $data['math'],
				'ss' 			=> $data['ss'],
				's' 			=> $data['s'],
				'rel' 			=> $data['rel'],
			]);
		}
	}


	
	
?>



