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
  $userDetails = $userDetails->readUserByReference($moderator,$table, $reference ,$fields ,$type);
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
  <div class="section_edit">
    <h4>User Details</h4>
    <div class="user_group_entry">
      <div class="input_field_elem">
        <p>First Name</p>
        <input type="text" name="firstName" value="<?php
                                                    if ($update) {
                                                      echo $user['firstName'];
                                                    }
                                                    ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Last Name</p>
        <input type="text" name="lastName" value="<?php
                                                  if ($update) {
                                                    echo $user['lastName'];
                                                  }
                                                  ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Other Name</p>
        <input type="text" name="otherName" value="<?php
                                                    if ($update) {
                                                      echo $user['otherName'];
                                                    }
                                                    ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>User Name</p>
        <input type="text" name="userName" value="<?php
                                                  if ($update) {
                                                    echo $user['username'];
                                                  }
                                                  ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>ID Number</p>
        <input type="text" name="IDNumber" value="<?php
                                                  if ($update) {
                                                    echo $user['nationalID'];
                                                  }
                                                  ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Date of Birth</p>
        <input type="date" name="dateOfBirth" value="<?php
                                                      if ($update) {
                                                        echo $user['dateOfBirth'];
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
        <p>Email</p>
        <input type="Email" name="email" value="<?php
                                                if ($update) {
                                                  echo $user['moderatorEmail'];
                                                }
                                                ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Password</p>
        <input type="password" name="password" value="<?php
                                                      if ($update) {
                                                        echo "00000";
                                                      }
                                                      ?>">
      </div>
      <div class="input_field_elem">
        <p>Phone 1</p>
        <input type="tel" name="phone1" value="<?php
                                                if ($update) {
                                                  echo $user['phoneNumber1'];
                                                }
                                                ?>">
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Phone 2</p>
        <input type="tel" name="phone2" value="<?php
                                                if ($update) {
                                                  echo $user['phoneNumber2'];
                                                }
                                                ?>">
      </div>
      <div class="input_field_elem">
        <p>Address</p>
        <input type="text" name="address" value="<?php
                                                  if ($update) {
                                                    echo $user['Address'];
                                                  }
                                                  ?>">
        <span>*</span>
      </div>
    </div>
  </div>
  <div class="section_edit">
    <h4>Account Details</h4>
    <div class="user_group_entry">
      <div class="input_field_elem">
        <p>Account type</p>
        <select name="accountType">
          <option value="Moderator" <?php
                                    if ($update) {
                                      if ($user['Role'] == 'Moderator') {
                                        echo "selected";
                                      }
                                    }
                                    ?>>Moderator</option>
          <option value="Admin" <?php
                                if ($update) {
                                  if ($user['Role'] == 'Admin') {
                                    echo "selected";
                                  }
                                }
                                ?>>Admin</option>
        </select>
        <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Account Status</p>
        <select name="accountStatus">
          <option value="Active" <?php
                                  if ($update) {
                                    if ($user['accountStatus'] == 'Active') {
                                      echo "selected";
                                    }
                                  }
                                  ?>>Active</option>
          <option value="Suspended" <?php
                                    if ($update) {
                                      if ($user['accountStatus'] == 'Suspended') {
                                        echo "selected";
                                      }
                                    }
                                    ?>>Suspended</option> </select> <span>*</span>
      </div>
      <div class="input_field_elem">
        <p>Date added</p>
        <input type="text" name="dataAdded" disabled value="<?php
                                                            if ($update) {
                                                              echo $user['regDate'];
                                                            }
                                                            ?>">
      </div>
      <div class="input_field_elem">
        <p>Last Modified</p>
        <input type="text" name="lastModified" disabled value="<?php
                                                                if ($update) {
                                                                  echo $user['lastModified'];
                                                                }
                                                                ?>">
      </div>
    </div>
  </div>
  <div class="section_edit">
    <h4>Personal Details</h4>
    <div class="user_group_entry">
      <div class="input_field_elem">
        <p>Next of Kin</p>
        <input type="text" name="nextOfKinFirstName" placeholder="First name" value="<?php
                                                                                      if ($update) {
                                                                                        echo $user['nextOfKinFirstName'];
                                                                                      }
                                                                                      ?>">
        <input type="text" name="nextOfKinLastName" placeholder="Last name" style="margin-left:10px" value="<?php
                                                                                                            if ($update) {
                                                                                                              echo $user['nextOfKinLastName'];
                                                                                                            }
                                                                                                            ?>">
      </div>
      <div class="input_field_elem">
        <p> </p>
        <input type="text" name="relation" placeholder="Relation" value="<?php
                                                                          if ($update) {
                                                                            echo $user['nextOfKinRelation'];
                                                                          }
                                                                          ?>">
        <input type="text" name="nextOfKinPhoneNumber" placeholder="Phone Number" style="margin-left:10px" value="<?php
                                                                                                                  if ($update) {
                                                                                                                    echo $user['nextOfKinNumber'];
                                                                                                                  }
                                                                                                                  ?>">
      </div>
      <div class="input_field_elem">
        <p>Address</p>
        <input type="text" name="nextOfKinAddress" value="<?php
                                                          if ($update) {
                                                            echo $user['nextOfKinAddress'];
                                                          }
                                                          ?>">
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