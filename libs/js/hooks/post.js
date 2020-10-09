function sendToHandler(action, handler, data, callback, id) {
    $.post("app/php/control/" + handler + ".php", {
            action: action,
            data: data,
            id: id
        })
        .done(function(data) {
            if (callback != undefined) {
                callback(data);
            }
        });
}

function sendToUserAccountHandler(action, handler, data, callback, token, user) {
    $.post("Views/userAccount/" + handler + ".php", {
            action: action,
            data: data,
            token: token,
            user: user
        })
        .done(function(data) {
            if (callback != undefined) {
                callback(data);
            }
        });
}

function sendToUserPOShandler(action, handler, data, callback, token) {
    $.post("Views/pointOfSale/" + handler + ".php", {
            action: action,
            data: data,
            token: token,
        })
        .done(function(data) {
            if (callback != undefined) {
                callback(data);
            }
        });
}

function sendToCatalogueHandler(action, handler, data, callback, token, id = null) {
    $.post("Views/catalogue/" + handler + ".php", {
            action: action,
            data: data,
            token: token,
            id: id
        })
        .done(function(data) {
            if (callback != undefined) {
                callback(data);
            }
        });
}

function sendToSalesHandler(action, handler, data, callback, token, validator = null) {
    $.post("Views/sales/" + handler + ".php", {
            action: action,
            data: data,
            token: token,
            validator: validator
        })
        .done(function(data) {
            if (callback != undefined) {
                callback(data);
            }
        });
}