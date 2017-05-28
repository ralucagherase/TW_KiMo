/**
 * Created by Raluca Gherase on 28.05.2017.
 */

$('document').ready(function() {
    /* validation */
    $("#add-child-form").validate({
        rules: {
            nume_copil: { required: true },
            prenume_copil: { required: true },
            zi_nastere_copil: { required: true },
            prenume_mama: { required: true },
            prenume_tata: { required: true },
            latitudine: { required: true },
            longitudine: { required: true }
        },
        submitHandler: submitAddChildForm
    });

    /* login submit */
    function submitAddChildForm() {
        var data = $("#add-child-form").serialize();
        $.ajax({
            type: 'POST',
            url: 'database/add_child_process.php',
            data: data,
            success: function(response) {
                $("#btn-add-child").html('<img src="assets/img/btn-ajax-loader.gif" /> &nbsp; Please wait...');
                setTimeout(function(){
                    $("#btn-add-child").html('Add');
                    $("#add-child-form")[0].reset();
                }, 4000);
            }
        });
        return false;
    }
});
