<?php

function send_mail($email,$subject,$body,$cc_email_address = null, $attachment_file = NULL){
  $obj =& get_instance();
  $obj->load->library('email',array('mailtype'  => 'html'));
  $obj->email->from(FROM_EMAIL, APP_NAME);
  $obj->email->reply_to(FROM_EMAIL, APP_NAME);
  $obj->email->to($email); 
  $obj->email->subject($subject);
  $obj->email->message($body);  
  if($attachment_file!= ""){
    $obj->email->attach($attachment_file);
  }
  $obj->email->send(false);
  $output =  $obj->email->print_debugger();
  return $output;
}

function get_current_company_email_configuration(){
    $obj =& get_instance();

    $smtp_config = array();

    

    $company_id = $obj->session->userdata('company_id')?$obj->session->userdata('company_id'):0;
    if(!empty($company_id)){
        $smtp_config['url'] = 'abc.com';
        $smtp_config['port'] = 'abc.com';
        $smtp_config['from_name'] = 'abc.com';
        $smtp_config['from_email'] = 'abc.com';
        $smtp_config['form_email_password'] = 'abc.com';
    }
    return $smtp_config;
}

function send_mailer($email,$subject,$body,$cc_email_address = null){
    require("application/third_party/phpmailer/class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host = COMPANY_URL;

    $mail->SMTPAuth = true;
    //$mail->SMTPSecure = "ssl";
    $mail->Port = 25;
    $mail->Username = FROM_EMAIL;
    $mail->Password = FROM_EMAIL_PASSWORD;

    $mail->From = FROM_EMAIL;
    $mail->FromName = FROM_NAME;
    $mail->AddAddress($email); 
     //$mail->AddReplyTo("mail@mail.com");

    $mail->IsHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;  //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    if(!$mail->Send())
    {
    	exit;
    }
}



?>