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
         $data['uom_list'] = get_uom_list('html', '');
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
            $companyId = $this->sessionData['company_id'];
            //echo '<pre>';print_r($this->input->post());die;
            $is_gst = 0;
            if(isset($_POST['is_gst']))
            {
                 $is_gst = 1;
            }

            $data = array(
                            'company_id' => $companyId,
                            'name' => $this->input->post('name'),
                            'code' => $this->input->post('code'),
                            'type' => $this->input->post('type'),
                            'group_type' => $this->input->post('group'),
                            'unit' => $this->input->post('item_uom'),
                            'description' => $this->input->post('description'),
                            'is_gst' => $is_gst,
                            'gst_tax_rate' => $this->input->post('gst_tax_rate'),
                            'status' => '1',
                            'is_deleted' => '0',
                        );

            $pricelist = array(
                            'price1' => $this->input->post('price1'),
                            'price2' => $this->input->post('price2'),
                            'price3' => $this->input->post('price3'),
                            'price4' => $this->input->post('price4'),
                            'price5' => $this->input->post('price5'),
                            'status' => '1',
                            'is_deleted' => '0',
                        );
            //print_r($this->input->post());die;
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
                $data['updated_date'] = DATETIME;
                $where = array('id' => $this->input->post('id'));
                $this->common_model->update_data('items',$data,$where);

                $pricelist['updated_date'] = DATETIME;
                $where = array('item_id' => $this->input->post('id'),'company_id' => $companyId);
                $this->common_model->update_data('items_price_list',$pricelist,$where);
                echo json_encode(array("status" => "success","message" => 'Item Updated Successfully', "data" => ""));
            }
            else
            {
                $data['created_date'] = DATETIME;
                $result = $this->common_model->insert('items', $data);
                $item_id = $this->db->insert_id();
                $pricelist['item_id'] = $item_id;

                $pricelist['company_id'] = $companyId;
                $pricelist['created_date'] = DATETIME;
                $result = $this->common_model->insert('items_price_list', $pricelist);
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
            $companyId = $this->sessionData['company_id'];
            $id = $this->uri->segment(3);
            if(is_numeric($id) && !empty($id))
            {
                $data = $this->common_model->getdata($selected = 'id,logo,code,name,type,group_type,unit,description,is_gst,gst_tax_rate,created_date','items', $where = array('id' => $id ), $limit = false, $offset = false, $orderby=false);
                $item_id = $data[0]->id;
                $pricedata = $this->common_model->getdata($selected = 'price1,price2,price3,price4,price5','items_price_list', $where = array('company_id'=>$companyId,'item_id' => $item_id), $limit = false, $offset = false, $orderby=false);

                $itemData = json_decode(json_encode($data),true);

                $itemData[0]['price2'] = $pricedata[0]->price2;
                $itemData[0]['price3'] = $pricedata[0]->price3;
                $itemData[0]['price4'] = $pricedata[0]->price4;
                $itemData[0]['price5'] = $pricedata[0]->price5;
                echo json_encode(array("status" => "success","message" => '', "data" => $itemData));
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