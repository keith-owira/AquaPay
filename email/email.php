<?php
require 'PHPMailer-master/vendor/autoload.php';
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;



//Load Composer's autoloader
//require 'vendor/autoload.php';

function sendemail($to,$subject,$body){
	
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->isSMTP();
      $mail->SMTPSecure = 'tls';
      $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

      $mail->SMTPAuth = true;
      $mail->CharSet = 'utf-8';
      $mail->Username = 'owirakeith57@gmail.com';
      $mail->Password = 'Lampard94';
      //Recipients
      $mail->setFrom('owirakeith57@gmail.com', 'AquaPay');
      $mail->addAddress($to);

  
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    

    $mail->send();
    return 'sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

?>