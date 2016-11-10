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

            if (isset($_POST['submitEigenschappen'])) {
                //echo "1 is hier!!";

                $resultCompetentiesSave = $classDatabase->retrieveData("competenties");

                $countRowsCompetentiesSave = $resultCompetentiesSave->num_rows;
                $arraySaveData = array();

                for($i = 1; $i <= $countRowsCompetentiesSave; $i++)
                {
                  $rowCompetentiesSave = $resultCompetentiesSave->fetch_assoc();

                  if (isset($_POST[$rowCompetentiesSave['id']]))
                  {
                    $arraySaveData[$rowCompetentiesSave['id']] = true;
                  }
                  else
                  {
                    $arraySaveData[$rowCompetentiesSave['id']] = false;
                  }
                }
                $classDatabase->saveEigenschappenData($arraySaveData);
            }
            elseif (isset($_POST['submitAccountSettings']))
            {
              $arraySaveAccountSettingsData = array();

              $arraySaveAccountSettingsData['tel'] = $_POST['tel'];
              $arraySaveAccountSettingsData['mail'] = $_POST['mail'];
              $arraySaveAccountSettingsData['pass'] = $_POST['pass'];

              $classDatabase->saveAccountSettingsData($arraySaveAccountSettingsData);
            }

            // Data voor eigenschappen ophalen
            $resultCompetenties = $classDatabase->retrieveData("competenties");
            $countRowsCompetenties = $resultCompetenties->num_rows;
            $resultWnemer_comp = $classDatabase->retrieveCheckIfExists("wnemer_comp", "1");
            $countRowsWnemer_comp = $resultWnemer_comp->num_rows;


            //Data voor account settings ophalen
            $resultAccountSettings = $classDatabase->retrieveDataFromUser("werknemers", "1");
            $rowAccountSettings = $resultAccountSettings->fetch_assoc();

            $arrayWnemer_comp = array();

            for($i = 1; $i <= $countRowsCompetenties; $i++)
            {
              $rowWnemer_comp = $resultWnemer_comp->fetch_assoc();

              array_push($arrayWnemer_comp, $rowWnemer_comp['comp_id']);
            }
            ?>

            <form class="form-horizontal" method='post'>
            <fieldset>

            <!-- Form Name -->
            <legend>Account Instellingen</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="tel">Telefoonnummer</label>  
              <div class="col-md-4">
              <input id="tel" name="tel" type="text" placeholder="0643849203" class="form-control input-md" value='<?php echo $rowAccountSettings['tel']; ?>'>
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="mail">E-mail</label>  
              <div class="col-md-4">
              <input id="mail" name="mail" type="text" placeholder="battleoftheschools@gmail.com" class="form-control input-md" value='<?php echo $rowAccountSettings['mail']; ?>'>
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="pass">Wachtwoord</label>
              <div class="col-md-4">
                <input id="pass" name="pass" type="password" placeholder="Wachtwoord" class="form-control input-md" value='<?php echo $rowAccountSettings['pass']; ?>'>
                
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="submitAccountSettings"></label>
              <div class="col-md-4">
                <button id="submitAccountSettings" name="submitAccountSettings" class="btn btn-primary">Opslaan</button>
              </div>
            </div>

            </fieldset>
            </form>

            <!-- <div class="form-group">
              <form action='' method='post'>
                <h2>Account Instellingen</h2>
                <label>Telefoonnummer</label><input type='text' name='tel' value='<?php echo $rowAccountSettings['tel']; ?>'/><br />
                <label>E-mail</label><input type='text' name='mail' value='<?php echo $rowAccountSettings['mail']; ?>'/><br />
                <label>Wachtwoord</label><input type='password' name='pass' value='<?php echo $rowAccountSettings['pass']; ?>'/><br />
                <input type='submit' name='submitAccountSettings' value='Opslaan'/>
              </form>
            </div> --> 
              <form action='' method='post' class="form-horizontal">
                <fieldset>

                <!-- Form Name -->
                <legend>Eigenschappen</legend>

                <!-- Multiple Checkboxes -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for=""></label>
                  <div class="col-md-4">
                  
                  

              <?php
              for($i = 1; $i <= $countRowsCompetenties; $i++)
              {
                $rowCompetenties = $resultCompetenties->fetch_assoc();
                $booleanGekozenCompetentie = false;

                foreach ($arrayWnemer_comp as $Wnemer_comp) 
                {
                  if ($rowCompetenties['id'] == $Wnemer_comp)
                  {
                    $booleanGekozenCompetentie = true;
                  } 
                }
                ?>
                
                <?php
                if ($booleanGekozenCompetentie == true)
                {
                  ?>
                  <div class="checkbox">
                    <label for="-0">
                    <?php
                      echo "<input type='checkbox' name='" . $rowCompetenties['id'] . "' checked>" . $rowCompetenties['beschrijving'] . "<br />";
                    ?>
                    </label>
                  </div>
                  <?php
                }
                else
                {
                  ?>
                  <div class="checkbox">
                    <label for="-0">
                    <?php
                      echo "<input type='checkbox' name='" . $rowCompetenties['id'] . "'>" . $rowCompetenties['beschrijving'] . "<br />";
                    ?>
                    </label>
                  </div>
                  <?php
                }
              }

            ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="submitEigenschappen"></label>
              <div class="col-md-4">
                <button id="submitEigenschappen" name="submitEigenschappen" class="btn btn-primary">Opslaan</button>
              </div>
            </div>

            </fieldset>
          </form>
        </div>

        <div class="col-sm-2"></div>
    </div>
  </body>