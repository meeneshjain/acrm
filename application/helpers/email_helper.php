<?php

function send_mailer($email,$subject,$body,$test_mail = 0){

    error_reporting(E_ALL);
    if($test_mail == 0){
        $smtp_config = get_company_smtp_configuration();
    }else{
        $smtp_config = $test_mail;
    }
    
    if($smtp_config['is_configured'] == 1){
        
        require("application/third_party/plugins/phpmailer/class.phpmailer.php");

        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->Host = $smtp_config['host'];

        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        $mail->Port = $smtp_config['port'];
        $mail->Username = $smtp_config['from_email'];
        $mail->Password = $smtp_config['from_password'];

        $mail->From = $smtp_config['from_email'];
        $mail->FromName = $smtp_config['from_name'];
        $mail->AddAddress($email); 
         //$mail->AddReplyTo("mail@mail.com");

        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;  //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        if(!$mail->Send())  {
            return 0;
        } else {
            return 2;
        }
    }else{
        return 1;
    }
}

/*
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
*/

function get_company_smtp_configuration(){
    $obj =& get_instance();
    $smtp_config = array();
    $company_id = get_current_company()?get_current_company():0;
    $obj->db->where(array("company_id"=>$company_id, "status"=>"1", "is_deleted"=>"0"));
    if($company_id!= 0 && $company_id!= ""){
        $smtp_config = $obj->db->get('company_email_smtp')->row_array();     
    }

    return $smtp_config;
}

function generate_email($sender_email,$template_key,$data){
    $obj =& get_instance();
	
	$logged_in_company = get_current_company();
    $company_query = "";
    $template_query = "SELECT `subject`, `body` FROM company_email_templates WHERE  status = 1 AND is_deleted = 0 AND company_id='$logged_in_company' AND `template_key` = '$template_key'";
    $result = $obj->db->query($template_query)->row_array();
    if(isset($result) && !empty($result)){
		$subject = $result['subject'];
		$mail_body = $result['body'];
		foreach ($data as $key => $value) {
			$subject = str_ireplace($key, $value, $subject);
			$mail_body = str_ireplace($key, $value, $mail_body);
		}
		send_mailer($sender_email,$subject,$mail_body,0);
	}	
}





/*$data = array(
            "{{app_name_short}}" => APP_NAME,
            "{{base_url}}" => 'http://google.com',
            "{{user_full_name}}" => 'Manish Carpenter',
            "{{user_name}}" => 'manishcrpntr',
            "{{password}}" => 'manish123',
            "{{app_name_full}}" => POWERED_BY_FULL
        );*/
?>