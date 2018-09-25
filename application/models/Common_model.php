<?php 
class Common_model extends CI_Model {	


	public function getdata($selected = false, $table, $where = false, $limit = false, $offset = false,$orderby=false) {
		if($selected == false) {
			$this->db->select('*');
		}
		else {
			$this->db->select($selected);
		}
		/**/
		$this->db->from($table);
		/**/
		if($where != false){
			$this->db->where($where);
		}
		/**/
		if($offset != false && $limit != false)
		{
			$this->db->limit($offset, $limit);
		}
		if($orderby != false)
		{
			$this->db->order_by($orderby[0],$orderby[1]);
		}
		/**/

		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result();
	}

	
	//insert your data in single row
	public function insert($table, $data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
		/*$data = array(
        	'title' => 'My title',
        	'name' => 'My Name',
        	'date' => 'My date'
		);
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')*/
	}

	/**
	 * Insert Batch
	 *
	 * inster multipal data in signle query
	 *
	 * @param array $table
	 * @param array $data
	 *
	 */
	public function insert_batch($table, $data){
		$this->db->insert_batch($table, $data);
		/*
		$data = array(
			array(
				'title' => 'My title',
                'name' => 'My Name',
                'date' => 'My date'
            ),
            array(
            	'title' => 'Another title',
                'name' => 'Another Name',
                'date' => 'Another date'
        	)
		);
		// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date'),  ('Another title', 'Another name', 'Another date')*/
	}

	/**
	 * Update Data
	 *
	 * update data
	 *
	 * @param string $table
	 * @param array $data
	 * @param array $where
	 *
	 */
	public function update_data($table,$data,$where) {
		$this->db->where($where);
		$this->db->update($table,$data);
		return $this->db->affected_rows();
	}

	/**
	 * Delete Data
	 *
	 * delete data from table
	 *
	 * @param string $table
	 * @param array $where
	 */
	public function delete_data($table, $where) {
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}

	/**
	 * Custom Query
	 *
	 * user define query exiqute
	 *
	 * @param string $query
	 *
	 */
	public function customQuery($query)
	{
		$query = $this->db->query($query);
		return $query->result();
	}


	public function customQueryCount($query)
	{
		return $this->db->query($query)->num_rows();
	}


	/* WITH SINGLE TABLE */
	public function get_datatable_json($table,$column_name,$where,$orderby)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$get_data = $this->input->get(NULL, TRUE);
		$dt_table = $table;
		$sort_column = array(false, true, true, false, false, false);
		
		$dt_columns = $column_name;
		
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
			$this->db->order_by($orderby);
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
		if($where != NULL)
		{
			$this->db->where($where);
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

        foreach ($dt_result->result_array() as $aRow) {
        	$output['data'][] = $aRow;
        }
        return $output;
    }

}

?>