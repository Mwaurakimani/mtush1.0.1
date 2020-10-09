<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>P.O.S</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>

                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="addUser" onclick=" renderContent('pointOfSale') ">New Sale</button>
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updateUserAccount()">Update</button>
            <button type="button" class="btn btn-outline-danger" id="deleteUser" onclick="deleteUserAccount()">Delete</button>
        </div>
        <div class="more_options_pannel">
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
            <div class="deliverDetails">
                <div class="elem_body">
                    <h5>Customer Name</h5>
                    <div class="input_elem">
                        <input type="text" name="customer_name">
                    </div>
                </div>
                <div class="elem_body">
                    <h5>Customer Number</h5>
                    <div class="input_elem">
                        <input type="text" name="customer_number">
                    </div>
                </div>
                <div class="elem_body">
                    <h5>Location</h5>
                    <div class="input_elem">
                        <input type="text" name="order_location">
                    </div>
                </div>
            </div>
            <div class="sales_body">
                <div class="sales_table">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">SubTotal</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody id="add_item_list">
                        </tbody>
                    </table>
                </div>
                <div class="sale_details">
                    <div class="sale_summary_label">
                        <label for="">Quantity</label>
                        <p id="sales_total_quantity">0</p>
                    </div>
                    <div class="sale_summary_label">
                        <label for="">Amount</label>
                        <p id="sales_total_amount">0</p>
                    </div>
                    <div class="sale_summary_label">
                        <button type="button" class="btn btn-outline-success" onclick="addSaleItem()">Add Item</button>
                        <button type="button" class="btn btn-outline-success" onclick="confirmSale()">Confirm</button>
                        <button type="button" class="btn btn-outline-danger" onclick="cancelSale()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>