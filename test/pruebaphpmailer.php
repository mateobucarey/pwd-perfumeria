<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// include_once ('../util/funciones.php');
include_once ('../configuracion.php');
require '../vendor/autoload.php';

// include_once __DIR__ . '/../util/funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos usando la función darDatosSubmitted()
    $datos = darDatosSubmitted();

    // Recupera los datos necesarios
    $destinatario = $datos['destinatario'] ?? null;
    $nombreDestinatario = $datos['nombreDestinatario'] ?? null;
    $asunto = $datos['asunto'] ?? null;
    $mensajeHtml = $datos['mensajeHtml'] ?? null;
    $mensajeTexto = $datos['mensajeTexto'] ?? null;

    // Valida que todos los campos necesarios estén presentes
    if ($destinatario && $nombreDestinatario && $asunto && $mensajeHtml && $mensajeTexto) {
        $resultado = enviarCorreo($destinatario, $nombreDestinatario, $asunto, $mensajeHtml, $mensajeTexto);
        echo $resultado;
    } else {
        echo 'Faltan datos obligatorios para enviar el correo.';
    }
} else {
    echo 'Método no permitido.';
}



function enviarCorreo($nombre, $mail, $idEstadoCompra){
    
        switch ($idEstadoCompra) {
            case 1:
                $asunto = 'Compra iniciada';
                $cuerpo = "$nombre:\n\n Le informamos que su compra ha sido iniciada. \n\n";
                break;
            case 2:
                $asunto = 'Compra aceptada';
                $cuerpo = "$nombre:,\n\nLe informamos que su compra ha sido aceptada, su pedido se está preparando para ser enviado.\n\n";
                break;
            case 3:
                $asunto = 'Compra enviada';
                $cuerpo = "$nombre:,\n\nLe informamos que su compra ha sido enviada. \n\n";
                break;
            case 4:
                $asunto = 'Compra cancelada';
                $cuerpo = "$nombre:,\n\nLe informamos que su compra ha sido cancelada.\n\n";
                break;
        }
}
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nicobucarey12@gmail.com';                     //SMTP username
    $mail->Password   = 'rlfviwbemtjygwoz';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nicobucarey12@gmail.com', 'Perfumeria');
    $mail->addAddress($mail, $nombre);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('nicobucarey12@gmail.com', 'Informacion');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //comprobante
    $mail->addAttachment($archivoPdf, 'Comprobante_de_Compra.pdf');


    $mail->send();
    // echo 'Message has been sent';
    echo 'El mensaje ha sido enviado correctamente.';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// Elimina el archivo PDF temporal después de enviarlo

unlink($archivoPdf);
