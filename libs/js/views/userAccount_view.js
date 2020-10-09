function verify_user() {
    var elem = $("#password_verification");
    var password = elem.val();

    if (isEmpty(password)) {
        alert("Password field cannot be empty");
    } else {
        var token = getToken();
        var action = "updateCurrentUser";
        var handler = "control";
        var data = password;

        sendToUserAccountHandler(action, handler, data, callback, token, null)

        function callback(data) {
            console.log(data);
        }
    }
}