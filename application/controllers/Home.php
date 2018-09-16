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
    
    public function login() {
		if($this->session->userdata('logged_in')=='1'){
			redirect("home/");
		}
		$data['page_title']="Login";
		$data['form_url'] = base_url("home/login_check");
		
		$this->load->view('include/front_header',$data);
		$this->load->view('login',$data);
		$this->load->view('include/front_footer');
		echo '';
    }
    
     public function dashboard() {
         check_session();
         $data['page_title'] = 'Dashboard';
         $data['breadcum_title'] = 'home';
         $data['active_sidemenu'] = "home";
		 $data['load_js'] = 'dashboard';
         $this->load->view('include/header',$data);
         $this->load->view('home',$data);
         $this->load->view('include/footer');	
    }
    
    
    public function login_check(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$login_check =  $this->home_model->login_check($username,$password);
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
		$this->session->unset_userdata('is_admin');
		$this->session->unset_userdata('user_role');
		$this->session->unset_userdata('full_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged_in');
		redirect("home/login");
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

}