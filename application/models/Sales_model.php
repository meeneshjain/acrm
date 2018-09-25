<?php 
class Sales_model extends CI_Model {	
    public function get_all_quotation() {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "users as us";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'us.id', 'c.company_name', 'user_roles.name as user_role_name', 'us.first_name', 'us.last_name','us.mobile_no', 'us.landline', 'us.created_date', 'us.updated_date' );
		
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

		$this->db->where(array('us.status' => '1', 'us.is_deleted' => '0'));
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
        $this->db->join('companies as c', 'c.id=us.company_id', 'left');
        $this->db->join('user_roles', 'user_roles.id=us.user_role_id', 'left');
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
        
            $row[] = ($aRow['company_name']!="") ? $aRow['company_name'] : "N/A";
            $row[] = ($aRow['user_role_name']!="") ? $aRow['user_role_name'] : "N/A";
            $row[] = ($aRow['first_name']!="") ? $aRow['first_name'] : "N/A";
            $row[] = ($aRow['last_name']!="") ? $aRow['last_name'] : "N/A";
            $row[] = ($aRow['mobile_no']!="") ? $aRow['mobile_no'] : "N/A";
            $row[] = ($aRow['landline']!="") ? $aRow['landline'] : "N/A";
        	$row[] = date('d M,Y @ h:i A',strtotime($aRow['created_date']));
			$row[] = '
			<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="getDetail('.$aRow['id'].')" ><i class="fa fa-edit"></i></button>
			
			<button onclick="delete_user('.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button>
			';

        	$output['data'][] = $row;
        }
        return $output;
    }
	
	
	function get_sales_data($company_id){
		$sales_count = $this->db->query("SELECT COUNT(id) as total_quote FROM `sales_quotation` WHERE `company_id` = '$company_id'")->row()->total_quote;
		$str_length = 4;
		$sales_count = $sales_count+1;
		$final_code = substr("0000{$sales_count}", -    $str_length);
		return strtoupper('DOC').'00'.date('Y').''.$final_code;
	}
	
	function get_account_list($company_id){
		$data = $this->db->query("SELECT id, account_number, `name` 
		FROM `account` 
		WHERE `status` = '1'")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	function get_account_contacts($account_id){
		$data = $this->db->query("SELECT id, CONCAT(first_name, ' ', last_name) as full_name, contact_no1 as contact_number
		FROM `contact` 
		WHERE `status` = '1' AND `account_id` = '$account_id'")->result_array(); //  AND `company_id` = '$company_id'
		return $data;
	}
	
	
    
}