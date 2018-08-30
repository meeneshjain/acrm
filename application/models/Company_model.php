<?php 
class Company_model extends CI_Model {	

	public function companylist()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = "companies as c";
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = array( 'c.id', 'c.company_name', 'c.email_1', 'c.contact_1', 'c.created_date');
		
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
		$this->db->where(array('status' => '0', 'is_deleted' => '0'));
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
            $row[] = '<input type="checkbox" name="users" id="participant_'.$aRow['id'].'" value="'.$aRow['id'].'" class="compckbx">';
        	$row[] = $aRow['company_name'];
        	$row[] = $aRow['email_1'];
        	$row[] = $aRow['contact_1'];
        	$row[] = date('d M,Y @ h:i A',strtotime($aRow['created_date']));
       		$row[] = '<button onclick="deleteCompany(this,'.$aRow['id'].')" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air"><i class="fa fa-trash-o"></i></button> <button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air" onclick="getDetail(this,'.$aRow['id'].')"><i class="fa fa-edit"></i></button>';

        	$output['data'][] = $row;
        }
        return $output;
    }

    public function insert()
	{
		$_POST['created_date'] = DATETIME;
		$_POST['updated_date'] = DATETIME;
		$_POST['pan_no'] = '';
		$_POST['gstin_no'] = '';
		$_POST['status'] = '0';
		$_POST['is_deleted'] = '0';
		$this->db->insert('`companies`', $_POST);
	}

	public function edit_detail($id)
	{
		return $this->db->query("SELECT * FROM `companies` WHERE `status` = '0' AND `id` = '$id'")->result_array();
	}

	public function update_detail()
	{
		$_POST['updated_date'] = DATETIME;
		$where = array('id' => $_POST['id']);
		unset($_POST['id']);
		$this->db->where($where);
		$this->db->update('`companies`',$_POST);
	}

	public function delete_detail($id)
	{
		$data['status'] = '1';
		$data['is_deleted'] = '1';
		$data['updated_date'] = DATETIME;
		$where = array('id' => $id);
		$this->db->where($where);
		$this->db->update('`companies`',$data);
	}
}

?>