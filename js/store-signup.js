var email_valid;
var confirm_pass;
var store_name_valid;

$("#submit-button").click(function () {
    validateEmail();
    confirmPassword();
    validatename();

    
    if (!confirm_pass) {
        $("#cpass").addClass("alert-danger");
        $("#cpass").addClass("alert");
    } else {
        $("#cpass").removeClass("alert-danger");
    }

    if (!email_valid) {
        $("#vemail").addClass("alert-danger");
        $("#vemail").addClass("alert");
    } else {
        $("#vemail").removeClass("alert-danger");
    }

    if (!store_name_valid) {
        $("#sname").addClass("alert-danger");
        $("#sname").addClass("alert");
    } else {
        $("#sname").removeClass("alert-danger");
    }


    if (email_valid && confirm_pass) {
        $("#signup-form").submit();
    }
});


function validateEmail() {
    var email_value = $("#email").val();
    email_valid = false;
    if (
        email_value.length > 5 &&
        email_value.lastIndexOf(".") > email_value.lastIndexOf("@") &&
        email_value.lastIndexOf("@") != -1
    ) {
        email_valid = true;
    }
}

function confirmPassword() {
    confirm_pass = false;
    if ($("#password").val() == $("#confirm-password").val() && $("#password").val().length > 5) {
        confirm_pass = true;
    }
}

function validatename() {
    store_name_valid = false;
    if ($("#store-name").val().length > 2) {
        store_name_valid = true;
    }
}


