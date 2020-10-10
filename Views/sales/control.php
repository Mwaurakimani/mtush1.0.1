<?php
require_once "../../app/php/Modal.php";

session_start();

if (isset($_SESSION['TOKEN'])) {
  //get the sent data
  $data = $_REQUEST['data'];
  $token = $_REQUEST['token'];
  $action = $_REQUEST['action'];

  //verify usertrue true;

  if ($verified) {
    if ($action == "openSale") {
      // get the order details
      $id = $data;

      $order = new order();

      $table = 'tbl_orders';
      $fields = [
        '*'
      ];
      $type = 'i';

      $reference = [
        array("UUID", $id),
      ];

      $thisOrder = $order->readOrdersByReference($moderator, $table, $reference, $fields, $type);

      $table = 'tbl_suborder';
      $fields = [
        '*'
      ];
      $type = 'i';

      $reference = [
        array("ref_ID", $id),
      ];

      $thisSubOrders = $order->readOrdersByReference($moderator, $table, $reference, $fields, $type);

      if($thisOrder[0] == true && $thisSubOrders[0] == true){
        $data = array(
          "main"=>$thisOrder,
          "sub"=>$thisSubOrders,
          "user"=> $_SESSION['LOGGED_USER']
        );

        $data = json_encode($data);

        $url = ROOT."/Views/sales/component/salesListing.php";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        echo $result;
      } else{
        return false;
        exit();
      }
    } elseif ($action == "deleteItem"){
      if(is_array($data)){
        foreach($data as $value){

          $password = ($_REQUEST['validator']);
          $USER = new userAccount();

          $table = 'tbl_moderators';
          $fields = [
            '*'
          ];
          $type = 'i';

          $reference = [
            array("UUID", $_SESSION["LOGGED_USER"]),
          ];


          $user = $USER->readUserByReference($moderator, $table, $reference, $fields, $type);

          $pass = $user[1][0]["password"];
          $role = $user[1][0]['Role'];

          if(!password_verify($password, $pass) && $role == "Admin"){
            $result = array(
              "status"=>false,
              "response"=> "Unauthorized deletion!"
            );

            echo json_encode($result);
            exit;
          }

          $value = $System->encodeToHTML($value);

          //send request to delete;

          $order = new order();

          $table = 'tbl_orders';

          $type = "i";

          $statement = "UUID = ?";

          $reference = [
            $value
          ];

          $result = $moderator->deleteFromDatabase($table, $type, $reference, $statement);
        }

        $response = array(
          "status" => true,
          "response" => "deletion successful"
        );

        echo json_encode($response);
        
      }else{
        exit();
      }
    }else{
      echo "No Action";
    }
  } else {
    echo "unverified";
  }
} else {
  echo "not set";
}
