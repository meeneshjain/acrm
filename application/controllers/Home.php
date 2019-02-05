<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();

		$this->load->model("home_model");
		$this->sessionData = $this->session->userdata();
	}
    
    public function index() {
		$this->dashboard();
	 }
	 
	public function page_not_found(){
		 $data['page_title']="Page Not Found";	
		$this->output->set_status_header('404'); 
		$this->load->view('include/front_header',$data);
		$this->load->view('page_not_found');
		$this->load->view('include/front_footer');
	}
    
    public function login($user_type = NULL) {
		if($user_type == ""){
			$this->page_not_found();
		} else {
			if($this->session->userdata('logged_in')=='1'){
				redirect($user_type."/");
				
			}
			$data['user_type'] = $user_type;
			if($user_type == "admin"){
				$data['page_title']="Administrator Login";
			} else if($user_type == "user"){
				$data['page_title']="User Login";
			}
			$data['form_url'] = base_url("home/login_check/$user_type");
			
			$this->load->view('include/front_header',$data);
			$this->load->view('login',$data);
			$this->load->view('include/front_footer');
		}
    }
    
     public function dashboard($user_type = NULL) {
		 
			check_session($user_type);
			$data['page_title'] = 'Dashboard';
			$data['breadcum_title'] = 'home';
			$data['active_sidemenu'] = "home";
			$data['load_js'] = 'dashboard';
			$data['company_options'] =  get_company_list('html', '');
			$data['top_bar_report'] =  $this->home_model->top_bar_report();
			$data['is_super_admin'] = $this->sessionData['is_admin'];
			$data['user_role_id'] = $this->sessionData['user_role_id'];
			$this->load->view('include/header',$data);
			$this->load->view('home',$data);
			$this->load->view('include/footer');		
	}
	
	public function service_call_report(){
	   $response =  $this->home_model->service_call_report();
	   	echo json_encode(array("status" =>'success',"message" => 'Report generated', "data" => $response));
	   die;
    }
    
    
    public function login_check($user_type = NULL){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$login_check =  $this->home_model->login_check($username,$password, $user_type);
		if($login_check['status'] == 1){
			
			$session_data = array(
				"is_admin"       => $login_check['is_super_admin'],
				// "user_role"   => $login_check['row']['user_role'],
				'full_name'      => $login_check['row']['first_name']. ' '. $login_check['row']['last_name'],
				'user_role_id'   => (isset($login_check['row']['user_role_id']) && $login_check['row']['user_role_id']!="") ? $login_check['row']['user_role_id'] : "",
				'company_id'     => (isset($login_check['row']['company_id']) && $login_check['row']['company_id']!="") ? $login_check['row']['company_id'] : "",
				'email'          => $login_check['row']['username'],
				'logged_in'      => $login_check['row']['id'],
			);

			$this->session->set_userdata($session_data);
			$status =  'success';
			$status_message = "";
		} else  {
			$status =  'invalid';
			$status_message = "Invalid login credentials, Please try again or contact your system administrator ";
		}
		echo json_encode(array("status" => $status,"message" => $status_message, "redirect_url" => base_url("home")));
		exit;
    }
    
    public function logout(){
		if($this->session->userdata('is_admin') == "1" ){
			$url = "admin/login";
		} else {
			$url = "user/login";
		}
		$this->session->unset_userdata('is_admin');
		$this->session->unset_userdata('user_role');
		$this->session->unset_userdata('full_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		redirect($url);
	} 
    
	
	public function server_side_example(){
		$response =  $this->home_model->server_side_example();
		echo json_encode($response);
		die;
	}
	
	public function upload($folder_name) {
		check_session();
		echo upload_images('image_upload', $folder_name);
	}

	public function remove_image() {
		check_session();
		$fileName = $this->input->get('filepath');
		if (unlink($fileName)) {
			echo 1;
		}
		else {
			echo 0;
		}
	}
	
	public function target_vs_achivement_report($current_user_id){
		$response =  $this->home_model->target_vs_achivement_report($current_user_id);
	 	echo json_encode(array("status" =>'success',"message" => 'Target Report generated', "data" => $response));
	    die;
	}
	
	public function get_rm_list($company_id = 0){
		if($this->input->is_ajax_request()) {
			$rm_data  = $this->home_model->get_rm_list($company_id);
            echo json_encode(array("status" => "success","message" => 'RM List', "data" => $rm_data));;
		} else {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
	}
	
	

}