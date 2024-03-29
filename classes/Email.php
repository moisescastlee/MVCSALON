<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
       
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '463ca7df919052';
        $mail->Password = '78a836dd747f05';
        
        $mail->Port = 2525;


        $mail->setFrom('el_moises_05@hotmail.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar email
        $mail->send();
    }

    public function enviarCuentaOlvidada() {

         //Crear el objeto de email
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = 'smtp.mailtrap.io';
         $mail->SMTPAuth = true;
         $mail->Username = '463ca7df919052';
         $mail->Password = '78a836dd747f05';
         
         $mail->Port = 2525;
 
 
         $mail->setFrom('el_moises_05@hotmail.com');
         $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
         $mail->Subject = 'Restablece tu password';
 
         //Set HTML
         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8';
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has acabado de solicitar tu password, sigue el siguiente enlace. </p>";
         $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Restablecer password</a> </p>";
         $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este mensaje. </p>";
         $contenido .= "</html>";
         $mail->Body = $contenido;
 
         //Enviar email
         $mail->send();
    }

}