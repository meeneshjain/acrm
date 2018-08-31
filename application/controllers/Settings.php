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
         
         
         
        $this->load->view('include/header',$data);
        $this->load->view('settings',$data);
        $this->load->view('include/footer');
     }
     
     public function all(){
         $this->index();
     }
}