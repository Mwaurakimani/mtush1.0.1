<?php
require_once "../../app/php/Modal.php";

session_start();

if (isset($_SESSION['TOKEN'])) {

    //get the sent data
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = true;

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
                'origin',
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
                $data['origin'],
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
            var_dump($combined);
            exit();

            $response = $Product->addProductToDatabase($combined, $moderator);

            echo json_encode($response);
        }else if ($action == "update") {
            $Product = new products();
            //getting fields
            $fields = [
                'productName',
                'supplier',
                'origin',
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
                $data['origin'],
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
        }else if($action == "list_products"){
            
            $data = json_decode($data);
            $offset = $data->offset;

            $moderator = new AdminUser();
            $caller = new products();
            $variables = array(
                "conn"=>$moderator,
                "offset"=>$offset,
            );

            $products = $caller->list_products($variables);

            echo json_encode($products);
        }else if($action == "filter_country"){
            $data = json_decode($data);

            $country = $data->country;

            if($country == "N/A"){
                $country = null;
            }

            $moderator = new AdminUser();
            $caller = new products();
            $variables = array(
                "conn"=>$moderator,
                "country"=>$country,
            );

            $products = $caller->filter_products($variables);

            if($products[0]){
                $all_products = array(
                    "status"=>true,
                    "products" => $products[1]
                );

                echo json_encode($all_products);
            }else{
                $all_products = array(
                    "status"=>false,
                    "response" => "No products matched your criteria"
                );

                echo json_encode($all_products);
            }
        }else{
            echo "Check action";
        }
    } else {
        echo "unverified";
    }
} else {
    echo "not set";
}
