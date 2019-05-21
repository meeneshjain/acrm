<?php
$sales_permission = get_user_permission();
?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   <?php echo $main_title; ?>
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
                                    <?php echo $main_title; ?>
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">

                                <?php  if($page_type == "sales_quote"){ 
                                    if(in_array('squtn_a',$sales_permission)){
                                    ?>
                                    <li class="m-portlet__nav-item">
                                        <a href="javascript:;" data-toggle="modal" data-target="#add_update_user_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                    <?php } }  ?>

                                    <?php  if($page_type == "sales_order"){ 
                                        if(in_array('sordr_a',$sales_permission)){
                                        ?>
                                        <li class="m-portlet__nav-item">
                                            <a href="javascript:;" data-toggle="modal" data-target="#add_update_user_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </li>
                                    <?php } }  ?>
                              
                                <!-- <li class="m-portlet__nav-item">
                                    <a onclick="deleteMultiple()" href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                            <div class="">
                                <table class="table table-striped- table-bordered table-hover table-checkable dt_table  m-table--head-separator-primary" id="user_list_dt_table" data-source="<?php echo $data_source; ?>">
                                    <thead class="">
                                        <tr>
                                            <th class="no-sort">
                                                <label class="m-checkbox m-checkbox--state-primary">
                                                    <input type="checkbox" class="usrchkbxAll" onclick="checkAll('usrchkbxAll','usrchkbx')" name="">
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th>
                                                Document No
                                            </th>
                                            <th>
                                              Doc. Date
                                            </th>
                                               <th>
                                              Account Name
                                            </th>
                                            <th>
                                             Business Partner
                                            </th>
                                            <th>
                                              Contact No
                                            </th>
                                            <th>
                                                Sales Employee
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Order Date
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
    </div>

<div class="modal fade" id="add_update_user_modal" role="dialog" aria-labelledby="add_update_user_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-mlg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="sales_action_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="add_update_user_modal_label">
                    <?php echo $popup_title; ?>
                    </h4>
                    <span class="col-sm-9"><button class="pull-right btn btn-xs btn-brand" onclick="printSalesOrder()" type="button" title="Print Popup Content"><i class="fa fa-print"></i></button></span>
                    
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body" id="modalDiv">
                    <div>
                        <div class="form-group m-form__group row ref_quote_no_block">
                            <label class="text-left col-lg-2 col-form-label ">
                                Reference Quotation Number
                            </label>
                            <div class="col-lg-3 col-sm-3 pull-right  ">
                           <!--  <input type="text" id="ref_quote_no" name="ref_quote_no" class="form-control m-input ref_quote_no_block" placeholder="Reference Quotation Number"> -->
                            <div class="ref_sales_order_input">
                              <!--  <select class="form-control m-input" id="ref_quote_no" name="ref_quote_no">
                                   <option value="">Select Sales Quotation Number</option>
                                </select> -->
                                <select style="width: 100%" class="form-control select2_selectbox" id="ref_quote_no" name="ref_quote_no" data-placeholder="Select Sales Quotation Number">
                                  <option value="">Select Sales Quotation Number</option>
                                </select>
                            </div>
                            <div class="ref_quote_no_label" style="display:none;">
                             <label class="text-left col-lg-2 col-sm-2 col-form-label "></label>
                            </div>
                        </div>
                        
                        <div class="col-lg-2 col-sm-2 loader_block" style="display:none;">
                            <span><i class="fa fa-spinner fa-spin fa-2x mt-2"></i></span>
                        </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="text-left col-lg-2 col-sm-2 col-form-label">Account Code </label>
                            <div class="col-lg-3 col-sm-3">
                               <!--  <select required class="form-control m-input" id="account_code" name="account_code">
                                    <option value="">Account Code</option>
                                    <?php // echo $account_numbers; ?>
                                </select> -->
                                <select style="width: 100%" class="form-control select2_selectbox" id="account_code" name="account_code" data-placeholder="Account Code">
                                  <option value="">Account Code</option>
                                  <?php echo $account_numbers; ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-2"></div>
                            <label class="text-left col-lg-2 col-sm-2 col-form-label">   Document Number  </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                    <input type="text" id="doc_number" required readonly name="doc_number" class="form-control m-input" placeholder="Enter Document Number">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">Account Name </label>
                            <div class="col-lg-3 col-sm-3">
                                  <input type="text" id="account_name" name="account_name" required readonly class="form-control m-input" placeholder="Enter Account Name ">
                                </div>
                             <div class="col-lg-2 col-sm-2"></div>
                                    <label class="text-left col-lg-2 col-sm-2 col-form-label">
                                        Document Date
                                    </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                    <input type="text" id="doc_date" readonly name="doc_date" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">Delivery Address </label>
                            <div class="col-lg-3 col-sm-3">
                                  <input type="text" id="delivery_address" name="delivery_address" class="form-control m-input" placeholder="Enter Delivery Address">
                                </div>
                              <div class="col-lg-2 col-sm-2"></div>
                                    <label class="text-left col-lg-2 col-sm-2 col-form-label">
                                       Delivery Date
                                    </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                    <input type="text" id="delivery_date" readonly name="delivery_date" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="Enter Delivery Date">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">GST No. </label>
                            <div class="col-lg-3 col-sm-3">
                                  <input type="text" id="gst_number" name="gst_number" class="form-control m-input" placeholder="Enter GST. No">
                                </div>
                              <div class="col-lg-2 col-sm-2"></div>
                                    <label class="text-left col-lg-2 col-sm-2 col-form-label">
                                        Valid Till
                                    </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                    <input type="text" id="valid_till" readonly name="valid_till" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="Enter Document Date">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">Business Partner </label>
                            <div class="col-lg-3 col-sm-3">
                                 <!--  <select required class="form-control m-input" id="contact_person" required name="contact_person">
                                    <option value="">Select Business Partner</option>
                                </select> -->
                                  <select required style="width: 100%" class="form-control select2_selectbox" id="contact_person" name="contact_person" data-placeholder="Select Business Partner">
                                  <option value="">Select Business Partner</option>
                                </select>
                                </div>
                              <div class="col-lg-2 col-sm-2"></div>
                             <label class="text-left col-lg-2 col-sm-2 col-form-label">Contact Number </label>
                            <div class="col-lg-3 col-sm-3">
                                  <input type="text" id="contact_no" required readonly name="contact_no" class="form-control m-input" placeholder="Enter Contact Number">
                                  <input type="hidden" id="contact_person_name" required readonly name="contact_name" class="form-control m-input" placeholder="">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">PAN No. </label>
                            <div class="col-lg-3 col-sm-3">
                                  <input type="text" id="pan_no" name="pan_no" class="form-control m-input" placeholder="Enter PAN No.">
                                </div>
                              <div class="col-lg-2 col-sm-2"></div>
                              <label class="text-left col-lg-2 col-sm-2 col-form-label"> Sales Employee </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                <input type="text" id="sales_employee" required name="sales_employee" class="form-control m-input" placeholder="Enter Sales Employee" value="<?php echo  $sales_employee_name; ?>">
                            </div>     
                        </div>
                         <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-sm-2 col-form-label">
                                        Stages
                                    </label>
                            <div class="col-lg-3 col-sm-3 pull-right">
                                <select required class="form-control m-input" id="sale_stages" required name="status">
                                </select>
                                </div>
                                 <div class="col-lg-2 col-sm-2"></div>
                                <!-- reference  -->
                                <div class="text-left col-lg-2 col-sm-2">
                                <label class="col-form-label revision_box_show sale_stages_sections"  style="display:none;">
                                     Is New Revision ?  
                                </label>
                                </div>
                                <div class="col-lg-3 col-sm-3 pull-right revision_box_show  sale_stages_sections" style="display:none;">
                                <span class="m-switch m-switch--icon pull-left">
                                        <label>
                                            <input type="checkbox" id="is_new_revision" name="is_new_revision" value="1">
                                            <span></span>
                                        </label>
                                    </span>
                                <input type="text" id="revision_number" name="revision_number" class="form-control m-input col-sm-5 " placeholder="Revision #" readonly>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="text-left col-lg-2 col-sm-2">
                                <label class="col-form-label cancel_reason_box sale_stages_sections" style="display:none;"> Cancel Reason </label>    
                            </div>
                            <div class="col-lg-3 col-sm-3">
                                  <textarea rows="3" id="cancel_reason" name="cancel_reason" required class="form-control m-input cancel_reason_box sale_stages_sections" style="display:none;" placeholder="Cancel Reason"></textarea>
                            </div>
                                <div class="col-lg-2 col-sm-2"></div>
                                
                        </div>
                    </div>
                    <hr>  
                    <div class="table ">
                        <table class="table m-table m-table--head-bg-success table-sm">
                        <thead>
                            <tr>
                                <th class="pl-3" width="3%">
                                    #
                                </th>
                                <th class="pl-3">
                                    Item Code
                                </th>
                                <th class="pl-3">
                                    Item Name
                                </th>
                                <th class="pl-3" width="8%">
                                    Quantity
                                </th>
                                <th class="pl-3">
                                    Price
                                </th>
                                <th class="pl-3" width="8%">
                                    Discount %
                                </th>
                                <th class="pl-3" width="8%">
                                    Tax %
                                </th>
                                <th class="pl-3" width="10%">
                                    Total
                                </th>
                                <th class="pl-3" width="15%">
                                    Remark
                                </th>
                                <th class="pl-3">
                                    <a href="javascript:;" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--pill add_more_rows btn-sm">
                                        <i class="fa fa-plus"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="item_detail_section"></tbody>
                    </table>
                    <hr>  
                    </div>
                    <div class="form-group m-form__group row">
                    <div class="col-md-6 col-sm-6 row">
                    <label class="text-left col-lg-3 col-sm-3 col-form-label">Pay Terms</label>
                        <div class="col-lg-7 col-sm-7">
                            <textarea type="text" rows="3" id="pay_terms" name="pay_terms" class="form-control m-input" placeholder="Enter Payment Terms"></textarea>
                        </div>
                        <label class="text-left col-lg-3 col-sm-3 col-form-label">Remark</label>
                        <div class="col-lg-7 col-sm-7">
                            <textarea type="text" rows="3" id="remark" name="remark" class="form-control m-input" placeholder="Enter Remark"></textarea>
                        </div>
                        
                    </div>
                    <div class="col-md-2 col-sm-2"></div>
                    <div class="col-md-4 col-sm-4 row">
                    <label class="text-left col-lg-5 col-sm-5 col-form-label"> Total Amount </label>
                    <div class="col-lg-7 col-sm-7 pull-right">
                            <input type="text" id="total_amount" readonly  name="total_amount" class="form-control m-input" placeholder="Total Amount" value="">
                        </div>
                         <label class="text-left col-lg-5 col-sm-5 col-form-label"> Other Charges </label>
                    <div class="col-lg-7 col-sm-7 pull-right">
                            <input type="text" id="other_charges"  name="other_charges" class="form-control m-input actual_calculator" placeholder="Other Charges" value="">
                        </div>
                        <div class="input-group m-form__group">
                         <label class="text-left col-lg-5 col-sm-5 col-form-label"> Tax on other charges </label>
                            <div class="col-lg-6 col-sm-6 pull-right">
                            <input type="text" id="total_tax"  name="total_tax" class="form-control m-input actual_calculator pull-left" placeholder="Tax on other charges" value="">
                            <div class="input-group-append" style="margin-top: -3px;">
                                <span class="input-group-text" id="basic-addon2">
                                  %
                                </span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group m-form__group">
                         <label class="text-left col-lg-5 col-sm-5 col-form-label"> Discount </label>
                    <div class="col-lg-6 col-sm-6 pull-right">
                            <input type="text" id="final_discount"  name="final_discount" class="actual_calculator form-control m-input pull-left" placeholder="Discount" value="">
                            <div class="input-group-append" style="margin-top: -3px;">
                                <span class="input-group-text" id="basic-addon2">
                                  %
                                </span>
                            </div>
                        </div>
                        </div>
                         <label class="text-left col-lg-5 col-sm-5 col-form-label"> Actual Total </label>
                    <div class="col-lg-7 col-sm-7 pull-right">
                            <input type="text" id="actual_total"  readonly name="actual_total" class="form-control m-input" placeholder="Actual Total" value="">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sales_employee_id" name="sales_employee_id" value="<?php echo  $sales_employee_id; ?>">
                    <input type="hidden" name="form_name" id="form_name"  value="<?php echo $page_type; ?>">
                    <input type="hidden" name="sales_form_title" id="sales_form_title" value="<?php echo $page_title; ?>">
                <input type="hidden" name="company_id" id="logged_in_company_id" value="<?php echo $loggedin_company_id; ?>">
                    <input type="hidden" id="sales_order_quotation_id" name="sales_id" value="0">
                    <input type="hidden" id="is_new_sales_order" name="is_new_sales_order" value="0">
                    <button type="button" id="save_update_button_click"  class="btn btn-primary">
                        <i class="fa fa-check"></i> Save
                    </button>
                    
                    <button type="button" class="btn btn-danger close_modal_common" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
</div>
                
<!-- <div class="modal fade extra_z_index" id="item_selection_modal" tabindex="-1" role="dialog" aria-labelledby="item_selection_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="user_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="item_selection_modal_label">
                    <?php echo 'Select Item' ?>
                    </h4>
                    <button type="button" class="close close_item_selection_modal remove_modal_over_modal_backdrop" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                 Modal Laucnhed
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-danger close_item_selection_modal remove_modal_over_modal_backdrop" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
</div> -->