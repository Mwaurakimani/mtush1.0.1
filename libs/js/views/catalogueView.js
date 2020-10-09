//open Edit user
function openCatalogue(id) {
    if (id) {
        // open in edit mode
        var token = getToken();
        var action = "open";
        var view = 'userAccountInput';
        var variables = ['userAccount', 'update'];
        var data = [view, token, variables];
        var handler = "router";

        sendToHandler(action, handler, data, callBack, id);

        function callBack(response) {
            var parent = $('.splashboard_1');
            parent.html(response);
            // alert("All stared fields are Required");
        }

    } else {
        // open in add mode
        var token = getToken();
        var action = "open";
        var view = 'catalogueInput';
        var variables = ['catalogue', 'add'];
        var data = [view, token, variables];
        var handler = "router";

        sendToHandler(action, handler, data, callBack, token, id = null);

        function callBack(response) {
            var parent = $('.splashboard_1');
            parent.html(response);
            // alert("All stared fields are Required");
        }
    }
}

function collector() {
    var data = {
        productName: $('input[name$="productName"]').val(),
        supplier: $('input[name$="supplier"]').val(),
        stock: $('input[name$="stock"]').val(),
        lowStock: $('input[name$="lowStock"]').val(),
        purchasePrice: $('input[name$="purchasePrice"]').val(),
        retailPrice: $('input[name$="retailPrice"]').val(),
        status: $('input[name$="status"]').val(),
        visibility: true,
        enableEdit: true,
        Notes: $('textarea[name$="Notes"]').val(),
    };

    $.each(data, function(key, val) {
        if ((val == "" || val == 'undefined')) {
            if (key == "status" || key == "Notes") {
                return;
            }
            console.log(key);
            data = false;
        }
    });

    return data;
}

function updateCatalogue() {
    var data = collector();

    if (data != false) {
        var elem = $(".editUserAccountContainer");

        var user = elem.attr('data-id');

        if (user) {
            var id = user;
            var action = "update";
            var handler = "control";
            var token = getToken();

            sendToCatalogueHandler(action, handler, data, callback, token, id);

            function callback(resp) {
                var res = JSON.parse(resp);
                var response = res['response'];
                if ((res['status'] == true)) {
                    alert(response);

                } else {
                    console.log(res);
                }
            }
        } else {
            var action = "addProduct";
            var handler = "control";
            var token = getToken();

            sendToCatalogueHandler(action, handler, data, callback, token, null);

            function callback(resp) {
                var res = JSON.parse(resp);
                var response = res['response'];
                if ((res['status'] == true)) {
                    alert(response);

                    var data = res['product'][1][0];

                    updateFields(data);


                } else {
                    console.log(res);
                }
            }
        }

    } else {
        alert("Error Uploading data 1");
    }
}

function searchVendor() {
    var elem = $(event.currentTarget);
}

function openProduct(id) {
    if (id) {
        // open in edit mode
        var token = getToken();
        var action = "open";
        var view = 'catalogueInput';
        var variables = ['catalogue', 'update'];
        var data = [view, token, variables];
        var handler = "router";

        sendToHandler(action, handler, data, callBack, id);

        function callBack(response) {
            var parent = $('.splashboard_1');
            parent.html(response);
            alert("All stared fields are Required");
        }

    } else {
        // open in add mode
        var token = getToken();
        var action = "open";
        var view = 'userAccountInput';
        var variables = ['userAccount', 'add'];
        var data = [view, token, variables];
        var handler = "router";

        sendToHandler(action, handler, data, callBack, token, id = null);

        function callBack(response) {
            var parent = $('.splashboard_1');
            parent.html(response);
            alert("All stared fields are Required");
        }
    }
}

function deleteProduct() {
    var elem = $(".editUserAccountContainer");

    var user = elem.attr('data-id');

    if (user) {
        console.log(user);

        var action = "Delete";
        var handler = "control";
        var token = getToken();

        sendToCatalogueHandler(action, handler, user, callback, token, null);

        function callback(resp) {
            var res = JSON.parse(resp);
            var response = res['response'];
            if ((res['status'] == true)) {
                alert(response);
                renderContent('catalogue');
            } else {
                console.log(res);
            }
        }
    }
}

function searchProductCatalog() {
    alert("Hellow world");
}