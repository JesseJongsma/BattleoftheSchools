<?php
    session_start();
    if(!$_SESSION['login'] == True)
    {
        header("Location: login.php");
    }
?>