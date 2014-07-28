$(document).ready(function() {
    /*$('logout-link').click(function(e){
        e.preventDefault();
    });*/
   
    $('#submit-modal-login').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: $('form').attr('method'),
            url: Routing.generate('fos_user_security_check'),
            data: $('form').serialize(),
            dataType: "json",
            success: function(data, status, object) {                
                if (data.error)
                 {  $('#modal-login-error-container').html('');
                    $('#modal-login-error-container').html("<div class=\"alert alert-danger fade in\">\n\<button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">&times;</button>"+data.message+"</div>");
                 }else
                 {                  
                     window.location.href = data.targetUrl;
                 }
            },
            error: function(data, status, object) {
                console.log(data.message);
            }
        });
    });
});
