function viewSale() {
    var elem = $(event.currentTarget);
    var tds = elem.find("td");
    var ref = $(tds[2]).text();

    var action = "openSale";
    var handler = "control";
    var token = getToken();

    sendToSalesHandler(action, handler, ref, callback, token);

    function callback(data) {
        $(".elemental_splashboard").html(data);
        openElemental();
    }
}

function checkSale() {
    event.stopPropagation();
    var elem = event.currentTarget;
    var refNumber = $(elem).parent();
    var tds = refNumber.find("td");
    var ref = $(tds[2]).text();
}

function checkAllSale() {
    event.stopPropagation();
    var objectElem = $(event.currentTarget);
    var checkBox = objectElem.find("input");
    var parent = $(event.currentTarget).parent().parent().parent().find('tbody');
    var elements = parent.find("input");

    if ((checkBox).prop("checked") == true) {
        elements.each(function(el) {
            $(this).prop("checked", true);
        })
    } else {
        elements.each(function(el) {
            $(this).prop("checked", false);
        })
    }
}

function deleteOrder() {
    var password
    password = prompt("Input Password");

    if (password === null) {
        console.log("prompt");
        return;
    }

    var deleting_array = [];
    var table = $(".splashboard_1").find("table");
    var elements = table.find("input");

    elements.each(function() {
        if (($(this)).prop("checked") == true) {
            var parent = $(this).parent().parent().parent().parent();
            var number = parent.find("td");
            var num = $(number[2]).text();

            deleting_array.push(num);
        }
    })

    if (deleting_array.length < 1 || deleting_array == undefined) {
        return;
    }

    var action = "deleteItem";
    var handler = "control";
    var token = getToken();

    sendToSalesHandler(action, handler, deleting_array, callback, token, password);

    function callback(data) {
        var response = JSON.parse(data);

        console.log(response);

        alert(response['response']);

        if (response['status'] == true) {
            var table1 = $(".splashboard_1").find("table");
            var elements1 = table1.find("input");

            elements1.each(function(index, value) {
                if (index == 0) {
                    $(this).prop("checked", false);
                    return;
                }
                if (($(this)).prop("checked") == true) {
                    var parent = $(this).parent().parent().parent().parent();
                    parent.fadeOut("slow");
                }
            })
        }

        return;
    }


}