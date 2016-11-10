<?php
  session_start();

  if ($_SESSION['gebruiker'] == "werknemer")
  {
    $userBoolean = true;
  }
  elseif ($_SESSION['gebruiker'] == "werkgever")
  {
    $userBoolean = false;
  }
?>
<div class="navbar-left">
  <div class="content">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="">Matching</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="#">Account</a></li>
      <li><a href="#">Instellingen</a></li>
      <?php
        if ($userBoolean)
        {
          ?>
          <li><a href="instellingen.php">Account</a></li>
         <?php
        }
        elseif (!$userBoolean) 
        {
          ?>
          <li><a href="bedrijveninstellingen.php">Account</a></li>
         <?php 
        }
        ?>
      <li><a href="#">Informatie</a></li>
      <?php
      if (!$userBoolean) 
        {
          ?>
          <li><a href="vacaturedashboard.php">Vacatures</a></li>
         <?php 
        }
        ?>
        <li><a href="login.php">Loguit</a></li>
    </ul>
  </div>
</div>