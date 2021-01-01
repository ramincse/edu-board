<?php 
	namespace Edu\Board\Controller;
	use Edu\Board\Support\Database;

	/**
	 * User Management 
	 */
	class User extends Database
	{
		/**
		 * User Add
		 */
		public function createUser($data)
		{
			$data = $this -> create('users', [
				'name' 	=> $data['name'],
				'uname' => $data['uname'],
				'email' => $data['email'],
				'cell' 	=> $data['cell'],
				'pass' 	=> password_hash('login', PASSWORD_DEFAULT),
				'role' 	=> $data['role'],
			]);

			if ( $data ) {
				return '<p class="alert alert-success">User created successfull !<button class="close" data-dismiss="alert">&times;</button></p>';
			}
		}

		/**
		 * Password Change
		 */
		public function passwordChange($user_id, $new_pass)
		{
			$this -> update('users', $user_id, [
				'pass' => password_hash($new_pass, PASSWORD_DEFAULT),
			]);

			return '<p class="alert alert-success">Password change successfull !<button class="close" data-dismiss="alert">&times;</button></p>';
		}

		/**
		 * Show All User
		 */
		public function allUser()
		{
			$data = $this -> all('users');
			return $data;
		}

		/**
		 * User Delete
		 */
		public function userDelete($id)
		{
			$data = $this -> delete('users', $id);

			if ( $data ) {
				return true;
			}
		}
	}
?>