$(document).ready(function() {

    var form_action = Routing.generate('user_publish_flat')
    // $.fn.wizard.logging = true;      

    var flat_wizard = $('#flat-wizard').wizard({
        keyboard: true,
        formClass: 'form-horizontal form-publish-flat ad-form',
        submitUrl: form_action,
        contentHeight: 500,
        contentWidth: 700,
        backdrop: 'static'
    });
    //$("#oficina_form_a_piso").selectpicker();
    $('#flat-wizard-start').click(function(e){
        e.preventDefault();
        flat_wizard.show();
    });
    
    $('form.form-publish-flat').attr('enctype', 'multipart/form-data');
    $('form.form-publish-flat').attr('action', form_action);
    flat_wizard.on("submit", function(wizard) {
        var form = $('form.form-publish-flat');
        post_data = new FormData(form[0]);
        post_data.append('last', 'true')
        $.ajax({
            type: "POST",
            url: flat_wizard.args.submitUrl,
            data: post_data,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data'
        }).done(function(response) {
            flat_wizard.submitSuccess();         // displays the success card
            flat_wizard.hideButtons();           // hides the next and back buttons
            flat_wizard.updateProgressBar(0);    // sets the progress meter to 0
        }).fail(function() {
            flat_wizard.submitError();           // display the error card
            flat_wizard.hideButtons();           // hides the next and back buttons
        });
    });
    
     $('form.form-publish-flat').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }        
    });


});

function flatValidateStep(card) {
   // var name = card.el[0].attr('data-cardname');
   
    var bootstrapValidator = $('form.form-publish-flat').data('bootstrapValidator');    
    //var a = bootstrapValidator.isValidContainer('div[data-cardname="flat.step1"]');
    var a = bootstrapValidator.isValidContainer(card.el);
    //bootstrapValidator.validateField('piso_form[localidad]');
    
    return a;
    
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
