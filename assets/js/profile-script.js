/**
 * Created by IRINA on 26.04.2017.
 */
$('document').ready(function() {
    /* validation */
    $("#profile-form").validate({
        rules: {
            nume: { required: false },
            prenume: { required: false },
            zi_nastere: { required: false }
        },
        submitHandler: submitProfileForm
    });

    /* login submit */
    function submitProfileForm() {
        var data = $("#profile-form").serialize();
        $.ajax({
            type: 'POST',
            url: 'database/profile_process.php',
            data: data,
            success: function(response) {
                $("#btn-submit").html('<img src="assets/img/btn-ajax-loader.gif" /> &nbsp; Saving ...');
                setTimeout(function(){ $("#btn-submit").html('Save') }, 4000);
            }
        });
        return false;
    }
});
