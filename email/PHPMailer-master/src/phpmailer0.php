<?php
require 'PHPMailer-master/vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'kimberlykavetsa@gmail.com';
$mail->Password = 'alumasa9';
$mail->setFrom('kimberlykavetsa@gmail.com');
$mail->addAddress('reesalumasa@gmail.com');
$mail->Subject = 'Hello from PHPMailer!';
$mail->Body = 'This is a test.';
//send the message, check for errors
if (!$mail->send()) {
    echo "ERROR: " . $mail->ErrorInfo;
} else {
    echo "SUCCESS";
}
