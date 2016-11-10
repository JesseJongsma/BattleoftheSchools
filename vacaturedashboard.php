<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vacature Dashboard</title>
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
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
            Vacature Dashboard
          </div>
        </div>
      </div>

      <?php include 'menu.php'; ?>
    
    </div>
    <div class='margin-top'></div>
    <div class="container-fluid">
        <div class="col-sm-2"></div>
        <!-- Lege zijkolom -->

        <div class="col-sm-8">

          <?php
            require('classes.php');

            $classDatabase = new database();
            $classDatabase->databaseConnect();

            if (isset($_POST['verwijderID']))
            {
              $succesfull = $classDatabase->deleteVacatureData("vacaturen", $_POST['verwijderID']);
            }

            // if (isset($_POST['editID']))
            // {
            //   echo $_POST['editID'];
            // }

            $results = $classDatabase->retrieveVacatureData("vacaturen", "2");
            $countRows = $results->num_rows;
          ?>

          <table class="table table-striped">
            <tr>
              <thead><h1>Openstaande Vacatures</h1></thead>
            </tr>
              <?php
                for($i = 1; $i <= $countRows; $i++)
                {
                  $row = $results->fetch_assoc();
                  ?>
                    <tr>
                      <td class="col-sm-3">
                        <h2>
                          <?php
                            echo $row['titel'];
                          ?>
                        </h2>
                      </td>
                      <td class="col-sm-3">
                        <h2>
                          <?php
                            echo $row['functie'];
                          ?>
                        </h2>
                      </td>
                      <td class="col-sm-1">
                        <!-- <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Edit</a> -->
                        <form action='vacaturetoevoegen.php' method='post'>
                          <input type="hidden" name="editID" value="<?php echo $row['id']; ?>">
                          <label for="myEditen<?php echo $row['id']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i> Edit</label>
                          <input id="myEditen<?php echo $row['id']; ?>" name="myEditen<?php echo $row['id']; ?>" type="submit" value="" class="hidden" />
                        </form>
                      </td>
                      <td class="col-sm-1">
                        <form action='' method='post' onsubmit="return confirm('Ben je zeker dat je deze vacature wil verwijderen?');">
                          <input type="hidden" name="verwijderID" value="<?php echo $row['id']; ?>">
                          <label for="myVerwijderen<?php echo $row['id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Verwijderen</label>
                          <input id="myVerwijderen<?php echo $row['id']; ?>" name="myVerwijderen<?php echo $row['id']; ?>" type="submit" value="" class="hidden" />
                        </form>
                      </td>
                    </tr>
                  <?php
                }
            ?>
          </table>
          <div class="row">
            <div class=col-sm-12>
              <div class="col-sm-12 footer">
                <a href="#" class="btn btn-block btn-lg btn-info"><span class="glyphicon glyphicon-open"></span> Toevoegen</a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-sm-2"></div>
    </div>
  </body>