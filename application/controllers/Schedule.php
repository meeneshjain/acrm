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
			$data = array(
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
		$response =  $this->common_model->getdata($selected = false, 'notes', $where = false, $limit = false, $offset = false, $orderby=array('0'=>'created_date','1'=>'desc'));
		echo json_encode(array("status" => "success","message" => '', "data" => $response));
		die;
	}


	/* MEETING CODE GOES HERE */

	public function add_meeting(){
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
							'created_date' => DATETIME,
							'created_by' => '1',
							'updated_date' => DATETIME,
							'status' => '1',
							'is_deleted' => '0'
						);
			$result = $this->common_model->insert('meeting', $data);
			echo json_encode(array("status" => "success","message" => 'Meeting Added Successfully.', "data" => $result));

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
		$response =  $this->common_model->getdata($selected = false, 'meeting', $where = false, $limit = false, $offset = false, $orderby=array('0'=>'created_date','1'=>'desc'));
		echo json_encode(array("status" => "success","message" => '', "data" => $response));
		die;
	}

	/* TASK CODE GOES HERE */

	public function add_task(){
		if($this->input->is_ajax_request())
		{
			$data = array(
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'created_date' => DATETIME,
							'status' => '1',
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
		$response =  $this->common_model->getdata($selected = false, 'task', $where = array('status' => '1','is_deleted' => '0'), $limit = false, $offset = false, $orderby=array('0'=>'created_date','1'=>'desc'));
		echo json_encode(array("status" => "success","message" => '', "data" => $response));
		die;
	}
}