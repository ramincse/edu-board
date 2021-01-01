<?php 
	namespace Edu\Board\Controller;
	use Edu\Board\Support\Database;
	use PDO;

	/**
	 * Student Management 
	 */
	class Student extends Database
	{
		/**
		 * Create new student
		 */
		public function createStudent($data)
		{
			$file_name = !empty($_FILES['photo']['name']) ? $this -> fileUpload($_FILES['photo'], '../../students/') : ' ';

			$this -> create('students', [
				'name' 	=> $data['name'],
				'roll' 	=> $data['roll'],
				'reg' 	=> $data['reg'],
				'board' => $data['board'],
				'inst' 	=> $data['inst'],
				'exam' 	=> $data['exam'],
				'year' 	=> $data['year'],
				'photo' => $file_name,
			]);
		}

		/**
		 * 
		 */
		public function allStudents()
		{
			$data = $this -> all('students');

			return $data -> fetchAll(PDO::FETCH_ASSOC);
		}
		
	} //End of class Student extends Database
?>