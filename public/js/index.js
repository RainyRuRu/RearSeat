var user;

function thisIs(userId) {
    user = userId;
}

function selectOption(option) {
    document.getElementById("select_option").innerHTML = option;
}

function goFindPage() {

}

function goSharePage() {

}

function goNewRequestPage() {
    if (!user) {
        $('#signin_modal').modal('show');
    }
}