/**
 * Created by Raluca Gherase on 25.04.2017.
 */
$('document').ready(function() {
    /* validation */
    $("#login-form").validate({
        rules: {
            password: { required: true },
            user_email: {
                required: true,
                email: true
            }
        },
        messages: {
            password: { required: "please enter your password" },
            user_email: "please enter your email address"
        },
        submitHandler: submitLoginForm
    });

    /* login submit */
    function submitLoginForm() {
        var data = $("#login-form").serialize();
        $.ajax({
            type: 'POST',
            url: 'database/login_process.php',
            data: data,
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success: function(response, data) {
                if(response == "ok"){
                    $("#btn-login").html('<img src="assets/img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    setTimeout(' window.location.href = "home.php"; ',4000);
                }
                else{
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                }
            }
        });
        return false;
    }
});
