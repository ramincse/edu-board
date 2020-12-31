<?php 
	namespace Edu\Board\Support;
	use Edu\Board\Support\Database;

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
			echo $email_uname;
			echo $pass;
		}
	} //End of Auth Management











?>