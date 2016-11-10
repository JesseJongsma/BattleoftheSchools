<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Title</title>
    
 
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
        <!-- Content -->

          <div class="inner cover">
            <h1 class="cover-heading">Dashboard</h1>
            <p class="lead">Kom direct in contact met werkgevers &amp; werknemers in heel Groningen</p>


            <?php include 'dash.php' ;?>


          </div>



        </div>

        <div class="col-sm-2"></div>
    </div>
  </body>