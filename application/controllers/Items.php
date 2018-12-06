<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
        $this->load->model("common_model");
        $this->load->model("items_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index($item_type) {
         
         $data['breadcum_title'] = 'Items';
         $data['active_sidemenu'] = "item";
         $data['load_js'] = 'items';
         
         $data['uom_list'] = get_uom_list('html', '');
         if($item_type!=""){
             $data['item_type'] = $item_type;
             if($item_type == "inventory"){
                $data['page_title'] = 'Inventory Items';        
                $data['active_sub_sidemenu'] = "inventory_item";
                $data['data_source'] = base_url('items/itemlist/INVENTORY');    
            } else if($item_type == "service"){
                $data['page_title'] = 'Service Items';
                $data['active_sub_sidemenu'] = "service_item";
                $data['data_source'] = base_url('items/itemlist/SERVICE');
            } 
        } else {
            redirect('home');
        }
         $this->load->view('include/header',$data);
         $this->load->view('items',$data);
         $this->load->view('include/footer');
     }

     public function itemlist($item_type){
        $companyId = get_current_company();
        
        $response =  $this->items_model->itemlist($companyId, $item_type);
        echo json_encode($response);
        die;
    }

        public function add_update_item(){
        if($this->input->is_ajax_request())
        {
            $companyId = get_current_company();
            //echo '<pre>';print_r($this->input->post());die;
            $is_gst = 0;
            if(isset($_POST['is_gst']))
            {
                 $is_gst = 1;
            }

            $data = array(
                            'company_id' => $companyId,
                            'logo' => $this->input->post('uploaded_images'),
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'type' => $this->input->post('type'),
                            'group_type' => strtoupper($this->input->post('item_type')),
                            'unit' => $this->input->post('item_uom'),
                            'description' => $this->input->post('description'),
                            'is_gst' => $is_gst,
                            'gst_tax_rate' => $this->input->post('gst_tax_rate'),
                            'status' => '1',
                            'is_deleted' => '0',
                        );

            $pricelist = array(
                            'price1' => $this->input->post('price1'),
                            'price2' => $this->input->post('price2'),
                            'price3' => $this->input->post('price3'),
                            'price4' => $this->input->post('price4'),
                            'price5' => $this->input->post('price5'),
                            'status' => '1',
                            'is_deleted' => '0',
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('items',$data,$where);

                $pricelist['updated_date'] = DATETIME;
                $where = array('item_id' => $this->input->post('id'),'company_id' => $companyId);
                $this->common_model->update_data('items_price_list',$pricelist,$where);
                echo json_encode(array("status" => "success","message" => 'Item Updated Successfully', "data" => ""));
            }
            else
            {
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('items', $data);
                $item_id = $this->db->insert_id();
                $pricelist['item_id'] = $item_id;

                $pricelist['company_id'] = $companyId;
                $pricelist['created_date'] = DATETIME;
                $result = $this->common_model->insert('items_price_list', $pricelist);
                echo json_encode(array("status" => "success","message" => 'Item Added Successfully.', "data" => $result));
            }
            die;

        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_item(){
        if($this->input->is_ajax_request())
        {
            $companyId = get_current_company();
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = $this->common_model->getdata($selected = 'id,logo,code,name,type,group_type,unit,description,is_gst,gst_tax_rate,created_date','items', $where = array('id' => $id ), $limit = false, $offset = false, $orderby=false);
                $item_id = $data[0]->id;
                $pricedata = $this->common_model->getdata($selected = 'price1,price2,price3,price4,price5','items_price_list', $where = array('company_id'=>$companyId,'item_id' => $item_id), $limit = false, $offset = false, $orderby=false);

                $itemData = json_decode(json_encode($data),true);

                $itemData[0]['price1'] = $pricedata[0]->price1;
                $itemData[0]['price2'] = $pricedata[0]->price2;
                $itemData[0]['price3'] = $pricedata[0]->price3;
                $itemData[0]['price4'] = $pricedata[0]->price4;
                $itemData[0]['price5'] = $pricedata[0]->price5;
                echo json_encode(array("status" => "success","message" => '', "data" => $itemData));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Item Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function delete_item(){
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = array('is_deleted' => '1','updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('items',$data,array('id' => $id));
                echo json_encode(array("status" => "success","message" => 'Item Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Item Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function multiple_delete_items(){
        if($this->input->is_ajax_request())
        {
            $get_data = $this->input->get('ids', TRUE);
            
            if(!empty($get_data))
            {
                $ids = explode(',', $get_data);
                foreach ($ids as $key => $value) 
                {
                    $data = array('is_deleted' => '1','updated_date' => DATETIME);
                    $res_data = $this->common_model->update_data('items',$data,array('id' => $value));
                }
                echo json_encode(array("status" => "success","message" => 'Items Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Items Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }
    
    public function service_contract(){
        $data['breadcum_title'] = 'Items';
        $data['active_sidemenu'] = "item";
        $data['load_js'] = 'item_service';
        $data['page_title'] = 'Service Contract';
        $data['main_title'] = $data['page_title'];
        $data['active_sub_sidemenu'] = "service_contract";
        $data['loggedin_company_id'] = get_current_company();
        $data['data_source'] = base_url('items/get_service_contract/' . $data['loggedin_company_id']);
        $columns = array(
			array("col" => "#",         "class" => "no-sort"),
			array("col" => "Serial Number", "class" => ""),
			array("col" => "Account ",  "class" => ""),
			array("col" => "Contact Person",      "class" => ""),
			array("col" => "Sales Employee",      "class" => ""),
			array("col" => "Item Name",      "class" => ""),
			array("col" => "Start Date",      "class" => ""),
			array("col" => "End Date",      "class" => ""),
			array("col" => "Status",      "class" => ""),
			array("col" => "Created On",      "class" => ""),
			array("col" => "Action",      "class" => "no-sort"),
        );
        
        $data['table_header_footer'] = generate_table_head($columns); 
        $data['sales_employee_id'] = get_current_user_id();
        $data['sales_employee_name'] = $this->sessionData['full_name'];
        $data['page_type'] = "service_contract";
        
        $this->load->view('include/header',$data);
        $this->load->view('item_service_contract_call',$data);
        $this->load->view('include/footer');
    }
    
    public function get_service_contract($companyId){
        
        $response =  $this->items_model->get_service_contract($companyId);
        echo json_encode($response);
        die;
    }
    
    public function service_call(){
        $data['breadcum_title'] = 'Items';
        $data['active_sidemenu'] = "item";
        $data['load_js'] = 'item_service';
        $data['page_title'] = 'Service Call';
        $data['main_title'] = $data['page_title'];
        $data['active_sub_sidemenu'] = "service_call";
        $data['loggedin_company_id'] = get_current_company();
        $data['data_source'] = base_url('items/get_service_calls/' . $data['loggedin_company_id']);
        $columns = array(
			array("col" => "#",         "class" => "no-sort"),
			array("col" => "Serial Number", "class" => ""),
			array("col" => "Account ",  "class" => ""),
			array("col" => "Contact Person",      "class" => ""),
			array("col" => "Sales Employee",      "class" => ""),
			array("col" => "Item Name",      "class" => ""),
			array("col" => "Start Date",      "class" => ""),
			array("col" => "End Date",      "class" => ""),
			array("col" => "Priority",      "class" => ""),
			array("col" => "Problem Origin",      "class" => ""),
			array("col" => "Problem Type",      "class" => ""),
			array("col" => "Created On",      "class" => ""),
			array("col" => "Action",      "class" => "no-sort"),
        );
        $data['table_header_footer'] = generate_table_head($columns);
         $data['sales_employee_id'] = get_current_user_id();
         $data['sales_employee_name'] = $this->sessionData['full_name'];
         $data['page_type'] = "service_call";
        $this->load->view('include/header',$data);
        $this->load->view('item_service_contract_call',$data);
        $this->load->view('include/footer');
    }
    
    
    public function get_service_calls($companyId){
        
        $response =  $this->items_model->get_service_calls($companyId);
        echo json_encode($response);
        die;
    }
    
    public function  all_drop_down_details($company_id, $form_name){
         $this->load->model('sales_model');
        $account_list = $this->sales_model->get_account_list($company_id);
        $item_list = $this->sales_model->get_item_list($company_id);
        $get_json_data = get_service_items('', 0);
        $service_stage = '<option value="">Select Service Stage</option>';
        foreach( $get_json_data['service_stage'] as $key => $inner_array ){
            $service_stage .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        $priority_list = '<option value="">Select Priority</option>';
        foreach( $get_json_data['priority'] as $key => $inner_array ){
            $priority_list .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        $call_status_option = '<option value="">Select Call Status</option>';
        foreach( $get_json_data['call_status'] as $key => $inner_array ){
            $call_status_option .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        $problem_origin_options = '<option value="">Select Problem Origin</option>';
        foreach( $get_json_data['problem_origin'] as $key => $inner_array ){
            $problem_origin_options .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }

        $problem_type_options = '<option value="">Select Problem Type </option>';
        foreach( $get_json_data['problem_type'] as $key => $inner_array ){
            $problem_type_options .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        $problem_subtype_options = '<option value="">Select Problem Subtpe</option>';
        foreach( $get_json_data['problem_subtype'] as $key => $inner_array ){
            $problem_subtype_options .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        $call_type_options = '<option value="">Select Call Type</option>';
        foreach( $get_json_data['call_type'] as $key => $inner_array ){
            $call_type_options .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
        }
        
        if($form_name == "service_call"){
            $service_serial_list = '<option value="">Select Contract Serial Number </option>';
            $serial_list = $this->items_model->get_contract_serial_number($company_id);
            foreach( $serial_list as $key => $serials ){
            $service_serial_list .= '<option value="'.$serials['id'].'">'.$serials['value'].'</option>';
        }
        }
        
        $sales_quotes = "";
        $output = array(
        "status"                 => "success",
        "message"                => 'New Contract or Call Init Info', 
        'account_list'           => $account_list, 
        'sale_employees'         => $this->sessionData['full_name'], 
        "item_list"              => $item_list, 
        "sales_quotes"           => $sales_quotes, 
        "service_stage"          => $service_stage,
        "priority_list"          => $priority_list,
        "call_status_option"     => $call_status_option,
        "problem_origin_options" => $problem_origin_options,
        "problem_type_options"   => $problem_type_options,
        "problem_subtype_options"=> $problem_subtype_options,
        "call_type_options"      => $call_type_options,
        );
        
        if($form_name == "service_call"){
             $output['service_serial_list'] =  $service_serial_list;
        }
        
        return $output;
    }
    
    public function get_new_contract_call_details($company_id, $form_name = NULL){
        
          if($this->input->is_ajax_request()) {
              if(empty($company_id) && $company_id == "" && $company_id == 0){
                  $output = array("status" => "error","message" => 'Company ID missing ', "data" => "");
                } else {
                   $output = $this->all_drop_down_details($company_id, $form_name);
                }
              } else {
		    	$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
            }
        echo json_encode($output);
        exit;
    }
    
    public function validate_serial_number($serial_number, $contract_id = NULL ){
        if($this->input->is_ajax_request()) {
            $seral_exits = $this->items_model->validate_serial_number($serial_number, $contract_id);
            $output = array("status" => "success","message" => 'New Contract or Call Init Info', 'is_exists' => $seral_exits);
        } else {
		    	$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
    }  
    
    public function save_update_contract($form_name, $id = NULL){
        
		 if($this->input->is_ajax_request()) {
            $post_data = $this->input->post(NULL, TRUE);
            if(empty($id) && $id == "" && $id == 0){
                if($form_name == "service_contract"){
                    $this->items_model->save_service_contract($post_data);
                } else if($form_name == "service_call"){
                    $this->items_model->save_service_call($post_data);
                }
                
				$output = array("status" => "success","message" => $post_data['sales_form_title'].' Inserted', "data" => "");
			} else {
                if($form_name == "service_contract"){
                    $this->items_model->update_service_contract($post_data, $id);
                } else if($form_name == "service_call"){
                    $this->items_model->update_service_call($post_data, $id);
                }
				$output = array("status" => "success","message" => $post_data['sales_form_title'].' Updated', "data" => "");    
			}
		} else {
			$output = array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => "");
        }
        echo json_encode($output);
        exit;
    }
    
    function get_service_details($service_type, $id){
        if($service_type == "service_contract"){
            $table = "item_service_contract";
        } else if($service_type == "service_call"){
            $table = "item_service_call";
        }
        
        $output = $this->all_drop_down_details(get_current_company(), $service_type);
        $item_service_data  = $this->items_model->get_service_details($table, $id);
        $output['status'] = 'success';
        $output['message'] = 'Contract and call details';
        $output['item_service_data'] = $item_service_data;
         echo json_encode($output);
        exit;
        // $output = array("status" => "success","message" => 'Contract and call details ', 'data' => $data);
    }
    
    function delete_service_contract_call($service_type, $id){
         if($this->input->is_ajax_request()) {
             if($service_type == "service_contract"){
                $table = "item_service_contract";
            } else if($service_type == "service_call"){
                $table = "item_service_call";
            }
            $delete_service  = $this->items_model->delete_service_contract_call($table, $id);
            echo json_encode(array("status" => "success","message" => 'Deleted Successfully!!', "data" => ''));
        } else {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }
    
    public function get_contract_serial_detail($serial_number){
        if($this->input->is_ajax_request()) {
            $serial_data  = $this->items_model->get_contract_serial_detail($serial_number);
            echo json_encode(array("status" => "success","message" => 'Serial Number Contract Detail Found.', "data" => $serial_data));
        } else {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }
}

?>