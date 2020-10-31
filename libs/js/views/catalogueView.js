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

function change_page() {
    var elem = $(".pagination");
    var current_page_elem = elem.find(".active_page");
    var current_page_number = current_page_elem.text();

    //total number of pages
    var all_pages_elem = elem.find("li");
    var counter = 0;

    $.each(all_pages_elem, function(key, val) {
        if ($(val).text() != "<<" && $(val).text() != ">>") {
            counter++;
        }
    });

    var total_page_count = counter;



    // change the page on click
    var clicked_elem = event.target;
    var page_number_clicked = $(clicked_elem).text();

    if (page_number_clicked != "<<" && page_number_clicked != ">>") {

        $.each(all_pages_elem, function(key, val) {
            $(val).removeClass("active_page");

            if (page_number_clicked == $(val).text()) {
                $(val).addClass("active_page");
            }
        });

    } else if (page_number_clicked == "<<") {
        var current_page_elem = elem.find(".active_page");
        var current_page_number = current_page_elem.text();

        $.each(all_pages_elem, function(key, val) {
            $(val).removeClass("active_page");

            if (parseInt($(val).text()) == (parseInt(current_page_number) - 1)) {
                $(val).addClass("active_page");
            }
        });
    } else if (page_number_clicked == ">>") {
        var current_page_elem = elem.find(".active_page");
        var current_page_number = current_page_elem.text();

        $.each(all_pages_elem, function(key, val) {
            $(val).removeClass("active_page");

            if (parseInt($(val).text()) == (parseInt(current_page_number) + 1)) {
                $(val).addClass("active_page");
            }
        });
    }

    var current_page_elem = elem.find(".active_page");
    var current_page_number = current_page_elem.text();
    // get next page
    var next_page = parseInt(current_page_number) + 1;
    var prev_page = parseInt(current_page_number) - 1;

    if (next_page > total_page_count) {
        $(".next_page_toggle").css("display", "none");
    } else {
        $(".next_page_toggle").css("display", "block");
    }

    //previous page
    if (prev_page < 1) {
        $(".previous_page_toggle").css("display", "none");
    } else {
        $(".previous_page_toggle").css("display", "block");
    }

    var offset = 10 * (parseInt(current_page_number) - 1)

    var action = "list_products";
    var handler = "control";
    var token = getToken();
    var data = JSON.stringify({
        "offset": offset
    });

    sendToCatalogueHandler(action, handler, data, callback, token, null);



    function callback(msg) {
        var data = JSON.parse(msg);
        var status = data[0];

        if (status != true) {
            alert("No products found");
        } else {
            $(".table tbody").html("");

            var full_string = "";
            var counter = 1;

            $.each(data[1], function(key, val) {

                console.log(val);

                var uuid = val.UUID;
                var productName = val.productName;
                var stockQuantity = val.stockQuantity;
                var regularPrice = val.regularPrice;
                var status = val.status;

                var paste_string = `
                <tr onclick="openProduct(` + uuid + `) class="clickable">
                    <td>` + counter + `</td>
                    <td>` + productName + `</td>
                    <td>` + stockQuantity + `</td>
                    <td>` + regularPrice + `</td>
                    <td>` + status + `</td>
                </tr>
                `
                full_string = full_string + paste_string;
                counter++
            });

            $(".table tbody").html(full_string);
        }
    }

}