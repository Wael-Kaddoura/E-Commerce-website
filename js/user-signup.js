var email_valid;
var confirm_pass;
var first_name_valid;
var last_name_valid;

$("#submit-button").click(function () {
    validateEmail();
    confirmPassword();
    validatefname();
    validatelname();

    
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

    if (!first_name_valid) {
        $("#fname").addClass("alert-danger");
        $("#fname").addClass("alert");
    } else {
        $("#fname").removeClass("alert-danger");
    }

    if (!last_name_valid) {
        $("#lname").addClass("alert-danger");
        $("#lname").addClass("alert");
    } else {
        $("#lname").removeClass("alert-danger");
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

function validatefname() {
    first_name_valid = false;
    if ($("#first-name").val().length > 2) {
        first_name_valid = true;
    }
}

function validatelname() {
    last_name_valid = false;
    if ($("#last-name").val().length > 2) {
        last_name_valid = true;
    }
}
