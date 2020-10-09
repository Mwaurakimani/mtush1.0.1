function focusInputElement() {
    var target = $(event.currentTarget);
    var input_elem = target.parent();

    input_elem.css({
        "border": "2px solid red"
    });
}

function preventDefault() {
    event.preventDefault();
}

function renderError(elem) {
    elem.css({
        "height": "auto"
    });
}

function focusOutInputElement() {
    var target = $(event.currentTarget);
    var input_elem = target.parent();

    input_elem.css({
        "border": "2px solid grey"
    });
}

function toggleViewPassowrd() {
    var elem = $(event.currentTarget).parent().find("input[name=password]");
    var view = elem.attr('data-view');

    if (view == "false") {
        elem.attr('data-view', 'true');
        var elem1 = elem.parent().find(".btn_view");
        elem1.removeClass("btn_view");
        elem1.addClass("btn_hide");
        elem.attr('type', 'text');
    } else {
        elem.attr('data-view', 'false');
        var elem1 = elem.parent().find(".btn_hide");
        elem1.removeClass("btn_hide");
        elem1.addClass("btn_view");
        elem.attr('type', 'password');
    }
    event.preventDefault();
}

function submitLoginForm() {
    console.log("hellow world");
}