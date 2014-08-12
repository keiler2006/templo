$(document).ready(function() {

    var form_action = Routing.generate('user_publish_flat');

    $('#flat-wizard-start').click(function(e) {
        e.preventDefault();
        var flat_wizard = $('#flat-wizard').wizard({
            keyboard: true,
            formClass: 'form-horizontal form-publish-flat ad-form',
            submitUrl: form_action,
            remoteContent: form_action,
            contentHeight: 450,
            contentWidth: 700,
            backdrop: 'static'
        });
        flat_wizard.show();

        flat_wizard.on('closed', function() {
            flat_wizard.reset();
        });

        flat_wizard.on("submit", function(wizard) {
            var form = $('form.form-publish-flat');
            post_data = new FormData(form[0]);
            post_data.append('last', 'true')
            $.ajax({
                type: "POST",
                url: wizard.args.submitUrl,
                data: post_data,
                processData: false,
                contentType: false,
                dataType: "json",
                enctype: 'multipart/form-data'
            }).done(function(response) {
                if (response.success)
                {
                    wizard.submitSuccess();         // displays the success card
                    wizard.hideButtons();           // hides the next and back buttons
                    wizard.updateProgressBar(0);    // sets the progress meter to 0
                } else
                {
                    wizard.find('div.wizard-error > div.alert-danger').html(response.cause);
                    wizard.submitError();           // displays the success card                  
                }

            }).fail(function() {
                wizard.submitFailure();           // display the error card
                wizard.hideButtons();           // hides the next and back buttons
            });
        });

        flat_wizard.on("reset", function() {
            flat_wizard.modal.find(':input').val('').removeAttr('disabled');
            flat_wizard.modal.find('.form-group').removeClass('has-error').removeClass('has-succes');
            $('form.form-publish-flat').data('bootstrapValidator').resetForm();
        });

        flat_wizard.el.find(".wizard-success .im-done").click(function() {
            flat_wizard.hide();
            setTimeout(function() {
                flat_wizard.reset();
            }, 250);

        });

        flat_wizard.el.find(".wizard-success .publish-another-flat").click(function() {
            flat_wizard.reset();
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

        photoConfig();

        $('#piso_form_tipo').change(function(e) {

            var alquiler_field = $('#piso_form_precio_alquiler');
            var alquiler_row = alquiler_field.parent().parent().parent();

            var venta_field = $('#piso_form_precio_venta');
            var venta_row = venta_field.parent().parent().parent();

            var select = $(this);

            if (select.val() === 'alquiler')
            {
                alquiler_row.show();
                venta_row.hide();
            } else {
                if (select.val() === 'venta') {
                    alquiler_row.hide();
                    venta_row.show();
                } else {
                    alquiler_row.show();
                    venta_row.show();
                }
            }
        });

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
