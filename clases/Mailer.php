<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

class Mailer
{

    function enviarEmail($email, $asunto, $cuerpo)
    {
        require_once __DIR__ .'/../config/config.php';
        require __DIR__ .'/../phpmailer/src/PHPMailer.php';
        require __DIR__ .'/../phpmailer/src/SMTP.php';
        require __DIR__ .'/../phpmailer/src/Exception.php';


        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG:OFF para produccion
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = MAIL_PORT; // use 587 `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Correo emisor y Nombre
            $mail->setFrom(MAIL_USER, 'Tienda ZACE');
            //Correo receptor y Nombre
            $mail->addAddress($email);

            //Contenido
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = utf8_decode($cuerpo);
            $mail->AltBody = $cuerpo;
            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            //enviar correo
            if( $mail->send()){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
            return false;
        }
    }
}






/*$cuerpo = '<h4>Gracias por su compra</h4>';
$cuerpo .= '<p>El ID de su compra es </b>' . $id_transaccion . '</b></p>';
$cuerpo .= '<p>La hora de la compra es  </b>' . $fecha . '</b></p>';
$cuerpo .= '<p>El monto pagado fue </b>$' . number_format($total, 2, '.', ',') . '</b></p>'; */