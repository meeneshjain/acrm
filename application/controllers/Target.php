<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends CI_Controller {
    
    public $sessionData;
	public function __construct()
    {
		parent::__construct();
		$this->load->model("common_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() 
    {
        //$this->load->model('opportunity_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $data['page_title'] = 'Target';
        $data['breadcum_title'] = 'Target';
        $data['active_sidemenu'] = "opportunity";
        //$data['load_js'] = 'Target';


        $this->load->view('include/header',$data);
        $this->load->view('target',$data);
        $this->load->view('include/footer');
    }



    public function opportunitylist()
    {
        $this->load->model('opportunity_model');
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $companyId = $this->sessionData['company_id'];
        $response =  $this->opportunity_model ->opportunitylist($userId,$user_role_id,$companyId);
        echo json_encode($response);
        die;
    }

    
     
}

?>