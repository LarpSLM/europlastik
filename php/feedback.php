<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/Exception.php';
require 'lib/PHPMailer.php';
require 'lib/SMTP.php';


$FROM = 'feedback.dl@yandex.ru';
$FROM_NAME = 'Европластик (Форма обратной связи)';

$RECIPIENT =  'europlastik@list.ru';
$RECIPIENT_NAME = 'Европластик';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
	$name = extractFromPost('name', 64);
	$userEmail = extractFromPost('e-mail', 64);
	$userPhone = extractFromPost('phone', 64);
	$message = extractFromPost('question', 5000);
	
    //Server settings
    //$mail->SMTPDebug = 2; 
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host = 'smtp.yandex.ru';						// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                        // Enable SMTP authentication
    $mail->Username = 'feedback.dl@yandex.ru';                 			// SMTP username
    $mail->Password = 'europlastik3018';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64'; 
    
    $mail->SMTPOptions = array(
		'ssl' => array(
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true
		)
	);

    //Recipients
    $mail->setFrom($FROM, $FROM_NAME);
    $mail->addAddress($RECIPIENT, $RECIPIENT_NAME);     // Add a recipient
    
    if(!empty($userEmail)) {
	    $mail->addReplyTo($userEmail, $name);
    }

    //Content
    $mail->Subject = "Обратная связь ($name)";
    $mail->Body    = "Пользователь $name оставил вопрос:\n\n$message"
	."\n\nОбратная связь с пользователем:\nE-mail:$userEmail\nТелефон:$userPhone";
    

    $mail->send();
	redirectToSuccess();
} catch (Exception $e) {
	redirectToError();
}

function redirectToSuccess() {
	header('Location: /mail-success.html');
}

function redirectToError() {
	header('Location: /mail-error.html');
}

function extractFromPost($name, $len) {
	if(array_key_exists($name, $_POST)) {
		$raw = $_POST[$name];
	
		if($raw != null && is_string($raw)) {
			return substr($raw, 0, $len);
		}
	} else {
		return "";	
	}
}
