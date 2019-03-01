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
        $data['page_title'] = 'Target';
        $data['breadcum_title'] = 'Target';
        $data['active_sidemenu'] = "target";
        $data['load_js'] = 'target';

        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];

        $data['user_role'] = $user_role_id;

        $this->load->view('include/header',$data);
        $this->load->view('target',$data);
        $this->load->view('include/footer');
    }


    public function getRegionalManager()
    {
        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        //$data['data_source'] = base_url('target/targetlist');
        $data['target_duration'] = get_target_duration_list('html','');
        $data['downline_user'] =  $this->target_model->getDownlineUser($userId,$user_role_id);
        $this->load->view('target/rm_view',$data);
        return $data;
    }

    public function getTeamLeader()
    {
        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $data['data_source'] = base_url('target/targetlist');
        $data['target_duration'] = get_target_duration_list('html','');
        $data['my_target'] = $this->target_model->myTarget($userId,$user_role_id);
        $data['downline_user'] =  $this->target_model->getDownlineUser($userId,$user_role_id);
        $this->load->view('target/tl_view',$data);
        return $data;
    }

    public function getUsers()
    {
        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        //$data['data_source'] = base_url('target/targetlist');
        $data['target_duration'] = get_target_duration_list('html','');
        $data['my_target'] = $this->target_model->myTarget($userId,$user_role_id);
        $data['downline_user'] =  $this->target_model->getDownlineUser($userId,$user_role_id);
        $this->load->view('target/user_view',$data);
        return $data;
    }

    public function getDownlineUser()
    {
        $this->load->model('target_model');
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $companyId = $this->sessionData['company_id'];
        $response =  $this->target_model ->getDownlineUser($userId,$user_role_id);
        return $response;
    }

    public function getMyDownlineUser($userId,$user_role_id)
    {
        $this->load->model('target_model');
        $companyId = $this->sessionData['company_id'];
        $response =  $this->target_model ->getDownlineUser($userId,$user_role_id);
        if(isset($response) && !empty($response))
        {
            $i = 1;
            echo '<table class="table-bordered table table-sm m-table m-table--head-bg-brand">
                    <thead class="thead-inverse"><tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Target Title</th>
                        <th>Target</th>
                    </tr>
                </thead><tbody>';
            foreach ($response as $key => $value) 
            {
            echo '<tr><th scope="row">'.$i.'</th>';
            echo '<td>'.$value['first_name'].' '.$value['last_name'].'</td>';
            if(!empty($value['target']))
            {
            echo '<td>'.$value['target'][0]['target_title'].'</td>';
            echo '<td>'.$value['target'][0]['target'].'</td>';
            }
            else
            {  
            echo '<td colspan="2" class="text-center"><span class="text-danger">No target assign yet!</span></td>';
            }
            $i++;
            }
            echo '</tbody></table>';
        }
    }

    public function getTargetTable(){
        $output_html = "";

        return $output_html;
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

            //print_r($this->input->post());die;

            
            //$check_exist_target = 


            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['target_title'] = $this->input->post('trgt_name');
                $data['target'] = $this->input->post('trgt_target');
                $data['description'] = $this->input->post('trgt_description');
                $data['updated_by'] = $userId;
                $data['updated_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('targets',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Target Updated Successfully', "data" => ""));
            }
            else
            {
                $data['target_title'] = $this->input->post('trgt_name');
                $data['target_duration_id'] = $this->input->post('trgt_duration');
                $data['target_type'] = $this->input->post('trgt_type');
                $data['target'] = $this->input->post('trgt_target');
                $data['description'] = $this->input->post('trgt_description');
                $data['start_date'] = $this->input->post('trgt_start_date');
                $data['end_date'] = $this->input->post('trgt_end_date');
                $data['company_id'] = $companyId;
                $data['is_current_target'] = 1;
                $data['assign_to_user_id'] = $this->input->post('trgt_user_id');
                $data['report_to_user_id'] = $userId;
                $data['status'] = '1';
                $data['is_deleted'] = '0';
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;

                //echo '<pre>';print_r($data);die;
                $this->common_model->update_data('targets', array('is_current_target' => '0'),array('assign_to_user_id' => $this->input->post('trgt_user_id')));
                $result = $this->common_model->insert('targets', $data);
                //$account_id = $this->db->insert_id();
                echo json_encode(array("status" => "success","message" => 'Target Added Successfully.', "data" => ""));
            }
            die;

        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function assign_team_target()
    {
        if($this->input->is_ajax_request())
        {
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];

            $data = array();
            $result = '';

            $total_target = $_POST['total_target'];
            $assign_target = array_sum($_POST['target']);

            //echo '<pre>';print_r($_POST);die;

            if(isset($_POST['user_id']) && !empty($_POST['user_id']))
            {
                foreach ($_POST['user_id'] as $key => $value) 
                {
                    if(isset($_POST['target_db_id'][$key]) && !empty($_POST['target_db_id'][$key]))
                    {
                        $data = array(
                            'target_title' => $this->input->post('title')[$key],
                            'target' => $this->input->post('target')[$key],
                            'updated_by' => $userId,
                            'updated_date' => DATETIME
                        );
                        $where = array('id' => $_POST['target_db_id'][$key]);
                        $result = $this->common_model->update_data('targets',$data,$where);
                    }
                    else
                    {
                        $data = array(
                            'assign_to_user_id' => $value,
                            'company_id' => $companyId,
                            'report_to_user_id' => $userId,
                            'target_title' => $this->input->post('title')[$key],
                            'target_duration_id' => $this->input->post('target_duration'),
                            'target_type' => $this->input->post('target_type'),
                            'start_date' => $this->input->post('start_date'),
                            'is_current_target' => 1,
                            'end_date' => $this->input->post('end_date'),
                            'target' => $this->input->post('target')[$key],
                            'status' => '1',
                            'is_deleted' => '0',
                            'created_by' => $userId,
                            'created_date' => DATETIME
                        );
                        //echo '<pre>';print_r($data);die;
                        $this->common_model->update_data('targets', array('is_current_target' => '0'),array('assign_to_user_id' => $value));
                        $result = $this->common_model->insert('targets', $data);
                    }
                }

                $trgt_data = array(
                    'target_left' => $total_target - $assign_target
                );
                $where = array('id' => $this->input->post('my_target_id'));
                $result = $this->common_model->update_data('targets',$trgt_data,$where);
            }

            //echo $result;
            echo json_encode(array("status" => "success","message" => 'Target Added Successfully.', "data" => $result));die;
            /*echo '<pre>';print_r($data);
            echo '<pre>';print_r($this->input->post());die;
            $companyId = $this->sessionData['company_id'];
            $userId = $this->sessionData['logged_in'];
            echo '<pre>';print_r($this->input->post());die;

            $data = array(
                            'company_id' => $companyId,
                            'target_title' => $this->input->post('trgt_name'),
                            'target_duration_id' => $this->input->post('trgt_duration'),
                            'target_type' => $this->input->post('trgt_type'),
                            'amount' => $this->input->post('trgt_amount'),
                            'product' => $this->input->post('trgt_product'),
                            'description' => $this->input->post('trgt_description'),
                        );
            print_r($this->input->post());die;
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
                $data['assign_to_user_id'] = $this->input->post('trgt_user_id');
                $data['status'] = '1';
                $data['is_deleted'] = '0';
                $data['created_by'] = $userId;
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('targets', $data);
                $account_id = $this->db->insert_id();
                echo json_encode(array("status" => "success","message" => 'Target Added Successfully.', "data" => $result));
            }
            die;*/
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