<?php 
class Home_model extends CI_Model {	
	
	public function login_check($username,$password, $user_type){
		$is_super_admin ="";
		if($user_type == 'admin') {
			$raw_query = 'SELECT * FROM admin 
			WHERE `username` = '.$this->db->escape($username).'  AND `password` = "'.md5($password).'"'; 
			$is_super_admin = 1;
		} else {
			$raw_query = 'SELECT * FROM users 
			WHERE ((`username` = '.$this->db->escape($username).') OR (`email` = '.$this->db->escape($username).'))  
			AND `password` = "'.md5($password).'"'; 
			$is_super_admin = 0; 
		}
		// print_r($raw_query); die;
		$query = $this->db->query($raw_query);
		if ($query->num_rows() > 0){ 
			$row = $query->row_array(); 
			return array("status" => 1,"row" => $row, 'is_super_admin'=> $is_super_admin);
		}  else {
			return array("status"=>0);
		}
	}
	
	public function server_side_example()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "categories as r";
		$dt_col_searchable = array(true, true, false, false);
		
		$dt_columns = array( 'r.id', 'r.categoryname', 'r.CategoryImage', 'r.id');
		
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

        foreach ($dt_result->result_array() as $aRow) {
        	
        	$row = array();
            //$row[] = '<input type="checkbox" name="users" id="participant_'.$aRow['id'].'" value="'.$aRow['id'].'" class="chlid_check">';
        	$row[] = ucfirst($aRow['id']) ;
        	$row[] = $aRow['categoryname'];
        	if(!file_exists($aRow['CategoryImage'])){
        		$image_path = "assets/images/no.jpg";
        	} else {
        		$image_path = $aRow['CategoryImage'];
        	}
        	
        	$row[] = '<img src="'.base_url($image_path).'" alt="'. $aRow['categoryname'].'" style="width:100px;">';
       		$row[] = '';

        	$output['data'][] = $row;
        }
        return $output;
    }
}


?>