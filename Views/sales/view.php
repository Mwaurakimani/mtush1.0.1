<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>Sales</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>
                    <li class="linker" onclick="renderContent('userAccount')">List</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="addUser" onclick=" renderContent('pointOfSale') ">New Sale</button>
            <button type="button" class="btn btn-outline-danger" id="deleteUser" onclick="deleteOrder()" style="visibility: visible;">Delete</button>
        </div>
        <div class="more_options_pannel">
            <div class="sys_input_element">
                <div class="input_element">
                    <input type="text">
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
                        <th scope="col">Customer</th>
                        <th scope="col">Number</th>
                        <th scope="col">Sale value</th>
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