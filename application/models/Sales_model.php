<?php 
class Sales_model extends CI_Model {	
    public function get_all_sales($type) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "sales_order as sl";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'sl.id', 'sl.doc_no', 'sl.doc_date', 'sl.account_name', 'sl.contact_person_name','sl.contact_person_number', 'sl.sales_employee', 'sl.stages', 'sl.created_date', 'sl.updated_date' );
		
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
					$search_column_flag = $dt_col_searchable[$i];
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

		if($type == "sales_quote"){
			$this->db->where(array('type' => 'QUOTATION'));
		} else if($type == "sales_order"){
			$this->db->where(array('type' => 'ORDER'));	
		}
		$this->db->where(array('sl.status' => '1', 'sl.is_deleted' => '0'));
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
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

        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
            $row[] = '<label class="m-checkbox m-checkbox--state-primary">
            <input type="checkbox" name="users" id="user_'.$aRow['id'].'" value="'.$aRow['id'].'" class="usrchkbx">
			<span></span></label>';
			
			 $row[] = ($aRow['doc_no']!="") ? $aRow['doc_no'] : "";
			 $row[] = ($aRow['doc_date']!="") ? get_only_date($aRow['doc_date']) : "";
			 $row[] = ($aRow['account_name']!="") ? $aRow['account_name'] : "";
			 $row[] = ($aRow['contact_person_name']!="") ? $aRow['contact_person_name'] : "";
			 $row[] = ($aRow['contact_person_number']!="") ? $aRow['contact_person_number'] : "";
			 $row[] = ($aRow['sales_employee']!="") ? $aRow['sales_employee'] : "";
			 $row[] = ($aRow['stages']!="") ? $aRow['stages'] : "";
			$row[] = convert_db_date_time($aRow['created_date']);
        
			$row[] = '
			<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="get_sales_details('.$aRow['id'].')" ><i class="fa fa-edit"></i></button>
			
			<button onclick="delete_sale('.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button>
			';

        	$output['data'][] = $row;
        }
        return $output;
    }
	
	
	function get_sales_data($company_id){
		$sales_count = $this->db->query("SELECT COUNT(id) as total_quote FROM `sales_order` WHERE `company_id` = '$company_id'")->row()->total_quote;
		$str_length = 4;
		$sales_count = $sales_count+1;
		$final_code = substr("0000{$sales_count}", -    $str_length);
		return strtoupper('DOC').$company_id.'00'.date('Y').''.$final_code;
	}
	
	function get_account_list($company_id){
		$data = $this->db->query("SELECT id, account_number, `name` 
		FROM `account` 
		WHERE `status` = '1'")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function get_item_list($company_id){
		$data = $this->db->query("SELECT it.id, it.code, it.`name`,it.gst_tax_rate as tax,
		CONCAT_WS('::', ipl.price1, ipl.price2, ipl.price3, ipl.price4, ipl.price5) as price_list
		FROM `items` as it 
		LEFT JOIN items_price_list as ipl ON it.id = ipl.item_id
		WHERE it.`status` = '1'
       GROUP BY id")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function get_sales_quote_list($company_id){
		$data = $this->db->query("SELECT *
		FROM `sales_order` as so 
		WHERE so.`type` = 'QUOTATION'")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function get_account_contacts($account_id){
		$data = $this->db->query("SELECT id, CONCAT(first_name, ' ', last_name) as full_name, mobile as contact_number
		FROM `contact_lead` 
		WHERE `status` = '1' AND `account_id` = '$account_id'")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function insert_sales($type,$post_data){
		if($type == "sales_quote"){
			$sale_type = "QUOTATION";
		} else if($type == "sales_order"){
			$sale_type = "ORDER";
		}
		
		$insert_data_hdr = array(
			"type"=> $sale_type,
			"sales_quote_ref_id"=>(isset($post_data['ref_quote_no']) && $post_data['ref_quote_no']!="") ? $post_data['ref_quote_no'] : 0,
			"company_id"=> $post_data['company_id'],
			"account_id"=> $post_data['account_code'],
			"account_name"=> $post_data['account_name'],
			"doc_no"=> $post_data['doc_number'],
			"doc_date"=> $post_data['doc_date'],
			"delivery_date"=> $post_data['delivery_date'],
			"valid_till"=> $post_data['valid_till'],
			"remarks"=> $post_data['remark'],
			"pan_card_no"=> $post_data['pan_no'],
			"pay_terms"=> $post_data['pay_terms'],
			"delivery_address"=> $post_data['delivery_address'],
			"gst_no"=> $post_data['gst_number'],
			"total_amount"=> $post_data['total_amount'],
			"discount"=> $post_data['final_discount'],
			"actual_total"=> $post_data['actual_total'],
			"other_charges"=>$post_data['other_charges'],
			"total_tax"=> $post_data['total_tax'],
			"stages"=> $post_data['status'],
			"cancel_reason"=>$post_data['cancel_reason'],
			"revision_number"=>$post_data['revision_number'],
			"contact_person_id"=> $post_data['contact_person'],
			"contact_person_name"=> $post_data['contact_name'],
			"contact_person_number"=> $post_data['contact_no'],
			"sales_employee_id"=> $post_data['sales_employee_id'],
			"sales_employee"=> $post_data['sales_employee'],
			"status "=> "1",
			"is_deleted"=> "0",
			"created_date"=> DATETIME,
			"created_by" => get_current_user_id(),
		);
		
		$res  = $this->db->insert('sales_order',$insert_data_hdr);
		if($res){
			$sales_order_id = $this->db->insert_id();
			if($post_data['status'] == "negotiation"){
				if(isset($post_data['is_new_revision']) && $post_data['is_new_revision']!=""){
					$insert_data_revision = array(
						"sales_order_id" => $sales_order_id,
						"revision_no" => $post_data['revision_number'] ,
						"revision_amount" => $post_data['actual_total'],
						"status" => "1",
						"is_deleted" => "0",
						"created_date" => DATETIME,
						"created_by" => get_current_user_id(),
					); 
					$res  = $this->db->insert('sales_order_revisions',$insert_data_revision);
				}
				
			}
			if(count($post_data['item_detail']) > 0){
				foreach($post_data['item_detail'] as $items ){
					$insert_data_detail = array(
						"company_id"=> $post_data['company_id'],
						"sales_order_id"=>$sales_order_id,
						"item_id"=> $items['id'],
						"item_code"=> $items['item_code'],
						"item_name"=> $items['item_name'],
						"quantity"=> $items['quantity'],
						"price"=> $items['price'],
						"discount"=> $items['discount'],
						"tax_amount"=> $items['tax_amount'],
						"total"=> $items['total'],
						"remark"=> $items['remark'],
						"status "=> "1",
						"is_deleted"=> "0",
						"created_date"=> DATETIME,
						"created_by" => get_current_user_id(),
					);
				$res2  = $this->db->insert('sales_order_details',$insert_data_detail);
				}
			}
		}
		
		
	}
	
	function update_sales($type, $post_data, $id){
		$update_hrd_data = array(
			// "sales_quote_ref_id"=>(isset($post_data['ref_quote_no']) && $post_data['ref_quote_no']!="") ? $post_data['ref_quote_no'] : "",
			"company_id"=> $post_data['company_id'],
			"account_id"=> $post_data['account_code'],
			"account_name"=> $post_data['account_name'],
			"doc_date"=> $post_data['doc_date'],
			"delivery_date"=> $post_data['delivery_date'],
			"valid_till"=> $post_data['valid_till'],
			"remarks"=> $post_data['remark'],
			"pan_card_no"=> $post_data['pan_no'],
			"pay_terms"=> $post_data['pay_terms'],
			"delivery_address"=> $post_data['delivery_address'],
			"gst_no"=> $post_data['gst_number'],
			"total_amount"=> $post_data['total_amount'],
			"discount"=> $post_data['final_discount'],
			"actual_total"=> $post_data['actual_total'],
			"other_charges"=>$post_data['other_charges'],
			"total_tax"=> $post_data['total_tax'],
			"stages"=> $post_data['status'],
			"cancel_reason"=>$post_data['cancel_reason'],
			"revision_number"=>$post_data['revision_number'],
			"contact_person_id"=> $post_data['contact_person'],
			"contact_person_name"=> $post_data['contact_name'],
			"contact_person_number"=> $post_data['contact_no'],
			"status "=> "1",
			"is_deleted"=> "0",
			"updated_date"=> DATETIME,
			"updated_by"=>get_current_user_id()
		);
		$this->db->where("id", $post_data['sales_id']);
		$res  = $this->db->update('sales_order',$update_hrd_data);
		if($res){
			$sales_order_id = $post_data['sales_id'];
			if($post_data['status'] == "negotiation"){
				if(isset($post_data['is_new_revision']) && $post_data['is_new_revision']!=""){
					$insert_data_revision = array(
						"sales_order_id" => $sales_order_id,
						"revision_no" => $post_data['revision_number'] ,
						"revision_amount" => $post_data['actual_total'],
						"status" => "1",
						"is_deleted" => "0",
						"created_date" => DATETIME,
						"created_by" => get_current_user_id(),
					); 
					$res  = $this->db->insert('sales_order_revisions',$insert_data_revision);
				}
			}
			if(count($post_data['item_detail']) > 0){
				foreach($post_data['item_detail'] as $items ){
					$insert_update_detail = array(
						"company_id"=> $post_data['company_id'],
						"item_id"=> $items['id'],
						"item_code"=> $items['item_code'],
						"item_name"=> $items['item_name'],
						"quantity"=> $items['quantity'],
						"price"=> $items['price'],
						"discount"=> $items['discount'],
						"tax_amount"=> $items['tax_amount'],
						"total"=> $items['total'],
						"remark"=> $items['remark'],
						"status "=> "1",
						"is_deleted"=> "0",
						"updated_by"=>get_current_user_id(),
						"updated_date"=> DATETIME,
					);
					if(isset($items['item_detail_id']) && $items['item_detail_id']!="" && $items['item_detail_id'] != "0"){
						$insert_update_detail["updated_date"] = DATETIME;
						$this->db->where("id", $items['item_detail_id']);
						$res2  = $this->db->update('sales_order_details',$insert_update_detail);	
					} else {
						$insert_update_detail["created_date"] = DATETIME;
						$insert_update_detail["sales_order_id"] = $sales_order_id;
						$res2  = $this->db->insert('sales_order_details',$insert_update_detail);
					}
				}
			}
		}
		
		
	
	}
	
	function get_sales_details($id){
		$header_details = $this->db->query("SELECT * FROM `sales_order` WHERE `status` = '1' AND `id` = '$id'")->row_array();
		
		$item_detail = $this->db->query("SELECT * FROM `sales_order_details` WHERE `status` = '1' AND `sales_order_id` = '$id'")->result_array();
		
		$account_list = $this->get_account_list($header_details['company_id']);
		$item_list = $this->get_item_list($header_details['company_id']);
		return array("header"=> $header_details, "detail"=> $item_detail, "account_list"=> $account_list, "item_list"=> $item_list);
	}
	
	function delete_so_detail_item($so_detail_id){
        $update_dataset = array(
			"status"=> 0,
			"is_deleted"=> 1,
			"updated_date"=> DATETIME
		);
		$this->db->where(array('id' => $so_detail_id));
        $response = $this->db->update('sales_order_details',$update_dataset);
        if($response > 0){
            return 1;
        } else {
            return 0;
        }
   }
   
   function delete_sales($so_id){
	    $update_dataset = array(
			"status"=> 0,
			"is_deleted"=> 1,
			"updated_date"=> DATETIME
		);
		$this->db->where(array('id' => $so_id));
        $response = $this->db->update('sales_order',$update_dataset);
        if($response > 0){
			$this->db->where(array('sales_order_id' => $so_id));
        	$response = $this->db->update('sales_order_details',$update_dataset);
            return 1;
        } else {
            return 0;
        }
   }
}