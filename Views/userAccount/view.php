<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>User Account</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>
                    
                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updateUserAccount()">Update</button>
        </div>
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updatePassword()">change Password</button>
        </div>
    </div>

    <div class="content_view_display_panel">
        <div class="user_change_password_pannel">
            <div class="password_change_holder">
                <h3>User Verification</h3>
                <p>Please input your Password</p>
                <div class="password_entry_region">
                    <input id="password_verification" type="password">
                </div>
                <button onclick="verify_user()">Confirm</button>
            </div>
        </div>
    </div>
</section>