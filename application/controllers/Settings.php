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
        $data['is_super_admin']    = $this->sessionData['is_admin']; 
        $data['user_role']         = get_user_role_list('data', NULL);
        $data['target_duration']   = get_target_duration_list('data', NULL);
        $data['subscription_plan'] = get_subscription_plan_list('data', NULL);
        $data['sales_stages']      = get_sales_stages_list('data', NULL);
        $data['uom_list']          = get_uom_list('data', NULL);
        if($this->sessionData['is_admin'] == 1){ // super admin all email template from main template table
            $data['email_templates'] = get_all_email_templates('data', NULL);
        } else { 
            $data['email_templates'] = get_company_email_templates('data', NULL);
        }
        $data['view_needed_js'] = $data['load_js'];
        $data['all_stages'] = $this->settings_model->get_sales_stages();
        $data['email_constants'] = get_all_email_template_constants();
        $data['db_tables'] = get_all_db_table_n_category();
        $data['company_subdata_source'] = base_url("settings/get_company_subscription");
        $data['service_call_options'] = get_service_items(1 , 1, "");
        
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
     
     public function get_uom_list(){
         $output= '';
         if($this->input->is_ajax_request()) {
             $response = $this->settings_model->uom_list();
              $output = array("status" => "success","message" => 'UOM found', "data" => $response);    
         } else {
            $output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }  
        echo json_encode($output);
        die;
     }
     
     public function save_update_uom(){
		 if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            $this->settings_model->save_update_uom($post_data);
            $output = array("status" => "success","message" => 'Success', "data" => "");
			
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
     }
     
     public function delete_uom($uom_id){
          $output= '';
		if($this->input->is_ajax_request()) {
			$id = $this->uri->segment(3);
			if(is_numeric($uom_id) && !empty($uom_id)) {
				$data = $this->settings_model->delete_uom($uom_id);
				$output = array("status" => "success","message" => 'UOM Deleted Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'UOM Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
   
     }
     
     public function get_email_template_list(){
          if($this->sessionData['is_admin'] == 1){ // super admin all email template from main template table
            $email_templates          = get_all_email_templates('html', NULL);
        } else { 
            $email_templates          = get_company_email_templates('html', NULL);
        }
        $output = array("status" => "success","message" => 'Email Template list', "data" => $email_templates);
         echo json_encode($output);
        die;
     }
     
     public function get_email_template_content($template_key){
         $output= '';
         if($this->input->is_ajax_request()) {
             $response = $this->settings_model->get_email_template_content($template_key);
              $output = array("status" => "success","message" => 'Template details recieved', "data" => $response);    
         } else {
            $output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }  
        echo json_encode($output);
        die;
     }
     
     public function update_email_template(){
         $output= '';
         if($this->input->is_ajax_request()) {
			$post_data = $this->input->post(NULL, TRUE);
            if(!empty($post_data)){
                $response = $this->settings_model->update_email_template($post_data);
                if($response == 1){
                    $output = array("status" => "success","message" => 'Email Template Updated', "data" => "");    
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
     
     public function get_general_setting_details(){
        if($this->input->is_ajax_request()) {
            $serial_data  = $this->settings_model->get_general_setting_details();
            echo json_encode(array("status" => "success","message" => 'General Settings Found', "data" => $serial_data));
        } else {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
     }
     
    public function update_global_settings(){
        if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(!empty($post_data)){
                $response = $this->settings_model->update_global_settings($post_data);
                if($response  == 1 ){
                    $output = array("status" => "success","message" => 'global settings updated', "data" => "");    
                } else {
                    $output = array("status" => "error","message" => 'Unable to update, there was some error', "data" => "");    
                }
            } else {
                $output = array("status" => "error","message" => 'No Data Found', "data" => "");    
            }
        } else {
           $output =  array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
    }
    
    public function database_backup(){
         $get_data = $this->input->get(NULL, TRUE);
         if(!empty($get_data)){
            $response = $this->settings_model->database_backup($get_data);
            if($response  == 1 ){
                $output = array("status" => "success","message" => "", "data" => "");    
            } else {
                $output = array("status" => "error","message" => 'Unable to update, there was some error', "data" => "");    
            }
        } else {
            $output = array("status" => "error","message" => 'No Data Found', "data" => "");    
        }
  
        echo json_encode($output);    
    }
    
    public function get_company_subscription(){
          $response =  $this->settings_model->get_company_subscription();
		echo json_encode($response);
		die;
    }
    
    public function get_company_urole_permission($user_role_id){
          if($user_role_id!= ""){
                $permission_data = $this->settings_model->get_company_urole_permission($user_role_id);
                if($permission_data){
                    $output = array("status" => "success","message" => "", "data" => $permission_data);    
                } else {
                    $output = array("status" => "info","message" => 'No permission given to this user', "data" => "");    
                }
        } else {
            $output = array("status" => "error","message" => 'There was some error getting permission', "data" => ""); 
        }
        echo json_encode($output); 
    }
    
    public function update_company_urole_permission(){
         if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(!empty($post_data)){
                 $response = $this->settings_model->update_company_urole_permission($post_data);
                if($response  == 1 ){
                    $output = array("status" => "success","message" => $post_data['current_role_name'] . ' permission updated', "data" => "");    
                } else {
                    $output = array("status" => "error","message" => 'Unable to update, there was some error', "data" => "");    
                }
            } else {
                $output = array("status" => "error","message" => 'No Data Found', "data" => "");    
            }
        } else {
           $output =  array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
    }
    
    public function get_service_call_option_data($json_key){
          if($json_key!= ""){
            $sc_json_data = $this->settings_model->get_service_call_option_data($json_key);
            if($sc_json_data){
                $output = array("status" => "success","message" => "", "data" => $sc_json_data);    
            } else {
                $output = array("status" => "info","message" => 'No service call data', "data" => "");    
            }
        } else {
            $output = array("status" => "error","message" => 'There was some error getting service call option details', "data" => ""); 
        }
        echo json_encode($output); 
    }
    
    public function save_update_service_call_option($json_key){
         if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(!empty($post_data)){
                $response = $this->settings_model->save_update_service_call_option($json_key, $post_data);
                if($response  == 1 ){
                    $output = array("status" => "success","message" => 'Service Call Options Updated', "data" => "");    
                } else {
                    $output = array("status" => "error","message" => 'Unable to update, there was some error', "data" => "");    
                }
            } else {
                $output = array("status" => "error","message" => 'No Data Found', "data" => "");    
            }
        } else {
           $output =  array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        
    }
}