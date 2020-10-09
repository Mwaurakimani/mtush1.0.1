<?php
require_once "../../app/php/Modal.php";

session_start();

if (isset($_SESSION['TOKEN'])) {

    //get the sent data
    $data1 = $_REQUEST['data'];
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = $System->verifyUser($token);

    if ($verified) {
        if ($action == "searchProduct") {
            $Products = new products();

            $table = 'tbl_products';

            $statement = "productName LIKE CONCAT('%',?,'%') AND  status = ?";

            $type = "si";

            $values = [$data,1];

            $result = $moderator->searcher($table, $statement, $type, $values);


            echo json_encode($result);

        } elseif($action == "confirmSale" ){
            $Order = new order();
            foreach ($data['orderDetails'] as $key => $value) {
                if($key == 'order'){
                    continue;
                }
                $data[$key] = $System->encodeToHTML($value);
            }

            $fields = [
                'customerName',
                'customerNumber',
                'orderLocation',
                'soldBy',
                'Quantity',
                'Amount'
            ];

            $values = [
                $data['customer_name'],
                $data['customer_number'],
                $data['customer_location'],
                $_SESSION['LOGGED_USER'],
                $data['Quantity'],
                $data['Amount']
            ];

            $combined  = array_combine($fields, $values);

            $response = $Order->addOrderToDatabase($combined, $moderator);

            

            $order_id = $response['product'][1][0]['UUID'];

            $all_items = $data1['list'];
            $sub_orders = [];

            foreach ($all_items as $key => $value) {

                $fields = [
                    'item',
                    'quantity',
                    'price',
                    'subtotal',
                    'addedBy',
                    'ref_ID'
                ];

                $values = [
                    $value[0],
                    $value[1],
                    $value[2],
                    $value[3],
                    $_SESSION['LOGGED_USER'],
                    $order_id
                ];

                $combined  = array_combine($fields, $values);

                $response1 = $Order->addSubToDatabase($combined, $moderator);

                $status = $response1['status'];

                if($status == true){
                    $id = $value[4];
                    $table = 'tbl_products';
                    $fields = [
                            '*'
                        ];
                    $type = 'i';

                    $reference = [
                        array("UUID", $id),
                    ];
                    $product = $moderator->get_by_ref($fields,$table,$moderator->getConnection(),$reference,$type);
                    $quantity = $product[1][0]['stockQuantity'];
                    $lowStockThreshold = $product[1][0]['lowStockThreshold'];
                    $currentQuantity = $quantity - $value[1];

                    if( $currentQuantity <= 0 ){
                        $table = 'tbl_products';
                        $field2 = [
                            'status'
                        ];
                        $value2 = [
                            0
                        ];

                        $combined  = array_combine($field2, $value2);

                        $product2 = $moderator->updateDatabase($combined, $table, $moderator->getConnection(), $id);
                    }

                    $table = 'tbl_products';
                    $field1 = [
                        'stockQuantity'
                    ];

                    $value1 = [
                        $currentQuantity
                    ];

                    $combined  = array_combine($field1, $value1);

                    $product3 = $moderator->updateDatabase($combined,$table,$moderator->getConnection(),$id);
                }
                array_push($sub_orders, $response1);
            };
            array_push($response,$sub_orders);
            echo json_encode($response);
        } elseif($action == "viewProduct" ){
            $Products = new products();

            $table = 'tbl_products';

            $statement = "productName LIKE CONCAT('%',?,'%') AND  status = ?";

            $type = "si";

            $values = [$data, 1];

            $result = $moderator->searcher($table, $statement, $type, $values);

            $result = json_encode($result);

            $url = ROOT . "/Views/pointOfSale/component/productsListing.php";
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            # Send request.
            $result = curl_exec($ch);
            curl_close($ch);
            # Print response.
            echo $result;
        } else{
            echo "undefined";
        }
    } else {
        echo "unverified";
    }
} else {
    echo "not set";
}
 