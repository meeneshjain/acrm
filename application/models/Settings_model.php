<?php 
class Settings_model extends CI_Model {	
    
    public function get_sales_stages(){
        $sale_stages_query = "SELECT id, name, description, probability, status, is_deleted, created_date, created_by, updated_date, updated_by FROM `sales_stages` WHERE `status` = '1'";
        return $this->db->query($sale_stages_query)->result_array();
    }
    
    public function uom_list(){
        $uom_res = "SELECT id, code, `name`  FROM uom WHERE status = '1' AND is_deleted = '0' ";
        return $this->db->query($uom_res)->result_array();
    }
    
    public function update_sale_stages($post_data){
        $count = 0;
        foreach($post_data['sale_stage'] as $id => $sale ){
           $update_query = "UPDATE sales_stages SET probability = '$sale[probability]' WHERE id = '$id'";
            $update_query_res = $this->db->query($update_query);
            if($update_query_res){
               $count++;   
            }
       }
       if($count > 0){
           return 1;
       } else {
           return 0;
       }
    }
    
    public function save_update_uom($post_data){
        $update_set = array("status"=>"0", "is_deleted"=>"1");
        $this->db->update('uom' ,$update_set);
        
        foreach($post_data['uom'] as $key => $data){
            
            $insert_update_data_set = array(
                "status"=>"1", 
                "is_deleted"=>"0",
                "code" => $data['code'],
                "name" => $data['name'],
                "updated_date"=> DATETIME
            );
            if(isset($data['id']) && $data['id']!=""){
                $this->db->where("id", $data['id']);
                $this->db->update("uom", $insert_update_data_set);
            } else {
                $this->db->insert("uom", $insert_update_data_set);
            }
        }
        
    }
    
    public function delete_uom($uom_id){
        $update_dataset = array(
			"status"=> 0,
			"is_deleted"=> 1,
			"updated_date"=> DATETIME
		);
		$this->db->where(array('id' => $uom_id));
        $response = $this->db->update('`uom`',$update_dataset);
        if($response > 0){
            return 1;
        } else {
            return 0;
        }
    }
    
    public function get_email_template_content($template_key){
        $sessionData = $this->session->userdata();
        if($sessionData['is_admin'] == "1"){
            $select_template_query = "SELECT id, template_key, `subject`, `body`  FROM email_templates WHERE status = '1' AND is_deleted = '0' AND template_key = '$template_key' ";
        } else if($sessionData['is_admin'] == 0){
            $company_id = get_current_company();
            $select_template_query = "SELECT id, template_key, `subject`, `body`  FROM company_email_templates WHERE status = '1' AND is_deleted = '0' AND template_key = '$template_key' AND company_id='$company_id' ";
        }
        return $this->db->query($select_template_query)->row_array();
    }
    
    function update_email_template($post_data){
        $sessionData = $this->session->userdata();
        $update_data = array(
            "subject" => $post_data['subject'],
            "body" => $post_data['body'],
            "updated_date"=> DATETIME
        );
        if($sessionData['is_admin'] == "1"){
            $table = "email_templates";
            
        } else if($sessionData['is_admin'] == 0){
        $company_id = get_current_company();
          $this->db->where(array("template_key"=> $post_data['template_key'], "company_id" => $company_id));
           $table = "company_email_templates";
        }
        $response = $this->db->update($table, $update_data);    
        // echo $this->db->last_query(); die;
         if($response > 0){
            return 1;
        } else {
            return 0;
        }
    }
    
    public function get_general_setting_details(){
        $data = $this->db->query("SELECT `name`, sys_value as `value`, sys_group FROM system_settings WHERE status = 1 and is_deleted = 0")->result_array();
        $output_data = []; 
        foreach($data as $settings ){
            $output_data[$settings['name']] = $settings['value'];
        }
		return $output_data;
    }
    
    public function update_global_settings($post_data){
        $count_success = 0;
        foreach($post_data as $key => $value){
          $update_settings = "UPDATE system_settings SET `sys_value` = '$value' WHERE `name`= '$key' ";
          $update_settings_res = $this->db->query($update_settings);
            if($update_settings_res){
                $count_success++;
            }
        }
        if($count_success > 0){
            return 1; 
        } else {
            return 0;
        }
    }
    
    public function database_backup($post_data){
        $this->load->dbutil();

        $prefs = array(     
            'format'      => 'zip',             
            'filename'    => date("Y-m-d-H-i-s").'.zip'
        );
        $backup =& $this->dbutil->backup($prefs); 

        $filename = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = $filename;

        $this->load->helper('file');
        write_file($save, $backup); 


        $this->load->helper('download');
        force_download($filename, $backup);
        return 1;
    }
    
    public function get_company_subscription(){
        
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "companies as cmp";
		$sort_column = array(true, true, true, true, true, true);
		
		$dt_columns = array( 'cmp.id as company_id', 'company_name', 'email_1', 'contact_1', 'sp.name as subscrion_name', ' (CASE WHEN sp.max_value !=0  THEN  sp.max_value  ELSE "N/A" end) as total_allowed', 'COUNT(us.id) as total_registration', '(CASE WHEN sp.max_value !=0  THEN  (sp.max_value - COUNT(us.id))  ELSE "N/A" end) as total_left');
		
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
			$this->db->order_by('cmp.id', 'DESC');
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
        $this->db->join('subscription_plan as sp', 'sp.id= cmp.subscription', 'left');
        $this->db->join('users as us', ' us.company_id = cmp.id', 'left');
        $this->db->group_by('cmp.id');
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
            $row[] = $aRow['company_id'];
            $row[] = $aRow['company_name'];
            $row[] = $aRow['email_1'];
            $row[] = $aRow['contact_1'];
            $row[] = $aRow['subscrion_name'];
            $row[] = $aRow['total_allowed'];
            $row[] = $aRow['total_registration'];
            $row[] = $aRow['total_left'];
		
        	$output['data'][] = $row;
        }
        return $output;
	
    }
    
    public function get_company_urole_permission($user_role_id){
        $logged_in_company = get_current_company();
        $select_query = "SELECT `value` FROM company_urole_permission WHERE  status = 1 AND is_deleted = 0 AND company_id='$logged_in_company' AND user_role_id='$user_role_id'";
        return $this->db->query($select_query)->row_array()['value'];
    }
    
    public function update_company_urole_permission($post_data){
        $logged_in_company = get_current_company();
        $permission_string = implode(',', $post_data['perm']);
        
        $update_query = "UPDATE company_urole_permission SET `value`='$permission_string' WHERE company_id='$logged_in_company' AND user_role_id='$post_data[current_role_id]'";
        $result = $this->db->query($update_query);
        return 1;
    }
}