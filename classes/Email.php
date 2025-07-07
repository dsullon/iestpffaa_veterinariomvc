<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = $_ENV['EMAIL_HOST'];
        $this->mailer->Username = $_ENV['EMAIL_USER'];
        $this->mailer->Password = $_ENV['EMAIL_PASS'];
        $this->mailer->Port = $_ENV['EMAIL_PORT'];;
        //$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    }

    public function confirmacionReserva($datos){
        $this->mailer->setFrom('contacto@veterinaria.pe', $_ENV['EMAIL_NAME']);
        $this->mailer->addAddress($datos['email'], $datos['cliente']);

        $this->mailer->isHTML(true);
        $this->mailer->CharSet = "UTF-8";

        $contenido = "<html>
            <p>Hola <strong>{$datos['cliente']}</strong>, se ha reservado una cita en nuestra veterinaria con el siguiente detalle:</p>
            <ul>
                <li>Fecha: {$datos['fecha']}</li>
                <li>Hora: {$datos['hora']}</li>
                <li>Servicio: {$datos['servicio']}</li>
            </ul>
            <p>Se recomienda asistir a la cita con 30 minutos de anticipación. En caso no pueda asistir y requiera una reprogramación favor de comunicarse al teléfono (01) 236-5688 como 24 horas antes de su cita.</p>
        </html>";

        $this->mailer->Subject = 'Reserva de cita';
        $this->mailer->Body = $contenido;
        $status = $this->mailer->send();
        return $status;
    }

    public function confirmacionRegistro($datos){
        $this->mailer->setFrom('contacto@veterinaria.pe', 'Contacto');
        $this->mailer->addAddress($datos['email'], $datos['usuario']);

        $this->mailer->isHTML(true);
        $this->mailer->CharSet = "UTF-8";

        $contenido = "<html>
            <p>Hola {$datos['usuario']},</p>
            <p>Gracias por registrarte en <strong>" . $_ENV['APP_NAME'] . "</strong>. Para completar tu registro y activar tu cuenta, por favor utiliza el siguiente enlace de confirmación.</p>
            <p><a href='" . $_ENV['APP_URL'] . "/auth/confirmar?token=" . $datos['token'] ."'>Activar mi cuenta</a></p>
            <p>Este paso es necesario para verificar tu correo electrónico y comenzar a disfrutar de nuestros servicios.</p>
            <p><em>Si no has solicitado esta cuenta, por favor ignora este mensaje.</em></p>
            <p><strong> Equipo " . $_ENV['APP_NAME'] . "</strong></p>
        </html>";

        $this->mailer->Subject = "Bienvenido(a) a " . $_ENV['APP_NAME'];
        $this->mailer->Body = $contenido;
        $status = $this->mailer->send();
        return $status;
    }

    public function confirmacionCompra($datos){
        $this->mailer->setFrom('contacto@veterinaria.pe', 'Contacto');
        $this->mailer->addAddress($datos['email'], $datos['usuario']);

        $this->mailer->isHTML(true);
        $this->mailer->CharSet = "UTF-8";

        $contenido = "<html>
            <p>Hola {$datos['usuario']},</p>
            <p>¡Gracias por tu compra en <strong>" . $_ENV['APP_NAME'] . "</strong>!</p>
            <p>
                Nos complace informarte que tu pedido ha sido confirmado con éxito y ya está siendo preparado con mucho cariño por nuestro equipo.
            </p>
            <p>
                <strong>Código de seguimiento: </strong>{$datos['codigo']}
            </p>
            <p>
                Podrás usar este código para conocer el estado de tu envío en cualquier momento.
            </p>
            <p>
                Recibirás una notificación tan pronto tu pedido salga de nuestras instalaciones. Si tienes alguna duda o necesitas ayuda adicional, no dudes en escribirnos.
            </p>
            <p>
                Gracias por confiar en nosotros para cuidar de tus peludos.
            </p>
            <p>Con aprecio,</p>
            <p>
                <strong> Equipo de " . $_ENV['APP_NAME'] . "</strong>
            </p>
        </html>";

        $this->mailer->Subject = " ¡Tu pedido ha sido confirmado! - " . $_ENV['APP_NAME'];
        $this->mailer->Body = $contenido;
        $status = $this->mailer->send();
        return $status;
    }
}