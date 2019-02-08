<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_form extends CI_Controller {
    
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
        $data['page_title'] = 'Enquiry Form';
        $data['breadcum_title'] = 'Enquiry Form';
        $data['active_sidemenu'] = "enquiryform";
        $data['load_js'] = 'enquiry';
        $data['data_source'] = base_url('enquiry_form/enquirylist');

        $companyId = $this->sessionData['company_id'];
        $data['item_list'] = $this->common_model->customQueryArray("SELECT `id`, `name`, `code` FROM `items` WHERE `company_id` = '$companyId'");

        $this->load->view('include/header',$data);
        $this->load->view('enquiry',$data);
        $this->load->view('include/footer');
    }


    public function enquirylist()
    {
        $account_permission = get_user_permission();
        $companyId = $this->sessionData['company_id'];
        $response =  $this->common_model->get_datatable_json("enquiry_form as ef",array( 'ef.id','ef.created_date','ef.organization','ef.account_manager','ef.mobile','ef.status'),array('is_deleted' => '0','company_id' => $companyId),"'id', 'DESC'");



        $row = array();
        foreach ($response['data'] as $key => $aRow) {
            
            $row[$key][] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="enquiry" id="enquiry_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="enquirychkbx"><span></span></label>';
            $row[$key][] = convert_db_date_time($aRow['created_date']);
            $row[$key][] = $aRow['organization'];
            $row[$key][] = $aRow['account_manager'];
            $row[$key][] = $aRow['mobile'];

            if($aRow['status'] == '0'){ 
                $row[$key][] = '<span class="m-badge m-badge--danger m-badge--wide changestats" data-id="'.$aRow['id'].'" data-status="'.$aRow['status'].'">Inactive</span>'; 
            }else{ $row[$key][] = '<span class="m-badge m-badge--success m-badge--wide changestats" data-id="'.$aRow['id'].'" data-status="'.$aRow['status'].'">Active</span>'; }
             

            $actn = '';
            $actn .= '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_enquiry" data-enquiry-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>';
                $actn .= ' <button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_enquiry" data-enquiry-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';
            if(in_array('enquiry_e',$account_permission)){
            }
            if(in_array('enquiry_d',$account_permission)){
            }

            $row[$key][] = $actn;

        }
        $response['data'] = $row;
        echo json_encode($response);
        die;
    }

    public function add_update_enquiry()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];

            $item_list = array();

            foreach ($_POST['item_ids'] as $key => $value) {
                $item_list['items'][] = array('id'=>$value,'name'=>$_POST['item_names'][$key],'quantity'=>$_POST['item_quantity'][$key]);
            }

            $data = array(
                            'company_id' => $companyId,
                            'organization' => $this->input->post('organization'),
                            'organization_short_name' => $this->input->post('organization_short_name'),
                            'account_manager' => $this->input->post('account_manager'),
                            'initiated_by' => $this->input->post('initiated_by'),
                            'web_address' => $this->input->post('web_address'),
                            'order_expected' => $this->input->post('order_expected'),
                            'state' => $this->input->post('state'),
                            'address' => $this->input->post('address'),
                            'email' => $this->input->post('email'),
                            'mobile' => $this->input->post('mobile'),
                            'enquiry_items' => json_encode($item_list,true),
                            'status' => '1',
                            'is_deleted' => '0',
                        );
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['created_by'] = $userId;
                $data['modified_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('enquiry_form',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Enquiry Updated Successfully', "data" => ""));
            }
            else
            {
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('enquiry_form', $data);
                $account_id = $this->db->insert_id();
                echo json_encode(array("status" => "success","message" => 'Enquiry Added Successfully.', "data" => $result));
            }
            die;
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_enquiry()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $userId = $this->sessionData['logged_in'];
                $data = $this->common_model->getdata($selected = 'id, organization, organization_short_name, account_manager, initiated_by, address, state, web_address, email, mobile, order_expected, enquiry_items, created_by','enquiry_form', $where = array('id' => $id,'company_id' => $companyId), $limit = false, $offset = false, $orderby=false);
                echo json_encode(array("status" => "success","message" => '', "data" => $data));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Enquiry Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function delete_enquiry()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = array('is_deleted' => '1','updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('enquiry_form',$data,array('id' => $id));
                echo json_encode(array("status" => "success","message" => 'Enquiry Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Enquiry Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function multiple_delete_enquiry(){
        if($this->input->is_ajax_request())
        {
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $data = array('is_deleted' => '1','updated_date' => DATETIME);
                    $res_data = $this->common_model->update_data('enquiry_form',$data,array('id' => $value));
                }
                echo json_encode(array("status" => "success","message" => 'Enquiry Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Enquiry Id doesn\'t exist.', "data" => ""));
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