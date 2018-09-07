<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
    
    public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("common_model");
		$this->sessionData = $this->session->userdata();
		check_session();
	}
    
    public function index() {
         $data['page_title'] = 'Items';
         $data['breadcum_title'] = 'Items';
         $data['active_sidemenu'] = "item";
         $data['load_js'] = 'items';
         $data['data_source'] = base_url('items/itemlist');
         $this->load->view('include/header',$data);
         $this->load->view('items',$data);
         $this->load->view('include/footer');
     }

     public function itemlist(){
        $this->load->model("items_model");
        $response =  $this->items_model->itemlist();
        echo json_encode($response);
        die;
    }

        public function add_update_item(){
        if($this->input->is_ajax_request())
        {
            $is_gst = 0;
            if(isset($_POST['is_gst']))
            {
                 $is_gst = 1;
            }

            $data = array(
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'type' => $this->input->post('type'),
                            'unit' => $this->input->post('unit'),
                            'description' => $this->input->post('description'),
                            'created_date' => DATETIME,
                            'is_gst' => $is_gst,
                            'status' => '1',
                            'is_deleted' => '0',
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('items',$data,$where);
                echo json_encode(array("status" => "success","message" => 'Item Updated Successfully', "data" => ""));
            }
            else
            {
                $result = $this->common_model->insert('items', $data);
                echo json_encode(array("status" => "success","message" => 'Item Added Successfully.', "data" => $result));
            }
            die;

        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function edit_item(){
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = $this->common_model->getdata($selected = 'id,logo,code,name,description,type,unit,is_gst,group_id,price_id,created_date','items', $where = array('id' => $id ), $limit = false, $offset = false, $orderby=false);
                echo json_encode(array("status" => "success","message" => '', "data" => $data));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Item Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }

    public function delete_item(){
        if($this->input->is_ajax_request())
        {
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = array('is_deleted' => '1','updated_date' => DATETIME);
                $res_data = $this->common_model->update_data('items',$data,array('id' => $id));
                echo json_encode(array("status" => "success","message" => 'Item Deleted Successfully!!', "data" => ''));
            }
            else
            {
                echo json_encode(array("status" => "error","message" => 'Item Id doesn\'t exist.', "data" => ""));
            }
        }
        else
        {
            echo json_encode(array("status" => "error","message" => 'UNAUTHORIZED ACCESS', "data" => ""));
        }
    }
     
}

?>