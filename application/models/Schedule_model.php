<?php 
class Schedule_model extends CI_Model {	


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
			$this->db->order_by();
		}
		/**/
		$query = $this->db->get();
		return $query->result();
	}

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
}

?>