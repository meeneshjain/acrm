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
	
	public function top_bar_report(){
		$report_data = array(
			"total_won_orders" =>  "",
			"total_open_so" =>  "",
			"total_open_sq" =>  "",
			"total_open_opportunity" =>  "",
		);
		$sessionData = $this->session->userdata();
		$is_super_admin = $sessionData['is_admin'];
		$user_role_id  = $sessionData['user_role_id'];
		$logged_in_company = get_current_company();
		$current_user_id = get_current_user_id(); // user wise report if not super admin 
		
		if($is_super_admin == 1){ // super admin 
			$total_won_orders = "SELECT COUNT(id) as total_won_orders FROM sales_order WHERE type = 'ORDER' AND stages = 'close'";
			$report_data['total_won_orders'] = $this->db->query($total_won_orders)->row()->total_won_orders;
			
			$total_open_so = "SELECT COUNT(id) as total_open_so FROM sales_order WHERE type = 'ORDER' AND (stages != 'close' OR stages != 'cancel')";
			$report_data['total_open_so'] = $this->db->query($total_open_so)->row()->total_open_so;

			$total_open_sq = "SELECT COUNT(id) as total_open_sq FROM sales_order WHERE type = 'QUOTATION' AND (stages != 'close' OR stages != 'cancel')";
			$report_data['total_open_sq'] = $this->db->query($total_open_sq)->row()->total_open_sq;

			$total_open_opportunity = "SELECT COUNT(id) as total_open_opportunity from contact_lead WHERE is_type = '2' and opp_sales_stage NOT IN (8,9)";
			$report_data['total_open_opportunity'] = $this->db->query($total_open_opportunity)->row()->total_open_opportunity;
		} else {
			if($user_role_id == "1"){ // company admin 
				$so_extra_where = " AND company_id = '$logged_in_company' ";
				$contact_lead_extra_where = " AND company_id = '$logged_in_company' ";
			
			} else if($user_role_id == "2"){ // RM report
				 $get_reports_to_tl = "SELECT GROUP_CONCAT(id) as tl_id from users WHERE user_role_id = 3 AND reports_to_user_id='$current_user_id' AND company_id = '$logged_in_company' ";
				 $get_reports_to_tl_res = $this->db->query($get_reports_to_tl)->row()->tl_id;
				 if($get_reports_to_tl_res == "" || $get_reports_to_tl_res == null){
					 $get_reports_to_tl_res = 0;
				 }
				 
				 $get_reporto_user = "SELECT GROUP_CONCAT(id) as user_id from users WHERE user_role_id = 4 AND reports_to_user_id IN ($get_reports_to_tl_res) AND company_id = '$logged_in_company'";
				 $get_reporto_user_res = $this->db->query($get_reporto_user)->row()->user_id;
				 
				 $array_tl_id =  explode(",", $get_reports_to_tl_res);
				 $array_user_id = explode(",", $get_reporto_user_res);
				 
				 $company_tl_user_id = implode(",", array_unique(array_merge($array_tl_id,$array_user_id)));
				 
				 $so_extra_where = " AND company_id = '$logged_in_company' AND  sales_employee IN ('$company_tl_user_id')";
				$contact_lead_extra_where = " AND company_id = '$logged_in_company' AND owner_id IN ('$company_tl_user_id')";
			} else if($user_role_id == "3"){ // TL report 
				$get_reporto_user = "SELECT GROUP_CONCAT(id) as user_id from users WHERE user_role_id = 4 AND reports_to_user_id IN ($current_user_id) AND company_id = '$logged_in_company'";
				$get_reporto_user_res = $this->db->query($get_reporto_user)->row()->user_id;
				if($get_reporto_user_res == "" || $get_reporto_user_res == null){
					 $get_reporto_user_res = 0;
				 }
				$array_user_id = explode(",", $get_reporto_user_res);
				$array_user_id = array_push($array_user_id, $current_user_id);	
				
			   $company_user_id =  implode(",", $array_user_id);
			   $so_extra_where = " AND company_id = '$logged_in_company' AND  sales_employee IN ('$company_user_id')";
			   $contact_lead_extra_where = " AND company_id = '$logged_in_company' AND owner_id IN ('$company_user_id')";
				 
			} else if($user_role_id == "4"){ // user report 
			   $so_extra_where = " AND company_id = '$logged_in_company' AND  sales_employee IN ('$current_user_id')";
			   $contact_lead_extra_where = " AND company_id = '$logged_in_company' AND owner_id IN ('$current_user_id')";
			}
			
			$total_won_orders = "SELECT COUNT(id) as total_won_orders FROM sales_order WHERE type = 'ORDER' AND stages = 'close' $so_extra_where";
			$report_data['total_won_orders'] = $this->db->query($total_won_orders)->row()->total_won_orders;
			
			$total_open_so = "SELECT COUNT(id) as total_open_so FROM sales_order WHERE type = 'ORDER' AND (stages != 'close' OR stages != 'cancel') $so_extra_where";
			$report_data['total_open_so'] = $this->db->query($total_open_so)->row()->total_open_so;

			$total_open_sq = "SELECT COUNT(id) as total_open_sq FROM sales_order WHERE type = 'QUOTATION' AND (stages != 'close' OR stages != 'cancel') $so_extra_where";
			$report_data['total_open_sq'] = $this->db->query($total_open_sq)->row()->total_open_sq;

			$total_open_opportunity = "SELECT COUNT(id) as total_open_opportunity from contact_lead WHERE is_type = '2' and opp_sales_stage NOT IN (8,9) $contact_lead_extra_where";
			$report_data['total_open_opportunity'] = $this->db->query($total_open_opportunity)->row()->total_open_opportunity;
		}
		
		return $report_data;
	}
	
	public function service_call_report(){
		$report_data = array(
			"prod_so" =>  "",
			"customer_no_so" =>  "",
			"total_amount_so" =>  "",
			
			"prod_sq" =>  "",
			"customer_no_sq" =>  "",
			"total_amount_sq" =>  "",
			
			"prod_opportunities" =>  "0",
			"customer_no_opportunities" =>  "0",
			"total_amount_opportunities" =>  "0",
			
			"prod_total" =>  "",
			"customer_no_total" =>  "",
			"total_amount_total" =>  "",
		);
		
		$sessionData = $this->session->userdata();
		$is_super_admin = $sessionData['is_admin'];
		$user_role_id  = $sessionData['user_role_id'];
		$logged_in_company = get_current_company();
		$current_user_id = get_current_user_id();	
		
		if($is_super_admin == 1){ // super admin 
			$so_where = "";
			$sq_where = "";
			
		} else {
			if($user_role_id == "1"){ // company admin 
				$so_where = "  AND so.company_id = '$logged_in_company'  ";
				$sq_where = "  AND so.company_id = '$logged_in_company'  ";
			} else if($user_role_id == "2"){ // RM report
				 // RM report
				 $get_reports_to_tl = "SELECT GROUP_CONCAT(id) as tl_id from users WHERE user_role_id = 3 AND reports_to_user_id='$current_user_id' AND company_id = '$logged_in_company' ";
				 $get_reports_to_tl_res = $this->db->query($get_reports_to_tl)->row()->tl_id;
				 if($get_reports_to_tl_res == "" || $get_reports_to_tl_res == null){
					 $get_reports_to_tl_res = 0;
				 }
				 
				 $get_reporto_user = "SELECT GROUP_CONCAT(id) as user_id from users WHERE user_role_id = 4 AND reports_to_user_id IN ($get_reports_to_tl_res) AND company_id = '$logged_in_company'";
				 $get_reporto_user_res = $this->db->query($get_reporto_user)->row()->user_id;
				 
				 $array_tl_id =  explode(",", $get_reports_to_tl_res);
				 $array_user_id = explode(",", $get_reporto_user_res);
				 
				 $company_tl_user_id = implode(",", array_unique(array_merge($array_tl_id,$array_user_id)));
				 
				 $so_where = " AND so.company_id = '$logged_in_company' AND  sales_employee IN ('$company_tl_user_id')";
				 $sq_where = " AND so.company_id = '$logged_in_company' AND sales_employee IN ('$company_tl_user_id')";
			
			} else if($user_role_id == "3"){ // TL report 
				$get_reporto_user = "SELECT GROUP_CONCAT(id) as user_id from users WHERE user_role_id = 4 AND reports_to_user_id IN ($current_user_id) AND company_id = '$logged_in_company'";
				$get_reporto_user_res = $this->db->query($get_reporto_user)->row()->user_id;
				if($get_reporto_user_res == "" || $get_reporto_user_res == null){
					 $get_reporto_user_res = 0;
				 }
				$array_user_id = explode(",", $get_reporto_user_res);
				$array_user_id = array_push($array_user_id, $current_user_id);	
				
			   $company_user_id =  implode(",", $array_user_id);
			   $so_where = " AND so.company_id = '$logged_in_company' AND  sales_employee IN ('$company_user_id')";
			   $sq_where = " AND so.company_id = '$logged_in_company' AND sales_employee IN ('$company_user_id')";
			   
				} else if($user_role_id == "4"){ // user report 
				$so_where = " AND so.company_id = '$logged_in_company' AND  sales_employee IN ('$current_user_id') ";
				$sq_where = "AND so.company_id = '$logged_in_company' AND sales_employee IN ('$current_user_id') ";
				
			}
		}
		
		$select_open_so_product = "SELECT COUNT(distinct(sod.item_id)) as open_so_product from sales_order_details  as sod
		LEFT JOIN sales_order as so ON so.id = sod.sales_order_id 
		WHERE so.`type`='ORDER' AND sod.status = '1' AND sod.is_deleted='0' $so_where";
		$report_data['prod_so']  = $this->db->query($select_open_so_product)->row()->open_so_product;
		
		
		$select_open_so_customer = "SELECT count(distinct(account_id)) AS open_so_customer FROM sales_order as so WHERE status = '1' AND is_deleted='0' $so_where";
		$report_data['customer_no_so']  = $this->db->query($select_open_so_customer)->row()->open_so_customer;
		
		
		$select_so_total_amount  = "SELECT FORMAT(SUM(so.actual_total), 3) as total_so_amount, SUM(so.actual_total) as total_non_formated_so from sales_order as so WHERE `type`='ORDER' AND status = '1' AND is_deleted='0' $so_where";
		$select_so_total_amount_res = $this->db->query($select_so_total_amount)->row();
		$report_data['total_amount_so'] = ($select_so_total_amount_res->total_so_amount!="") ? $select_so_total_amount_res->total_so_amount : 0;
		
		$select_open_sq_customer = "SELECT count(distinct(account_id)) as open_sq_customer from sales_order as so   WHERE `type`='QUOTATION' AND status = '1' AND is_deleted='0' $sq_where";
		$report_data['customer_no_sq'] = $this->db->query($select_open_sq_customer)->row()->open_sq_customer;
		
		
		$select_open_sq_product = "SELECT COUNT(distinct(sod.item_id)) as open_sq_product from sales_order_details  as sod
		LEFT JOIN sales_order as so ON so.id = sod.sales_order_id 
		WHERE so.`type`='QUOTATION' AND sod.status = '1' AND sod.is_deleted='0' $sq_where";
		$report_data['prod_sq'] = $this->db->query($select_open_sq_product)->row()->open_sq_product;
				
		$select_total_sq_amount = "SELECT FORMAT(SUM(so.actual_total), 3) as total_sq_amount, SUM(so.actual_total) as total_non_formated_sq from sales_order as so WHERE `type`='QUOTATION' AND status = '1' AND is_deleted='0' $sq_where";
		$select_total_sq_amount_res = $this->db->query($select_total_sq_amount)->row();
		$report_data['total_amount_sq'] = ($select_total_sq_amount_res->total_sq_amount!="") ? $select_total_sq_amount_res->total_sq_amount : 0;
		
		// opportunity section goes here 
		
		$report_data["prod_total"] = ($report_data['prod_so'] + $report_data['prod_sq']);
		$report_data["customer_no_total"] = ($report_data['customer_no_so'] + $report_data['customer_no_sq']);
		$report_data["total_amount_total"] = number_format((float)($select_total_sq_amount_res->total_non_formated_sq) + (float)($select_so_total_amount_res->total_non_formated_so), 3);
		
		return $report_data;
		
	}
}


?>