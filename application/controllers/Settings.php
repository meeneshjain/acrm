<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();

		$this->load->model("settings_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() {
        $data['page_title'] = 'Preferences';
        $data['breadcum_title'] = 'home';
        $data['active_sidemenu'] = "home";
        $data['load_js'] = 'setting';
         
        $data['user_role'] = get_user_role_list('data', NULL);
        $data['target_duration'] = get_target_duration_list('data', NULL);
        $data['subscription_plan'] = get_subscription_plan_list('data', NULL);
        $data['sales_stages'] = get_sales_stages_list('data', NULL);
         
        $data['all_stages'] = $this->settings_model->get_sales_stages();
        
        $this->load->view('include/header',$data);
        $this->load->view('settings',$data);
        $this->load->view('include/footer', $data);
     }
     
     public function all(){
         $this->index();
     }
     
     public function update_sale_stages(){
         $output= '';
         if($this->input->is_ajax_request()) {
			$post_data = $this->input->post(NULL, TRUE);
            if(!empty($post_data)){
                $response = $this->settings_model->update_sale_stages($post_data);
                if($response == 1){
                    $output = array("status" => "success","message" => 'Sale Stages Updated', "data" => "");    
                } else {
                    $output = array("status" => "error","message" => 'Unable to update, there was some error', "data" => "");    
                }
            } else {
                $output = array("status" => "error","message" => 'No Data Found', "data" => "");    
            }
		} else {
            $output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        } 
        echo json_encode($output);
        die;
     }
}