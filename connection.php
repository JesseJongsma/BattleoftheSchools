<!-- database connectie gegevens -->

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bos";


// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($db -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>