$(document).ready(function () {

    $("#formLogin").validate({
        rules: {
            usnombre: {
                required: true
            },
            uspass: {
                required: true
            }
        },
        messages: {
            usnombre: {
                required: "Ingrese su usuario"
            },
            uspass: {
                required: "Ingrese su contraseña"
            }
        },
        errorElement: "span",

        errorPlacement: function (error, element) {

            var elementosRepetidos2 = document.querySelectorAll(".captcha-incorrecto");
            elementosRepetidos2.forEach(function(elemento2) {
                elemento2.remove();
            });

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

            var uspassValue = $("#uspass").val();

            var uspass = CryptoJS.MD5(uspassValue).toString();

            var usnombre = $("#usnombre").val();

            var formData = {
                'usnombre': usnombre,
                'uspass': uspass
            };
            
            $.ajax({ 
                url: "../action/validarLogin.php",
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

                        window.location.href = "home.php"; 

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