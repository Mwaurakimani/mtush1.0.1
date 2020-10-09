<?php
set_include_path('control.php');

$mode = $_SESSION['mode'];
$update = false;

if (($mode == "update") && (isset($_SESSION['itemVariable']))) {
    $Products = new products();

    $table = 'tbl_products';

    $fields = [
        '*'
    ];

    $type = "i";

    $reference = [
        array("UUID", $_SESSION['itemVariable']),
    ];
    
    $product = $Products->readProductsByReference($moderator, $table, $reference, $fields, $type);

    if ($product[1] == true) {
        $update = true;
        $item = $product[1][0];
    } else {
        echo "Error accessing user.Please contact Administrator to resolve Issue";
    }
}
?>

<div class="editUserAccountContainer" data-id="<?php if ($update) {
                                                    echo $item['UUID'];
                                                } else {
                                                    echo "";
                                                } ?>">
    <div class="section_edit" style="padding-bottom: 30px;overflow:visible;">
        <h4>Products Details</h4>
        <div class="user_group_entry" style="display:flex;height: 160px;align-items:flex start;">
            <div class="input_field_elem">
                <p>Product Name</p>
                <input type="text" name="productName" style="display: block;height:50px" value="<?php
                                                                                                if ($update) {
                                                                                                    echo $item['productName'];
                                                                                                }
                                                                                                ?>">
                <div class="vendor_logo_display">
                    <img src="favicon.ico" alt="img">
                </div>
            </div>
        </div>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>Supplier</p>
                <input type="text" name="supplier" value="<?php
                                                            if ($update) {
                                                                echo $item['supplier'];
                                                            }
                                                            ?>" onkeyup="searchVendor()">
                <span>*</span>
                <div class="supplierDropBox">

                </div>

            </div>
        </div>
    </div>
    <div class="section_edit">
        <h4>Stock Control</h4>
        <div class="user_group_entry">
            <div class="user_group_entry_1">
                <div class="input_field_elem">
                    <p>Stock Quantity</p>
                    <input type="Number" name="stock" value="<?php
                                                                if ($update) {
                                                                    echo $item['stockQuantity'];
                                                                }
                                                                ?>">
                    <span>*</span>

                </div>
                <div class="input_field_elem">
                    <p>Low threshold Quantity</p>
                    <input type="Number" name="lowStock" value="<?php
                                                                if ($update) {
                                                                    echo $item['lowStockThreshold'];
                                                                }
                                                                ?>">
                    <span>*</span>

                </div>
            </div>
            <div class="user_group_entry_1">
                <div class="input_field_elem">
                    <p>Purchase Price</p>
                    <input type="Number" name="purchasePrice" value="<?php
                                                                        if ($update) {
                                                                            echo $item['purchasePrice'];
                                                                        }
                                                                        ?>">
                    <span>*</span>

                </div>
                <div class="input_field_elem">
                    <p>Regular Price</p>
                    <input type="Number" name="retailPrice" value="<?php
                                                                    if ($update) {
                                                                        echo $item['regularPrice'];
                                                                    }
                                                                    ?>">
                    <span>*</span>

                </div>
            </div>
        </div>
    </div>

    <div class="section_edit" style="padding-bottom: 30px;">
        <h4>Product Management</h4>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>Added by</p>
                <input type="text" name="addedBy" value="<?php
                                                            if ($update) {
                                                                echo $item['addedBy'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Date Created</p>
                <input type="text" name="dateAdded" value="<?php
                                                            if ($update) {
                                                                echo $item['dateAdded'];
                                                            }
                                                            ?>" disabled>
                <span>*</span>
            </div>
        </div>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>Modified by</p>
                <input type="text" name="modifiedBy" value="<?php
                                                            if ($update) {
                                                                echo $item['modifiedBy'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Date Modified</p>
                <input type="text" name="dateModified" value="<?php
                                                                if ($update) {
                                                                    echo $item['dateModified'];
                                                                }
                                                                ?>" disabled>
                <span>*</span>
            </div>
        </div>
    </div>

    <div class="section_edit">
        <h4>Modification</h4>
        <div class="user_group_entry" style="height: 400px;">
            <div class="input_field_elem">
                <p>Status</p>
                <input type="text" name="status"  value="<?php
                                                                    if ($update) {
                                                                        echo $item['status'];
                                                                    }
                                                                    ?>">
            </div>
            <div class="input_field_elem">
                <p style="align-self: flex-start;">Visibility</p>
                <input type="text" name="Visibility" disabled value="<?php
                                                                        if ($update) {
                                                                            echo $item['visibility'];
                                                                        }
                                                                        ?>">

            </div>
            <div class="input_field_elem">
                <p style="align-self: flex-start;">Enable Edit</p>
                <input type="text" name="EnableEdit" disabled value="<?php
                                                                        if ($update) {
                                                                            echo $item['enableEdit'];
                                                                        }
                                                                        ?>">

            </div>
            <div class="input_field_elem" style="height: 200px;width:100%;align-items:flex-start">
                <p>Notes</p>
                <textarea name="Notes" id="" cols="30" rows="10"><?php
                                                                    if ($update) {
                                                                        echo $item['Notes'];
                                                                    }
                                                                    ?></textarea>
            </div>
        </div>
    </div>
</div>
<style>
    .pagination {
        display: none;
    }

    #updateUser {
        visibility: visible;
    }

    #deleteUser {
        visibility: visible;
    }
</style>