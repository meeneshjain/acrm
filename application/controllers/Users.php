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
         $data['user_role'] = get_user_role_list('html', NULL);
         $data['loggedin_company_id'] = $this->sessionData['company_id'];
     //    $data['team_leaders'] = get_user_role_list('data', NULL);
         $this->load->view('include/header',$data);
         $this->load->view('user',$data);
         $this->load->view('include/footer');
     }
     
     public function get_all_users(){
       $response =  $this->user_model->get_all_users();
		echo json_encode($response);
		die;
	}
     
     public function save_update($id = NULL){
		 if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(empty($id) && $id == "" && $id == 0){
				$this->user_model->insert_user($post_data);
				$output = array("status" => "success","message" => 'User Inserted', "data" => "");
			} else {
				$this->user_model->update_user($post_data, $id);
				$output = array("status" => "success","message" => 'User Detail Updated', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
     }
     
     public function get_details($id){
		if($this->input->is_ajax_request()) {
			if(is_numeric($id) && !empty($id)) {
				$data = $this->user_model->get_details($id);
				$output = array("status" => "success","message" => '', "data" => $data);
			} else {
				$output = array("status" => "error","message" => 'User Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
    }
     
    public function delete_user($id){
		if($this->input->is_ajax_request()) {
			$id = $this->uri->segment(3);
			if(is_numeric($id) && !empty($id)) {
				$data = $this->user_model->delete_user($id);
				$output = array("status" => "success","message" => 'User Deleted Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'User Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
    }
     
     
}

?>