<?php

include_once('app/php/Modal.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body style="overflow: scroll;">
    <style>
        .table_border {
            margin: auto;
            width: 600px;
        }

        .company_logo {
            width: 180px;
            height: 70px;
            margin: auto;
            margin-bottom: 20px;
        }

        img {
            height: 100%;
        }
    </style>


    <?php
    $allUsers = null;
    $products = new products();
    $iter = 1;
    $table = 'tbl_products';
    $fields = [
        '*'
    ];
    $type = 'i';

    $reference = [
        array(1, 1),
    ];

    $allProducts = $products->readProductsByReference($moderator, $table, $reference, $fields, $type);
    $items = $allProducts[1];
    ?>
    <div class="company_logo">
        <img src="Logo.png" alt="">
    </div>
    <div class="table_border">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Product Price</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $count = 1;
                // var_dump($items);
                foreach ($items as $key => $value) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $count;
                                        $count++ ?></th>
                        <td><?php echo $value['productName'] ?></td>
                        <td><?php echo $value['stockQuantity'] ?></td>
                        <td><?php echo $value['regularPrice'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>