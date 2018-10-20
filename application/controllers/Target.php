<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target extends CI_Controller {
    
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
        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $data['page_title'] = 'Target';
        $data['breadcum_title'] = 'Target';
        $data['active_sidemenu'] = "target";
        $data['load_js'] = 'target';
        $data['data_source'] = base_url('target/targetlist');
        $data['target_duration'] = get_target_duration_list('html','');

        $this->load->view('include/header',$data);
        $this->load->view('target',$data);
        $this->load->view('include/footer');
    }



    public function targetlist()
    {
        $this->load->model('target_model');
        //$user_role_id = $this->sessionData['user_role_id'];
        //$userId = $this->sessionData['logged_in'];
        $companyId = $this->sessionData['company_id'];
        $response =  $this->target_model ->targetlist($companyId);
        echo json_encode($response);
        die;
    }

    public function add_update_target()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            //echo '<pre>';print_r($this->input->post());die;

            $data = array(
                            'company_id' => $companyId,
                            'name' => $this->input->post('trgt_name'),
                            'target_duration_id' => $this->input->post('trgt_duration'),
                            'target_type' => $this->input->post('trgt_type'),
                            'target' => $this->input->post('trgt_amount'),
                            'product_id' => $this->input->post('trgt_product'),
                            'description' => $this->input->post('trgt_description'),
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_by'] = $userId;
                $data['updated_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('targets',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Target Updated Successfully', "data" => ""));
            }
            else
            {
                $data['status'] = '1';
                $data['is_deleted'] = '0';
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('targets', $data);
                $account_id = $this->db->insert_id();
                echo json_encode(array("status" => "success","message" => 'Target Added Successfully.', "data" => $result));
            }
            die;

        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_target()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $userId = $this->sessionData['logged_in'];
                $data = $this->common_model->getdata($selected = '*','targets', $where = array('id' => $id,'company_id' => $companyId), $limit = false, $offset = false, $orderby=false);
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

    
     
}

?>