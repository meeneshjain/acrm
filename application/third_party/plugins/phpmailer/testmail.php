<?php

require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "indocon.co.in";

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "bri@indocon.co.in";
$mail->Password = "*7R{{s4on61a";

$mail->From = "bri@indocon.co.in";
$mail->FromName = "Test from Info";
$mail->AddAddress("j.meenesh@gmail.com");
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = "Your script is working fine.";
$mail->Body = "Mail script test<b>in bold!</b>";
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";

?>