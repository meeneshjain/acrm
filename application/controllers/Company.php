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
			echo json_encode(array("status" => "ERROR","message" => '<div class="alertmsg error"><span class="closeb">x</span><i class="fa fa-warning"></i> Unauthorized Access!</div>', "responseText" => ""));
		}
    }
    
	
	public function companylist(){
		$response =  $this->company_model->companylist();
		echo json_encode($response);
		die;
	}
}