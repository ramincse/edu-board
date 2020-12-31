<?php 
	namespace Edu\Board\Controller;
	use Edu\Board\Support\Database;

	/**
	 * User Management 
	 */
	class User extends Database
	{
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
	}
?>