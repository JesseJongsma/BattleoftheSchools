<?php 
session_start(); 
error_reporting(0);
if ($_SESSION['access'] != 4) {
	header('location:/');
}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>CMS</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/custom.css">

</head>
<body>

<div class='container'>
<?php
if ($_GET['updateNow'] == 'check') {
	header('location:' . $_SERVER['PHP_SELF']);
}
if ($_GET['delNow'] == 'check') {
	header('location:' . $_SERVER['PHP_SELF']);
}
class CMS {
	/**
	* CMS CLASS
	* Variable CRUD
	*
	* Set connection values in the __construct function
	*
	* Set database when calling class
	* For example:
	* $class = new CMS('db here');
	*
	* Set table static in the __construct or use get value to set table
	* For example:
	* (Example 1 = Static) $this -> table = 'table here';
	* (Example 2 = get) Set the following input in a form, don't forget to change table name
	* <input type='hidden' name='table' value='table here'>
	* 
	* NOTE: TABLE ALWAYS REQUIRE TO HAVE id AS FIRST COOLUMN (INT & AI).
	*/
	
	private $conn;
	private $table;
	
	function __construct ($connect_db = 'no_db_selected', $connect_table = ''){
		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$this -> conn = new mysqli("$server", "$user", "$pass", "$connect_db");
		$this -> db = $connect_db;
		$this -> table = $connect_table;
		if (!isset($this -> table)) {
			$this -> table = $_GET['table'];
		}
		
		$_SESSION['db'] = $this -> db;
		$_SESSION['table'] = $this -> table;
	}
	
	/**
	* RETRIEVE FUNCTION
	*
	* Function needs 1 value (table) when called in php
	* For example:
	* $class = new CMS('test');
	* $class -> Retrieve('important_info');
	*
	* This will retrieve all data from table important_info, in the database test.
	*/
	function Retrieve (){
		if ($result = $this -> conn -> query("SELECT * FROM " . $this -> table)) {
			if (isset($_GET['sorting']) && $_GET['sorting'] != 'none') {
				$sort = $_GET['sorting'];
			}
			if (isset($sort)) {
				$result = $this -> conn -> query("SELECT * FROM " . $this -> table . " ORDER BY " . $sort . " ASC");
				echo "<i class='center-button'><a href='?sorting=none'>Reset sorting</a></i>";
			}
			echo "<i class='center-button2'><a href='/'>Home</a></i>";
			echo "<table id='tfhover' class='tftable' border='1'>
				  <tr>";
			while ($columnName = mysqli_fetch_field($result)) {
				if ($columnName -> name != 'id' && $columnName -> name != 'pass') {
					echo "<th><a href='?sorting=" . $columnName -> name . "'>" . $columnName -> name . "</a></th>";
				}
			}
			echo "<th>
				  Update & Delete
				  </th>";
			echo "</tr>";
			
			while ($row = mysqli_fetch_row($result)) {
				$idCount = 0;
				echo "<tr>";
				foreach($row as $field) {
					if ($idCount != 0 && $idCount != 2) {
						echo "<td>" . $field . "</td>";
					}
					if ($idCount == 0) {
						$id = $field;
					}
					$idCount ++;
				}
				echo "<td>
					  <form method = 'get' action = ''>
					  <input type = 'hidden' name = 'id' value = '$id'>
					  <input type = 'submit' name = 'update' value = 'Update'>
					  </form>
					  <form method = 'get' action = ''>
					  <input type = 'hidden' name = 'id' value = '$id'>
					  <input type = 'submit' name = 'del' value = 'Delete'>
					  <input type = 'hidden' name = 'delNow' value = 'check'>
					  </form>
					  </td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else {
			echo "<p>COULDN'T GET DATA</p>";
		}
	}
	
	function Update (){
		$id = $_GET['id'];
		$query = $this -> conn -> query("SELECT * FROM " . $this -> table . " WHERE id = " . $id);
		$row = mysqli_fetch_row($query);
		$count = 0;
		$counter = 1;
		$check = $_GET['updateNow'];
		
		/**
		* Set up the form to update
		*/
		if ($check != 'check') {
			$values = array();
			$columns = array();
			$counter = 0;
			
			echo "<div class='overlay'></div>
				  <div class='window'>";
			echo "<b>";
			/**
			* Make arrays for setting up update form
			*/
			while ($columnName = mysqli_fetch_field($query)) {
				$columnName = $columnName -> name;
				array_push($columns, "$columnName");
			}
			foreach ($row as $value) {
				array_push($values, "$value");
			}
			echo "</b><br />";
			echo "<form method = 'get' action = ''>
				  <input type = 'hidden' name = 'updateNow' value = 'check'>
				  <input type = 'hidden' name = 'table' value = '" . $this -> table . "'>
				  <input type = 'hidden' name = 'id' value = '$id'>";
				  
			foreach (array_combine($columns, $values) as $column => $value) {
					if ($counter != 0) {
						if ( $column == 'pass') {
							echo "<input type = 'hidden' value = '$value' name = '$counter'>";
						}
						else {
							echo "<label><label>$column:</label> ";
							?>
							<input type = '<?php if (is_numeric($value)) {echo "number' step = 'any";} else {echo "text";}?>' 
							value = '<?php echo $value; ?>' name = '<?php echo $counter; ?>'></label><wbr />
							<?php
						}
					}
				$counter++;
			}
			echo "<br /><input type = 'submit' name = 'update' value = 'Update'>
				  </form>";
			echo "<button class='closeit'>Cancel</button>";
			echo "</div>";
		}
		else {
			$values2 = array();
			$columns2 = array();
			
			/**
			* Get column names and put them in an array()
			*/
			$query = $this -> conn -> query("SELECT * FROM " . $this -> table);
			while ($columnNames = $query -> fetch_field()) {
				$columnName = $columnNames -> name;
				array_push($columns2, "$columnName");
			}
			
			/**
			* Get values to update and put them in an array()
			*/
			$values2[] = $id;
			foreach ($_GET as $key => $value) {
				if (is_numeric($key)) {
					array_push($values2, "'$value'");
				}
			}
			
			/**
			* Combine both arrays 
			*/
			$sql = '';
			foreach (array_combine($columns2, $values2) as $column => $value) {
				if ($count != 0) {
					$sql .= ", ";
				}
				$count++;
				$sql .= $column . " = " . $value;
			}

			$queryUpdate = "UPDATE " . $this -> table . " SET $sql WHERE id = $id";
			$this -> conn -> query($queryUpdate);
		}
	}
	
	function Del (){
		$id = $_GET['id'];
		$query = "DELETE FROM " . $this -> table . " WHERE id = " . $id;
		$this -> conn -> query ($query);
	}
}

/**
* Set db
*/
$connect_db = 'lemapdufap';

/**
* Set table
*/
$connect_table = 'users';

$class = new CMS("$connect_db", "$connect_table");
$class -> Retrieve();

if ($_GET['update'] == 'Update') {
	$class -> Update();
}
if ($_GET['del'] == 'Delete') {
	$class -> Del();
}
?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="/assets/js/custom.js"></script>

</body>
</html>