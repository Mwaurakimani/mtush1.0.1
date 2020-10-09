<?php
require_once 'app/php/Modal.php';
session_start();

if (!isset($_SESSION['LOGGED_USER'])) {
    header("location:" . ROOT);
}

// TODO:edit the token generator
$_SESSION['TOKEN'] = 1234;
?>
<html lang="en">
<!-- config -->
<meta charset="UTF-8">
<meta http-equiv="refresh" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<title>Home</title>
<!-- end config -->

<!-- libs -->

<!-- bootstrap -->
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- end libs -->

<!-- site libs -->
<script data-main="libs/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
<link rel="stylesheet" href="libs/css/main.css">
<!-- end site libs -->

<!-- other libs -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
<!-- end of other libs  -->
</head>

<body data-token="<?php echo $_SESSION['TOKEN'] ?>">
    <div class="elemental">
        <div class="elemental_splashboard">
            
        </div>
        <button onclick="closeElemental()">Close</button>
    </div>
    <nav>
        <div class="nav_logo">
            <img src="logo.png" alt="">
        </div>
        <div class="home_search_bar">
            <form action="">
                <div class="input_element">
                    <input type="search">
                    <div class="input_suggestion">
                        <!-- input suggestion area on its own -->
                    </div>
                </div>
            </form>
        </div>
        <div class="account_pannel" onclick="toggleDropdown('open')">
            <div class="account_image">
                <img src="<?php echo IMAGES . "/icons/user.png" ?>" alt="">
            </div>
            <div class="account_dropdown_pannel">
                <div class="welcome_note">
                    <p>Welcome back Peter</p>
                </div>
                <div class="user_option_panel">
                    <div class="option_element">
                        <div class="dropdown_elem">

                        </div>
                        <div class="btn_group">
                            <button type="button" class="btn btn-danger" onclick="actionLogOut()">Log out</button>
                            <button type="button" class="btn btn-danger">Danger</button>
                            <button type="button" class="btn btn-danger">Danger</button>
                            <button type="button" class="btn btn-danger" onclick="toggleDropdown('close')">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="system_body">
        <section class="side_panel">
            <div class="sidePanelPin">

            </div>
            <div class="btn_group">
                <h6>Home</h6>
                <div class="nav_btn" onclick="renderContent('dashboard')">
                    <img src="<?php echo IMAGES . "/icons/dashboard.png" ?>" alt="">
                    <p>Dashboard</p>
                </div>
            </div>
            <div class="btn_group">
                <h6>Store</h6>
                <div class="nav_btn" onclick="renderContent('pointOfSale')">
                    <img src="<?php echo IMAGES . "/icons/pos.png" ?>" alt="">
                    <p>P.O.S</p>
                </div>
                <div class="nav_btn" onclick="renderContent('catalogue')">
                    <img src="<?php echo IMAGES . "/icons/catalogue.png" ?>" alt="">
                    <p>Catalogue</p>
                </div>
                <div class="nav_btn" onclick="renderContent('customers')">
                    <img src="<?php echo IMAGES . "/icons/customers.png" ?>" alt="">
                    <p>Customers</p>
                </div>
                <div class="nav_btn" onclick="renderContent('sales')">
                    <img src="<?php echo IMAGES . "/icons/orders.png" ?>" alt="">
                    <p>Sales</p>
                </div>
                <div class="nav_btn" onclick="renderContent('transactions')">
                    <img src="<?php echo IMAGES . "/icons/transaction.png" ?>" alt="">
                    <p>Transactions</p>
                </div>
            </div>
            <div class="btn_group">
                <h6>Management</h6>
                <div class="nav_btn" onclick="renderContent('vendors')">
                    <img src="<?php echo IMAGES . "/icons/vendor.png" ?>" alt="">
                    <p>Vendors</p>
                </div>
                <div class="nav_btn" onclick="renderContent('accounts')">
                    <img src="<?php echo IMAGES . "/icons/accounts.png" ?>" alt="">
                    <p>Accounts</p>
                </div>
                <div class="nav_btn" onclick="renderContent('notifications')">
                    <img src="<?php echo IMAGES . "/icons/notifications.png" ?>" alt="">
                    <p>Notifications</p>
                </div>
                <div class="nav_btn" onclick="renderContent('reports')">
                    <img src="<?php echo IMAGES . "/icons/report.png" ?>" alt="">
                    <p>Reports</p>
                </div>
                <div class="nav_btn" onclick="renderContent('inference')">
                    <img src="<?php echo IMAGES . "/icons/inference.png" ?>" alt="">
                    <p>Inference</p>
                </div>
            </div>
            <div class="btn_group">
                <h6>Admin</h6>
                <div class="nav_btn" onclick="renderContent('userAccount')">
                    <img src="<?php echo IMAGES . "/icons/user.png" ?>" alt="">
                    <p>User</p>
                </div>
                <div class="nav_btn" onclick="renderContent('moderators')">
                    <img src="<?php echo IMAGES . "/icons/manager.png" ?>" alt="">
                    <p>Moderators</p>
                </div>
                <div class="nav_btn" onclick="renderContent('locations')">
                    <img src="<?php echo IMAGES . "/icons/locations.png" ?>" alt="">
                    <p>Locations</p>

                </div>
            </div>
        </section>
        <section class="main_panel">

        </section>
    </section>
    <script>
        var entered = true;
    </script>
</body>

</html>