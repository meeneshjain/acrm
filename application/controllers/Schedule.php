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

    public function update_detail(){
		if($this->input->is_ajax_request())
		{
			$this->company_model->update_detail();
			echo json_encode(array("status" => "success","message" => 'Company Detail Updated', "data" => ""));

		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
    }

    public function delete_company(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->company_model->delete_detail($id);
				echo json_encode(array("status" => "success","message" => 'Company Deleted Successfully!!', "data" => ''));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Company Id doesn\'t exist.', "data" => ""));
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
}