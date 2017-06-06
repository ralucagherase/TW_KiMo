/**
 * Created by IRINA on 27.05.2017.
 */
/**
 * Created by IRINA on 27.05.2017.
 */
$('document').ready(function() {
    /* validation */
    $("#signup-form").validate({
        rules: {
            password: { required: true },
            confirm_password: {
                required: true,
                equalTo : "#password"
            },
            user_email: {
                required: true,
                email: true
            }
        },
        messages: {
            password: { required: "please enter your password" },
            confirm_password: {
                required: "please enter your password",
                equalTo: "Passwords are not the same"
            },
            user_email: "please enter your email address"
        },
        submitHandler: submitLoginForm
    });

    /* signup submit */
    function submitLoginForm() {
        var data = $("#signup-form").serializeArray();
        $.ajax({
            type: 'POST',
            url: 'database/signup_process.php',
            data: data,
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btn-signup").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success: function(response, data) {
                if(response == "ok"){
                    $("#btn-signup").html('<img style="width: 14px;" src="assets/img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    setTimeout(' window.location.href = "home.php"; ',4000);
                }
                else{
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-signup").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                }
            }
        });
        return false;
    }
});
