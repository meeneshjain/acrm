<?php 
class User_model extends CI_Model {	
    public function get_all_users() {
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
            <input type="checkbox" name="users" id="participant_'.$aRow['id'].'" value="'.$aRow['id'].'" class="compckbx">
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
	
	public function insert_user($post_data) {
		$data = array(
			"user_role_id" => $post_data['user_role'],
			"company_id" => $post_data['company_id'],
			"email" => $post_data['email'],
			"username" => $post_data['username'],
			"password" => $post_data['password'],
			"first_name" => $post_data['first_name'],
			"last_name" => $post_data['last_name'],
			"mobile_no" => $post_data['mobile'],
			"landline" => $post_data['landline'],
			"address" => $post_data['address'],
			"designation" => $post_data['designation'],
			"dob" => $post_data['dob'],
			"doj" => $post_data['doj'],
			"status" => (isset($post_data['status']) && $post_data['status']==1) ? 1 : 0,
			'updated_date' => DATETIME,
			'created_date' => DATETIME,

		);
		$res  = $this->db->insert('users',$data);
	}
	
	public function update_user($post_data, $id) {
		$data = array(
			"first_name" => $post_data['first_name'],
			"last_name" => $post_data['last_name'],
			"mobile_no" => $post_data['mobile'],
			"landline" => $post_data['landline'],
			"address" => $post_data['address'],
			"designation" => $post_data['designation'],
			"dob" => $post_data['dob'],
			"doj" => $post_data['doj'],
			"status" => (isset($post_data['status']) && $post_data['status']==1) ? 1 : 0,
			'updated_date' => DATETIME,

		);
		$this->db->where(array('id' => $id));
		$this->db->update('users',$data);
	}
	
	public function get_details($id) {
		return $this->db->query("SELECT * FROM `users` WHERE `status` = '1' AND `id` = '$id'")->row_array();
	}
	
	public function delete_user($id) {
		$update_dataset = array(
			"status"=> 0,
			"is_deleted"=> 1,
			"updated_date"=> DATETIME
		);
		$this->db->where(array('id' => $id));
		$this->db->update('`users`',$update_dataset);
	}

	public function user_detail($companyId,$userId)
	{
		$data = array();
		$user = $this->db->query("SELECT `u`.`id`,`u`.`email`,`u`.`user_role_id`,`u`.`company_id`,`u`.`first_name`,`u`.`last_name`,`u`.`mobile_no`,`u`.`landline`,`u`.`address`,`u`.`designation`,`u`.`dob`,`u`.`doj`,`u`.`status`,`u`.`is_deleted`,`u`.`created_date` FROM `users` as `u` WHERE `u`.`company_id` = '$companyId' AND `u`.`id` = '$userId'")->row_array();
		$data = $user;
		$role = $this->db->query("SELECT `ur`.`id` as `role_id`,`ur`.`name` FROM `user_roles` as `ur` WHERE `ur`.`id` = '".$user['user_role_id']."'")->row_array();
		$data['roledetail'] = $role;
		return $data;
	}

	public function user_profile_update($post_data, $id) 
	{
		$data = array(
			"first_name" => $post_data['first_name'],
			"last_name" => $post_data['last_name'],
			"mobile_no" => $post_data['mobile'],
			"landline" => $post_data['landline'],
			"address" => $post_data['address'],
			"dob" => $post_data['dob'],
			"address" => $post_data['address'],
			'updated_date' => DATETIME,

		);
		$this->db->where(array('id' => $id));
		$this->db->update('users',$data);
	}

	
	public function change_password($post_data, $id) 
	{
		$current_password = md5($post_data['password']);
		$check_current_pass = $this->db->query("SELECT `password` FROM `users` WHERE `id` = '$id'")->row_array();
		if($current_password == $check_current_pass['password'])
		{
			if($post_data['new_password'] == $post_data['confirm_password'])
			{
				$data = array(
					"password" => md5($post_data['new_password']),
					'updated_date' => DATETIME,
				);
				$this->db->where(array('id' => $id));
				$this->db->update('users',$data);
				$output = array("status" => "success","message" => 'Password Updated Successfully!!', "data" => '');
			}
			else
			{
				$output = array("status" => "danger","message" => 'New password not match with confirm password.', "data" => '');
			}
		}
		else
		{
			$output = array("status" => "danger","message" => 'Your current password do not match.', "data" => '');
		}		
		return $output;
	}

	public function get_activities() {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "activity_logs as al";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'al.id', 'al.title', 'al.type', 'al.log_msg', 'CONCAT(`userfor`.`first_name`," ",`userfor`.`last_name`) as userfor', 'CONCAT(`userby`.`first_name`," ",`userby`.`last_name`) as userby', 'al.created_date');
		
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

		$this->db->where(array('al.status' => '1'));
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);
        $this->db->join('users as userfor', 'userfor.id=al.activity_for_user_id', 'left');
        $this->db->join('users as userby', 'userby.id=al.activity_by_user_id', 'left');
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
            <input type="checkbox" name="usractivity" id="usractivity_'.$aRow['id'].'" value="'.$aRow['id'].'" class="usrprflckbx">
            <span></span></label>';
        

            $row[] = $aRow['title'];
            $row[] = addslashes($aRow['log_msg']);
        	$row[] = date('d M,Y @ h:i A',strtotime($aRow['created_date']));
            $row[] = '<small><i>Created By : <i class="fa fa-user"></i>'.$aRow['userfor'].'</small>';
			//$row[] = '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="getDetail('.$aRow['id'].')" ><i class="fa fa-edit"></i></button><button onclick="delete_user('.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button>';

        	$output['data'][] = $row;
        }
        return $output;
	}


}

?>