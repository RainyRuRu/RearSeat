 jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});

 function onload(){
    $('#pagination').twbsPagination({
        totalPages: 1,
        visiblePages: 5,
        onPageClick: function (event, page) {}
    });
 }

 function selectOption(option) {
    document.getElementById("select_option").innerHTML = option;
}

function goSearch() {
    var keyword = document.forms["search_form"]["keyword"].value;
    var request = document.getElementById("select_option").innerHTML == "找車位" ? 1 : 0;
    window.location.assign("search.php?keyword=" + keyword + "&request=" + request);
    return false;
}
    