<!DOCTYPE html>
<html lang="en">

<head>
    <!-- config -->
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Document</title>
    <!-- end config -->

    <!-- libs -->

    <!-- bootstrap -->
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- end libs -->

    <!-- site libs -->
    <script data-main="libs/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>

    <link rel="stylesheet" href="libs/css/main.css">
    <!-- end site libs -->
</head>

<body onkeypress="submitLoginForm()">
<!-- testing update -->
    <div class="login_view">
        <div class="login_section">
            <div class="image_show">
                <img src="Logo.png" alt="img">
            </div>
            <div class="login_form">
                <form action="app/php/control/signin.php" method="POST">
                    <h3>Sign in</h3>
                    <div class="input_element">
                        <button class="btn_icon btn_user" onclick="preventDefault()"></button>
                        <input onfocus="focusInputElement()" onfocusout="focusOutInputElement()" type="text" name="username" required placeholder="Username">
                        <div class="display_input_error">User name is invalid</div>
                        <div class="input_suggestion">

                        </div>
                    </div>
                    <div class="input_element ">
                        <button class="btn_icon btn_email" onclick="preventDefault()"></button>
                        <input onfocus="focusInputElement()" onfocusout="focusOutInputElement()" type="email" name="email" required placeholder="Email">
                        <div class="display_input_error">User name is invalid</div>
                    </div>
                    <div class="input_element ">
                        <button class="btn_icon btn_password" onclick="preventDefault()"></button>
                        <input onfocus="focusInputElement()" onfocusout="focusOutInputElement()" type="password" name="password" class="input_double_btn" data-view="false" required placeholder="Password">
                        <button class="btn_icon btn_view" onclick="toggleViewPassowrd()"></button>
                        <div class="display_input_error">User name is invalid</div>
                    </div>
                    <div class="button_holder">
                        <button class="btn btn-danger" name="Submit">Sign In</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                    <div style="height:30px"></div>
                    <div class="action_redirect">
                        <a href="" style="color:red">Forgot password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var entered = null;
    </script>
</body>

</html>