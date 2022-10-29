<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';
require_once('../config/config.php');

class MailerBuilder
{

    private static function createMailInstance($user, $subject, $body)
    {
        //se crea el objeto de PHPMailer y se establecen los parametro para envio
        $mail = new PHPMailer(true);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = HOST_SMTP;  //servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = USERNAME_SMTP; //Correo de envio
        $mail->Password = PASSWORD_SMTP; //Contraseña del correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Encriptacion
        $mail->Port = 465; //Puerto del servidor
        $mail->setFrom(USERNAME_SMTP, 'Administrador Web'); //Remitente
        $mail->addAddress($user->email, $user->nombres . " " . $user->apellidos); //Correo a quien se le envia
        $mail->isHTML(true);
        $mail->Subject = $subject;  //Asunto del correo
        //Codigo HTML que se quiere que se muestre
        $mail->Body = $body;
        return $mail;
    }

    public static function sendActivationMail($user)
    {
        try {
            $subject = 'Validacion de cuenta de usuario';
            $body = ' 
            <html>
        <head>
            <title>Activacion de usuario</title>
        </head>
        <body>
            <div
                style="
                    float: left;
                    background-color: #ffffff;
                    padding: 10px 30px 10px 30px;
                    border: 1px solid #f6f6f6;
                "
            >
                <div class="adM"></div>
                <div style="float: left; max-width: 470px">
                    <div class="adM"></div>
                    <p
                        style="
                            line-height: 21px;
                            font-family: Helvetica, Verdana, Arial, sans-serif;
                            font-size: 12px;
                        "
                    >
                        <strong
                            style="
                                line-height: 21px;
                                font-family: Helvetica, Verdana, Arial, sans-serif;
                                font-size: 18px;
                            "
                            >Confirma la activacion</strong
                        >
                    </p>
                    <div
                        style="
                            line-height: 21px;
                            min-height: 100px;
                            font-family: Helvetica, Verdana, Arial, sans-serif;
                            font-size: 12px;
                        "
                    >
                        <p
                            style="
                                line-height: 21px;
                                font-family: Helvetica, Verdana, Arial, sans-serif;
                                font-size: 12px;
                            "
                        >
                            Gracias por registrate
                        </p>
                        <p
                            style="
                                line-height: 21px;
                                font-family: Helvetica, Verdana, Arial, sans-serif;
                                font-size: 12px;
                            "
                        >
                            Valida tu cuenta ingresando al siguiente link:
                        </p>
                        <p
                            style="
                                line-height: 21px;
                                font-family: Helvetica, Verdana, Arial, sans-serif;
                                font-size: 12px;
                                margin-bottom: 25px;
                                background-color: #f7f9fc;
                                padding: 15px;
                            "
                        >
                            <strong>Confirmar: </strong
                            ><a
                                style="color: #4371ab; text-decoration: none"
                                href="' . constant('URL') . 'index.php?key=' . $user->hash . '"' . '
                                target="_blank"
                                >Click para activar cuenta</a
                            >
                        </p>
                        <p
                            style="
                                line-height: 21px;
                                font-family: Helvetica, Verdana, Arial, sans-serif;
                                font-size: 12px;
                            "
                        >
                            Muchas Gracias,<br />Desarrollo Web
                        </p>
                        <div class="yj6qo"></div>
                        <div class="adL"></div>
                    </div>
                    <div class="adL"></div>
                </div>
                <div class="adL"></div>
            </div>
        </body>
    </html>';

            $mail = MailerBuilder::createMailInstance($user, $subject, $body);
            if (!$mail->send()) { //se valida si se envio correctamente
                error_log("MailerBuilder::sendActivationMail -> Error al enviar email de validacion!" . $mail->ErrorInfo);
            } else {
                error_log("MailerBuilder::sendActivationMail -> Email de validacion enviado con exito!");
            }
        } catch (Exception $e) {
            error_log("MailerBuilder::sendActivationMail -> Exepcion al enviar mail!" . $e);
        }
    }

    public static function sendRecoveryMail($user, $codeRecovery)
    {

        try {

            $subject = 'Recuperacion de contraseña de usuario';

            $body = ' 
        <html>
	<head>
		<title>Codigo de recuperacion de contraseña</title>
	</head>
	<body>
		<div
			style="
				float: left;
				background-color: #ffffff;
				padding: 10px 30px 10px 30px;
				border: 1px solid #f6f6f6;
			"
		>
			<div class="adM"></div>
			<div style="float: left; max-width: 470px">
				<div class="adM"></div>
				<p
					style="
						line-height: 21px;
						font-family: Helvetica, Verdana, Arial, sans-serif;
						font-size: 12px;
					"
				>
					<strong
						style="
							line-height: 21px;
							font-family: Helvetica, Verdana, Arial, sans-serif;
							font-size: 18px;
						"
						>Confirma la recuperacion</strong
					>
				</p>
				<div
					style="
						line-height: 21px;
						min-height: 100px;
						font-family: Helvetica, Verdana, Arial, sans-serif;
						font-size: 12px;
					"
				>
					<p
						style="
							line-height: 21px;
							font-family: Helvetica, Verdana, Arial, sans-serif;
							font-size: 12px;
						"
					>
						Gracias por registrate
					</p>
					<p
						style="
							line-height: 21px;
							font-family: Helvetica, Verdana, Arial, sans-serif;
							font-size: 12px;
						"
					>
						Recupera tu contraseña ingresando el siguiente codigo:
					</p>
					<p
						style="
							line-height: 21px;
							font-family: Helvetica, Verdana, Arial, sans-serif;
							font-size: 12px;
							margin-bottom: 25px;
							background-color: #f7f9fc;
							padding: 15px;
						"
					>
						<strong>Codigo: ' . $codeRecovery . ' </strong>
					</p>
					<p
						style="
							line-height: 21px;
							font-family: Helvetica, Verdana, Arial, sans-serif;
							font-size: 12px;
						"
					>
						Muchas Gracias,<br />Desarrollo Web
					</p>
					<div class="yj6qo"></div>
					<div class="adL"></div>
				</div>
				<div class="adL"></div>
			</div>
			<div class="adL"></div>
		</div>
	</body>
</html>';
            $mail = MailerBuilder::createMailInstance($user, $subject, $body);
            if (!$mail->send()) { //se valida si se envio correctamente
                error_log("MailerBuilder::sendRecoveryMail -> Error añ enviar email de recuperacion de contraseña " . $mail->ErrorInfo);
            } else {
                error_log("MailerBuilder::sendRecoveryMail -> Email de recuperacion de contraseña enviado con exito");
            }
        } catch (Exception $e) {
            error_log("MailerBuilder::sendRecoveryMail -> Exepcion al enviar email de recuperacion de contraseña " . $e);
        }
    }
}
