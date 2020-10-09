<?php
require_once "../../app/php/Modal.php";

session_start();

if (isset($_SESSION['TOKEN'])) {

    //get the sent data
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = $System->verifyUser($token);

    if ($verified) {
        if($action == "addProduct"){
            $Product = new products();
            foreach ($data as $key => $value) {
                $data[$key] = $System->encodeToHTML($value);
            }
            //getting fields
            $fields = [
                'productName',
                'supplier',
                'stockQuantity',
                'lowStockThreshold',
                'purchasePrice',
                'regularPrice',
                'addedBy',
                'modifiedBy',
                'Notes',
                'status'
            ];

            $user =  $_SESSION['LOGGED_USER'];

            $values = [
                $data['productName'],
                $data['supplier'],
                $data['stock'],
                $data['lowStock'],
                $data['purchasePrice'],
                $data['retailPrice'],
                $user,
                $user,
                $data['Notes'],
                $data['status']
            ];

            $combined  = array_combine($fields, $values);

            $response = $Product->addProductToDatabase($combined, $moderator);

            echo json_encode($response);
        }
        else if ($action == "update") {
            $Product = new products();
            foreach ($data as $key => $value) {
                $data[$key] = $System->encodeToHTML($value);
            }
            //getting fields
            $fields = [
                'productName',
                'supplier',
                'stockQuantity',
                'lowStockThreshold',
                'purchasePrice',
                'regularPrice',
                'addedBy',
                'modifiedBy',
                'Notes',
                'status'
            ];

            $user =  $_SESSION['LOGGED_USER'];

            $values = [
                $data['productName'],
                $data['supplier'],
                $data['stock'],
                $data['lowStock'],
                $data['purchasePrice'],
                $data['retailPrice'],
                $user,
                $user,
                $data['Notes'],
                $data['status']
            ];

            $combined  = array_combine($fields, $values);

            $response = $moderator->updateDatabase($combined, 'tbl_products',$moderator->getConnection(), $_REQUEST['id']);

            echo json_encode($response);
        }else if ($action == "Delete") {
            $id = ($_REQUEST['data']);

            $table = 'tbl_products';

            $type = "i";

            $statement = "UUID = ?"; 

            $reference = [
                $id
            ];

            $product = new products();
            $result = $product->deleteProduct($table,$type,$reference, $statement);

            echo json_encode($result);
        } else{
            echo "Check action";
        }
    } else {
        echo "unverified";
    }
} else {
    echo "not set";
}
