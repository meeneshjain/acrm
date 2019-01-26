<?php 
class User_model extends CI_Model {	
    public function get_all_users($companyId) {
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

		$this->db->where(array('us.status' => '1', 'us.is_deleted' => '0','company_id' => $companyId));
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
            <span></span class="ml-3"></label>';
        
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
			"password" => md5($post_data['password']),
			"first_name" => $post_data['first_name'],
			"last_name" => $post_data['last_name'],
			"mobile_no" => $post_data['mobile'],
			"landline" => $post_data['landline'],
			"address" => $post_data['address'],
			"designation" => $post_data['designation'],
			"dob" => $post_data['dob'],
			"doj" => $post_data['doj'],
			"status" => (isset($post_data['status']) && $post_data['status']==1) ? 1 : 0,
			'profile_pic'=> ($post_data['uploaded_images']) ? $post_data['uploaded_images'] : DEFAULT_IMAGE,
			'updated_date' => DATETIME,
			'created_date' => DATETIME,
			"created_by" => get_current_user_id(),
		);
		
		if($post_data['user_role'] == '4'){
			$data['reports_to_user_id'] = $post_data['team_lead_dd'];
		} else if($post_data['user_role'] == '3'){
			$data['reports_to_user_id'] = $post_data['rm_dd'];
		} else if($post_data['user_role'] == '2'){
			$user_company_id = $this->db->query("SELECT `id` FROM `users` WHERE `company_id` = '".$post_data['company_id']."' ORDER BY `id` ASC LIMIT 1")->row_array();
			$data['reports_to_user_id'] = $user_company_id['id'];
		}
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
			'profile_pic'=> ($post_data['uploaded_images']) ? $post_data['uploaded_images'] : DEFAULT_IMAGE,
			"status" => (isset($post_data['status']) && $post_data['status']==1) ? 1 : 0,
			'updated_date' => DATETIME,
			"updated_by" => get_current_user_id(),
		);
		
		 
		if($post_data['user_role'] == '4'){
			$data['reports_to_user_id'] = $post_data['team_lead_dd'];
		} else if($post_data['user_role'] == '3'){
			$data['reports_to_user_id'] = $post_data['rm_dd'];
		} else if($post_data['user_role'] == '2'){
			$user_company_id = $this->db->query("SELECT `id` FROM `users` WHERE `company_id` = '".$post_data['company_id']."' ORDER BY `id` ASC LIMIT 1")->row_array();
			$data['reports_to_user_id'] = $user_company_id['id'];
		}
		
		$this->db->where(array('id' => $id));
		$this->db->update('users',$data);
	}
	
	public function get_details($id) {
		return $this->db->query("SELECT * FROM `users` WHERE `status` = '1' AND `id` = '$id'")->row_array();
	}
	
	public function get_employee_user_name($company_id){
		$data = $this->db->query("SELECT company_name, company_prefix, company_code_start 
		FROM `companies` 
		WHERE `status` = '1' AND `id` = '$company_id'")->row_array();
		$prefix = ($data['company_prefix']);
		$str_length = 4; 
		$employee_count = $this->db->query("SELECT COUNT(id) as total_employee FROM `users` WHERE `company_id` = '$company_id'")->row()->total_employee;
		$employee_count++;
		$final_code = substr("0000{$employee_count}", -$str_length);
		return strtoupper($prefix).''.$final_code;
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

	public function admin_detail($userId)
	{
		$data = array();
		$data = $this->db->query("SELECT * FROM `admin` WHERE `id` = '$userId'")->row_array();
		return $data;
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
	
	public function get_user_list_by_role($company_id, $user_role){
		$where = array(
			"status"=>"1",
			"is_deleted"=>"0",
			"user_role_id"=>$user_role,
			"company_id"=>$company_id,
		);
		$this->db->where($where);	
		$result = $this->db->get("users");
		if($result->num_rows() > 0){
			return $result->result_array();
		} else {
			return 0;
		}
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

	public function admin_profile_update($post_data, $id) 
	{
		//print_r($post_data);die;
		$data = array(
			"first_name" => $post_data['first_name'],
			"last_name" => $post_data['last_name'],
			"email" => $post_data['email'],
			"contact" => $post_data['mobile'],
		);
		$this->db->where(array('id' => $id));
		$this->db->update('admin',$data);
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

	public function admin_change_password($post_data, $id) 
	{
		$current_password = md5($post_data['password']);
		$check_current_pass = $this->db->query("SELECT `password` FROM `admin` WHERE `id` = '$id'")->row_array();
		if($current_password == $check_current_pass['password'])
		{
			if($post_data['new_password'] == $post_data['confirm_password'])
			{
				$data = array(
					"password" => md5($post_data['new_password']),
				);
				$this->db->where(array('id' => $id));
				$this->db->update('admin',$data);
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
            <span class="ml-3"></span></label>';
        

            $row[] = $aRow['title'];
            $row[] = addslashes($aRow['log_msg']);
        	$row[] = date('d M,Y @ h:i A',strtotime($aRow['created_date']));
            $row[] = '<small><i class="fa fa-user"></i> '.$aRow['userfor'].'</small>';
			//$row[] = '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="getDetail('.$aRow['id'].')" ><i class="fa fa-edit"></i></button><button onclick="delete_user('.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button>';

        	$output['data'][] = $row;
        }
        return $output;
	}
	
	public function current_subscription_details($company_id){
		$raw_query = "
		SELECT SQL_CALC_FOUND_ROWS cmp.id as company_id, company_name, email_1, contact_1, sp.name as subscrion_name, 
		COUNT(us.id) as total_registration,
		(CASE WHEN sp.max_value !=0  THEN  sp.max_value  ELSE 'N/A' end) as total_allowed,
		(CASE WHEN sp.max_value !=0  THEN  (sp.max_value - COUNT(us.id))  ELSE 'N/A' end) as total_left
		FROM `companies` as `cmp` LEFT JOIN `subscription_plan` as `sp` ON `sp`.`id`= `cmp`.`subscription` 
		LEFT JOIN `users` as `us` ON `us`.`company_id` = `cmp`.`id` 
		WHERE company_id = '$company_id'
		GROUP BY `cmp`.`id` 
		ORDER BY `company_id` ASC 
		";
		// echo $raw_query; die;
		return $raw_query_res = $this->db->query($raw_query)->row_array();
	}


}

?>