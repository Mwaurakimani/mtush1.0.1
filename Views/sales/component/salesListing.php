<?php
//test for session existence
session_start();



$jsonStr = file_get_contents("php://input"); //read the HTTP body.
$json = json_decode($jsonStr);

$order = $json->main;
$subs = $json->sub;

$order = $order[1][0];
$subs = $subs[1];


?>
<div class="sale_viewer">
    <h2>Sale View</h2>
    <div class="elem_holder">
        <p class="title">Ref No. :</p>
        <p><?php echo $order->UUID ?></p>
    </div>
    <div class="elem_holder">
        <p class="title">Date :</p>
        <p><?php echo $order->dateAdded ?></p>
    </div>
    <div class="elem_holder">
        <p class="title">Name:</p>
        <p><?php echo $order->customerName ?></p>
    </div>
    <div class="elem_holder">
        <p class="title">Number :</p>
        <p><?php echo $order->customerNumber ?></p>
    </div>
    <div class="elem_holder">
        <p class="title">Amount :</p>
        <p><?php echo $order->Amount ?></p>
    </div>
    <div class="sales_lister">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"></th>
                    <th scope="col">Product</th>
                    <th scope="col">No. Bales</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($subs as $key => $value) {
                    $quantity = $value->quantity;
                    $item = $value->item;
                    $price = $value->price;


                ?>
                    <tr>
                        <td class="quantity" scope="row">
                            <?php echo $counter ?>
                        </td>
                        <td class="quantity">
                            <?php echo $item ?>
                        </td>
                        <td class="description">
                            <?php echo $quantity ?>
                        </td>
                        <td class="price">
                            <?php echo $price ?>
                        </td>
                    </tr>
                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php

?>