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
}