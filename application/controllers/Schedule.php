<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedule extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("schedule_model");
		$this->load->model("common_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function add_notes(){
		if($this->input->is_ajax_request())
		{
			$userId = $this->sessionData['logged_in'];
			$companyId = $this->sessionData['company_id'];
			$data = array(
							'user_id' => $userId,
							'company_id' => $companyId,
							'subject' => $this->input->post('subject'),
							'message' => $this->input->post('message'),
							'color' => $this->input->post('color'),
							'created_date' => DATETIME,
							'created_date' => DATETIME,
							'status' => '0',
							'is_deleted' => '0',
						);
			$result = $this->common_model->insert('notes', $data);
			echo json_encode(array("status" => "success","message" => 'Note Added Successfully.', "data" => $result));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function edit_notes(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->common_model->getdata($selected = 'id,subject,message,color', 'notes', $where = array('id' => $id ), $limit = false, $offset = false, $orderby=false);
				echo json_encode(array("status" => "success","message" => '', "data" => $data));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Notes Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function update_notes(){
		if($this->input->is_ajax_request())
		{
			$data = array(
							'subject' => $this->input->post('subject'),
							'message' => $this->input->post('message'),
							'color' => $this->input->post('color'),
							'updated_date' => DATETIME
						);
			$where = array('id' => $this->input->post('id'));
			$this->common_model->update_data('notes',$data,$where);
			echo json_encode(array("status" => "success","message" => 'Notes Updated Successfully', "data" => ""));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function delete_notes(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->common_model->delete_data('notes',array('id' => $id));
				echo json_encode(array("status" => "success","message" => 'Notes Deleted Successfully!!', "data" => ''));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Notes Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
	public function get_notes(){
		$userId = $this->sessionData['logged_in'];
		$response =  $this->common_model->getdata($selected = false, 'notes', $where = array('is_deleted' => 0,'user_id' => $userId), $limit = false, $offset = false, $orderby=array('0'=>'created_date','1'=>'desc'));
		if(!empty($response))
		{		
			echo json_encode(array("status" => "success","message" => '', "data" => $response));
		}
		else
		{
			echo json_encode(array("status" => "success","message" => '', "data" => ''));
		}
		die;
	}
	/* MEETING CODE GOES HERE */
	public function add_meeting(){
		//print_r($_POST);die;
		if($this->input->is_ajax_request())
		{
			$userId = $this->sessionData['logged_in'];
			$companyId = $this->sessionData['company_id'];
			$data = array(
				'company_id' => $companyId,
				'subject' => $this->input->post('subject'),
				'description' => $this->input->post('description'),
				'user_ids' => implode(',', $this->input->post('meeting_invitees')),
				'start_datetime' => $this->input->post('start_date'),
				'end_datetime' => $this->input->post('end_date'),
				'status_type' => $this->input->post('status_type'),
				'alert_before_datetime' => $this->input->post('alert_datetime'),
				'created_date' => DATETIME,
				'created_by' => $userId,
				'updated_date' => DATETIME,
				'status' => '1',
				'is_deleted' => '0'
			);
			$result = $this->common_model->insert('meeting', $data);
			$r_id = $this->db->insert_id();
			$invitees = implode(",", $_POST['meeting_invitees']);
			if(isset($_POST['meeting_invitees']) && !empty($_POST['meeting_invitees']))
			{
				foreach ($_POST['meeting_invitees'] as $key => $value) {
					add_notification("MEETING",$r_id,$_POST['subject'],$_POST['description'],$this->sessionData['logged_in'],$value);
				}
			}
			echo json_encode(array("status" => "success","message" => 'Meeting Added Successfully.', "data" =>$invitees ));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function edit_meeting(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->common_model->getdata($selected = false, 'meeting', $where = array('id' => $id ), $limit = false, $offset = false, $orderby=false);
				echo json_encode(array("status" => "success","message" => '', "data" => $data));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Meeting Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function update_meeting(){
		if($this->input->is_ajax_request())
		{
			$data = array(
				'subject' => $this->input->post('subject'),
				'description' => $this->input->post('description'),
				'user_ids' => implode(',', $this->input->post('meeting_invitees')),
				'start_datetime' => $this->input->post('start_date'),
				'end_datetime' => $this->input->post('end_date'),
				'status_type' => $this->input->post('status_type'),
				'alert_before_datetime' => $this->input->post('alert_datetime'),
				'updated_by' => '1',
				'updated_date' => DATETIME,
			);
			$where = array('id' => $this->input->post('id'));
			$this->common_model->update_data('meeting',$data,$where);
			echo json_encode(array("status" => "success","message" => 'Meeting Updated Successfully', "data" => ""));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function delete_meeting(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->common_model->delete_data('meeting',array('id' => $id));
				echo json_encode(array("status" => "success","message" => 'Meeting Deleted Successfully!!', "data" => ''));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Meeting Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
	public function get_meeting(){
		$userId = $this->sessionData['logged_in'];
		//$output['meeting_added'] =  $this->common_model->getdata($selected = false, 'meeting', $where = array('is_deleted' => 0,'created_by' => $userId), $limit = 100, $offset = false, $orderby=array('0'=>'id','1'=>'desc'));
		$output['meeting_added'] =  $this->common_model->customQueryArray("SELECT * FROM `meeting` WHERE `is_deleted` = '0' AND `created_by` = '$userId' LIMIT 25");
		$output['meeting_attend'] = $this->common_model->customQueryArray("SELECT * FROM `meeting` WHERE FIND_IN_SET($userId,user_ids) AND `is_deleted` = '0' LIMIT 25");
		
		$data = array_merge($output['meeting_added'],$output['meeting_attend']);
		if(!empty($data))
		{		
			foreach ($data as $key => $value) 
			{
				if($value['created_by'] == $userId){
					$data[$key]['byme'] = 1;
				}else{
					$data[$key]['byme'] = 0;
				}
				$data[$key]['showtime'] = date('h:i',strtotime($value['start_datetime']));
				$data[$key]['showdate'] = date('l, F d, Y @ h:i A',strtotime($value['start_datetime']));
				$data[$key]['description'] = truncated_string($value['description'],100);
			}
			function cmp($a, $b) {
			  return strtotime($b['start_datetime']) - strtotime($a['start_datetime']);
			}
			usort($data, "cmp");
			echo json_encode(array("status" => "success","message" => '', "data" => $data));
		}
		else
		{
			echo json_encode(array("status" => "success","message" => '', "data" => ''));
		}
	}
	
	/* TASK CODE GOES HERE */
	public function add_task(){
		$userId = $this->sessionData['logged_in'];
		$companyId = $this->sessionData['company_id'];
		if($this->input->is_ajax_request())
		{
			$data = array(
							'company_id' => $companyId,
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'created_date' => DATETIME,
							'status' => '1',
							'created_by' => $userId,
							'is_deleted' => '0',
						);
			$result = $this->common_model->insert('task', $data);
			echo json_encode(array("status" => "success","message" => 'Task Added Successfully.', "data" => $result));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
	
	public function get_task(){
		$userId = $this->sessionData['logged_in'];
		$response =  $this->common_model->getdata($selected = false, 'task', $where = array('status' => '1','is_deleted' => '0','created_by' => $userId), $limit = false, $offset = false, $orderby=array('0'=>'created_date','1'=>'desc'));
		if(!empty($response))
		{		
			echo json_encode(array("status" => "success","message" => '', "data" => $response));
		}
		else
		{
			echo json_encode(array("status" => "success","message" => '', "data" => ''));
		}
		die;
	}
	public function mark_task_complete(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			$status = $this->uri->segment(4);
			if(is_numeric($id) && !empty($id))
			{
				$data = array(
						'complete' => $status,
						'updated_date' => DATETIME
					);
				$where = array('id' => $id);
				$this->common_model->update_data('task',$data,$where);
				echo json_encode(array("status" => "success","message" => 'Task updated Successfully!!', "data" => ""));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Meeting Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
	}
	public function delete_task(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->common_model->delete_data('task',array('id' => $id));
				echo json_encode(array("status" => "success","message" => 'Task Deleted Successfully!!', "data" => ''));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Task Id doesn\'t exist.', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    /* CALLS CODE GOES HERE */
	public function add_calls(){
		if($this->input->is_ajax_request())
		{
			$userId = $this->sessionData['logged_in'];
			$companyId = $this->sessionData['company_id'];
			$alert_before_time = $this->input->post('start_date');
			$alert_before_time = strtotime($alert_before_time);
			$alert_before_time = strtotime("+".$this->input->post('alert_datetime')." minute", $alert_before_time);
			$alert_before_time = date('Y-m-d H:i:s',$alert_before_time);
			$data = array(
							'company_id' => $companyId,
							'lead_id' => $this->input->post('calls_sb_lead_id'),
							'lead_type' => $this->input->post('calls_sb_lead_type'),
							'account_id' => $this->input->post('calls_sb_account_id'),
							'reason' => $this->input->post('reason'),
							'callback_time' => $this->input->post('start_date'),
							'status_type' => $this->input->post('status_type'),
							'alert_before_datetime' => $alert_before_time,
							'users_ids' => implode(',', $this->input->post('calls_sb_invitees')),
							'created_date' => DATETIME,
							'created_by' => $userId,
							'updated_date' => DATETIME,
							'status' => '1',
							'is_deleted' => '0'
						);
			$result = $this->common_model->insert('calls', $data);
			echo json_encode(array("status" => "success","message" => 'Calls Added Successfully.', "data" => $result));
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }
    public function get_calls(){
		$userId = $this->sessionData['logged_in'];
		$companyId = $this->sessionData['company_id'];
		$response =  $this->schedule_model->getCalls($userId,$companyId);
		//$response =  $this->common_model->getdata($selected = false, 'calls', $where = array('is_deleted' => 0,'created_by' => $userId), $limit = 100, $offset = false, $orderby=array('0'=>'id','1'=>'desc'));
		
		if(!empty($response))
		{	
			foreach ($response as $key => $value) 
			{
				$response[$key]->showtime = date('h:i',strtotime($value->callback_time));
				$response[$key]->showdate = date('l, F d, Y',strtotime($value->callback_time));
				$response[$key]->description = truncated_string($value->reason,100);
			}
			echo json_encode(array("status" => "success","message" => '', "data" => $response));
		}
		else
		{
			echo json_encode(array("status" => "success","message" => '', "data" => ''));
		}
	}
	/* USER CHAT */
	public function get_online_user(){
		$userId = $this->sessionData['logged_in'];
		$companyId = $this->sessionData['company_id'];
		$data = $this->schedule_model->get_online_users($companyId);
		if(!empty($data))
		{	
			echo json_encode(array("status" => "success","message" => '', "data" => $data));
		}
		else
		{
			echo json_encode(array("status" => "success","message" => '', "data" => ''));
		}
	}
	public function get_chat_history($f_userid,$t_userid){
		$userId = $this->sessionData['logged_in'];
		$companyId = $this->sessionData['company_id'];
		$data = $this->schedule_model->get_chat_history($f_userid,$t_userid);
		echo json_encode($data);
	}
}