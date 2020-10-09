<?php
set_include_path('control.php');
?>
<section class="Content">
    <div class="content_view_header">
        <h4>Vendors</h4>
        <ul class="bread_crumbs">
            <li>
                <ul>
                    <li class="linker" onclick="renderContent('vendors')">List</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content_view_options">
        <div class="action_buttons">
            <button type="button" class="btn btn-outline-danger" id="addUser" onclick="openVendor()">Add Vendor</button>
            <button type="button" class="btn btn-outline-danger" id="updateUser" onclick="updateUserAccount()">Update</button>
            <button type="button" class="btn btn-outline-danger" id="deleteUser" onclick="deleteUserAccount()">Delete</button>
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
        <div class="splashboard_1">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $allUsers = null;
                    $userAccount = new userAccount();
                    $iter = 1;

                    $table = 'tbl_moderators';

                    $fields = [
                        '*'
                    ];

                    $allUsers = $userAccount->readAllUsers($moderator, $table, $fields);

                    if ($allUsers[0] == true) {
                        foreach ($allUsers[1] as $value) {
                            $uuid = $value['UUID'];
                            $name = $value['firstName'] . " " . $value['otherName'] . " " . $value['lastName'];
                            $email = $value['moderatorEmail'];
                            $phone = $value['phoneNumber1'];
                            $role = $value['Role'];
                    ?>
                            <tr onclick="openUserAccount(<?php echo `'` . $uuid . `'` ?>)">
                                <th scope="row">
                                    <?php
                                    echo $iter;
                                    ?>
                                </th>
                                <td>
                                    <?php
                                    echo $name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $email;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $phone;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $role;
                                    $iter++;
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        No data available
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