<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("sales_model");
        $this->sessionData = $this->session->userdata();
        check_session();
    }
    
    public function quotation() {
         $data['page_title'] = 'Sales Quotation';
         $data['breadcum_title'] = 'users';
         $data['active_sidemenu'] = "sales_quotation";
         $data['main_title'] = $data['page_title'];
         $data['popup_title'] = "Add ". $data['page_title'];
         $data['load_js'] = 'sales';
         $data['page_type'] = "sales_quote";
         $data['sales_employee_name'] = $this->sessionData['full_name'];
         $data['data_source'] = base_url('users/get_all_quotation');
         $data['account_numbers'] = get_account_number('html', NULL);
         $data['loggedin_company_id'] = $this->sessionData['company_id'];
         $this->load->view('include/header',$data);
         $this->load->view('sales',$data);
         $this->load->view('include/footer');
     }
     
      public function order() {
         $data['page_title'] = 'Sales Order';
         $data['breadcum_title'] = 'users';
         $data['active_sidemenu'] = "sales_order";
         $data['main_title'] = $data['page_title'];
         $data['popup_title'] = "Add ". $data['page_title'];
         $data['load_js'] = 'sales';
         $data['page_type'] = "sales_order";
         $data['data_source'] = base_url('users/get_all_order');
         $data['loggedin_company_id'] = $this->sessionData['company_id'];
         $data['sales_employee_name'] = $this->sessionData['full_name'];
         $this->load->view('include/header',$data);
         $this->load->view('sales',$data);
         $this->load->view('include/footer');
     }
     
     public function get_all_quotation(){
       $response =  $this->sales_model->get_all_quotation();
		echo json_encode($response);
		die;
    }
    
    public function get_all_order(){
       $response =  $this->sales_model->get_all_order();
		echo json_encode($response);
		die;
    }
    
     public function get_sales_data($company_id = NULL){
          if($this->input->is_ajax_request()) {
              if(empty($company_id) && $company_id == "" && $company_id == 0){
                  $output = array("status" => "error","message" => 'Company ID missing ', "data" => "");
                } else {
                    $docNumber = $this->sales_model->get_sales_data($company_id);
                    $account_list = $this->sales_model->get_account_list($company_id);
				     $output = array("status" => "success","message" => 'Document Number Generated', "doc_number" => $docNumber, 'account_list'=>$account_list, 'sale_employees'=> $this->sessionData['full_name']);
                }
              } else {
		    	$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
            }
        echo json_encode($output);
        exit;
     }
     
     function get_account_contacts($account_id){
        if($this->input->is_ajax_request()) {
             if(empty($account_id) && $account_id == "" && $account_id == 0){
                  $output = array("status" => "error","message" => 'Account ID missing ', "data" => "");
                } else {
                     $contact_list = $this->sales_model->get_account_contacts($account_id);
				     $output = array("status" => "success","message" => 'Contact List Generated', 'contact_list'=>$contact_list);
                }
        } else {
		   	$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
     }
}