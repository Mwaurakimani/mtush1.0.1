<?php
set_include_path('control.php');

$mode = $_SESSION['mode'];
$update = false;

if (($mode == "update") && (isset($_SESSION['itemVariable']))) {
    $userDetails = new userAccount();

    $table = 'tbl_moderators';

    $fields = [
        '*'
    ];

    $type = "i";

    $reference = [
        array("UUID", $_SESSION['itemVariable']),
    ];
    $userDetails = $userDetails->readUserByReference($moderator, $table, $reference, $fields, $type);
    if ($userDetails[1] == true) {
        $user = $userDetails[1][0];
        $update = true;
    } else {
        echo "Error accessing user.Please contact Administrator to resolve Issue";
    }
}
?>

<div class="editUserAccountContainer" data-id="<?php if ($update) {
                                                    echo $user['UUID'];
                                                } else {
                                                    echo "";
                                                } ?>">
    <div class="section_edit" style="padding-bottom: 30px;">
        <h4>Vendor Details</h4>
        <div class="user_group_entry" style="display:flex;height: 160px;align-items:flex start;">
            <div class="input_field_elem">
                <p>Vendor Name</p>
                <input type="text" name="vendor_name" style="display: block;height:50px">
                <div class="vendor_logo_display">
                    <img src="favicon.ico" alt="img">
                </div>
            </div>
        </div>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>City 1</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Address 1</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
            </div>
        </div>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>City 2</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Address 2</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
            </div>
        </div>
    </div>
    <div class="section_edit">
        <h4>Contact Details</h4>
        <div class="user_group_entry">
            <div class="input_field_elem">
                <p>Postal Code</p>
                <input type="Email" name="email" value="<?php
                                                        if ($update) {
                                                            echo $user['moderatorEmail'];
                                                        }
                                                        ?>">
                <span>*</span>
            </div>
            <div class="input_field_elem">
                <p>Tel</p>
                <input type="password" name="password" value="<?php
                                                                if ($update) {
                                                                    echo "00000";
                                                                }
                                                                ?>">
            </div>
            <div class="input_field_elem">
                <p>Email</p>
                <input type="tel" name="phone1" value="<?php
                                                        if ($update) {
                                                            echo $user['phoneNumber1'];
                                                        }
                                                        ?>">
                <span>*</span>
            </div>
            <div class="input_field_elem">
                <p>URL</p>
                <input type="tel" name="phone2" value="<?php
                                                        if ($update) {
                                                            echo $user['phoneNumber2'];
                                                        }
                                                        ?>">
            </div>
        </div>
    </div>

    <div class="section_edit" style="padding-bottom: 30px;">
        <h4>Dealer Details</h4>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>Dealer 1 name</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Dealer 1 tel</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
            </div>
        </div>
        <div class="user_group_entry_1">
            <div class="input_field_elem">
                <p>Dealer 2 name</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
                <p>Dealer 2 tel</p>
                <input type="text" name="firstName" value="<?php
                                                            if ($update) {
                                                                echo $user['firstName'];
                                                            }
                                                            ?>">
                <span>*</span>
            </div>
        </div>
    </div>

    <div class="section_edit">
        <h4>Entry Details</h4>
        <div class="user_group_entry" style="height: 400px;">
            <div class="input_field_elem">
                <p>Date added</p>
                <input type="text" name="dataAdded" disabled value="<?php
                                                                    if ($update) {
                                                                        echo $user['regDate'];
                                                                    }
                                                                    ?>">
            </div>
            <div class="input_field_elem">
                <p style="align-self: flex-start;"> Last Modified</p>
                <input type="text" name="lastModified" disabled value="<?php
                                                                        if ($update) {
                                                                            echo $user['lastModified'];
                                                                        }
                                                                        ?>">
            </div>
            <div class="input_field_elem" style="height: 200px;width:100%;align-items:flex-start">
                <p>Last Modified</p>
                <textarea name="" id="" cols="30" rows="10"></textarea>
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