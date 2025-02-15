$(document).ready(function () {

    $("#formCrearCuenta").validate({
        rules: {
            usnombre: {
                required: true,
            },
            usmail: {
                required: true,
                mailValido: {mailValido: true}
            }
        },
        messages: {
            usnombre: {
                required: "Ingrese su usuario"
            },
            usmail: {
                required: "Ingrese su dirección de mail"
            }
        },
        errorElement: "span",

        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".contenedor-dato").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },

        submitHandler: function(form){

            var alertaMensajesElem = document.getElementById('alertaMensajes');
            alertaMensajesElem.innerHTML = "";

            var nombre = document.getElementById('usnombre').value;
            var mail = document.getElementById('usmail').value;

            var formData = {
                'usnombre': nombre,
                'usmail': mail
            };

            var formData = {'usnombre': nombre, 'usmail': mail};

            console.log(formData)
            
            $.ajax({ 
                url: "../action/validarCrearCuenta.php",
                type: "POST",
                dataType: "json",
                data: formData,
                async: false,

                complete: function(xhr, textStatus) {
                },
                success: function(respuesta, textStatus, xhr) {

                    if (respuesta.resultado == "exito"){

                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = [
                            '<div class="alert alert-success alert-dismissible" role="alert">',
                            '   <div>' + respuesta.mensaje + '</div>',
                            '</div>'
                        ].join('');
                        alertaMensajesElem.append(wrapper);

                        $("#formCrearCuenta")[0].reset();

                    } else {

                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = [
                            '<div class="alert alert-danger alert-dismissible" role="alert">',
                            '   <div>' + respuesta.mensaje + '</div>',
                            '</div>'
                        ].join('');
                        alertaMensajesElem.append(wrapper);
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
                    console.log(xhr.responseText);
                }
            });
        }
    });

    
});

jQuery.validator.addMethod("mailValido", function (value, element) {
    return this.optional(element) || (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value));
}, "Formato de mail no válido");