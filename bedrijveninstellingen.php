<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Instellingen</title>
    
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
            Instellingen
          </div>
        </div>
      </div>

      <?php include 'menu.php'; ?>
    
    </div>
    <div class='margin-top'></div>
    <div class="container-fluid">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
          <?php
            require('classes.php');


            $classDatabase = new database();

            $classDatabase->databaseConnect();

            // Opslaan van data wat verstuurd is

            if (isset($_POST['submitBedrijvenAccountSettings']))
            {
              $arraySaveBedrijvenAccountSettingsData = array();

              $arraySaveBedrijvenAccountSettingsData['naam'] = $_POST['naam'];
              $arraySaveBedrijvenAccountSettingsData['straat'] = $_POST['straat'];
              $arraySaveBedrijvenAccountSettingsData['huisnr'] = $_POST['huisnr'];
              $arraySaveBedrijvenAccountSettingsData['postc'] = $_POST['postcode'];
              $arraySaveBedrijvenAccountSettingsData['woonplaats'] = $_POST['plaats'];
              $arraySaveBedrijvenAccountSettingsData['tel'] = $_POST['telefoonnummer'];
              $arraySaveBedrijvenAccountSettingsData['mail'] = $_POST['mail'];
              $arraySaveBedrijvenAccountSettingsData['beschrijving'] = $_POST['omschrijving'];
              $arraySaveBedrijvenAccountSettingsData['pass'] = $_POST['password'];

              $classDatabase->saveBedrijvenAccountSettingsData($arraySaveBedrijvenAccountSettingsData);
            }

            //Data voor account settings ophalen
            $resultBedrijvenAccountSettings = $classDatabase->retrieveDataFromUser("bedrijven", "1");
            $rowBedrijvenAccountSettings = $resultBedrijvenAccountSettings->fetch_assoc();

            ?>

           <form action='' method='post' class="form-horizontal">
           <fieldset>

           <!-- Form Name -->
           <legend>Account Settings</legend>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="naam">Naam</label>  
             <div class="col-md-4">
             <input id="naam" name="naam" type="text" placeholder="Post van Pieter" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['naam']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="plaats">Plaats</label>  
             <div class="col-md-4">
             <input id="plaats" name="plaats" type="text" placeholder="Groningen" class="form-control input-md"  value='<?php echo $rowBedrijvenAccountSettings['woonplaats']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="postcode">Postcode</label>  
             <div class="col-md-4">
             <input id="postcode" name="postcode" type="text" placeholder="8489IE" class="form-control input-md"  value='<?php echo $rowBedrijvenAccountSettings['postc']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="straat">Straat</label>  
             <div class="col-md-4">
             <input id="straat" name="straat" type="text" placeholder="Pop Dijkemaweg 88" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['straat']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="huisnr">Huisnummer</label>  
             <div class="col-md-4">
             <input id="huisnr" name="huisnr" type="text" placeholder="88" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['huisnr']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="telefoonnummer">Telefoonnummer</label>  
             <div class="col-md-4">
             <input id="telefoonnummer" name="telefoonnummer" type="text" placeholder="0483-748339" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['tel']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="mail">E-mail</label>  
             <div class="col-md-4">
             <input id="mail" name="mail" type="text" placeholder="battleoftheschools@gmail.com" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['mail']; ?>'>
               
             </div>
           </div>

           <!-- Text input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="omschrijving">Omschrijving</label>  
             <div class="col-md-4">
             <input id="omschrijving" name="omschrijving" type="text" placeholder="ik ben een placeholder" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['beschrijving']; ?>'>
               
             </div>
           </div>

           <!-- Password input-->
           <div class="form-group">
             <label class="col-md-4 control-label" for="password">Wachtwoord</label>
             <div class="col-md-4">
               <input id="password" name="password" type="password" placeholder="**********" class="form-control input-md" value='<?php echo $rowBedrijvenAccountSettings['pass']; ?>'>
               
             </div>
           </div>

           <!-- Button -->
           <div class="form-group">
             <label class="col-md-4 control-label" for=""></label>
             <div class="col-md-4">
               <button id="submitBedrijvenAccountSettings" name="submitBedrijvenAccountSettings" class="btn btn-primary">Opslaan</button>
             </div>
           </div>

           </fieldset>
           </form>

       </div>

        <div class="col-sm-2"></div>
    </div>
  </body>