<?php
require 'connection.php';
// HIER MOET HIJ DE SESSION LEZEN EN HET BEDRIJFS ID OMZETTEN IN EEN VARIABELE

echo "<pre>";
print_r($_POST);
echo "</pre>";
$vactitel = $_POST['titel'];
$vacbeschrijving = $_POST['omschrijving'];

$sql_vac_insert = "INSERT INTO vacaturen (`id`, `titel`, `beschrijving`, `bedr_id`) 
VALUES (NULL, '$vactitel', '$vacbeschrijving', '2')";

if(!isset($_POST['submit']))
{
  echo "testje";
}
else
{
  if (mysqli_query($con, $sql_vac_insert)) {
    $done = true;
} else {
    echo "Error: " . $sql_vac_insert . "<br>" . mysqli_error($con);
    echo "ik ben hier";
}
}

?>

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

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/battle.js"></script>

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
            Hier je titel!
          </div>
        </div>
      </div>

      <?php include 'menu.php' ;?>
    
    </div>
    <div class='margin-top'></div>
    <div class="container-fluid">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
          <br>
          <form class="form-horizontal" action="" method="post">
          <fieldset>

          <!-- Form Name -->
          <legend>Vacature toevoegen</legend>

          <?php

          if ($done == true) {

            echo "<div class='alert alert-success' role='alert'><strong>Top!</strong> Er is een vacature toegevoegd. </div>";
          }

          ?>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="titel">Vacature titel</label>  
            <div class="col-md-4">
            <input id="titel" name="titel" type="text" placeholder="Voer hier uw vacature titel in" class="form-control input-md" required="">
              
            </div>
          </div>

          <!-- Textarea -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="omschrijving">Vacature omschrijving</label>
            <div class="col-md-4">                     
              <textarea class="form-control" id="omschrijving" name="omschrijving"></textarea>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="submit"></label>
            <div class="col-md-4">
              <button id="submit" name="submit" value="verstuurd" class="btn btn-primary">Voeg toe »</button>
            </div>
          </div>

          </fieldset>
          </form>
        </div>

        <div class="col-sm-2"></div>
    </div>
  </body>