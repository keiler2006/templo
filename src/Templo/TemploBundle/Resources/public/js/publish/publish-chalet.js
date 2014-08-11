$(document).ready(function() {

    var form_action = Routing.generate('user_publish_flat')
    // $.fn.wizard.logging = true;      

    var chale_wizard = $('#flat-wizard').wizard({
        keyboard: true,
        formClass: 'form-horizontal form-publish-chale',
        submitUrl: form_action,
        contentHeight: 500,
        contentWidth: 700,
        backdrop: 'static'
    });
    //$("#oficina_form_a_piso").selectpicker();
    $('#chale-wizard-start').click(function(e){
        e.preventDefault();
        chale_wizard.show();
    });
    
    $('form.form-publish-chale').attr('enctype', 'multipart/form-data');
    $('form.form-publish-chale').attr('action', form_action);
    chale_wizard.on("submit", function(wizard) {
        var form = $('form.form-publish-chale');

        post_data = new FormData(form[0]);
        post_data.append('last', 'true')

        $.ajax({
            type: "POST",
            url: chale_wizard.args.submitUrl,
            data: post_data,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data'
        }).done(function(response) {
            chale_wizard.submitSuccess();         // displays the success card
            chale_wizard.hideButtons();           // hides the next and back buttons
            chale_wizard.updateProgressBar(0);    // sets the progress meter to 0
        }).fail(function() {
            chale_wizard.submitError();           // display the error card
            chale_wizard.hideButtons();           // hides the next and back buttons
        });
    }
    );


});

function validateStep1(card) {
    /* var form = $('form.form-office');
     var datos = card.el.find('input').serializeArray();
     datos.push({
     name: "step",
     value: card.index + 1
     });
     var r;
     $.ajax({
     type: 'POST',
     url: form.attr('action'),
     async: false,
     data: datos,
     success: function(data) {
     if (!data.success) {
     for (i = 0; i < data.cause.length; i++) {
     campo = data.cause[i].field;
     errores = data.cause[i].errors;
     showFieldErrors(campo, errores);
     }
     r = false;
     } else
     {
     r = true;
     }
     }
     });
     return r;*/


    return true;

}

function validateStep2(card) {
    var form = $('form.form-office');
    var datos = card.el.find('input').serializeArray();

    var datos_location = $('div.wizard-card[data-cardname="location"]').find('input').serializeArray();
    for (i = 0; i < datos_location.length; i++)
    {
        datos.push(datos_location[i]);
    }

    datos.push({
        name: "step",
        value: card.index + 1
    });
    var r;
    $.ajax({
        type: 'POST',
        url: form.attr('action'),
        async: false,
        data: datos,
        success: function(data) {
            if (!data.success) {
                for (i = 0; i < data.cause.length; i++) {
                    campo = data.cause[i].field;
                    errores = data.cause[i].errors;
                    showFieldErrors(campo, errores);
                }
                r = false;
            } else
            {
                r = true;
            }
        }
    });
    return r;
}

function showFieldErrors(campo, errores) {
    field = $('#piso_form_' + campo);
    form_group = field.parents('.form-group');
    form_group.addClass('has-error');
    div = field.parent('div');
    div.find('ul').remove();
    ul = document.createElement('ul');
    for (i = 0; i < errores.length; i++)
    {
        li = document.createElement('li');
        li.appendChild(document.createTextNode(errores[i]));
        ul.appendChild(li);
    }
    div.append(ul);
}
