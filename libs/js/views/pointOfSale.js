function addSaleItem() {
    var elem = $("#add_item_list");
    var tally = $("#sale_product_number").text();
    tally++;

    elem.append(`
        <tr>
            <td>
                <input type="text" onchange="enterProduct()" onkeyup="listProducts()" onfocus="displayLister()" onfocusout="hideLister()" class="sale_input_item">
                <div class="listProductSelect">
                <ul>
                    <li>No items Found</li>
                </ul>
                </div>
            </td>
            <td>
                <input type="number" onkeyup="enterProduct()" onchange="enterProduct()" class="sale_input_quantity" value="0" min="0">
            </td>
            <td>
                <input type="number" onkeyup="enterProduct()" onchange="enterProduct()" class="sale_input_price" value="0" min="0">
            </td>
            <td class="sale_item_subTotal">0</td>
            <td class="sale_item_remover_holder" onclick="removeSaleItem()">
                <p class="remove_item">x</p>
            </td>
        </tr>
    `);

    //update product count
    getProductCount();
    evaluateSale();
}

function removeSaleItem() {

    var elem = $(event.currentTarget);
    var parent = elem.parent();

    parent.remove();

    //update product count
    getProductCount();
    evaluateSale();
}

function enterProduct() {
    var parent = $(event.currentTarget).parent().parent();

    var item = parent.find(".sale_input_item").val();
    var Quantity = parent.find(".sale_input_quantity").val();
    var price = parent.find(".sale_input_price").val();

    if (isEmpty(Quantity) || isEmpty(price)) {
        // if (isEmpty(item) || isEmpty(Quantity) || isEmpty(price)) {
        return;
    } else {
        var calculated = Quantity * price;
        parent.find('.sale_item_subTotal').text(calculated);
    }
    evaluateSale();
}

function getProductCount() {
    //gets the cout of rows in the sales section
    var elem = $(".sales_tbl_element table #add_item_list");

    $("#sale_product_number").text(elem.children().length);

    return $("#sale_product_number").text();
}

function evaluateSale() {
    var mylist = $(".sales_table .table tbody");
    var sale = {
        Quantity: 0,
        Amount: 0
    };

    var children = mylist.children();

    $.each(children, function(itemIndex, itemValue) {
        var Quantity = $(itemValue).find('.sale_input_quantity').val();
        var Amount = $(itemValue).find('.sale_item_subTotal').text();
        // TODO: Convert from .val() to .text()

        sale.Quantity = sale.Quantity + parseInt(Quantity);

        sale.Amount = sale.Amount + parseInt(Amount);
    });

    $("#sales_total_quantity").text(sale.Quantity);

    $("#sales_total_amount").text(sale.Amount);
}

function listProducts() {
    var elem = $(event.currentTarget);
    var token = getToken();

    var productName = elem.val();

    if (isEmpty(productName)) {
        var listingelem = $(".listProductSelect ul");
        listingelem.html("<li onclick =`pickItem()`>No items Found<li>")
        return;
    }

    sendToUserPOShandler("searchProduct", "control", productName, callback, token);

    function callback(msg) {
        msg = JSON.parse(msg);
        var status = msg[0];
        var listingelem = $(".listProductSelect ul");
        listingelem.html(" ")

        if (status != true) {
            var listingelem = $(".listProductSelect ul");
            listingelem.html("<li onclick =`pickItem()`>No items Found<li>")
        } else {
            var listingelem = $(".listProductSelect ul");
            listingelem.html(" ")
            msg[1].forEach(function(item, index) {
                listingelem.append(
                    "<li onclick =pickItem() data-limit='" + item.stockQuantity + "' data-id='" + item.UUID + "' data-price= '" + item.regularPrice + "'>" + item.productName + "</li>"
                );
            });
        }
    }
}

function pickItem() {
    console.log("picking item");
    var item = $(event.currentTarget).text();
    var price = $(event.currentTarget).data("price");
    var id = $(event.currentTarget).data("id");
    var max = $(event.currentTarget).data("limit");
    var parent = $(event.currentTarget).parent().parent().parent().parent();
    parent.find(".sale_input_quantity").attr("max", max);
    parent.find(".sale_input_item").val(item);
    parent.find(".sale_input_price").val(price);
    parent.find(".sale_input_quantity").val(1);
    parent.find(".sale_item_subTotal").text(price * 1);

    var lister = $(".listProductSelect");

    parent.attr("data-id", id);

    lister.css({
        "display": "none"
    });


    evaluateSale();

}

///sales
function displayLister() {
    console.log("clcicked");
    var clicked = $(event.currentTarget).parent().parent();

    var lister = clicked.find(".listProductSelect");

    lister.css({
        "display": "block"
    });
}

function hideLister() {
    var clicked = $(event.currentTarget).parent().parent();
    var state = clicked.find('.listProductSelect ul li:first-child').text();

    if (state === "No items Found") {
        var lister = clicked.find(".listProductSelect");

        lister.css({
            "display": "none"
        });
    }
}

function confirmSale() {
    //get all the data in the fields
    var token = getToken();
    var customer_name = $('input[name$="customer_name"]').val();
    var customer_number = $('input[name$="customer_number"]').val();
    var customer_location = $('input[name$="order_location"]').val();
    var mylist = $(".sales_table .table tbody");
    var order = [];
    var orderDetails = {
        customer_name: customer_name,
        customer_number: customer_number,
        customer_location: customer_location,
        Quantity: $('#sales_total_quantity').text(),
        Amount: $('#sales_total_amount').text()
    };

    var children = mylist.children();
    if (children.length <= 0) {
        alert("No items included");
        return;
    }

    $.each(children, function(itemIndex, itemValue) {
        var id = $(itemValue).data("id");
        var item = $(itemValue).find('.sale_input_item').val();
        var Quantity = $(itemValue).find('.sale_input_quantity').val();
        var price = $(itemValue).find('.sale_input_price').val();
        var Amount = $(itemValue).find('.sale_item_subTotal').text();

        var row = [item, Quantity, price, Amount, id];
        order.push(row);
    });
    var data = {
        orderDetails: orderDetails,
        list: order
    };

    sendToUserPOShandler("confirmSale", "control", data, callback, token);

    function callback(msg) {
        var obj = JSON.parse(msg);
        var product_id = obj['product'][1][0]['UUID'];

        if (obj['status'] == true) {
            console.log("Added successfully");
            window.open(root + "/print.php?id=" + product_id, "_blank");
            cancelSale();
        } else {
            console.log("error adding sale");
        }
    }
}

function cancelSale() {
    $('input[name$="customer_name"]').val("");
    $('input[name$="customer_number"]').val("");
    $('input[name$="order_location"]').val("");
    $('#add_item_list').html("");
    getProductCount();
    evaluateSale();
}

function render_prod_search_in() {
    var elem = $(event.currentTarget);
    var parent = elem.parent().parent().parent();
    var search_pannel = parent.find(".search_product_pos");
    search_pannel.css("display", "block");
    search_pannel.animate({
        opacity: 1,
        top: "100%"
    }, 300);
}

function render_prod_search_out() {
    var elem = $(event.currentTarget);
    var parent = elem.parent().parent().parent();
    var search_pannel = parent.find(".search_product_pos");
    search_pannel.animate({
        opacity: 0,
    }, 200, function() {
        search_pannel.css({
            display: "none",
            top: "150%"
        });
    });
}

function search_product_pos() {
    var elem = $(event.currentTarget);
    var value = elem.val();
    var token = getToken();

    sendToUserPOShandler("viewProduct", "control", value, callback, token);

    function callback(msg) {
        $("#search_pos_container").html(msg);
    }
}