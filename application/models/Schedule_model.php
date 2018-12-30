<?php 
class Schedule_model extends CI_Model {	


	public function getCalls($userId,$companyId) {

		$dt_columns = array('c.lead_type', 'c.reason', 'c.callback_time', 'c.alert_before_datetime', 'c.users_ids', 'c.status_type', 'c.created_date', 'cl.id as lead_id', 'cl.first_name', 'cl.last_name', 'cl.mobile', 'a.id as acnt_id', 'a.name', 'a.account_number');
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from('calls as c');
		$this->db->where(array('c.status' => '1', 'c.is_deleted' => '0', 'c.company_id'=> $companyId));
		//$this->db->where("cl.owner_id IN (".$lead_owner.")",NULL, false);
        $this->db->join('contact_lead as cl', 'c.lead_id=cl.id', 'left');
        $this->db->join('account as a', 'c.account_id=c.account_id', 'left');
        $this->db->join('users as u', 'c.created_by=u.id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() );
		$output = $dt_result->result();
		return $output;
		//echo json_encode(array("status" => "success","message" => '', "data" => $output));
	}

	public function get_online_users($companyId){
		$dt_columns = array( 'u.id', 'ur.name as user_role_name', 'u.first_name', 'u.last_name', 'u.is_login' );
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from('users as u');
		$this->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.company_id'=> $companyId));
		//$this->db->where("cl.owner_id IN (".$lead_owner.")",NULL, false);
        $this->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() );
		$output = $dt_result->result();
		return $output;
	}

	public function get_chat_history($f_userid,$t_userid){

		$output = array();
		$this->db->query("UPDATE `chat_history` SET `is_read` = '1' WHERE `from_id` = '$t_userid' AND `to_id` = '$f_userid'");
		$data = $this->db->query("SELECT `id`, `from_id`, `to_id`, `messege`, `send_at`, `is_read` FROM `chat_history` WHERE `from_id` = '$f_userid' AND `to_id` = '$t_userid' OR `from_id` = '$t_userid' AND `to_id` = '$f_userid' ORDER BY `send_at` ASC LIMIT 50")->result_array();
		
		foreach ($data as $key => $value) 
		{
			$value['send_at'] = date('d M Y @ h:i:s A',strtotime($value['send_at']));
			$output[] = $value;
		}
		return $output;
	}
}



?>