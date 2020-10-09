function renderContent(view, callbackAction) {
    if (!isEmpty(view)) {
        var token = getToken();

        var action = "routing";
        var data = [view, token];
        var handler = "router";

        sendToHandler(action, handler, data, callBack, token);

        function callBack(response) {
            var parent = $('.main_panel');
            parent.html(response);

            if (callbackAction) {
                callbackAction();
            }
        }
    } else {
        console.log("none");
    }
}

function toggleDropdown(action) {
    var elem = $('.account_dropdown_pannel');

    if (action == 'open') {
        elem.fadeIn();
        console.log("done");
    } else {
        elem.fadeOut();
        console.log("closing");
    }
    event.stopPropagation();
}

function actionLogOut() {
    var token = getToken();
    sendToHandler("logOut", "session", null, callBack, token);

    function callBack(data) {
        window.location.href = "/";
    }
}

function closeElemental() {
    $(".elemental").fadeOut();
}

function openElemental() {
    $(".elemental").css("display", "flex")
        .hide()
        .fadeIn();
}