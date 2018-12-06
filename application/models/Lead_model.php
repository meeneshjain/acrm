<?php 
class Lead_model extends CI_Model {	

	public function leadlist($userId,$user_role_id,$companyId)
	{
		//Recommit on git
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		$lead_owner = '';
		if($user_role_id == 4)
		{
			$lead_owner = $userId;
		}
		else
		{
			$owner_ids = array();
			$result = $this->db->query("SELECT id FROM users WHERE reports_to_user_id = '$userId'")->result_array();
			foreach ($result as $key => $value) 
			{
				$owner_ids['id'][] = $value['id'];
			}
			$owner_ids['id'][] = $userId;
			$ids = implode(',', $owner_ids['id']);
			$lead_owner = $ids;
		}

		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "contact_lead as cl";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'cl.id', 'cl.first_name', 'cl.last_name', 'cl.mobile', 'cl.email_1', 'cl.created_date', 'cl.company_id', 'a.id as acnt_id', 'a.name', 'a.account_number', 'u.first_name as own_fname','u.last_name as own_lname');
		
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
		$this->db->where(array('cl.is_type' => '1', 'cl.status' => '1', 'cl.is_deleted' => '0', 'cl.company_id'=> $companyId));
		$this->db->where("cl.owner_id IN (".$lead_owner.")",NULL, false);
        $this->db->join('account as a', 'cl.account_id=a.id', 'left');
        $this->db->join('users as u', 'cl.owner_id=u.id', 'left');
		$dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
		//echo last_query(1);
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
            $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="contacts" id="cont_id_'.$aRow['id'].'" value="'.$aRow['id'].'" class="leadchkbx"><span></span></label>';
        	$row[] = $aRow['name'] ."(".$aRow['account_number'].")";
        	$row[] = $aRow['first_name']." ".$aRow['last_name'];
        	$row[] = $aRow['own_fname']." ".$aRow['own_lname'];
        	$row[] = $aRow['mobile'];
        	$row[] = $aRow['email_1'];
        	$row[] = convert_db_date_time($aRow['created_date']);
			$row[] = '
			<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air convert_to_opportunity_btn custom-popover" data-lead-id="'.$aRow['id'].'" data-opportunity-name="'.$aRow['first_name'].' '.$aRow['last_name'].'" data-account-name="'.$aRow['name'] .'('.$aRow['account_number'].')'.'"  data-toggle="m-popover" data-placement="left" title="Make Opportunity" data-content="Convert to Opportunity"><i class="fa fa-dollar"></i></button>

			<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_cont" data-lead-id="'.$aRow['id'].'"><i class="fa fa-edit"></i></button>
			<button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air delete_lead" data-lead-id="'.$aRow['id'].'"><i class="fa fa-trash-o"></i></button>
			<button class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air calls_modal" data-name="'.$aRow['first_name']." ".$aRow['last_name'].'" data-type="LEAD"  data-account="'.$aRow['name'] ."(".$aRow['account_number'].")".'" data-contact="'.$aRow['mobile']." ".$aRow['last_name'].'" data-lead-id="'.$aRow['id'].'" data-acnt-id="'.$aRow['acnt_id'].'"><i class="fa fa-clock-o"></i></button>
			';

        	$output['data'][] = $row;
        }
        return $output;
    }

    public function user_downline_list($userId,$companyId,$user_role_id)
    {
    	$data = array();
	    if($user_role_id == 1)
	    {
	        $this->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
			$this->db->from('users as u');
			$this->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.company_id'=> $companyId));
	        $this->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
	        $this->db->order_by("ur.id", "asc");
			$result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number()); 
	        $data = $result->result_array();
	    
	    }
	    else
	    {
	        $this->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
			$this->db->from('users as u');
			$this->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.reports_to_user_id' => $userId, 'u.company_id'=> $companyId));
	        $this->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
	        $this->db->order_by("ur.id", "asc");
			$result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number()); 
	        $data = $result->result_array();
	    }
		return $data;
    }
}

?>