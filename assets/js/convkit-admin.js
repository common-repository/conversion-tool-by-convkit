;jQuery(function($){

    $('#convkit-plugin-settings').submit(function(e){
        e.preventDefault();

        var
            $invalidKeyDiv = $('#convkit-plugin-settings-invalid-key'),
            $successDiv = $('#convkit-plugin-settings-success'),
            $errorDiv = $('#convkit-plugin-settings-error'),
            $form = $(this),
            apiKey = $form.find('input[data-convkit-type="api-key"]').val()
        ;

        $.ajax({
            url: $form.data('checkUrlTpl').replaceAll('{{apiKey}}', apiKey),
            type: 'GET',
            success: function(){
                hideElement($invalidKeyDiv)
                ajaxSaveSettingsForm($form, $successDiv, $errorDiv);
            },
            error:function (){
                showElement($invalidKeyDiv);
            }
        });
    });

    function hideElement( $el ){

        if( $el.is(":visible") ){
            $el.fadeTo( 100, 0, function() {
                $el.slideUp( 100);
            });
        }
    }

    function showElement( $el ){
        $el.slideDown(100, function() {
            $el.fadeIn( 100);
        });
    }

    function ajaxSaveSettingsForm( $form, $successDiv, $errorDiv ){
        $.ajax({
            data: $form.serialize(),
            type: $form.attr('method'),
            url: $form.attr('action'),
            success: function (response) {
                if (response.success) {
                    hideElement($errorDiv);
                    showElement($successDiv);
                }
                else{
                    hideElement($successDiv);
                    showElement($errorDiv);
                }
            }
        });
    }
});
