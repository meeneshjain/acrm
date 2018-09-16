<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("company_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() {
         $data['page_title'] = 'View Company';
         $data['breadcum_title'] = 'home';
         $data['active_sidemenu'] = "company";
         $data['load_js'] = 'company';
         $data['subscription_plan'] = get_subscription_plan_list("html", $selected_value = NULL);
         $this->load->view('include/header',$data);
         $this->load->view('company',$data);
         $this->load->view('include/footer');
	}
	 
	public function save_update($id = NULL){
		if($this->input->is_ajax_request())
		{
			if(empty($id) && $id == ""){
				$this->company_model->insert();
				echo json_encode(array("status" => "success","message" => 'Company Inserted', "data" => ""));
			} else {
				$this->company_model->update_detail();
				echo json_encode(array("status" => "success","message" => 'Company Detail Updated', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
	}

    public function edit_detail(){
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id))
			{
				$data = $this->company_model->edit_detail($id);
				echo json_encode(array("status" => "success","message" => '', "data" => $data));
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

    public function multiple_delete_company(){
		if($this->input->is_ajax_request())
		{
			$get_data = $this->input->get('ids', TRUE);
			
			if(!empty($get_data))
			{
				$ids = explode(',', $get_data);
				foreach ($ids as $key => $value) 
				{
					$data = $this->company_model->delete_detail($value);
				}
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

	public function companylist(){
		$response =  $this->company_model->companylist();
		echo json_encode($response);
		die;
	}

	public function check_prefix()
	{
		if($this->input->is_ajax_request())
		{
			$id = $this->uri->segment(3);
			$prefix = strtoupper($this->uri->segment(4));
			$data = $this->company_model->check_prefix($prefix,$id);
			if($data == 0)
			{
				echo json_encode(array("status" => "success","message" => 'Company Prefix Approved Successfully!!', "data" => ''));
			}
			else
			{
				echo json_encode(array("status" => "error","message" => 'Company Prefix exist, Please choose another', "data" => ""));
			}
		}
		else
		{
			echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
		}
	}
}