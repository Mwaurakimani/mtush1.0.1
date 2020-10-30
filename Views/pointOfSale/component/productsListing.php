<?php
session_start();

$jsonStr = file_get_contents("php://input"); //read the HTTP body.
$json = json_decode($jsonStr);

if ($json[0] != true) {
?>
    <p style="text-align: center;padding:20px;">No records found</p>
<?php
} else {
?>
    <table class="table table-sm table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $productsArray = $json[1];
            foreach ($productsArray as $key => $value) {
            ?>
                <tr>
                    <th scope="row"><?php echo $count;
                                    $count++ ?></th>
                    <td><?php echo $value->productName ?></td>
                    <td><?php echo $value->stockQuantity ?></td>
                    <td><?php echo $value->regularPrice ?></td>
                    <td><?php echo $value->status ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
