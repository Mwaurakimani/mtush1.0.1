<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>Catalogue</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>
                    <li class="linker" onclick="renderContent('catalogue')">List</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="addUser" onclick="openCatalogue()">Add Product</button>
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updateCatalogue()">Update</button>
            <button type="button" class="btn btn-outline-danger" id="deleteUser" onclick="deleteProduct()">Delete</button>
        </div>
        <div class="more_options_pannel">
            <div class="sys_input_element">
                <div class="input_element">
                    <input type="text" style="margin-right:10px" onkeyup="searchProductCatalog()">
                    <button type="button" class="btn btn-outline-danger">Search</button>
                </div>
            </div>
            <div class="sys_input_element">
                <div class="input_element">
                    <select name="sort" id="" placeholder="Sort">
                        <option value="sort">Sort</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="content_view_display_panel">
        <div class="splashboard_1">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>

                </thead>
                <tbody>
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

                    
                    if ($allProducts[0] == true) {
                        foreach ($allProducts[1] as $value) {
                            $uuid = $value['UUID'];
                            $number = $iter;
                            $iter++;
                            $name = $value['productName'];
                            $stock = $value['stockQuantity'];
                            $price = $value['regularPrice'];
                            $Status = $value['status'];
                    ?>
                            <tr onclick="openProduct(<?php echo `'` . $uuid . `'` ?>)">
                                <th scope="row">
                                    <?php
                                    echo $number;
                                    ?>
                                </th>
                                <td>
                                    <?php
                                    echo $name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $stock;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $price;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($Status){
                                        echo "Active";
                                    }else{
                                        echo "Inactive";
                                    }
                                    
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>

                    <?php
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination">
        <ul>
            <li>&lt;&lt;</li>
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
            <li>&gt;&gt;</li>
        </ul>
    </div>
</section>