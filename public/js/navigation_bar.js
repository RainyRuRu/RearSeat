var emailOK = false;
var passwordOK = false;
var passwordRepeatOK = false;

function checkEmail() {
    var email = document.forms["signup_form"]["email"].value;
    if (!(email.includes("@") && email.includes("nknu"))) {
        emailOK = false;
        changeCheckMode("mail_check", "wrong");
        return;
    }

    $.ajax({
        url:'api.php',
        data:{action: "hasEmail",
              email: email},
        type:'get',
        dataType:'JSON',
        success: function(output) {
            if (output.has == true){
                emailOK = true;
                changeCheckMode("mail_check", "ok");
            } else{
                emailOK = false;
                changeCheckMode("mail_check", "wrong");
            }
        }
    });
}

function checkPassword() {
    var length = document.forms["signup_form"]["password"].value.length;

    if (length >= 6) {
        passwordOK = true;
        changeCheckMode("pw_check", "ok");
        checkPasswordRepeat();
    } else {
        passwordOK = false;
        changeCheckMode("pw_check", "wrong");
        passwordRepeatOK = false;
        changeCheckMode("pwr_check", "unknow");
    }
}

function checkPasswordRepeat() {
    if (!passwordOK) {
        return;
    }

    var pw = document.forms["signup_form"]["password"].value.length;
    var pwr = document.forms["signup_form"]["password_repeat"].value.length;
    if (pwr == pw) {
        passwordRepeatOK = true;
        changeCheckMode("pwr_check", "ok");
    } else {
        passwordRepeatOK = false;
        changeCheckMode("pwr_check", "wrong");
    }
}

function changeCheckMode(elementId, mode) {
    if (mode == "ok") {
        document.getElementById(elementId).innerHTML = '<span class="glyphicon glyphicon-ok-sign col-sm-1 check_icon check_ok" aria-hidden="true"></span>';
    } else if (mode == "unknow") {
        document.getElementById(elementId).innerHTML = '<span class="glyphicon glyphicon-exclamation-sign col-sm-1 check_icon check_unknow" aria-hidden="true"></span>';
    } else {
        document.getElementById(elementId).innerHTML = '<span class="glyphicon glyphicon-remove-sign col-sm-1 check_icon check_wrong" aria-hidden="true"></span>';
    }
}

function inputCheck() {
    if (!(emailOK && passwordOK && passwordRepeatOK)) {
        document.getElementById("signup_message").innerHTML = '<div class="alert alert-danger" role="alert">請檢查未打勾處</div>'
        return false;
    }
}