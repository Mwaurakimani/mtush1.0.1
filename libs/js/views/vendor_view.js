//open Edit vendor0
function openVendor(id) {
    if (id) {
        // open in edit mode
        console.log("update");
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
        console.log("new");
        var token = getToken();
        var action = "open";
        var view = 'vendorInput';
        var variables = ['vendors', 'add'];
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