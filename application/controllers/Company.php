<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();

		$this->load->model("home_model");
		$this->load->model("company_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() {
         $data['page_title'] = 'Dashboard';
         $data['breadcum_title'] = 'home';
         $data['active_sidemenu'] = "home";
         
         $this->load->view('include/header',$data);
         $this->load->view('company',$data);
         $this->load->view('include/footer');
	 }
    
    public function insert(){
		if($this->input->is_ajax_request())
		{
			$this->company_model->insert();
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
				echo json_encode(array("status" => "success","message" => 'Company Id doesn\'t exist.', "data" => $data));
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

	public function companylist(){
		$response =  $this->company_model->companylist();
		echo json_encode($response);
		die;
	}
}