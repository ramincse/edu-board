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
if ( isset($_GET['logout']) AND $_GET['logout'] == 'success' ) {
        $auth -> userLogout();
    }
```