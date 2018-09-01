<?php 
class Settings_model extends CI_Model {	
    
    public function get_sales_stages(){
        $sale_stages_query = "SELECT id, name, description, probability, status, is_deleted, created_date, created_by, updated_date, updated_by FROM `sales_stages` WHERE `status` = '1'";
        return $this->db->query($sale_stages_query)->result_array();
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
}