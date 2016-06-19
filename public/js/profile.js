function onload(tab) {
    var id = "#" + tab + "Tab";
    $(id).addClass('active');
    if (tab == "") {
        $("#profileTab").addClass('active');
    }
}