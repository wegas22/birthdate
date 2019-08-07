$(document).ready(function() {

    $('#photoimg').die('click').live('change', function() {
        //$("#preview").html('');

        $("#imageform").ajaxForm({
            target: '#preview',
            beforeSubmit: function() {

                console.log('ttest');
                $("#imageloadstatus").show();
                $("#imageloadbutton").hide();
            },
            success: function() {
                console.log('test');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
            },
            error: function() {
                console.log('xtest');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
            }
        }).submit();


    });
});