<?php

require_once ROOTPATH . '/libs/PHPMailer/src/PHPMailer.php';
require_once ROOTPATH . '/libs/PHPMailer/src/Exception.php';
require_once ROOTPATH . '/libs/PHPMailer/src/SMTP.php';

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

class Email {

	public static function send($title,
								$subject,
								$html,
								$to) {

		$headers = "Content-Type: text/html; charset=UTF-8";

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 587;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$mail->Username = 'no-reply@paraguayinvest.com';
		//Password to use for SMTP authentication
		$mail->Password = 'Pyinvest975';
		//Set who the message is to be sent from
		$mail->setFrom('no-reply@paraguayinvest.com', $title);
		//Set an alternative reply-to address
		//$mail->addReplyTo('replyto@example.com', 'First Last');
		//Set who the message is to be sent to
		$mail->addAddress($to, '');
		//$mail->AddBCC($bcc);
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
		$mail->msgHTML($html);
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'Orden de Trabajo - Cierre';
		//Attach an image file
		//$mail->addAttachment($ruta . $archivo_nombre);
	
		$mail->CharSet = 'UTF-8';

		$send = $mail->send();

		return array (
            'state' => $send,
            'msg' => ($send ? 'Email enviado con éxito.' : 'No se ha podido enviar el email: ' . $mail->ErrorInfo)
        );
		/*
		return array (
			'estado' => $send,
			'msg' => ($send ? 'Email enviado con éxito.' : 'No se ha podido enviar el email: ' . $mail->ErrorInfo)
		);
		if (!$mail->send()) {
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message sent!';
		}
		*/
	}

}