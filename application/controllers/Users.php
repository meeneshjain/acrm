<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("user_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() {
         $data['page_title'] = 'User';
         $data['breadcum_title'] = 'users';
         $data['active_sidemenu'] = "user";
         $data['load_js'] = 'user';
         $data['data_source'] = base_url('users/get_all_users');
         $this->load->view('include/header',$data);
         $this->load->view('user',$data);
         $this->load->view('include/footer');
     }
     
     public function insert_user(){
         
     }
     
     public function update_user(){
         
     }
     
     public function get_all_users(){
         
     }
     
}

?>