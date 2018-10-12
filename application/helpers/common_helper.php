<?php

function report_error(){
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

function pr($data,$die=1){
	print_r("<pre>");
	print_r($data);
	if($die==1){
		die;
	}
}
function last_query($die=0){
	print_r("<pre>");
	$ci=& get_instance();
	echo $ci->db->last_query();
	if($die==1){
		die;
	}
}

function no_form_input_specified($get_post_data){
	if(!isset($get_post_data) || $get_post_data=="" || empty($get_post_data)){
		redirect("/home");
	}
}

function generate_random_string($len = 10,$without_time = 0){
	$characters = '01234abcdefghizABCDZ0123EFGHIJKLMNOPQRSTjklmn56789opqrstuvwxyUVWXY456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $len; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	if($without_time == 0){
		return $randomString."-".strtotime("now");
	} else {
		return $randomString;
	}
}


function generate_strong_password($len = 8){
	$character_set_array = array(
		array('count' => 5, 'characters' => 'abcdefghijklmnopqrstuvwxyz'),
		array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'),
		array('count' => 2, 'characters' => '0123456789'),
		array('count' => 1, 'characters' => '-)(!@#$<>:="?{}~'),
	);
	$temp_array = array();
	foreach ($character_set_array as $character_set) {
		for ($i = 0; $i < $character_set['count']; $i++) {
			$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
		}
	}
	shuffle($temp_array);
	return implode('', $temp_array);
}

function check_session($user_type = NULL){
	$obj =& get_instance();
	if($obj->session->userdata('logged_in')==''){
		$returnURL = "";
		$uri_segment = $obj->uri->segment(1);
		if($uri_segment!="home"){
			$urldata = $obj->uri->segment_array();
			$urldata =  implode("/",$urldata);
			$returnURL = '?return_url='.$urldata;
		} 
		$url = "";
		if($user_type == ""){
			$url = "user/login".$returnURL;
		} else {
			$url  = "$user_type/login".$returnURL;
		}
		redirect($url);
	}
}

function allowed_video_ext(){
	return array("mp4",'3gp','avi','mov','mpeg');
}

function allowed_image_ext(){
	return array('jpg','jpeg','gif','bmp','png','');
}

function upload_images($filename = null, $folder_name){
	$min_width = 400;
	$min_height = 400;
	$obj =& get_instance();
	$videoExts = allowed_image_ext();	  
	$name = $_FILES[$filename]['name'];
	$tmp_name = $_FILES[$filename]['tmp_name'];
	$ext = pathinfo($name,PATHINFO_EXTENSION);

    $rand = generate_random_string();
	$renamedfile = $rand.".".$ext;
	$target_path = UPLOAD_IMAGES."$folder_name/".$renamedfile;
	if(move_uploaded_file($tmp_name,$target_path))	{
		return trim($target_path);
	}
}

function cal_date_diff($date1,$date2 = null){
	$obj =& get_instance();
	$obj->load->database();
	if($date2 == NULL){
		$date2 = date("Y-m-d");
	}
	$sql_string = "SELECT DATEDIFF('$date1','$date2') AS DiffDate";
	$query_row =  $obj->db->query($sql_string)->row_array();
	$diff = $query_row['DiffDate'];
	return $diff;
	
}

function generate_drop_down($value, $text, $table, $type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	$query = $obj->db->query("SELECT $value, $text FROM $table");
	if($query->num_rows() > 0)	{
		$output = "";
		foreach($query->result_array() as $table_data){
			if($type == 'html'){
				
				$selected="";
				if($selected_value == $table_data[$value]){
					$selected = 'selected';
				}
				$output.='<option value="'.$table_data[$value].'" '.$selected.'>'.ucfirst($table_data[$text]).'</option>';
			} 
			else if($type == 'special'){
				$output[$table_data[$value]] = $table_data;
			}
			else {
				$output[$table_data[$value]] = ucfirst($table_data[$text]);
			}
			
		}
		return $output;
	} else {
		return 0;
	}
}

