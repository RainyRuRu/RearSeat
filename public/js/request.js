function warn() {
    var r = confirm("留言一旦送出就無法刪除，你確定要留言嗎？");
    if (!r) {
        return false;
    }
}