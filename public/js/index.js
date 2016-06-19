var user;

function onload(userId, message) {
    user = userId;
    
    if (message) {
        document.getElementById("message_content").innerHTML = message;
        $('#message_modal').modal('show');
    }
}

function selectOption(option) {
    document.getElementById("select_option").innerHTML = option;
}

function goFindPage() {
    window.location.assign("find_list.php");
}

function goSharePage() {
    window.location.assign("share_list.php");
}

function goNewRequestPage() {
    if (!user) {
        $('#login_modal').modal('show');
    } else {
        window.location.assign("new_request.php");
    }
}

function goTheRequestPage(request_id) {
    window.location.assign("request.php?id=" + request_id);
}

function goSearch() {
    var keyword = document.forms["search_form"]["keyword"].value;
    var request = document.getElementById("select_option").innerHTML == "找車位" ? 1 : 0;
    window.location.assign("search.php?keyword=" + keyword + "&request=" + request);
    return false;
}