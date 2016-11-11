<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Title</title>
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="menu-wrapper">  
      <div class="navbar-top">
        <div class="toggle-btn-holder">
          <div class="toggle-btn">
          </div>
        </div>
        <div class="header-text-holder">
          <div class="header-text">

          </div>
        </div>
      </div>

      <?php include 'menu.php' ;?>
    
    </div>
    <div class='margin-top'></div>
    <div class="container-fluid">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
        	<div class="page">
        	
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
					header('location: dashboard.php');
				}
			}
			?>
		<div class="container">
		  <button type="button" class="btn" data-toggle="collapse" data-target="#demo">Goedgekeurd</button>
		  <div id="demo" class="collapse">
			<?php
			if ($motiv == True) 
			{	
				$queryUpdate = "UPDATE matches SET motivatie = '$motiv', progress = '2' WHERE wnemer_id = $wnemer AND vaca_id = $vaca";
				if ($this -> conn -> query($queryUpdate)) 
				{
					header('location: dashboard.php');
				}
			}
			$vacaturen = array();
			$motivaties = array();
			if ($query = $this -> conn -> query("SELECT vaca_id, motivatie FROM matches WHERE wnemer_id = $wnemer AND progress = 3")) {
				while ($vaca_id = mysqli_fetch_row($query)) {
					array_push($motivaties, "$vaca_id[1]");
					array_push($vacaturen, "$vaca_id[0]");
				}
			}
			else {
				echo "Couldn't get data @ step 1";
			}
			foreach (array_combine($vacaturen, $motivaties) AS $id => $motivatie) {
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "<p><h4>Vacatuur " . $row['0'] . "</h4></p>";
					echo "<p><h4>Motivatie: </h4> $motivatie </p>";
				}
				
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
				echo "<p><h4>Gevraagde competenties($totcomps): </h4>";
				foreach ($comps AS $id) {
					$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
					while ($row = mysqli_fetch_row($query)) {
						$compsaantal ++;
						array_push($idcomps, "$row[0]");
						echo "-> $row[1]";
					}
				echo "</p>";
			}						
			$jouwcompsaantal = 0;
			$jouwcomps = array();
				foreach ($idcomps AS $jouwcomp) {
					$query = $this -> conn -> query("SELECT * FROM wnemer_comp WHERE comp_id = $jouwcomp AND wnemer_id = $wnemer");
					while ($row = mysqli_fetch_row($query)) {
						$jouwcompsaantal ++;
						array_push($jouwcomps, "$row[0]");
					}
				}
				
				echo "<p><h4>Gematchde competenties($jouwcompsaantal): </h4>";
				foreach ($jouwcomps AS $id) {
					$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
					while ($row = mysqli_fetch_row($query)) {
						echo "-> $row[1]";
					}
				}
				echo "</p>";
				
				echo "<p><h4>Aantal % gemeen: </h4>";
				$percent = $jouwcompsaantal / $compsaantal * 100;
				echo "$percent%</p>";
			}

			?>					
			</div>
		</div>
		
		
		
		<div class="container">
		  <button type="button" class="btn" data-toggle="collapse" data-target="#demo2">In behandeling</button>
		  <div id="demo2" class="collapse">
			<?php
			if ($motiv == True) 
			{	
				$queryUpdate = "UPDATE matches SET motivatie = '$motiv', progress = '2' WHERE wnemer_id = $wnemer AND vaca_id = $vaca";
				if ($this -> conn -> query($queryUpdate)) 
				{
					header('location: dashboard.php');
				}
			}
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
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "<p><h4>Vacatuur " . $row['0'] . "</h4></p>";
					echo "<p><h4>Motivatie: </h4> $motivatie </p>";
				}
				
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
				echo "<p><h4>Gevraagde competenties($totcomps): </h4>";
				foreach ($comps AS $id) {
					$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
					while ($row = mysqli_fetch_row($query)) {
						$compsaantal ++;
						array_push($idcomps, "$row[0]");
						echo "-> $row[1]";
					}
				echo "</p>";
			}						
			$jouwcompsaantal = 0;
			$jouwcomps = array();
				foreach ($idcomps AS $jouwcomp) {
					$query = $this -> conn -> query("SELECT * FROM wnemer_comp WHERE comp_id = $jouwcomp AND wnemer_id = $wnemer");
					while ($row = mysqli_fetch_row($query)) {
						$jouwcompsaantal ++;
						array_push($jouwcomps, "$row[0]");
					}
				}
				
				echo "<p><h4>Gematchde competenties($jouwcompsaantal): </h4>";
				foreach ($jouwcomps AS $id) {
					$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
					while ($row = mysqli_fetch_row($query)) {
						echo "-> $row[1]";
					}
				}
				echo "</p>";
				
				echo "<p><h4>Aantal % gemeen: </h4>";
				$percent = $jouwcompsaantal / $compsaantal * 100;
				echo "$percent%</p>";
			}

			?>					
			</div>
		</div>
		<div class="container">
		  <button type="button" class="btn" data-toggle="collapse" data-target="#demo3">Geliked</button>
		  <div id="demo3" class="collapse">
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
				$query = $this -> conn -> query("SELECT id FROM vacaturen WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "<h4><p>Vacatuur " . $row['0'] . "</h4></p>";
					$vacature_id = $row[0];
				}
				
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
			echo "<p><h4>Gevraagde competenties($totcomps): </h4>";
			foreach ($comps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					$compsaantal ++;
					array_push($idcomps, "$row[0]");
					echo "-> $row[1] <br />";
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
			
			echo "<p><h4>Jouw gematchde competenties($jouwcompsaantal): </h4>";
			foreach ($jouwcomps AS $id) {
				$query = $this -> conn -> query("SELECT * FROM competenties WHERE id = $id");
				while ($row = mysqli_fetch_row($query)) {
					echo "-> " . $row[1]. "<br/>";
				}
				
			}
			echo "</p>";
			
			echo "<p><h4>Aantal % gemeen: </h4>";
			$percent = $jouwcompsaantal / $compsaantal * 100;
			echo "$percent% </p>";
			
			
			
			?>
			</div>
			<!-- The Modal -->
			<div id="myModal" class="modal">

			  <!-- Modal content -->
			  <div class="modal-content">
				<span class="close">x</span>
				<p>Some text in the Modal..</p>
				<form action = '' method = 'get'>
					<input type = 'hidden' name = 'motiv' value = 'True'>
					<input type = 'hidden' name = 'vaca_id' value = '<?php echo $vacature_id; ?>'>
					<p><textarea name ='motivtext'  rows='5'></textarea></p>
					<input type = 'submit' value = 'Voeg motivatie toe'>
				</form>
			  </div>

			</div>

			<button id="btn">Voeg motivatie toe</button>	
			
				
				<!-- Trigger/Open The Modal -->
				
				

			  </div>
			</div>
			<?php
			}
			?>
			</div>
		<?php

?>
</div>
</div>
</div>
				
			<?php
		}
		}
}

$class = new CMS('', '');
$class -> Retrieve();
?>
        </div>

        <div class="col-sm-2"></div>
    </div>
						<script src="js/battle.js"></script>
  </body>