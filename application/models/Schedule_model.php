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
}

?>