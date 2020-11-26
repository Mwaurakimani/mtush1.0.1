function verify_user() {
    var elem = $("#password_verification");
    var password = elem.val();

    if (isEmpty(password)) {
        alert("Password field cannot be empty");
    } else {
        var token = getToken();
        var action = "openUser";
        var handler = "control";
        var data = password;

        sendToUserAccountHandler(action, handler, data, callback, token, null)

        function callback(data) {
            var data = JSON.parse(data);

            if (data.status) {
                var elem1 = $(".content_view_display_panel");
                elem1.html(data.response);
            } else {
                alert(data.response);
            }
        }
    }
}

function updatePassword() {
    var token = getToken();
    var action = "update_password";
    var handler = "control";
    var data = "hi";

    sendToUserAccountHandler(action, handler, data, callback, token, null)

    function callback(msg) {
        var elem = $(".elemental_splashboard");

        elem.html(msg);
        openElemental();
    }
}

function confirmPasswordChange() {
    var token = getToken();
    var action = "confirm_change_password";
    var handler = "control";

    var current_password = $('input[name$="current_password"]').val();
    var New_password = $('input[name$="New_password"]').val();
    var Confirm_password = $('input[name$="Confirm_password"]').val();

    if (isEmpty(current_password) || isEmpty(New_password) || isEmpty(Confirm_password)) {
        alert("Some Fields Were Empty");
        return;
    } else {
        var data = {
            "current_password": current_password,
            "New_password": New_password,
            "Confirm_password": Confirm_password
        }

        data = JSON.stringify(data);

        sendToUserAccountHandler(action, handler, data, callback, token, null)

        function callback(msg) {
            console.log(msg);
        }
    }
}