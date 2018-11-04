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
         $data['breadcum_title'] = 'sales';
         $data['active_sidemenu'] = "sales_quotation";
         $data['main_title'] = $data['page_title'];
         $data['popup_title'] = "Add ". $data['page_title'];
         $data['load_js'] = 'sales';
         $data['page_type'] = "sales_quote";
         $data['sales_employee_id'] = get_current_user_id();
         $data['sales_employee_name'] = $this->sessionData['full_name'];
         $data['data_source'] = base_url('sales/get_all_sales/'.$data['page_type']);
         $data['account_numbers'] = get_account_number('html', NULL);
         $data['loggedin_company_id'] = get_current_company();
         $this->load->view('include/header',$data);
         $this->load->view('sales',$data);
         $this->load->view('include/footer');
     }
     
      public function order() {
         $data['page_title'] = 'Sales Order';
         $data['breadcum_title'] = 'sales';
         $data['active_sidemenu'] = "sales_order";
         $data['main_title'] = $data['page_title'];
         $data['popup_title'] = "Add ". $data['page_title'];
         $data['load_js'] = 'sales';
         $data['page_type'] = "sales_order";
         $data['data_source'] = base_url('sales/get_all_sales/'.$data['page_type']);
         $data['loggedin_company_id'] = get_current_company();
         $data['sales_employee_id'] = get_current_user_id();
         $data['sales_employee_name'] = $this->sessionData['full_name'];
         $this->load->view('include/header',$data);
         $this->load->view('sales',$data);
         $this->load->view('include/footer');
     }
     
     public function get_all_sales($type){
       $response =  $this->sales_model->get_all_sales($type);
		echo json_encode($response);
		die;
    }
    
    public function save_update($type,$id = NULL){
		 if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(empty($id) && $id == "" && $id == 0){
				$this->sales_model->insert_sales($type,$post_data);
				$output = array("status" => "success","message" => $post_data['sales_form_title'].' Inserted', "data" => "");
			} else {
                if(isset($post_data['is_new_sales_order']) && $post_data['is_new_sales_order']=="1"){
                    $this->sales_model->insert_sales($type,$post_data);
				    $output = array("status" => "success","message" => $post_data['sales_form_title'].' Inserted', "data" => "");
                } else {
                    $this->sales_model->update_sales($type,$post_data, $id);
				    $output = array("status" => "success","message" => $post_data['sales_form_title'].' Updated', "data" => "");    
                }
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
     }
     
    public function get_sales_data($company_id = NULL, $form_name = NULL){
          if($this->input->is_ajax_request()) {
              if(empty($company_id) && $company_id == "" && $company_id == 0){
                  $output = array("status" => "error","message" => 'Company ID missing ', "data" => "");
                } else {
                    $docNumber = $this->sales_model->get_sales_data($company_id);
                    $account_list = $this->sales_model->get_account_list($company_id);
                    $item_list = $this->sales_model->get_item_list($company_id);
                    $sales_quotes = "";
                    if($form_name == "sales_order"){
                        $sales_quotes = $this->sales_model->get_sales_quote_list($company_id);
                    }
				    $output = array("status" => "success","message" => 'Document Number Generated', "doc_number" => $docNumber, 'account_list'=>$account_list, 'sale_employees'=> $this->sessionData['full_name'], "item_list"=> $item_list, "sales_quotes"=>$sales_quotes);
                }
              } else {
		    	$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
            }
        echo json_encode($output);
        exit;
     }
     
     public function get_sales_details($id){
        if($this->input->is_ajax_request()) {
			if(is_numeric($id) && !empty($id)) {
                $data = $this->sales_model->get_sales_details($id);
                $output = array("status" => "success","message" => '', "header" => $data['header'], 'details' => $data['detail'], 'account_list'=>$data['account_list'], "item_list"=> $data['item_list']);
            } else {
				$output = array("status" => "error","message" => 'Sales ID doesnt exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
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
     
     function delete_so_detail_item($so_detail_id){
        $output= '';
		if($this->input->is_ajax_request()) {
			if(is_numeric($so_detail_id) && !empty($so_detail_id)) {
				$data = $this->sales_model->delete_so_detail_item($so_detail_id);
				$output = array("status" => "success","message" => 'Deleted Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
     }
     
     function delete_sales($so_id){
        $output= '';
		if($this->input->is_ajax_request()) {
			if(is_numeric($so_id) && !empty($so_id)) {
				$data = $this->sales_model->delete_sales($so_id);
				$output = array("status" => "success","message" => 'Deleted Successfully!!', "data" => '');
			} else {
				$output = array("status" => "error","message" => 'Id doesn\'t exist.', "data" => "");
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        die;
     }
     
     
}