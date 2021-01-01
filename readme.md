## Education Board Result System
This is a learning purpose project for student result calculation. We use some programming language here.

### Use of Programming Language
- HTML 5
- CSS 3
- javaScript
- jQuery
- PHP
- MySQL
- OOP
- PDO

### Database Class Design
```php
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
```
### Logout System
```html
<a href="?logout=success">Logout</a>
```
```php
use Edu\Board\Support\Auth;
$auth = new Auth; 
    
if ( isset($_GET['logout']) AND $_GET['logout'] == 'success' ) {
        $auth -> userLogout();
    }
```
### Password Change
```php
if ( isset($_POST['change_pass']) ) {
    $old_pass       = $_POST['old_pass'];
    $new_pass       = $_POST['new_pass'];
    $confirm_pass   = $_POST['confirm_pass'];
    $user_id        = $_SESSION['id'];

    //Check Old Password
    if ( password_verify($old_pass, $_SESSION['pass']) ) {
        $old_pass_check = true;
    }else{
        $old_pass_check = false;
    }

    //Confirm Password
    if ( $new_pass == $confirm_pass ) {
        $cpass = true;
    }else{
        $cpass = false;
    }

    if ( empty($old_pass) || empty($new_pass ) || empty($confirm_pass) ) {
        $mess = '<p class="alert alert-danger">All fields are required !<button class="close" data-dismiss="alert">&times;</button></p>';
    }elseif($cpass == false){
        $mess = '<p class="alert alert-danger">New password not match !<button class="close" data-dismiss="alert">&times;</button></p>';
    }elseif ( $old_pass_check == false ) {
        $mess = '<p class="alert alert-danger">Old password not match !<button class="close" data-dismiss="alert">&times;</button></p>';
    }else{
        $mess = $usr -> passwordChange($user_id, $new_pass);
    }
}

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
```