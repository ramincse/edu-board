<?php 
	namespace Edu\Board\Support;
	use Edu\Board\Support\Database;
	use PDO;

	/**
	 * Auth Management
	 */
	class Auth extends Database
	{
		/**
		 * Login Management
		 */
		public function userLoginSystem($email_uname, $pass)
		{
			$data = $this -> emailUsernameCheck($email_uname);

			$num = $data['num'];
			$login_user_data = $data['data'] -> fetch(PDO::FETCH_ASSOC);
			$login_user_data['name'];

			//Email or Uname
			if ( $num == 1 ) {
				//Password
				if ( password_verify($pass, $login_user_data['pass']) ) {
					header('location:dashboard.php');
				}else{
					return '<p class="alert alert-warning">Wrong password !<button class="close" data-dismiss="alert">&times;</button></p>';
				} // End of Password
			}else{
				return '<p class="alert alert-warning">Email or Uname is incorrect !<button class="close" data-dismiss="alert">&times;</button></p>';
			} //End of Email or Uname
		}

		/**
		 * Username Check
		 */
		public function emailUsernameCheck($email_uname)
		{
			return $this -> dataCheck('users', $email_uname);			
		}
	} //End of Auth Management











?>