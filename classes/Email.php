<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    private const HOST = "sandbox.smtp.mailtrap.io";
    private const PORT = 2525;
    private const EMAIL_USER = "a094c99a5b699f";
    private const EMAIL_PASS = "f7bf99fd9e33c2";
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = self::HOST;
        $this->mailer->Port = self::PORT;
        $this->mailer->Username = self::EMAIL_USER;
        $this->mailer->Password = self::EMAIL_PASS;
        //$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    }

    public function confirmacionReserva($datos){
        $this->mailer->setFrom('contacto@veterinaria.pe', 'Contacto');
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
        depurar($this->mailer->ErrorInfo);
        return $status;
    }
}