<?php 
/* NEEDS:
 * START RETREIVE
 */

// error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
<head>

	<title>Matches</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
</head>
<body>
<div class='container'>
<?php

class CMS {
	
	private $conn;
	private $table;
	
	function __construct ($dbname = 'db', $tablename = 'boeking'){
		require('connection.php');
		
		$tablename = "vacaturen";
		$this -> conn = $db;
		$this -> db = $dbname;
		$this -> table = $tablename;
	}
	
	function Retrieve (){
		$wnemer = 1;
		$vacaturen = array();
		if ($query = $this -> conn -> query("SELECT vaca_id FROM matches WHERE wnemer_id = $wnemer")) {
			while ($vaca_id = mysqli_fetch_row($query)) {
				foreach ($vaca_id as $id) {
					array_push($vacaturen, "$id");
				}
			}
		}
		else {
			echo "<p>Couldn't get data @ step 1</p>";
		}
		
		foreach ($vacaturen AS $id) {
			?><div class='col-sm-6'><?php
			$query = $this -> conn -> query("SELECT titel, functie, beschrijving FROM vacaturen WHERE id = $id");
			while ($row = mysqli_fetch_row($query)) {
				echo $row['0'];
				echo $row['1'];
				echo $row['2'];
			}
			?></div><?php
		}
	}
}

$class = new CMS('dbname', 'tablename');
$class -> Retrieve();

?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/bootstrap.min.js"></script>


</body>
</html>