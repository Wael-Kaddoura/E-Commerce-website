var email_valid;

$("#submit-button").click(function () {
    validateEmail();

    if (!email_valid) {
        $("#vemail").addClass("alert-danger");
        $("#vemail").addClass("alert");
    } else {
        $("#vemail").removeClass("alert-danger");
    }

    if (email_valid) {
        $("#signup-form").submit();
    }
})

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
