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
                    <select name="sort" id="" placeholder="Sort" onchange="sort_setter()" onload="sort_setter(false)">
                        <option value="sort">Sort</option>
                        <option selected value="unSort">Un-sort</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="catalogue_sort_options">
        <div class="input_element_holder">
           <p>Country</p>
           <select name="" id="" onchange="filter_countries()">
               <option value="N/A">N/A</option>
               <option value="Germany">Germany</option>
               <option value="Italy">Italy</option>
               <option value="China">China</option>
               <option value="Canada">Canada</option>
               <option value="UK">UK</option>
           </select>
        </div>
    </div>

    <div class="content_view_display_panel">
        <div class="splashboard_1">
            <?php
            $moderator = new AdminUser();
            $caller = new products();
            $variables = array(
                "conn"=>$moderator,
                "offset"=>0,
            );

            $products = $caller->list_products($variables);
            $array_of_products = $products[1];

            // var_dump($products);
            ?>
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
                    $tally = 1;
                        foreach((array)$array_of_products as $value){
                            // var_dump($value);
                            
                            $uuid = $value['UUID'];
                            $Name = $value['productName'];
                            $Stock = $value['stockQuantity'];
                            $Price = $value['regularPrice'];
                            $Status = $value['status'];
                        
                    ?>
                    <tr onclick="openProduct(<?php echo `'` . $uuid . `'` ?>)" class="clickable">
                        <td><?php echo $tally ?></td>
                        <td><?php echo $Name ?></td>
                        <td><?php echo $Stock ?></td>
                        <td><?php echo $Price ?></td>
                        <td><?php if($Status == 1){
                            echo "active";
                        }else{
                            echo "Inactive";
                        }
                         ?></td>
                    </tr>
                    <?php
                        $tally++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination">
        <ul>
            <?php
                $products = $caller->product_counter($moderator);
                $total = $products['COUNT(*)'];
                $total_page_couunt = (intdiv($total,25)) + 1;
            ?>
            <li class="previous_page_toggle" onclick="change_page()" style="display: none;">&lt;&lt;</li>
            <?php

            for($iter = 1;$iter <= $total_page_couunt; $iter++){
            ?>
            <li onclick="change_page()" <?php if($iter == "1"){ echo 'class="active_page"';} ?> ><?php echo $iter ?></li>
            <?php
            }
            ?>
            <!-- <li class="active_page">1</li> -->
            <li class="next_page_toggle" onclick="change_page()" >&gt;&gt;</li>
        </ul>
    </div>
</section>

