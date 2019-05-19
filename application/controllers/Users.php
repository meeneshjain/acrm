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
         $data['loggedin_company_id'] = get_current_company();
         $data['tl_data'] = $this->user_model->get_user_list_by_role($data['loggedin_company_id'], '3');
         $data['tl_options'] = "";
         if($data['tl_data'] != 0){
             foreach($data['tl_data'] as $team_leads){
                 $tl_name = $team_leads['first_name'] . ' ' . $team_leads['last_name'];
                 $data['tl_options'] .= '<option value="'.$team_leads['id'].'">'.$tl_name.'</option>';
                }
         }
                  
         $data['rm_data'] = $this->user_model->get_user_list_by_role($data['loggedin_company_id'],  '2');
         $data['rm_options'] = "";
         if($data['rm_data'] != 0){
             foreach($data['rm_data'] as $rm){
                 $tl_name = $rm['first_name'] . ' ' . $rm['last_name'];
                 $data['rm_options'] .= '<option value="'.$rm['id'].'">'.$tl_name.'</option>';
            }
        }
        $data['current_subscription_details'] = $this->user_model->current_subscription_details($data['loggedin_company_id']);
         $this->load->view('include/header',$data);
         $this->load->view('user',$data);
         $this->load->view('include/footer');
     }
     
    public function get_all_users(){
        if($this->session->userdata('is_admin') == 1){
            $companyId = 'SA'; // Super admin
		}else{
            $companyId = get_current_company();
		}
        $response =  $this->user_model->get_all_users($companyId);
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
     
     public function get_employee_user_name($company_id = NULL){
          if($this->input->is_ajax_request()) {
              if(empty($company_id) && $company_id == "" && $company_id == 0){
                  $output = array("status" => "error","message" => 'Company ID missing ', "data" => "");
                } else {
                    $employeeID = $this->user_model->get_employee_user_name($company_id);
                    $current_subscription = $this->user_model->current_subscription_details($company_id);
                    $output = array("status" => "success","message" => 'Employee Code Generated', "data" => $employeeID, 'current_subscription'=> $current_subscription);
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
                $option = "";
                if( $data['user_role_id'] == "4" ||  $data['user_role_id'] == "3"){
                    $text = "";
                    if($data['user_role_id'] == 4){
                    $text = "Assign Team Lead";
                        $reports_to_manager_role =  3;
                    } else if($data['user_role_id'] == 3){
                    $text = "Assign Regional Manager";
                        $reports_to_manager_role =  2;
                    }
                    
                    $reports_to_detail['tl_data'] = $this->user_model->get_user_list_by_role($data['company_id'], $reports_to_manager_role);
                    if($reports_to_detail['tl_data'] != 0){
                        $option = '<option value="">'. $text.'</option>';
                        foreach($reports_to_detail['tl_data'] as $re_to){
                            $rto_name = $re_to['first_name'] . '' . $re_to['last_name'];
                            $selected = "";
                            if($re_to['id'] == $data['reports_to_user_id']){
                                $selected = 'selected';
                            }
                            $option .= '<option value="'.$re_to['id'].'" '.$selected.'>'.$rto_name.'</option>';
                        }
                    }
                } 
				$output = array("status" => "success","message" => '', "data" => $data, 'reports_to_list' => $option);
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

    public function multiple_delete_users(){
        if($this->input->is_ajax_request())
        {
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $data = $this->user_model->delete_user($value);
                }
                echo json_encode(array("status" => "success","message" => 'Users Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Users Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function user_profile()
    {
    	$companyId = get_current_company();
    	$userId = $this->sessionData['logged_in'];
        $is_super_admin = $this->sessionData['is_admin'];
    	//print_r($this->sessionData);

    	$data['page_title'] = 'User Profile';
        $data['breadcum_title'] = 'User Profile';
        $data['active_sidemenu'] = "";
        $data['load_js'] = 'user';

        $data['is_super_admin'] = $is_super_admin;

        if($is_super_admin == '1')
        {
            $data['userdetail'] = $this->user_model->admin_detail($userId);
            $data['user_role_id'] = "";
        }
        else
        {
            $data['userdetail'] = $this->user_model->user_detail($companyId,$userId);
            $data['user_role_id'] =  $data['userdetail']['user_role_id'];
            $data['current_subscription_details'] = $this->user_model->current_subscription_details($data['userdetail']['company_id']);
         //   print_r($data['current_subscription_details']); die;
            $data['user_activities_data_source'] = base_url('users/get_activities');    
        }

        //$data['user_role'] = get_user_role_list('html', NULL);
        //$data['loggedin_company_id'] = get_current_company();
        //$data['team_leaders'] = get_user_role_list('data', NULL);
        $this->load->view('include/header',$data);
        $this->load->view('userprofile',$data);
        $this->load->view('include/footer');
    }

    public function user_profile_update()
    {
    	if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $is_super_admin = $this->sessionData['is_admin'];
			if(is_numeric($id) && !empty($id)) {
				$post_data = $this->input->post(NULL, TRUE);
                if($is_super_admin == 1)
                {
                    $data = $this->user_model->admin_profile_update($post_data,$id);
                }
                else
                {
				    $data = $this->user_model->user_profile_update($post_data,$id);
                }
				$output = array("status" => "success","message" => 'User Updated Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'User Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
    }

    public function change_password()
    {
    	if($this->input->is_ajax_request()) {

			$id = $this->input->post('user_id');
            $is_super_admin = $this->sessionData['is_admin'];
			if(is_numeric($id) && !empty($id)) {
				$post_data = $this->input->post(NULL, TRUE);
                if($is_super_admin == 1)
                {
                    $output = $this->user_model->admin_change_password($post_data,$id);
                }
                else
                {
				    $output = $this->user_model->change_password($post_data,$id);
                }
				//$output = array("status" => "success","message" => 'User Updated Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'User Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
    }
     
    public function get_activities()
   	{
   		$companyId = get_current_company();
    	$userId = $this->sessionData['logged_in'];
    	$response =  $this->user_model->get_activities($companyId,$userId);
		echo json_encode($response);
		die;

   	}
     
}

?>