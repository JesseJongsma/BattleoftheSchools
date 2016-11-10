<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<<<<<<< HEAD
    <title>Instellingen</title>
=======
    <title>Title</title>
>>>>>>> origin/master
    
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
<<<<<<< HEAD
            Instellingen
=======
            Hier je titel!
>>>>>>> origin/master
          </div>
        </div>
      </div>

<<<<<<< HEAD
      <?php include 'menu.php'; ?>
=======
      <?php include 'menu.php' ;?>
>>>>>>> origin/master
    
    </div>
    <div class='margin-top'></div>
    <div class="container-fluid">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
<<<<<<< HEAD
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
            <form action='' method='post'>
              <h2>Account Instellingen</h2>
              <label>Telefoonnummer</label><input type='text' name='tel' value='<?php echo $rowAccountSettings['tel']; ?>'/><br />
              <label>E-mail</label><input type='text' name='mail' value='<?php echo $rowAccountSettings['mail']; ?>'/><br />
              <label>Wachtwoord</label><input type='password' name='pass' value='<?php echo $rowAccountSettings['pass']; ?>'/><br />
              <input type='submit' name='submitAccountSettings' value='Opslaan'/>
            </form>
            <form action='' method='post'>
            <h2>Eigenschappen</h2>
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
                if ($booleanGekozenCompetentie == true)
                {
                  echo "<input type='checkbox' name='" . $rowCompetenties['id'] . "' checked>" . $rowCompetenties['beschrijving'] . "<br />";
                }
                else
                {
                  echo "<input type='checkbox' name='" . $rowCompetenties['id'] . "'>" . $rowCompetenties['beschrijving'] . "<br />";
                }
              }

            ?>
            <input type='submit' name='submitEigenschappen' value='Opslaan'/>
          </form>
=======
        <!-- Content -->
>>>>>>> origin/master
        </div>

        <div class="col-sm-2"></div>
    </div>
<<<<<<< HEAD
=======
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
>>>>>>> origin/master
  </body>