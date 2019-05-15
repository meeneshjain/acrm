<?php 
class Items_model extends CI_Model {	

	public function itemlist($companyId, $item_type)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "items as i";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'i.id', 'i.logo', 'i.code', 'i.name', 'i.group_type', 'i.type', 'i.unit', 'i.is_gst', 'i.created_date');
		
        //Pagination
		if(isset($get_data['start']) && $get_data['length'] != '-1') {
			$this->db->limit(intVal($get_data['length']), intVal($get_data['start']));
		}

       //Sorting
		if(isset($get_data['order'])) {
				$sort_column = $dt_columns[$get_data['order'][0]['column']];
				if(strstr($sort_column, "as") !== false) {
					$temp_sort_column = explode(" as ", $sort_column);
					$this->db->order_by($temp_sort_column[1], ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
				} else {
					$this->db->order_by($sort_column, ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
				}
		} else {
			$this->db->order_by('id', 'DESC');
		}
		
		if ( isset($get_data['search']) && $get_data['search']['value'] != "" ) {
			$this->db->group_start();       
			for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
				if ( isset($get_data['search']['value']) && $get_data['search']['value'] != "" ) {
					$search_column = $dt_columns[$i];
					$search_column_flag = $dt_columns[$i];
					if($search_column_flag){
						if(strstr($search_column, "as") !== false) {
							$temp_search_colm = explode(" as ", $search_column);
							$this->db->or_like($temp_search_colm[0], $get_data['search']['value'], 'both'); 
						} else {
							$this->db->or_like($search_column, $get_data['search']['value'], 'both'); 
						}
					}
				}
			}
			$this->db->group_end();       
		}
		
		$where_array = array('status' => '1', 'is_deleted' => '0','company_id' => $companyId, "group_type"=>$item_type);
		 
		 
		 $this->db->where($where_array);
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
        // $this->db->join('project_participants as pp', 'p.id=pp.project_id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
		// last_query(1);
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

        $output = array(
        	"draw" => intval(@$get_data['draw']),
        	"recordsTotal" => $dt_total,
        	"recordsFiltered" => $dt_filtered_total,
        	"data" => array()
        );

        $items_permission = get_user_permission();
        

        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
            $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="items" id="items_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="itmckbx"><span class="ml-3"></span></label>';

            $imgscr = base_url('assets/images/no.jpg');
            if(!empty($aRow['logo']) && file_exists($aRow['logo']))
            {
            	$imgscr = base_url($aRow['logo']);
            }
        	$row[] = '<img class="m-widget7__img img-thumbnail" src="'.$imgscr.'" alt="" style="width:80px;">';
        	$row[] = $aRow['code'];
        	$row[] = $aRow['name'];
        	$row[] = $aRow['type'];
        	$row[] = $aRow['unit'];
        	if($aRow['is_gst'] == '0'){  $row[] = '<span class="m-badge m-badge--danger m-badge--wide">No</span>'; } else { $row[] = '<span class="m-badge m-badge--success m-badge--wide">Yes</span>'; }
        	 
        	$row[] = convert_db_date_time($aRow['created_date']);

        	$actn = '';

        	$type = strtolower($aRow['group_type']);
        	
        	if($type == "inventory"){
	        	if(in_array('invitm_e',$items_permission)){
        			$actn .='<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_item" data-item-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>';
				}
				if(in_array('invitm_d',$items_permission)){
					$actn .='<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_item" data-item-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';				
				}
			}

			if($type == "service"){
				if(in_array('seritm_e',$items_permission)){
        			$actn .='<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_item" data-item-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>';
				}
				if(in_array('seritm_d',$items_permission)){
					$actn .='<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_item" data-item-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';
				}
			}


			$row[] = $actn;

        	$output['data'][] = $row;
        }
        return $output;
	}
	
	public function validate_serial_number($serial_number, $contract_id = NULL ){
		
		$where = array("serial_number"=> $serial_number);
		if($contract_id != ""){
			$where['id!='] = $contract_id;
		}
		$this->db->where($where);
		$this->db->from("item_service_contract");
		$result = $this->db->get();
		if($result->num_rows() > 0){
			return 1;
		} else{
			return 0;
		}
	}
	
	public function save_service_contract($post_data){
	
		$insert_contract_data = array(
			"company_id" => $post_data["company_id"],
			"account_id" => $post_data["account_code"],
			"account_name" => $post_data["account_name"],
			"contact_person_id" => $post_data["contact_person"],
			"contact_person_name" => $post_data["contact_name"],
			"contact_person_number" => $post_data["contact_no"],
			"stage" => $post_data["serviec_status"],
			"serial_number" => $post_data["serial_number"],
			"start_date" => $post_data["start_date"],
			"end_date" => $post_data["end_date"],
			"free_services" => $post_data["free_services"],
			"remark" => $post_data["remark"],
			"item_id" => $post_data["item_code"],
			"item_name" => $post_data["item_name"],
			"response_time" => $post_data["reponse_time"],
			"response_duration_type" => $post_data["response_time_type"],
			"resolution_time" => $post_data["resolution_time"],
			"resolution_duration_type" => $post_data["resolution_time_type"],
			"sales_employee" => $post_data["sales_employee_name"],
			"sales_employee_id" => $post_data["sales_employee_id"],
			"status "=> "1",
			"is_deleted"=> "0",
			"created_date"=> DATETIME,
			"created_by" => get_current_user_id(),
		);
		
		$res  = $this->db->insert('item_service_contract',$insert_contract_data);
		
	}
	
	public function update_service_contract($post_data, $id){
		$update_contract_data = array(
			"account_id" => $post_data["account_code"],
			"account_name" => $post_data["account_name"],
			"contact_person_id" => $post_data["contact_person"],
			"contact_person_name" => $post_data["contact_name"],
			"contact_person_number" => $post_data["contact_no"],
			"stage" => $post_data["serviec_status"],
			"start_date" => $post_data["start_date"],
			"end_date" => $post_data["end_date"],
			"free_services" => $post_data["free_services"],
			"remark" => $post_data["remark"],
			"item_id" => $post_data["item_code"],
			"item_name" => $post_data["item_name"],
			"response_time" => $post_data["reponse_time"],
			"response_duration_type" => $post_data["response_time_type"],
			"resolution_time" => $post_data["resolution_time"],
			"resolution_duration_type" => $post_data["resolution_time_type"],
			"status "=> "1",
			"is_deleted"=> "0",
			"updated_date"=> DATETIME,
			"updated_by" => get_current_user_id(),
		);
		$this->db->where('id', $id);
		$res  = $this->db->update('item_service_contract',$update_contract_data);
	}
	
	public function get_service_contract($companyId)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "item_service_contract as i";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'i.id', 'i.serial_number', 'i.account_name', 'i.contact_person_name', 'i.sales_employee', 'i.item_name', 'i.start_date', 'i.end_date', 'i.stage', 'i.created_date',  'i.updated_date');
		
        //Pagination
		if(isset($get_data['start']) && $get_data['length'] != '-1') {
			$this->db->limit(intVal($get_data['length']), intVal($get_data['start']));
		}

       //Sorting
		if(isset($get_data['order'])) {
			$sort_column = $dt_columns[$get_data['order'][0]['column']];
			if(strstr($sort_column, "as") !== false) {
				$temp_sort_column = explode(" as ", $sort_column);
				$this->db->order_by($temp_sort_column[1], ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
			} else {
				$this->db->order_by($sort_column, ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
			}
		} else {
			$this->db->order_by('id', 'DESC');
		}
		
		if ( isset($get_data['search']) && $get_data['search']['value'] != "" ) {
			$this->db->group_start();       
			for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
				if ( isset($get_data['search']['value']) && $get_data['search']['value'] != "" ) {
					$search_column = $dt_columns[$i];
					$search_column_flag = $dt_columns[$i];
					if($search_column_flag){
						if(strstr($search_column, "as") !== false) {
							$temp_search_colm = explode(" as ", $search_column);
							$this->db->or_like($temp_search_colm[0], $get_data['search']['value'], 'both'); 
						} else {
							$this->db->or_like($search_column, $get_data['search']['value'], 'both'); 
						}
					}
				}
			}
			$this->db->group_end();       
		}
		
		$where_array = array('status' => '1', 'is_deleted' => '0','company_id' => $companyId);
		 
		 
		$this->db->where($where_array);
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
        // $this->db->join('project_participants as pp', 'p.id=pp.project_id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
		// last_query(1);
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

        $output = array(
        	"draw" => intval(@$get_data['draw']),
        	"recordsTotal" => $dt_total,
        	"recordsFiltered" => $dt_filtered_total,
        	"data" => array()
        );

        $items_permission = get_user_permission();

        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
			/* $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="items" id="items_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="itmckbx"><span></span></label>'; */
			

			$row[] =  '<span class="ml-3 bold"><strong>'. $aRow['id'] .'</strong></span>';
			$row[] =  $aRow['serial_number'];
			$row[] =  $aRow['account_name'];
			$row[] =  $aRow['contact_person_name'];
			$row[] =  $aRow['sales_employee'];
			$row[] =  $aRow['item_name'];
			$row[] =  convert_db_date_time($aRow['start_date']);
			$row[] =  convert_db_date_time($aRow['end_date']);
			$row[] =  ucfirst($aRow['stage']);

        	 
        	$row[] = convert_db_date_time($aRow['created_date']);


        	$actn = '';

        	if(in_array('sercon_e',$items_permission)){
    			$actn .='<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_item add_update_click" data-service_type="service_contract" data-service-id="'.$aRow['id'].'" data-form_type="edit" ><i class="fa fa-edit"></i></button>';
			}
			if(in_array('sercon_d',$items_permission)){
				$actn .='<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_service" data-service_type="service_contract" data-service-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';
			}




			$row[] = $actn;

        	$output['data'][] = $row;
        }
        return $output;
	}
	
	public function get_service_details($table, $id){
		$data = $this->db->query("SELECT *
		FROM `$table` as sic 
		WHERE sic.`id` = '$id'")->row_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function delete_service_contract_call($table, $id){
		$data = $this->db->query("UPDATE `$table` SET status='0', is_deleted= '1' 
		WHERE `id` = '$id'");
		return $data;
	}
	
	function get_contract_serial_number($company_id){
		$data = $this->db->query("SELECT id, serial_number as value
		FROM `item_service_contract` as sic 
		WHERE `company_id` = '$company_id' 
		GROUP BY serial_number")->result_array();
		return $data;
	}
	
	function save_service_call($post_data){
		$insert_call_data = array(
			'item_service_contract_id' => $post_data['service_contract_id'],
			'item_service_contract_serial_number' => $post_data["serial_number"],
			"company_id" => $post_data["company_id"],
			"account_id" => $post_data["account_code"],
			"account_name" => $post_data["account_name"],
			"contact_person_id" => $post_data["contact_person"],
			"contact_person_name" => $post_data["contact_name"],
			"contact_person_number" => $post_data["contact_no"],
			// "stage" => $post_data["serviec_status"],
			"start_date" => $post_data["start_date"],
			"end_date" => $post_data["end_date"],
			"remark" => $post_data["remark"],
			"item_id" => $post_data["item_code"],
			"item_name" => $post_data["item_name"],
			"sales_employee_id" => $post_data["sales_employee_id"],
			"sales_employee" => $post_data["sales_employee_name"],
			"priority" => $post_data['priority'],
			"call_status"=>$post_data['call_status'],
			"planned_call_date" => $post_data['planned_date'],
			"tentative_call_date" => $post_data['tentative_date'],
			"approved_call_date" => $post_data['approved_date'],
			"rejected_call_date" => $post_data['rejected_date'],
			"subject" => $post_data['call_subject'],
			"description" => $post_data['call_description'],
			"problem_origin" => $post_data['problem_origin'],
			"problem_type" => $post_data['problem_type'],
			"problem_subtype" => $post_data['problem_subtype'],
			"call_type" => $post_data['call_type'],
			"technician" => $post_data['technician'],
			"given_by" => $post_data['given_by'],
			"given_to" => $post_data['given_to'],
			"job_description" => $post_data['job_description'],
			"status "=> "1",
			"is_deleted"=> "0",
			"created_date"=> DATETIME,
			"created_by" => get_current_user_id(),
		);
		$res  = $this->db->insert('item_service_call',$insert_call_data);
		
	}

	function update_service_call($post_data, $id){
	 	$update_call_data = array(
			
			"account_id" => $post_data["account_code"],
			"account_name" => $post_data["account_name"],
			"contact_person_id" => $post_data["contact_person"],
			"contact_person_name" => $post_data["contact_name"],
			"contact_person_number" => $post_data["contact_no"],
			"start_date" => $post_data["start_date"],
			"end_date" => $post_data["end_date"],
			"item_id" => $post_data["item_code"],
			"item_name" => $post_data["item_name"],
			"sales_employee_id" => $post_data["sales_employee_id"],
			"sales_employee" => $post_data["sales_employee_name"],
			"priority" => $post_data['priority'],
			"call_status"=>$post_data['call_status'],
			"planned_call_date" => $post_data['planned_date'],
			"tentative_call_date" => $post_data['tentative_date'],
			"approved_call_date" => $post_data['approved_date'],
			"rejected_call_date" => $post_data['rejected_date'],
			"subject" => $post_data['call_subject'],
			"description" => $post_data['call_description'],
			"problem_origin" => $post_data['problem_origin'],
			"problem_type" => $post_data['problem_type'],
			"problem_subtype" => $post_data['problem_subtype'],
			"call_type" => $post_data['call_type'],
			"technician" => $post_data['technician'],
			"given_by" => $post_data['given_by'],
			"given_to" => $post_data['given_to'],
			"job_description" => $post_data['job_description'],
			"updated_date"=> DATETIME,
			"updated_by" => get_current_user_id(),
		);
		$this->db->where('id', $id);
		$res  = $this->db->update('item_service_call',$update_call_data);
	}
	
	public function get_service_calls($companyId){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "item_service_call as i";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'i.id', 'i.item_service_contract_serial_number as serial_number', 'i.subject', 'i.contact_person_name', 'i.sales_employee', 'i.item_name', 'i.start_date', 'i.end_date', 'i.priority', 'i.problem_origin', 'i.problem_type', 'i.created_date',  'i.updated_date');
		
        //Pagination
		if(isset($get_data['start']) && $get_data['length'] != '-1') {
			$this->db->limit(intVal($get_data['length']), intVal($get_data['start']));
		}

       //Sorting
		if(isset($get_data['order'])) {
			$sort_column = $dt_columns[$get_data['order'][0]['column']];
			if(strstr($sort_column, "as") !== false) {
				$temp_sort_column = explode(" as ", $sort_column);
				$this->db->order_by($temp_sort_column[1], ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
			} else {
				$this->db->order_by($sort_column, ($get_data['order'][0]['dir'] === 'asc' ? 'asc' : 'desc'));
			}
		} else {
			$this->db->order_by('id', 'DESC');
		}
		
		if ( isset($get_data['search']) && $get_data['search']['value'] != "" ) {
			$this->db->group_start();       
			for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
				if ( isset($get_data['search']['value']) && $get_data['search']['value'] != "" ) {
					$search_column = $dt_columns[$i];
					$search_column_flag = $dt_columns[$i];
					if($search_column_flag){
						if(strstr($search_column, "as") !== false) {
							$temp_search_colm = explode(" as ", $search_column);
							$this->db->or_like($temp_search_colm[0], $get_data['search']['value'], 'both'); 
						} else {
							$this->db->or_like($search_column, $get_data['search']['value'], 'both'); 
						}
					}
				}
			}
			$this->db->group_end();       
		}
		
		$where_array = array('status' => '1', 'is_deleted' => '0','company_id' => $companyId);
		 
		 
		$this->db->where($where_array);
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
        // $this->db->join('project_participants as pp', 'p.id=pp.project_id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
		// last_query(1);
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

        $output = array(
        	"draw" => intval(@$get_data['draw']),
        	"recordsTotal" => $dt_total,
        	"recordsFiltered" => $dt_filtered_total,
        	"data" => array()
        );

        $items_permission = get_user_permission();

        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
			/* $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="items" id="items_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="itmckbx"><span></span></label>'; */
			$row[] =  '<span class="ml-3 bold"><strong>'. $aRow['id'] .'</strong></span>';
			
			$row[] = ($aRow['serial_number']!="" && $aRow['serial_number']!='0') ? $aRow['serial_number'] : 'N/A';
			$row[] =  $aRow['subject'];
			$row[] =  $aRow['contact_person_name'];
			$row[] =  $aRow['sales_employee'];
			$row[] =  $aRow['item_name'];
			$row[] =  $aRow['start_date'];
			$row[] =  $aRow['end_date'];
			$priority = $aRow['priority'];
			if($priority == "low"){
				$priority_class = "text-primary";
			} else if($priority == "medium"){
				$priority_class = "text-warning";
			} else if($priority == "high"){
				$priority_class = "text-danger";
			}
			$row[] =  '<span class="'.$priority_class.'"><strong>'. ucfirst($aRow['priority']). '</strong></span>';
			$row[] =  $aRow['problem_origin'];
			$row[] =  $aRow['problem_type'];
        	 
        	$row[] = convert_db_date_time($aRow['created_date']);
			
			$actn = '';
			if(in_array('sercall_e',$items_permission)){
    			$actn .='<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_item add_update_click" data-service_type="service_contract" data-service-id="'.$aRow['id'].'" data-form_type="edit" ><i class="fa fa-edit"></i></button>';
			}
			if(in_array('sercall_d',$items_permission)){
				$actn .='<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_service" data-service_type="service_contract" data-service-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>';
			}
			$row[] = $actn;

        	$output['data'][] = $row;
		}
		
        return $output;
	}
	
	public function get_contract_serial_detail($serial_number){
		$data = $this->db->query("SELECT * FROM `item_service_contract` as sic 
		WHERE `id` = '$serial_number'")->row_array();
		return $data;
		
	}
 
}

?>