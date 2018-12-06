<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunity extends CI_Controller {
    
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
        $this->load->model('opportunity_model');
        $companyId = $this->sessionData['company_id'];
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $data['page_title'] = 'Opportunity';
        $data['breadcum_title'] = 'Opportunity';
        $data['active_sidemenu'] = "opportunity";
        $data['load_js'] = 'opportunity';

        $sales_stages = get_sales_stages_list_with_prob('special', '');
        $output = '';
        foreach($sales_stages as $value){
            $output.='<option value="'.$value['id'].'" data-probability="'.$value['probability'].'">'.ucfirst($value['name']).'</option>';
        }
        $data['sales_stages'] = $output;
        $data['data_source'] = base_url('opportunity/opportunitylist');
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

        $this->load->view('include/header',$data);
        $this->load->view('opportunity',$data);
        $this->load->view('include/footer');
    }



    public function opportunitylist()
    {
        //Recommit on git
        $this->load->model('opportunity_model');
        $user_role_id = $this->sessionData['user_role_id'];
        $userId = $this->sessionData['logged_in'];
        $companyId = $this->sessionData['company_id'];
        $response =  $this->opportunity_model ->opportunitylist($userId,$user_role_id,$companyId);
        echo json_encode($response);
        die;
    }

    
     
}

?>