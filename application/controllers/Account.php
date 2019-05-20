<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    
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
        $data['page_title'] = 'Account';
        $data['breadcum_title'] = 'Account';
        $data['active_sidemenu'] = "account";
        $data['load_js'] = 'account';
        $data['data_source'] = base_url('account/accountlist');

        $this->load->view('include/header',$data);
        $this->load->view('account',$data);
        $this->load->view('include/footer');
    }

    public function accountlist()
    {
        $account_permission = get_user_permission();

        if($this->session->userdata('is_admin') == 1){
            $companyId = $this->sessionData['company_id'];
            $response =  $this->common_model->get_datatable_json("account as a",array( 'a.id', 'a.account_number', 'a.name', 'a.description', 'a.contact_no_1', 'a.email_1', 'a.created_date', 'a.status'),array('is_deleted' => '0'),"'id', 'DESC'");
        }else{
            $companyId = $this->sessionData['company_id'];
            $response =  $this->common_model->get_datatable_json("account as a",array( 'a.id', 'a.account_number', 'a.name', 'a.description', 'a.contact_no_1', 'a.email_1', 'a.created_date', 'a.status'),array('is_deleted' => '0','company_id' => $companyId),"'id', 'DESC'");
        }


        //echo '<PRE>';print_r($response['data']);die;


        $row = array();
        foreach ($response['data'] as $key => $aRow) {
            
            $row[$key][] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="acnt" id="acnt_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="acntchkbx"><span></span></label>';
            $row[$key][] = $aRow['account_number'];
            $row[$key][] = $aRow['name'];
            $row[$key][] = $aRow['email_1'];
            $row[$key][] = $aRow['contact_no_1'];
            $row[$key][] = convert_db_date_time($aRow['created_date']);

            if($aRow['status'] == '0'){ 
                $row[$key][] = '<span class="m-badge m-badge--danger m-badge--wide changestats" data-id="'.$aRow['id'].'" data-status="'.$aRow['status'].'">Inactive</span>'; 
            }else{ $row[$key][] = '<span class="m-badge m-badge--success m-badge--wide changestats" data-id="'.$aRow['id'].'" data-status="'.$aRow['status'].'">Active</span>'; }
             

            $actn = '';
            if(in_array('acnt_e',$account_permission)){
                $actn .= '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_account" data-acnt-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>';
            }
            if(in_array('acnt_d',$account_permission)){
                $actn .= ' <button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_account" data-acnt-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';
            }

            $row[$key][] = $actn;

        }
        $response['data'] = $row;
        echo json_encode($response);
        die;
    }

    public function add_update_account()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            //echo '<pre>';print_r($this->input->post());die;

            $data = array(
                            'company_id' => $companyId,
                            'name' => $this->input->post('name'),
                            'contact_no_1' => $this->input->post('contact_no_1'),
                            'contact_no_2' => $this->input->post('contact_no_2'),
                            'email_1' => $this->input->post('email_1'),
                            'email_2' => $this->input->post('email_2'),
                            'address' => $this->input->post('address'),
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
                $this->common_model->update_data('account',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Account Updated Successfully', "data" => ""));
            }
            else
            {
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('account', $data);
                $account_id = $this->db->insert_id();

                $code = "ACNT".str_pad($account_id, 6, '0', STR_PAD_LEFT);
                $where = array('id' => $account_id);
                $this->common_model->update_data('account',array('account_number'=>$code),$where);
                echo json_encode(array("status" => "success","message" => 'Account Added Successfully.', "data" => $result));
            }
            die;

        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_account()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $userId = $this->sessionData['logged_in'];
                $data = $this->common_model->getdata($selected = 'id,account_number,name,contact_no_1,contact_no_2,email_1,email_2,description,address,status,created_date','account', $where = array('id' => $id,'company_id' => $companyId), $limit = false, $offset = false, $orderby=false);
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

    public function delete_account()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = array('is_deleted' => '1','updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('account',$data,array('id' => $id));
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

    public function multiple_delete_account(){
        if($this->input->is_ajax_request())
        {
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $data = array('is_deleted' => '1','updated_date' => DATETIME);
                    $res_data = $this->common_model->update_data('account',$data,array('id' => $value));
                }
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