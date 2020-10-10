<?php
require_once "../../app/php/Modal.php";

session_start();

if(isset($_SESSION['TOKEN'])){

    //get the sent data
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = true;

    if($verified){
        if($action == "updateCurrentUser"){
            
        }elseif($action == "update"){
            echo "other";
        }
    }else{
        echo "unverified";
    }
}else{
    echo "not set";
}


