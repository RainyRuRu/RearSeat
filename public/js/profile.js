function onload(tab) {
    var id = "#" + tab + "Tab";
    $(id).addClass('active');
    if (tab == "") {
        $("#profileTab").addClass('active');
    }
    $("#submitBtn").hide();
}

function edit() {
    inputs = $("#profileForm").find("input");

    inputs.each(function( index ) {
        $(this).prop("disabled", false);
    });

    $("#editBtn").hide();
    $("#submitBtn").show();

}

function switchDiv(option) {
    if (option == "request") {
        $("#requestDiv").show();
        $("#reservationDiv").hide();
    } else {
        $("#requestDiv").hide();
        $("#reservationDiv").show();
    }
 
}