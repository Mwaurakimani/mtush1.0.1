<?php
$servername = "localhost";
$username = "mtushimp_moderator1";
$password = "Mtushimports2675";
$dbname = "mtushimp_maindatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    var_dump($conn);
}

