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

    
    <style>
    /* Prevent the text contents of draggable elements from being selectable. */
    [draggable] {
      -moz-user-select: none;
      -khtml-user-select: none;
      -webkit-user-select: none;
      user-select: none;
      /* Required to make elements draggable in old WebKit */
      -khtml-user-drag: element;
      -webkit-user-drag: element;
    }
    .column {
      height: 35px;
      width: 100%;
      float: left;
      border: 2px solid #666666;
      border-radius: 4px;
      margin-right: 5px;
      margin-bottom: 10px;
      
      text-align: center;
      cursor: move;
    }
    .column header {
      color: black;
      text-shadow: #000 0 1px;
      box-shadow: 5px;
      
      
      -webkit-border-top-left-radius: 10px;
      -moz-border-radius-topleft: 10px;
      -ms-border-radius-topleft: 10px;
      border-top-left-radius: 10px;
      -webkit-border-top-right-radius: 10px;
      -ms-border-top-right-radius: 10px;
      -moz-border-radius-topright: 10px;
      border-top-right-radius: 10px;
    }
    </style>
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
        <!-- <div class="col-sm-2"></div> -->

        <div class="col-sm-8 col-sm-offset-2">
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
                <legend>Mogelijke eigenschappen</legend>

                <!-- Multiple Checkboxes -->
                <div class="form-group">
                  <!-- <label class="col-md-4 control-label" for=""></label> -->
                  <div class="col-sm-6">
              
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
                $halfCount = $countRowsCompetenties / 2 + 1;
                if ($halfCount == $i)
                {
                ?>
                </div>
                <div class='col-sm-6'>
                
                <?php
                }
                if ($booleanGekozenCompetentie == true)
                {
                  ?>
                  <div class="checkbox">
                    <label for="-0">
                    <?php
                      echo "<input type='checkbox' class='single-checkbox' name='" . $rowCompetenties['id'] . "' checked>" . $rowCompetenties['beschrijving'] . "<br />";
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
                      echo "<input type='checkbox' class='single-checkbox' name='" . $rowCompetenties['id'] . "'>" . $rowCompetenties['beschrijving'] . "<br />";
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
          <legend>Geselecteerde eigenschappen</legend>
          <?php
            $resultCompetenties = $classDatabase->retrieveData("competenties");
            $countRowsCompetenties = $resultCompetenties->num_rows;
            $resultWnemer_comp = $classDatabase->retrieveCheckIfExists("wnemer_comp", "1");
            $countRowsWnemer_comp = $resultWnemer_comp->num_rows;

            $arrayWnemer_comp = array();

            for($i = 1; $i <= $countRowsCompetenties; $i++)
            {
              $rowWnemer_comp = $resultWnemer_comp->fetch_assoc();

              array_push($arrayWnemer_comp, $rowWnemer_comp['comp_id']);
            }
            ?>
            <form action='' method='post'>
            <div id="columns" class="row">

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
            <div class="column col-sm-1" name='<?php echo $rowCompetenties['id']; ?>' draggable="true"><header><?php echo $rowCompetenties['beschrijving']; ?></header></div>
            <?php
              }
            }
            ?>
          </div>

          <div class="form-group">
              <label class="col-md-4 control-label" for="submitEigenschappen"></label>
              <div class="col-md-4">
                <button id="submitEigenschappen" name="submitEigenschappen" class="btn btn-primary">Opslaan</button>
              </div>
            </div>
          </from>
        </div> <!-- Afsluiting bootstrap col-sm-8 -->


       
    </div>
    <script>
     $('input[type=checkbox]').change(function(e){
   if ($('input[type=checkbox]:checked').length >= 8) {
        $(this).prop('checked', false)
        alert("allowed only 8");
   }
})
     function handleDragStart(e) {
       this.style.opacity = '0.4';  // this / e.target is the source node.
     }

     var cols = document.querySelectorAll('#columns .column');
     [].forEach.call(cols, function(col) {
       col.addEventListener('dragstart', handleDragStart, false);
     });
     function handleDragStart(e) {
       this.style.opacity = '0.4';  // this / e.target is the source node.
     }

     function handleDragOver(e) {
       if (e.preventDefault) {
         e.preventDefault(); // Necessary. Allows us to drop.
       }

       e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

       return false;
     }

     function handleDragEnter(e) {
       // this / e.target is the current hover target.
       this.classList.add('over');
     }

     function handleDragLeave(e) {
       this.classList.remove('over');  // this / e.target is previous target element.
     }

     var cols = document.querySelectorAll('#columns .column');
     [].forEach.call(cols, function(col) {
       col.addEventListener('dragstart', handleDragStart, false);
       col.addEventListener('dragenter', handleDragEnter, false);
       col.addEventListener('dragover', handleDragOver, false);
       col.addEventListener('dragleave', handleDragLeave, false);
     });
     function handleDrop(e) {
       // this / e.target is current target element.

       if (e.stopPropagation) {
         e.stopPropagation(); // stops the browser from redirecting.
       }

       // See the section on the DataTransfer object.

       return false;
     }

     function handleDragEnd(e) {
       // this/e.target is the source node.

       [].forEach.call(cols, function (col) {
         col.classList.remove('over');
       });
     }

     var cols = document.querySelectorAll('#columns .column');
     [].forEach.call(cols, function(col) {
       col.addEventListener('dragstart', handleDragStart, false);
       col.addEventListener('dragenter', handleDragEnter, false)
       col.addEventListener('dragover', handleDragOver, false);
       col.addEventListener('dragleave', handleDragLeave, false);
       col.addEventListener('drop', handleDrop, false);
       col.addEventListener('dragend', handleDragEnd, false);
     });
     var dragSrcEl = null;

     function handleDragStart(e) {
       // Target (this) element is the source node.
       

       dragSrcEl = this;

       e.dataTransfer.effectAllowed = 'move';
       e.dataTransfer.setData('text/html', this.innerHTML);
     }
     function handleDrop(e) {
       // this/e.target is current target element.

       if (e.stopPropagation) {
         e.stopPropagation(); // Stops some browsers from redirecting.
       }

       // Don't do anything if dropping the same column we're dragging.
       if (dragSrcEl != this) {
         // Set the source column's HTML to the HTML of the column we dropped on.
         dragSrcEl.innerHTML = this.innerHTML;
         this.innerHTML = e.dataTransfer.getData('text/html');
       }

       return false;
     }
    </script>
  </body>