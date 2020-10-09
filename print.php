<?php
include_once('app/php/Modal.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="libs/css/main.css">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  $id = $_GET['id'];
  // $id = 51;

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

  ?>
  <style>
    body {
      padding: 0;
      margin: 0;
      overflow: auto;
      font-weight: 500;
    }

    .img_body {
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .img_body img {
      height: 100%;
      object-position: center;
      filter: grayscale(100%);
    }

    * {
      font-size: 14px;
      font-family: 'Roboto Mono', monospace;
    }

    td,
    th,
    tr,
    table {
      width: 100%;
      border-top: 1px solid black;
      border-collapse: collapse;
    }

    td.description,
    th.description {
      width: 150px;
      max-width: 75px;
      padding: 5px 2px 3px;
    }

    td.quantity,
    th.quantity {
      width: 20px;
      max-width: 50px;
      word-break: break-all;
    }

    td.price,
    th.price {
      width: 50px;
      max-width: 40px;
      word-break: break-all;
    }

    .centered {
      text-align: center;
      align-content: center;
    }

    .ticket {
      width: 500px;
      max-width: 300px;
    }

    img {
      max-width: inherit;
      width: inherit;
    }

    @media print {

      .hidden-print,
      .hidden-print * {
        display: none !important;
      }
    }
  </style>

  <div class="ticket">
    <div class="img_body">
      <img src="Logo.png" alt="">
    </div>
    <p style="text-align: center;">
      MTUSH IMPORTS LTD
      <br>P.O Box 275-20117,
      <br>Naivasha
      <br>Tel: 0792783603
    </p>
    <p id="displayDate" style="text-align: center;">
      <?php
      echo $thisOrder[1][0]['dateAdded'];
      ?>
    </p>

    <table>
      <thead>
        <tr>
          <th class="quantity">Q.</th>
          <th class="description">Item</th>
          <th class="price">Ksh</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $subOrders = $thisSubOrders['1'];

        foreach ($subOrders as $key => $value) {
          $quantity = $value['quantity'];
          $item = $value['item'];
          $price = $value['price'];


        ?>
          <tr>
            <td class="quantity">
              <?php echo $quantity ?>
            </td>
            <td class="description">
              <?php echo $item ?>
            </td>
            <td class="price">
              <?php echo $price ?>
            </td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <td class="quantity"></td>
          <td class="description" style="font-weight:600"> TOTAL</td>
          <td class="price" style="font-weight:800"> <?php echo ($thisOrder[1][0]['Amount']) ?></td>
        </tr>
        </tr>
      </tbody>
    </table>
    <p>=============================================</p>
    <p style="padding: 0px; margin: 0px;">Customer :<?php echo $thisOrder[1][0]['customerName'] ?> </p>
    <p style="padding: 0px; margin: 0px;">Number : <?php echo $thisOrder[1][0]['customerNumber'] ?> </p>
    <p style="padding: 0px; margin: 0px;">Location : <?php echo $thisOrder[1][0]['orderLocation'] ?> </p>

    <p>=============================================</p>
    <p>Ref No. : <?php echo $id ?></p>
    <br>
    <br>
    <p class="centered" style="margin-bottom: 30px">Thanks for your purchase!
      <br>Welcome back</p>
    <br>
    <br>
  </div>
  <button id="btnPrint" class="hidden-print" onclick="print()">Print</button>
  <script>
    var entered = null;
  </script>
</body>

</html>