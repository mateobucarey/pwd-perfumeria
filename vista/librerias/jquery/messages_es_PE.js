(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 * Region: PE (Perú)
 */
$.extend( $.validator.messages, {
	required: "Este campo es obligatorio.",
	remote: "Error, complete este campo.",
	email: "Error, escriba un correo electrónico válido.",
	url: "Error, escriba una URL válida.",
	date: "Error, escriba una fecha válida.",
	dateISO: "Error, escriba una fecha (ISO) válida.",
	number: "Error, escriba un número válido.",
	digits: "Error, escriba sólo dígitos.",
	creditcard: "Error, escriba un número de tarjeta válido.",
	equalTo: "Error, escriba el mismo valor de nuevo.",
	extension: "Error, escriba un valor con una extensión permitida.",
	maxlength: $.validator.format( "Error, no escriba más de {0} caracteres." ),
	minlength: $.validator.format( "Error, no escriba menos de {0} caracteres." ),
	rangelength: $.validator.format( "Error, escriba un valor entre {0} y {1} caracteres." ),
	range: $.validator.format( "Error, escriba un valor entre {0} y {1}." ),
	max: $.validator.format( "Error, escriba un valor menor o igual a {0}." ),
	min: $.validator.format( "Error, escriba un valor mayor o igual a {0}." ),
	nifES: "Error, escriba un NIF válido.",
	nieES: "Error, escriba un NIE válido.",
	cifES: "Error, escriba un CIF válido."
} );
return $;
}));