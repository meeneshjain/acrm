<?php
$items_permission = get_user_permission();
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
   <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   <?php echo $page_title; ?>
                </h3>
           </div>
        </div>
    </div>

    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="-portlet m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Item List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">

                             <?php if($item_type == "inventory"){ 
                                if(in_array('invitm_a',$items_permission)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill item_modal_open_btn" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <?php } if(in_array('invitm_d',$items_permission)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill multiple_items_delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                                <?php  }  } ?>

                                <?php if($item_type == "service"){ 
                                    if(in_array('seritm_a',$items_permission)){ ?>
                                    <li class="m-portlet__nav-item">
                                        <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill item_modal_open_btn" data-form_type="add">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <?php } if(in_array('seritm_d',$items_permission)){ ?>
                                    <li class="m-portlet__nav-item">
                                        <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill multiple_items_delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </li>
                                    <?php  }  } ?>

                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary" id="item_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="itmckbxAll" onclick="checkAll('itmckbxAll','itmckbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        UOM
                                    </th>
                                    <th>
                                        GST
                                    </th>
                                    <th>
                                        Create Date
                                    </th>
                                    <th class="no-sort">
                                      Action
                                  </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="item_modal" tabindex="-1" role="dialog" aria-labelledby="item_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title item_modal_heading" id="item_modal_lable">
                        EDIT ITEM DETAIL
                    </h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group" style="margin-top: 7px;">
                                    <label class="">Itme Image</label>
                                    <div class="col-sm-4 col-md-3 col-lg-2">
                                        <div class="fileinput fileinput-new thum_img_outer" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail thum_img" style="height: 120px;" data-trigger="fileinput">
                                            <img data-folder_name="items" src="<?php echo base_url('assets/images/no.jpg') ?>" alt="..." id="changed_images" class="item_logo_src" style="max-width: 220px;" >
                                            </div>
                                            <a href="<?php echo base_url("home/remove_image"); ?>" class="btn btn-sm btn-pill btn-danger deleteImage hide" style="display:none"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <input type="file" id="upload_images_single" data-displayname="Item Logo"  name="..." accept="image/*"   >
                                    <input type="hidden" class="item_logo_src_value" name="uploaded_images" value="">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                        <label>
                                            Item Code:
                                        </label>
                                        <input required type="text" id="item_code" name="code" class="form-control m-input" placeholder="Enter Item Code">
                                    </div>    
                                    <div class="col-lg-6">
                                        <label>
                                            Item Name:
                                        </label>
                                        <input type="hidden" id="item_id" name="id" value="0">
                                        <input required type="text" id="item_name" name="name" class="form-control m-input" placeholder="Enter Item name">

                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>
                                            Item Type:
                                        </label>
                                        <select required class="form-control m-input" id="item_type" name="type">
                                            <option value=""> --Select Type --</option>
                                            <option value="SERIAL"> SERIAL</option>
                                            <option value="BATCH"> BATCH</option>
                                            <option value="NONE"> NONE</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>
                                            Item Group:
                                        </label>
                                        <select id="item_group" disabled  name="group" class="form-control m-input">
                                            <option value="SERVICE">Service</option>
                                            <option value="INVENTORY">Inventory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>
                                            Price List:
                                        </label>
                                        <select id="item_price_list" name="price_list" class="form-control m-input">
                                            <option value="price1"> Price 1 </option>
                                            <option value="price2"> Price 2 </option>
                                            <option value="price3"> Price 3 </option>
                                            <option value="price4"> Price 4 </option>
                                            <option value="price5"> Price 5 </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>
                                            Item Price:
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    INR
                                                </span>
                                            </div>
                                            <input required type="text" id="itm_price1" name="price1" data-parsley-required-message="" class="form-control m-input itm_prc_input" placeholder="Enter price1">
                                            <input required type="text" id="itm_price2" name="price2" data-parsley-required-message="" class="form-control m-input itm_prc_input" placeholder="Enter price2" style="display: none;">
                                            <input required type="text" id="itm_price3" name="price3" data-parsley-required-message="" class="form-control m-input itm_prc_input" placeholder="Enter price3" style="display: none;">
                                            <input required type="text" id="itm_price4" name="price4" data-parsley-required-message="" class="form-control m-input itm_prc_input" placeholder="Enter price4" style="display: none;">
                                            <input required type="text" id="itm_price5" name="price5" data-parsley-required-message="" class="form-control m-input itm_prc_input" placeholder="Enter price5" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    UOM:
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select id="item_uom" name="item_uom" class="form-control m-input">
                                        <?php echo $uom_list;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    GST Applicable(?)
                                </label><br>
                                <span class="m-switch m-switch--icon">
                                    <label>
                                        <input type="checkbox" checked="checked" id="item_gst" name="is_gst" value="0">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    GST Rate
                                </label>
                                <div class="input-group is_gst_rate_apply">
                                    <input required type="text" id="item_gst_rate" name="gst_tax_rate" data-parsley-required-message="" class="form-control m-input" placeholder="Enter gst rate">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2">
                                            %
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    About Item:
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea required class="form-control m-input" id="item_description" name="description" placeholder="About the items" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="item_type" id="item_type_id" value="<?php echo $item_type ?>">
                        <button type="button" id="item_action_btn"  class="btn btn-primary">
                         <i class="fa fa-check"></i> Update
                     </button>

                     <button type="button" class="btn btn-danger close_modal_common" data-dismiss="modal">
                         <i class="fa fa-times"></i> Close
                     </button>
                </div>
            </form>
        </div>
    </div>
</div>