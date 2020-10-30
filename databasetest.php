<?php
$servername = "localhost";
$username = "mtushimp_moderator";
$password = "Mtush123456";
$dbname = "mtushimp_maindatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
    var_dump($conn);
}

