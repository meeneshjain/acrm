<?php 
class Target_model extends CI_Model {	

	public function targetlist($companyId)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "targets as t";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 't.id', 't.name', 't.target', 't.target_type', 't.product_id', 'td.name as tdname', 'td.in_days', 't.created_date');
		
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

		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
		$this->db->where(array('t.status' => '1', 't.is_deleted' => '0','t.company_id' => $companyId));
        $this->db->join('target_duration as td', 'td.id=t.target_duration_id', 'left');
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
            $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="trgt" id="trgt_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="trgtchkbx"><span></span></label>';
        	$row[] = $aRow['name'];
        	$row[] = ucfirst($aRow['target_type']);
        	$row[] = (!empty($aRow['target'])) ? $aRow['target'] : $aRow['product_id'];
        	$row[] = $aRow['tdname'];
        	$row[] = $aRow['in_days'];
        	$row[] = convert_db_date_time($aRow['created_date']);
			$row[] = '
			<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_trgt" data-trgt-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>
			
			<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_trgt" data-trgt-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>
			';

        	$output['data'][] = $row;
        }
        return $output;
    }

    public function myTarget($userId,$user_role_id)
    {
    	$roleArray = array('1' => 'ADMIN','2' => 'REGIONAL MANAGER','3'=>'TEAM LEADER','4' => 'USER');
    	$data['role'] = $roleArray[$user_role_id];
    	$data['target'] = $this->db->query("SELECT t.id,t.target_title,t.target_type,t.target,t.target_left,t.target_duration_id,td.name,td.in_days FROM targets as t,target_duration as td WHERE t.target_duration_id = td.id AND assign_to_user_id = '".$userId."'")->result_array();
    	return $data;
    }

    public function getDownlineUser($userId,$user_role_id)
    {
    	$data = array();
    	$uom_res = "SELECT u.id,u.first_name,u.last_name,u.reports_to_user_id,u.username,u.user_role_id,ur.name as role_name FROM users as u,user_roles as ur WHERE u.status = '1' AND u.is_deleted = '0' AND u.user_role_id = ur.id AND u.reports_to_user_id = '$userId'";
        $data = $this->db->query($uom_res)->result_array();
        foreach ($data as $key => $value) 
        {
        	$data[$key]['reported_users'] = $this->db->query("SELECT COUNT(`id`) as count FROM `users` WHERE `reports_to_user_id` = '".$value['id']."'")->row()->count;
        	$data[$key]['target'] = $this->db->query("SELECT t.id,t.target_title,t.target_type,t.target,t.amount,t.product,td.name,td.in_days FROM targets as t,target_duration as td WHERE t.target_duration_id = td.id AND assign_to_user_id = '".$value['id']."'")->result_array();
        }
        //echo '<PRE>';print_r($data);die;
        return $data;
    }

}

?>