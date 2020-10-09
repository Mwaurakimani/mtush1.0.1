<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>Transactions</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>

                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="addUser" onclick=" renderContent('pointOfSale') ">New Transaction</button>
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updateUserAccount()" style="visibility:visible">Update</button>
            <button type="button" class="btn btn-outline-danger" id="deleteUser" onclick="deleteUserAccount()" style="visibility:visible">Delete</button>
        </div>
        <div class=" more_options_pannel">
            <div class="sys_input_element">
                <div class="input_element">
                    <input type="text" style="margin-right: 5px;" onfocus="render_prod_search_in()" onblur="render_prod_search_out()" onkeyup="search_product_pos()">
                    <button type="button" class="btn btn-outline-danger" style="border-radius: 5px;">Search</button>
                </div>
            </div>
            <div class="search_product_pos">
                <div id="search_pos_container">

                </div>
            </div>
        </div>
    </div>

    <div class="content_view_display_panel">
        <div class="splashboard_1" style="padding-top:10px">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="height: 20px;">
                        <th style="width: 30px;height:10px" onclick="checkAllSale()">
                            <form style="height:10px">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="allCheckboxes" name="example2">
                                </div>
                            </form>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ref number</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $order = new order();

                    $table = 'tbl_orders';
                    $fields = [
                        '*'
                    ];
                    $type = 'i';

                    $thisOrder = $order->readAllOrders($moderator, $table, $fields);

                    if ($thisOrder[0] == true) {
                        $count = 1;
                        foreach ($thisOrder[1] as $key => $value) {
                            $refNumber = $value['UUID'];
                            $customer = $value['customerName'];
                            $number = $value['customerNumber'];
                            $saleValue = $value['Amount']
                    ?>
                            <tr onclick="viewSale()">
                                <td style="width: 30px;" onclick="checkSale()">
                                    <form>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="<?php echo "check-" . $refNumber ?>">
                                        </div>
                                    </form>
                                </td>
                                <td><?php echo $count ?></td>
                                <td><?php echo $refNumber ?></td>
                                <td><?php echo $customer ?></td>
                                <td><?php echo $number ?></td>
                                <td><?php echo $saleValue ?></td>
                            </tr>
                        <?php
                            $count++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No records available</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</section>