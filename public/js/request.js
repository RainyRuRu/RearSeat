function warn() {
    var r = confirm("留言一旦送出就無法刪除，你確定要留言嗎？");
    if (!r) {
        return false;
    }
}

function reservation(seat_id, user_id) {
    $.ajax({
        url:'api.php',
        data:{action: "addReservation",
              seat_id: seat_id,
              user_id: user_id,
              message: ""},
        type:'get',
        dataType:'JSON',
        success: function(output) {
            if (output.result){
                alert("OK");
            }
        }
    });
}