//open Edit user


function openUserAccount(id) {
    if (id) {
        // open in edit mode
        var token = getToken();
        var action = "open";
        var view = 'userAccountInput';
        var variables = ['moderators', 'update'];
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
        var variables = ['moderators', 'add'];
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

function acccollector() {
    var data = {
        firstName: $('input[name$="firstName"]').val(),
        lastName: $('input[name$="lastName"]').val(),
        otherName: $('input[name$="otherName"]').val(),
        userName: $('input[name$="userName"]').val(),
        IdNumber: $('input[name$="IDNumber"]').val(),
        dateOfBirth: $('input[name$="dateOfBirth"]').val(),
        email: $('input[name$="email"]').val(),
        phone1: $('input[name$="phone1"]').val(),
        phone2: $('input[name$="phone2"]').val(),
        address: $('input[name$="address"]').val(),
        accountType: $('select[name$="accountType"] option:selected').val(),
        accountStatus: $('select[name$="accountStatus"] option:selected').val(),
        nextOfKinFirstName: $('input[name$="nextOfKinFirstName"]').val(),
        nextOfKinLastName: $('input[name$="nextOfKinLastName"]').val(),
        nextOfKinRelation: $('input[name$="relation"]').val(),
        nextOfKinNumber: $('input[name$="nextOfKinPhoneNumber"]').val(),
        nextOfKinAddress: $('input[name$="nextOfKinAddress"]').val()
    };

    $.each(data, function(key, val) {
        if ((key != 'phone2' && isEmpty(val)) || (key != 'password' && isEmpty(val))) {
            console.log(key);
            data = false;
        }
    });

    return data;
}

function updateUserAccount() {
    var data = acccollector();

    if (data != false) {

        var elem = $(".editUserAccountContainer");

        var user = elem.attr('data-id');

        if (user) {
            var action = "change";
            var handler = "control";
            var token = getToken();

            sendToUserAccountHandler(action, handler, data, callback, token, user);

            function callback(resp) {
                var res = JSON.parse(resp);
                var response = res.response;
                if ((res.status == true) && (res.User != null) && (res.User[0] == true)) {
                    alert(response);

                    var data = res.User[1][0];

                    updateFields(data);

                } else {
                    alert("Error Adding User.Please Contact Administrator to resolve this issue.");
                }
            }
        } else {
            var action = "addUser";
            var handler = "control";
            var token = getToken();

            sendToModeratorHandler(action, handler, data, callback, token, null);

            function callback(resp) {
                var res = JSON.parse(resp);
                var response = res.response;
                if ((res.status == true) && (res.User != null) && (res.User[0] == true)) {
                    alert(response);

                    var data = res.User[1][0];

                    updateFields(data);

                } else {
                    alert("Error Adding User.Please Contact Administrator to resolve this issue.");
                }
            }
        }

    } else {
        alert("Error Uploading data 2");
    }
}

function updateFields(data) {
    if ((data['firstName']) != "") {
        $('input[name$="firstName"]').val(data['firstName']);
    }
    if ((data['lastName']) != "") {
        $('input[name$="lastName"]').val(data['lastName']);
    }
    if ((data['otherName']) != "") {
        $('input[name$="otherName"]').val(data['otherName']);
    }
    if ((data['username']) != "") {
        $('input[name$="userName"]').val(data['username']);
    }
    if ((data['nationalID']) != "") {
        $('input[name$="IDNumber"]').val(data['nationalID']);
    }
    if ((data['dateOfBirth']) != "") {
        $('input[name$="dateOfBirth"]').val(data['dateOfBirth']);
    }
    if ((data['moderatorEmail']) != "") {
        $('input[name$="email"]').val(data['moderatorEmail']);
    }
    if ((data['password']) != "") {
        $('input[name$="password"]').val('0000');
    }
    if ((data['phoneNumber1']) != "") {
        $('input[name$="phone1"]').val(data['phoneNumber1']);
    }
    if ((data['phoneNumber2']) != "") {
        $('input[name$="phone2"]').val(data['phoneNumber2']);
    }
    if ((data['Address']) != "") {
        $('input[name$="address"]').val(data['Address']);
    }
    if ((data['nextOfKinFirstName']) != "") {
        $('input[name$="nextOfKinFirstName"]').val(data['nextOfKinFirstName']);
    }
    if ((data['nextOfKinLastName']) != "") {
        $('input[name$="nextOfKinLastName"]').val(data['nextOfKinLastName']);
    }
    if ((data['nextOfKinRelation']) != "") {
        $('input[name$="relation"]').val(data['nextOfKinRelation']);
    }
    if ((data['nextOfKinNumber']) != "") {
        $('input[name$="nextOfKinPhoneNumber"]').val(data['nextOfKinNumber']);
    }
    if ((data['nextOfKinAddress']) != "") {
        $('input[name$="nextOfKinAddress"]').val(data['nextOfKinAddress']);
    }
    if ((data['regDate']) != "") {
        $('input[name$="dataAdded"]').val(data['regDate']);
    }
    if ((data['lastModified']) != "") {
        $('input[name$="lastModified"]').val(data['lastModified']);
    }
    if ((data['Role']) != "") {

    }
    if ((data['accountStatus']) != "") {
        var elems = $('select[name$="accountStatus"]').find('option');
        $.each(elems, function(key, val) {
            $(val).removeAttr('selected');
        });
    }
}

function searchModerator() {
    var elem = $(event.currentTarget);
    var data = elem.val();

    if (!isEmpty(data)) {
        var action = "searchModerator";
        var handler = "control";
        var token = getToken();

        sendToModeratorHandler(action, handler, data, callback, token)

        function callback(msg) {
            var data = JSON.parse(msg);

            if (data[0]) {
                var tableBody = $(document.getElementsByTagName("tbody")[0]);
                tableBody.html("");
                var count = 1;
                var fullStatement = ""

                $.each(data[1], function(key, val) {
                    var uid = val.UUID;
                    var name = val.firstName + " " + val.otherName + " " + val.lastName;
                    var email = val.moderatorEmail;
                    var phone = val.phone1;
                    var status = val.status;

                    var statement = `
                        <tr onclick="openUserAccount('` + uid + `')">
                            <th scope="row">
                                ` + count + `
                            </th>
                            <td>
                                ` + name + `
                            </td>
                            <td>
                                ` + email + `
                            </td>
                            <td>
                                ` + phone + `
                            </td>
                            <td>
                                ` + status + `
                            </td>
                        </tr>
                    `;
                    count++;
                    fullStatement = fullStatement + statement;
                });

                tableBody.html(fullStatement);
                return
            } else {
                alert("No record found");
            }
        }
    } else {
        return;
    }
}