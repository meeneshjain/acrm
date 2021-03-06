<?php 
class Company_model extends CI_Model {	

	public function companylist()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "companies as c";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'c.id', 'c.logo', 'c.company_name', 'c.email_1', 'c.contact_1', 'c.created_date','c.status');
		
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

		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
		$this->db->from($dt_table);

		if($this->session->userdata('is_admin') == 1){
			$this->db->where(array('is_deleted' => '0'));
		}
		else { //	if($this->session->userdata('user_role_id') == 1){
			$this->db->where(array('is_deleted' => '0', 'id' => get_current_company()));
		}


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

		$company_permission = get_user_permission();
        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
            $row[] = '<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" name="users" id="participant_'.$aRow['id'].'" value="'.$aRow['id'].'" class="compckbx"><span class="ml-3"></span></label>';
            $imgscr = base_url('assets/images/no.jpg');
            if(!empty($aRow['logo']))
            {
            	$imgscr = base_url($aRow['logo']);
            }
        	$row[] = '<img class="m-widget7__img img-thumbnail" src="'.$imgscr.'" alt="" style="width:80px">';
        	$row[] = $aRow['company_name'];
        	$row[] = $aRow['email_1'];
        	$row[] = $aRow['contact_1'];
        	if($aRow['status'] == '0'){ 
        		$row[] = '<span class="m-badge m-badge--danger m-badge--wide">Inactive</span>'; 
        	}else{ $row[] = '<span class="m-badge m-badge--success m-badge--wide">Active</span>'; }
        	$row[] = date('d M,Y @ h:i A',strtotime($aRow['created_date']));
        	
        	if($this->session->userdata('is_admin') == 1){
				$row[] = '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="getDetail(this,'.$aRow['id'].')" ><i class="fa fa-edit"></i></button> <button onclick="deleteCompany(this,'.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button>';
        	}
        	else if(in_array('comp_e',$company_permission)){
					$row[] = '<button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air add_update_click edit_company" data-el_id="'.$aRow['id'].'" data-form_type="edit" onclick="getDetail(this,'.$aRow['id'].')" ><i class="fa fa-edit"></i></button>';
			}else{
				$row[] = '';
			}
				
        	$output['data'][] = $row;
        }
        return $output;
    }

    public function insert()
	{
		$userArray = array(
			'user_role_id' => '1',
			'email' => $this->input->post('email_address'),
			'username' => $this->input->post('user_name'),
			'password' => md5($this->input->post('password')),
			'first_name	' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'mobile_no' => $this->input->post('user_contact_no'),
			'created_date' => DATETIME,
			'dob' => DATE,
			'doj' => DATE,
			'status' => '1',
			'is_deleted' => '0',
			'created_by' => '1'
		);
		$company_name = $this->input->post('company_name');
		$companyArray = array(
			'company_name' => $company_name,
			'logo' => $this->input->post('uploaded_images'),
			'company_prefix' => $this->input->post('company_prefix'),
			'company_code_start' => '0001',
			'email_1' => $this->input->post('email_1'),
			'email_2' => $this->input->post('email_2'),
			'contact_1	' => $this->input->post('contact_1'),
			'contact_2	' => $this->input->post('contact_2'),
			'subscription	' => $this->input->post('subscription'),
			'about_company	' => $this->input->post('about_company'),
			'address	' => $this->input->post('address'),
			'created_date' => DATETIME,
			'updated_date' => DATETIME,
			'pan_no' => DATE,
			'gstin_no' => DATE,
			'status' => (isset($_POST['status']) && $_POST['status']==1) ? 1 : 0,
			'is_deleted' => '0'
		);

		$this->db->insert('`companies`', $companyArray);
		$company_id = $this->db->insert_id();
		$userArray['company_id'] = $company_id;
		$this->db->insert('`users`', $userArray);
		
		// generate default smtp details for the company 
		generate_company_smtp($company_id, $company_name);
		// insert default email templates for the company 		
		generate_new_company_templates($company_id); 
		// Insert User Role Permission default value
		generate_company_user_role($company_id);

		// Send Employee registration email
		$mail_var = array(
            "{{app_name_short}}" => APP_NAME,
            "{{base_url}}" => base_url(),
            "{{user_full_name}}" => $this->input->post('first_name').' '.$this->input->post('last_name'),
            "{{user_name}}" => $this->input->post('username'),
            "{{password}}" => $this->input->post('password'),
            "{{app_name_full}}" => POWERED_BY_FULL
        );

		generate_email($this->input->post('email_address'),'company_employee_registration',$mail_var);
	}

	public function edit_detail($id)
	{
		return $this->db->query("SELECT * FROM `companies` WHERE `is_deleted` = '0' AND `id` = '$id'")->result_array();
	}

	public function check_prefix($prefix,$id)
	{
		$query = $this->db->get_where('companies', array('company_prefix' => $prefix));
        return $query->num_rows();
	}

	public function update_detail()
	{
		$data = array(
			'company_name' => $this->input->post('company_name'),
			'logo' => $this->input->post('uploaded_images'),
			'email_1' => $this->input->post('email_1'),
			'email_2' => $this->input->post('email_2'),
			'contact_1' => $this->input->post('contact_1'),
			'contact_2' => $this->input->post('contact_2'),
			'subscription' => $this->input->post('subscription'),
			'about_company' => $this->input->post('about_company'),
			'address' => $this->input->post('address'),
			'subscription' => $this->input->post('subscription'),
			'subscription' => $this->input->post('subscription'),
			'status' => (isset($_POST['status']) && $_POST['status']==1) ? 1 : 0,
			'updated_date' => DATETIME,

		);
		$where = array('id' => $this->input->post('id'));
		$this->db->where($where);
		$this->db->update('companies',$data);
	}

	public function delete_detail($id)
	{
		$data['status'] = '0';
		$data['is_deleted'] = '1';
		$data['updated_date'] = DATETIME;
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->update('`companies`',$data);
	}
}

?>