function user_list_role_wise($userId,$companyId,$user_role_id,$selected_value=null)
{
	$obj =& get_instance();
	$obj->load->database();

	$data = array();
    if($user_role_id == 1)
    {
        $obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
		$obj->db->from('users as u');
		$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.company_id'=> $companyId));
        $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
        $obj->db->order_by("ur.id", "asc");
		$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
        $data = $result->result_array();
    
    }
    else
    {
        $obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
		$obj->db->from('users as u');
		$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.reports_to_user_id' => $userId, 'u.company_id'=> $companyId));
        $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
        $obj->db->order_by("ur.id", "asc");
		$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
        $data = $result->result_array();
    }

    if(empty($data))
    {
    	$obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
		$obj->db->from('users as u');
		$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id' => $userId, 'u.company_id'=> $companyId));
        $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
        $obj->db->order_by("ur.id", "asc");
		$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
        $data = $result->result_array();
    }

    $user_role_wise = array();

    if(isset($data) && !empty($data))
    {
        foreach ($data as $key => $value) 
        {
            $user_role_wise[$value['role_id']][] = $value;
        }
    }

	$html = '';
    if(isset($user_role_wise['2']) && !empty($user_role_wise['2']))
    {
        $html .='<optgroup label="Resional Managers">';
        foreach ($user_role_wise['2'] as $rmkey => $rmvalue) 
        {
        	$selected="";
			if($selected_value == $rmvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$rmvalue['id'].'" '.$selected.'>'.$rmvalue['empname'].' ('.$rmvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }

    if(isset($user_role_wise['3']) && !empty($user_role_wise['3']))
    {
        $html .='<optgroup label="Team Leaders">';
        foreach ($user_role_wise['3'] as $tlkey => $tlvalue) 
        {
        	$selected="";
			if($selected_value == $tlvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$tlvalue['id'].'" '.$selected.'>'.$tlvalue['empname'].' ('.$tlvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }

    if(isset($user_role_wise['4']) && !empty($user_role_wise['4']))
    {
        $html .='<optgroup label="Other Users">';
        foreach ($user_role_wise['4'] as $ukey => $uvalue) 
        {
        	$selected="";
			if($selected_value == $uvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$uvalue['id'].'" '.$selected.'>'.$uvalue['empname'].' ('.$uvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }
    return $html;
}



function get_company_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'company_name', 'companies', $type,$selected_value);
}

function get_user_role_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'user_roles', $type,$selected_value);
}

function get_target_duration_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'target_duration', $type,$selected_value);
}

function get_subscription_plan_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'subscription_plan', $type,$selected_value);
}

function get_sales_stages_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'sales_stages', $type,$selected_value);
}

function get_sales_stages_list_with_prob($type, $selected_value = NULL){
	return generate_drop_down('id', 'name,probability', 'sales_stages', $type,$selected_value);
}

function get_uom_list($type, $selected_value = NULL){
	return generate_drop_down('code', 'name', 'uom', $type,$selected_value);
}

function get_account_number($type, $selected_value = NULL){
	return generate_drop_down('id', 'code', 'uom', $type,$selected_value);
}


function active_inactive_dp($type="html", $selectedstats = null ){
	$array = array(
		"1"=>"Active",
		"2"=>"Suspended",
	);
	$html = "";
	if($type=="html"){
		foreach($array as $key => $value){
			$selected = "";
			if($key == $selectedstats && $selectedstats!=""){
				$selected = 'selected';
			}
			$html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
		return $html;
	} else {
		return $array;
	}
}

function generate_table_head($array = ""){
	$html = "<tr>";
	foreach($array as $key => $inner_array){
		$class = ' class="'.$inner_array['class'].'"';
		$html .= '<th'.$class.'>'.$inner_array['col'].'</th>'."\n";
	}
	$html .= "</tr>";
	return $html;
}

function aes_encrypt($string) {
	$output = false;
	$output = base64_encode(@openssl_encrypt($string, ENCRYPTION_METHOD, SECRET_KEY));    
	return $output;
}

function aes_decypt($string) {
	$output = false;
	$output = base64_decode($string);
	$output = @openssl_decrypt($output, ENCRYPTION_METHOD, SECRET_KEY);
	return $output;
}


function load_required_js($page_name){
	$js_list =  array(
		"dashboard" => array('dashboard_activity.js'),
		"setting" => array('settings_page.js'),
		"sidebar" => array('sidebar_activities.js'),
		"company" => array('company.js'),
		"user" => array('user.js'),
		"items" => array('items.js'),
		"sales" => array('sales_module.js'),
		"account" => array('account.js'),
		"contact" => array('contact.js'),
		"lead" => array('lead.js'),
		
	);
	return $js_list[$page_name];
}

function convert_db_date_time($date){
	return date(DISPLAY_FORMAT,strtotime($date));
}

function get_only_date($date){
	return date(DEFAULT_DATE_FORMAT,strtotime($date));
}

function truncated_string($string,$len) {
 if(strlen($string)>$len) {
  $new = substr($string, 0,$len);
  $new .= ". . ."; 
 } else {
  $new = $string; 
 }
 return $new;
}
?>