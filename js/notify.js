function notify(content, type) {
    var notifyBar = document.getElementById("notify");
    notifyBar.innerHTML = "<div class='alert alert-" + type + " alert-dismissible fade show' role='alert'>" +
        "<strong>" + content + ".</strong>" +
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
        "</div>"
};