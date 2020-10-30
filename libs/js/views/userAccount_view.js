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
            var elem1 = $(".content_view_display_panel");
            elem1.html(data);
        }
    }
}