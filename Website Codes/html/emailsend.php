<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/mailer/src/Exception.php';
require '/var/www/html/mailer/src/PHPMailer.php';
require '/var/www/html/mailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "email@gmail.com";
$mail->Password   = "password";

$mail->IsHTML(true);
$mail->AddAddress("send_to_email", "recipient-name");
$mail->SetFrom("send_from_email", "no-reply");
//$mail->AddReplyTo("reply-to-email@domain", "reply-to-name");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<p>This is a Test Email sent via Gmail SMTP Server using PHP mailer class. Hello Father. How are you ??</p>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}


?>
