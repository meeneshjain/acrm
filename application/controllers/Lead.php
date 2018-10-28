<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Controller {
    
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
        $this->load->model('lead_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $data['page_title'] = 'Lead';
        $data['breadcum_title'] = 'Lead';
        $data['active_sidemenu'] = "lead";
        $data['load_js'] = 'lead';

        $sales_stages = get_sales_stages_list_with_prob('special', '');
        $output = '';
        foreach($sales_stages as $value){
            $output.='<option value="'.$value['id'].'" data-probability="'.$value['probability'].'">'.ucfirst($value['name']).'</option>';
        }
        $data['sales_stages'] = $output;
        $data['data_source'] = base_url('lead/leadlist');
        $data['account_list'] = $this->common_model->getdata($selected = 'id,account_number,name','account', $where = array('is_deleted' => '0','status' => '1','company_id' => $companyId), $limit = false, $offset = false, $orderby=false);
        
        /* 
            # BELOW FUNCTION WRITTEN IN COMMON MODEL#
            @function : user_list_role_wise()
            @param1 : logged user id
            @param2 : logged company id
            @param3 : user role id and it use for get his/her downline users
            @param4 : get selected user 
        */
        $data['user_list'] = user_list_role_wise($userId,$companyId,$user_role_id,'');
        $data['lead_source'] = get_lead_source('select');
        $data['opp_type'] = get_opportunity_type('select');

        $this->load->view('include/header',$data);
        $this->load->view('lead',$data);
        $this->load->view('include/footer');
    }



    public function leadlist()
    {
        $this->load->model('lead_model');
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $companyId = $this->sessionData['company_id'];
        $response =  $this->lead_model->leadlist($userId,$user_role_id,$companyId);
        echo json_encode($response);
        die;
    }

    public function account_list()
    {
        if($this->input->is_ajax_request())
        {
            $data = array();
            $companyId = $this->sessionData['company_id'];
            $account_list = $this->common_model->getdata($selected = 'id,account_number as text','account', $where = array('is_deleted' => '0','status' => '1','company_id' => $companyId), $limit = false, $offset = false, $orderby= false);

            $record = json_decode(json_encode($account_list),true);
            
            //$data['total_count'] = count($record);
            //$data['incomplete_results'] = false;
            //$data['items'] = $record;
            echo json_encode($record);die;
        }
    }

    public function user_list()
    {
        
    }

    public function add_update_lead()
    {
        if($this->input->is_ajax_request())
        {

            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            //echo '<pre>';print_r($this->input->post());die;

            $data = array(
                            'first_name' => $this->input->post('first_name'),
                            'last_name' => $this->input->post('last_name'),
                            'mobile' => $this->input->post('mobile'),
                            'email_1' => $this->input->post('email_1'),
                            'other_contact' => $this->input->post('other_contact'),
                            'other_email' => $this->input->post('other_email'),
                            'title' => $this->input->post('title'),
                            'fax' => $this->input->post('fax'),
                            'department' => $this->input->post('department'),
                            'website_url' => $this->input->post('website_url'),
                            'primary_address' => $this->input->post('primary_address'),
                            'primary_city' => $this->input->post('primary_city'),
                            'primary_state' => $this->input->post('primary_state'),
                            'primary_pincode' => $this->input->post('primary_pincode'),
                            'primary_country' => $this->input->post('primary_country'),
                            'secondary_address' => $this->input->post('secondary_address'),
                            'secondary_city' => $this->input->post('secondary_city'),
                            'secondary_state' => $this->input->post('secondary_state'),
                            'secondary_pincode' => $this->input->post('secondary_pincode'),
                            'secondary_country' => $this->input->post('secondary_country'),
                            'description' => $this->input->post('description'),
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_by'] = $userId;
                $data['owner_id'] = $this->input->post('owner_id');
                $data['updated_date'] = DATETIME;

                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('contact_lead',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Contact Updated Successfully', "data" => ""));
            }
            else
            {
                $data['company_id'] = $companyId;
                $data['owner_id'] = $userId;
                $data['is_type'] = '1';
                $data['status'] = '1';
                $data['is_deleted'] = '0';
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
                $data['account_id'] = $this->input->post('account_name');

                $result = $this->common_model->insert('contact_lead', $data);

                echo json_encode(array("status" => "success","message" => 'Contact Added Successfully.', "data" => $result));
            }
            die;
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_lead()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $userId = $this->sessionData['logged_in'];
                
                $data = $this->common_model->getdata($selected = '*','contact_lead', $where = array('id' => $id,'company_id' => $companyId), $limit = false, $offset = false, $orderby=false);
                echo json_encode(array("status" => "success","message" => '', "data" => $data));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Account Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function delete_contact()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $userId = $this->sessionData['logged_in'];
                $data = array('updated_by' => $userId,'status'=>'0','is_deleted' => '1','updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('contact_lead',$data,array('id' => $id));
                echo json_encode(array("status" => "success","message" => 'Account Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Account Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function multiple_delete_contact(){
        if($this->input->is_ajax_request())
        {
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $userId = $this->sessionData['logged_in'];
                    $data = array('updated_by' => $userId,'status'=>'0','is_deleted' => '1','updated_date' => DATETIME);
                    $res_data = $this->common_model->update_data('contact_lead',$data,array('id' => $value));
                }
                echo json_encode(array("status" => "success","message" => 'Contact Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Contact Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    
    public function convert_contact_to_lead(){
        if($this->input->is_ajax_request())
        {
            $assign_to = $this->input->get('assign_to',TRUE);
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $userId = $this->sessionData['logged_in'];
                    $data = array(
                                    'owner_id' => $assign_to,
                                    'updated_by' => $userId,
                                    'is_type'=> '1',
                                    'assign_date' => DATETIME,
                                    'convert_lead_date' => DATETIME
                                );
                    $res_data = $this->common_model->update_data('contact_lead',$data,array('id' => $value));
                }
                echo json_encode(array("status" => "success","message" => 'Contact Converted to lead Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Contact Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function checkDuplicate()
    {
        if($this->input->is_ajax_request())
        {
            //print_r($_POST);die;
            $companyId = $this->sessionData['company_id'];
            $id = $this->input->post('id');
            $account_id = $this->input->post('account_id');
            $column = $this->input->post('column');
            $value = $this->input->post('value');
            $msg = explode("_", $column);

            if(!empty($id))
            {
                $data = $this->common_model->customQueryCount("SELECT `id` FROM `contact_lead` WHERE `id` != '$id' AND `$column` = '$value' AND `company_id` = '$companyId' AND `account_id` = '$account_id'");
                if(!empty($data))
                {
                    echo json_encode(array("status" => "error","message" => 'Contact already exist with same '.$value.' choose another '.$msg[0], "data" => ""));

                }
                else
                {
                    echo json_encode(array("status" => "success","message" => 'Contact verified Successfully!!', "data" => ''));
                }
            }
            else
            {
                $data = $this->common_model->customQueryCount("SELECT `id` FROM `contact_lead` WHERE `$column` = '$value' AND `company_id` = '$companyId' AND `account_id` = '$account_id'");
                if(!empty($data))
                {
                    echo json_encode(array("status" => "error","message" => 'Contact already exist with same '.$value.' choose another '.$msg[0], "data" => ""));
                }
                else
                {
                    echo json_encode(array("status" => "success","message" => 'Contact verified Successfully!!', "data" => ''));
                }
            }
        }
    }


    public function convert_to_opportunity()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            //echo '<PRE>';print_r($_POST);
            $data = array(
                            'opp_currency' => $this->input->post('oppr_currency'),
                            'opp_close_date' => $this->input->post('oppr_close_date'),
                            'opp_amount' => $this->input->post('oppr_amount'),
                            'opp_type' => $this->input->post('oppr_type'),
                            'opp_sales_stage' => $this->input->post('oppr_stage'),
                            'opp_probability' => $this->input->post('oppr_probability'),
                            'opp_lead_source' => $this->input->post('oppr_source'),
                            'opp_next_step' => $this->input->post('oppr_next_step'),
                            'opp_description' => $this->input->post('oppr_description')
                        );
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['is_type'] = '2';
                $data['updated_by'] = $userId;
                $data['updated_date'] = DATETIME;
                $data['convert_oppr_date'] = DATETIME;

                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('contact_lead',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Lead Converted to Opportunity Successfully', "data" => ""));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Something went wrong please check.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }
    
     
}

?>