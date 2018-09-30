<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    
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
        $companyId = $this->sessionData['company_id'];
        $data['page_title'] = 'Contact';
        $data['breadcum_title'] = 'Contact';
        $data['active_sidemenu'] = "contact";
        $data['load_js'] = 'contact';
        $data['data_source'] = base_url('contact/contactlist');
        $data['account_list'] = $this->common_model->getdata($selected = 'id,account_number,name','account', $where = array('is_deleted' => '0','status' => '1','company_id' => $companyId), $limit = false, $offset = false, $orderby=false);

        $this->load->view('include/header',$data);
        $this->load->view('contact',$data);
        $this->load->view('include/footer');
    }

    public function contactlist()
    {
        $this->load->model('contact_model');
        $companyId = $this->sessionData['company_id'];
        $response =  $this->contact_model->contactlist();
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
            //echo '{"total_count":"100","incomplete_results":"false",items" : [{"id":"1","text":"ACNT000001"},{"id":"2","text":"ACNT000002"},{"id":"3","text":"ACNT000003"},{"id":"4","text":"ACNT000004"},{"id":"5","text":"ACNT000005"},{"id":"6","text":"ACNT000006"},{"id":"7","text":"ACNT000007"},{"id":"8","text":"ACNT000008"},{"id":"9","text":"ACNT000009"},{"id":"10","text":"ACNT000010"},{"id":"11","text":"ACNT000011"},{"id":"12","text":"ACNT000012"},{"id":"13","text":"ACNT000013"},{"id":"14","text":"ACNT000014"},{"id":"15","text":"ACNT000015"},{"id":"16","text":"ACNT000016"},{"id":"17","text":"ACNT000017"},{"id":"18","text":"ACNT000018"},{"id":"19","text":"ACNT000019"},{"id":"20","text":"ACNT000020"},{"id":"21","text":"ACNT000021"},{"id":"22","text":"ACNT000022"},{"id":"23","text":"ACNT000023"},{"id":"24","text":"ACNT000024"},{"id":"25","text":"ACNT000025"},{"id":"26","text":"ACNT000026"},{"id":"27","text":"ACNT000027"},{"id":"28","text":"ACNT000028"},{"id":"29","text":"ACNT000029"}]}';

        }
    }

    public function add_update_account()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            //echo '<pre>';print_r($this->input->post());die;

            $data = array(
                            'account_id' => $this->input->post('account_name'),
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
                            'status' => '1',
                            'is_deleted' => '0',
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_by'] = $userId;
                $data['updated_date'] = DATETIME;

                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('contact_lead',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Contact Updated Successfully', "data" => ""));
            }
            else
            {
                $data['company_id'] = $companyId;
                $data['owner_id'] = $userId;
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
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

    public function edit_contact()
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

    public function checkDuplicate()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $id = $this->input->post('id');
            $column = $this->input->post('column');
            $value = $this->input->post('value');
            $msg = explode("_", $column);

            if(!empty($id))
            {
                $data = $this->common_model->customQueryCount("SELECT `id` FROM `account` WHERE `id` != '$id' AND `$column` = '$value' AND `company_id` = '$companyId'");
                if(!empty($data))
                {
                    echo json_encode(array("status" => "error","message" => 'Account already exist with same '.$value.' choose another '.$msg[0], "data" => ""));

                }
                else
                {
                    echo json_encode(array("status" => "success","message" => 'Account verified Successfully!!', "data" => ''));
                }
            }
            else
            {
                $data = $this->common_model->customQueryCount("SELECT `id` FROM `account` WHERE `$column` = '$value' AND `company_id` = '$companyId'");
                if(!empty($data))
                {
                    echo json_encode(array("status" => "error","message" => 'Account already exist with same '.$value.' choose another '.$msg[0], "data" => ""));
                }
                else
                {
                    echo json_encode(array("status" => "success","message" => 'Account verified Successfully!!', "data" => ''));
                }
            }
        }
    }

    public function changestats()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            $status = $this->uri->segment(4);

            if(is_numeric($id) && !empty($id))
            {
                if($status == 0){$dbstatus = 1;}else{$dbstatus = 0;}
                $data = array('status' => $dbstatus,'updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('account',$data,array('id' => $id));
                echo json_encode(array("status" => "success","message" => 'Account Status Change Successfully!!', "data" => ''));
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
    
     
}

?>