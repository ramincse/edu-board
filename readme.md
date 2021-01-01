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
### Data Insert by Ajax
```js
(function($){
	$(document).ready(function(){
		//Dash Menu Active
		// $(document).on('click', 'ul#dashmenu li', function(){
		// 	$('ul#dashmenu li').removeClass('active');
		// 	$(this).addClass('active');
		// });

		//Add new user modal
		$(document).on('click', 'a#add_user_btn', function(){
			$('#add_user_modal').modal('show');

			return false;
		});

		//Add new user form submit
		$(document).on('submit', 'form#add_user_form', function(event){
			event.preventDefault();

			$.ajax({
				url : 'templates/ajax/user_add.php',
				method : "POST",
				data : new FormData(this),
				contentType : false,
				processData : false,
				success : function(data){
					$('form#add_user_form')[0].reset();
					$('#add_user_modal').modal('hide');
					$('.mess').html(data);
				},
			});
		});
	});
})(jQuery)
```
```php
	require_once "../../../config.php";
	require_once "../../../vendor/autoload.php";

	use Edu\Board\Controller\User;
	$user = new User;

	$data = $user -> createUser($_POST);
	echo $data;

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
 * Data Create
 */
public function create($table, $data)
{
	//Make SQL Column from data
	$array_key = array_keys($data);
	$array_col = implode(',', $array_key);

	//Make SQL Values from data
	$array_val 		= array_values($data);
	foreach ($array_val as $value) {
		$form_value[] = "'" . $value . "'";
	}
	$array_values 	= implode(',', $form_value);

	//Data sent to student table
	$sql = "INSERT INTO $table ($array_col) VALUES ($array_values) ";
	$stmt = $this -> connection() -> prepare($sql);
	$stmt -> execute();

	if ( $stmt ) {
		return true;
	}else{
		return false;
	}
}
```
```html
<div class="mess"></div>
```
### Show All Data
```js
function allUsers(){
	$.ajax({
		url : 'templates/ajax/user_all.php',
		success : function(data){
			$('tbody#all_users_tbody').html(data);
		}
	});
}
allUsers();
```
```php
/**
 * At user_all.php page
 */
require_once "../../../config.php";
require_once "../../../vendor/autoload.php";

use Edu\Board\Controller\User;
$user = new User;

$data = $user -> allUser();

$all_data = $data -> fetchAll();

$i = 1;
foreach ($all_data as $single_data) :
```
```html
<tr>
    <td><?php echo $i; $i++; ?></td>
    <td><?php echo $single_data['name']; ?></td>
    <td><?php echo $single_data['email']; ?></td>
    <td><?php echo $single_data['cell']; ?></td>
    <td><?php echo $single_data['role']; ?></td>
    <td>
        <img style="width: 50px; height: 50px; display: block;" src="images/<?php echo $single_data['photo']; ?>" alt="">
    </td>
    <td><?php echo $single_data['status']; ?></td>
    <td>
        <a class="btn btn-sm btn-info" href="">View</a>
        <a class="btn btn-sm btn-warning" href="">Edit</a>
        <a class="btn btn-sm btn-danger" href="">Delete</a>
    </td>
</tr>
```
```php
endforeach;
/**
 * At user.php Class
 */
public function allUser()
{
	$data = $this -> all('users');
	return $data;
}

/**
 * Data Show All
 */
public function all($tbl, $order = 'DESC')
{
	$sql = "SELECT * FROM $tbl ORDER BY id $order";
	$stmt = $this -> connection() -> prepare($sql);
	$stmt -> execute();
	return $stmt;
}
```

