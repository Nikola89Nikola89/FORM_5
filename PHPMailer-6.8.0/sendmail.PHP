<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exeption.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

//mail from
$mail->setFrom('info@fls.guru', 'freelanser');
//mail to
$mail->addAddress('nicola89nicola89@gmail.com');
//letter subject
$mail->Subject = 'Hello world!!!';

//hand
$hand = "Right";
if($_POST['hand'] == "left"){
    $hand = "Left";
}

//letter body
$body = '<h1>Hello.. Here is my form.</h1>';

if(trim(!empty($_POST['name']))){
    $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))){
    $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['hand']))){
    $body.='<p><strong>Hand:</strong> '.$_hand.'</p>';
}
if(trim(!empty($_POST['age']))){
    $body.='<p><strong>Age:</strong> '.$_POST['age'].'</p>';
}

if(trim(!empty($_POST['message']))){
    $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
}

//add file
if(!empty($_FILES['image']['tmp_name'])) {
    //way to load file
    $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
    //load file
    if(copy($_FILES['image']['tmp_name'], $filePath)){
        $fileAttach = $filePath;
        $body.='<p><strong>Photo</strong>';
        $mail->addAttachment($fileAttach);
    }
}

$mail->Body = $body:

//send
if (!$mail->send()) {
    $message = 'Error';
} else {
    $message = 'Data send!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>