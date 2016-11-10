<?php 
/* NEEDS:
 * START RETREIVE WITH LEGIT wnemer_id and bedr of werknemer
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
	
	function __construct ($dbname = '', $tablename = ''){
		require('connection.php');
		
		$tablename = "vacaturen";
		$this -> conn = $db;
		$this -> db = $dbname;
		$this -> table = $tablename;
	}
	
	function Retrieve (){
		$soort = 'werknemer';
		$wnemer = 1;
		$vaca = $_GET['vaca_id'];
		$motiv = $_GET['motivtext'];
		if ($soort == 'werknemer') {
			if ($motiv == True) {
				
				$queryUpdate = "UPDATE matches SET motivatie = '$motiv', progress = '2' WHERE wnemer_id = $wnemer AND vaca_id = $vaca";
				if ($this -> conn -> query($queryUpdate)) {
					header('location: index.php');
				}
			}
			?>
			<!--
				* PART: Match
				* Progress: 3;
			-->
			<h3>Match! Bedrijf heeft uw contactgegevens</h3>
			<div class='col-xs-12'>
			<?php
			$vacaturen = array();
			if ($query = $this -> conn -> query("SELECT vaca_id FROM matches WHERE wnemer_id = $wnemer AND progress = 3")) {
				while ($vaca_id = mysqli_fetch_row($query)) {
					foreach ($vaca_id AS $id) {
						array_push($vacaturen, "$id");
					}
				}
			}
			else {
				echo "Couldn't get data @ step 1";
			}
			
			foreach ($vacaturen AS $id) {
				echo "<h4>Informatie: </h4>
					  <p>";			
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "Vacature: " . $row['0'];
				}
				echo "</p>";
				
				$totcomps = 0;
				$comps = array();
				if ($query = $this -> conn -> query("SELECT comp_id FROM comp_vaca WHERE vaca_id = $id")) {
					while ($comp_id = mysqli_fetch_row($query)) {
						foreach ($comp_id AS $id) {
							array_push($comps, "$id");
							$totcomps++;
						}
					}
				}
				else {
					echo "Couldn't get data @ step 2";
				}
			
			$compsaantal = 0;
			$idcomps = array();
			echo "<h4>Gevraagde competenties($totcomps): </h4>
				  <p>";
			foreach ($comps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					$compsaantal ++;
					array_push($idcomps, "$row[0]");
					echo "-> " . $row[1]. "<br/>";
				}
			}
			echo "</p>";
			
			$jouwcompsaantal = 0;
			$jouwcomps = array();
			foreach ($idcomps AS $jouwcomp) {
				$query = $this -> conn -> query("SELECT * FROM wnemer_comp WHERE comp_id = $jouwcomp AND wnemer_id = $wnemer");
				while ($row = mysqli_fetch_row($query)) {
					$jouwcompsaantal ++;
					array_push($jouwcomps, "$row[0]");
				}
			}
			
			echo "<h4>Jouw gematchde competenties($jouwcompsaantal): </h4>
				  <p>";
			foreach ($jouwcomps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "-> " . $row[1]. "<br/>";
				}
			}
			echo "</p>";
			
			echo "<h4>Aantal % gemeen: </h4>";
			$percent = $jouwcompsaantal / $compsaantal * 100;
			echo "$percent%";
			}
			?>
			</div>
			
			<!-- 
				* PART: In behandeling
				* Progress: 2;
			-->
			<h3>In behandeling</h3>
			<div class='col-xs-12'>
			<?php
			$vacaturen = array();
			$motivaties = array();
			if ($query = $this -> conn -> query("SELECT vaca_id, motivatie FROM matches WHERE wnemer_id = $wnemer AND progress = 2")) {
				while ($vaca_id = mysqli_fetch_row($query)) {
					array_push($motivaties, "$vaca_id[1]");
					array_push($vacaturen, "$vaca_id[0]");
				}
			}
			else {
				echo "Couldn't get data @ step 1";
			}
			foreach (array_combine($vacaturen, $motivaties) AS $id => $motivatie) {
				echo "<h4>Informatie: </h4>
					  <p>";			
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "Vacature: " . $row['0'] . "<br />";
				}
				echo "Motivatie:  $motivatie <br />";
				echo "</p>";
				
				$totcomps = 0;
				$comps = array();
				if ($query = $this -> conn -> query("SELECT comp_id FROM comp_vaca WHERE vaca_id = $id")) {
					while ($comp_id = mysqli_fetch_row($query)) {
						foreach ($comp_id AS $id) {
							array_push($comps, "$id");
							$totcomps++;
						}
					}
				}
				else {
					echo "Couldn't get data @ step 2";
				}
			
			$compsaantal = 0;
			$idcomps = array();
			echo "<h4>Gevraagde competenties($totcomps): </h4>
				  <p>";
			foreach ($comps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					$compsaantal ++;
					array_push($idcomps, "$row[0]");
					echo "-> " . $row[1]. "<br/>";
				}
			}
			echo "</p>";
			
			$jouwcompsaantal = 0;
			$jouwcomps = array();
			foreach ($idcomps AS $jouwcomp) {
				$query = $this -> conn -> query("SELECT * FROM wnemer_comp WHERE comp_id = $jouwcomp AND wnemer_id = $wnemer");
				while ($row = mysqli_fetch_row($query)) {
					$jouwcompsaantal ++;
					array_push($jouwcomps, "$row[0]");
				}
			}
			
			echo "<h4>Jouw gematchde competenties($jouwcompsaantal): </h4>
				  <p>";
			$matchcompetenties = array();
			foreach ($jouwcomps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "-> " . $row[1]. "<br/>";
					array_push($matchcompetenties, $row[1]);
				}
			}
			echo "</p>";
			
			echo "<h4>Aantal % gemeen: </h4>";
			$percent = $jouwcompsaantal / $compsaantal * 100;
			echo "$percent%";

			}
			?>
			</div>
			
			<!-- 
				* PART: Geliked
				* Progress: 1;
			-->
			<h3>Geliked</h3>
			<div class='col-xs-12'>			
			<?php
			$vacaturen = array();
			if ($query = $this -> conn -> query("SELECT vaca_id FROM matches WHERE wnemer_id = $wnemer AND progress = 1")) {
				while ($vaca_id = mysqli_fetch_row($query)) {
					foreach ($vaca_id AS $id) {
						array_push($vacaturen, "$id");
					}
				}
			}
			else {
				echo "Couldn't get data @ step 1";
			}
			
			foreach ($vacaturen AS $id) {
				echo "<h4>Informatie: </h4>
					  <p>";			
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "Vacature: " . $row['0'];
					$vacature_id = $row[0];
				}
				echo "</p>";
				
				$totcomps = 0;
				$comps = array();
				if ($query = $this -> conn -> query("SELECT comp_id FROM comp_vaca WHERE vaca_id = $id")) {
					while ($comp_id = mysqli_fetch_row($query)) {
						foreach ($comp_id AS $id) {
							array_push($comps, "$id");
							$totcomps++;
						}
					}
				}
				else {
					echo "Couldn't get data @ step 2";
				}
			
			$compsaantal = 0;
			$idcomps = array();
			echo "<h4>Gevraagde competenties($totcomps): </h4>
				  <p>";
			foreach ($comps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					$compsaantal ++;
					array_push($idcomps, "$row[0]");
					echo "-> " . $row[1]. "<br/>";
				}
			}
			echo "</p>";
			
			$jouwcompsaantal = 0;
			$jouwcomps = array();
			foreach ($idcomps AS $jouwcomp) {
				$query = $this -> conn -> query("SELECT * FROM wnemer_comp WHERE comp_id = $jouwcomp AND wnemer_id = $wnemer");
				while ($row = mysqli_fetch_row($query)) {
					$jouwcompsaantal ++;
					array_push($jouwcomps, "$row[0]");
				}
			}
			
			echo "<h4>Jouw gematchde competenties($jouwcompsaantal): </h4>
				  <p>";
			foreach ($jouwcomps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "-> " . $row[1]. "<br/>";
				}
			}
			echo "</p>";
			
			echo "<h4>Aantal % gemeen: </h4>";
			$percent = $jouwcompsaantal / $compsaantal * 100;
			echo "$percent% <br />";
			?>
			<button id="myBtn">Voeg motivatie toe</button>

			<div id="myModal" class="modal">
			  <div class="modal-content">
				<span class="close">x</span>
				<h3>Gematchde competenties</h3>
				<?php
				foreach ($matchcompetenties AS $competentie) {
					echo "- $competentie <br />";
				}
				?>
				<h3>Motivatie:</h3>
				<form action = '' method = 'get'>
					<input type = 'hidden' name = 'motiv' value = 'True'>
					<input type = 'hidden' name = 'vaca_id' value = '<?php echo $vacature_id; ?>'>
					<p><textarea name ='motivtext'  rows='5'></textarea></p>
					<input type = 'submit' value = 'Voeg motivatie toe'>
				</form>

			  </div>
			</div>
			<?php
			}
			?>
			</div><?php
		}
	}
}

$class = new CMS('', '');
$class -> Retrieve();

?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/bootstrap.min.js"></script>


</body>
</html>