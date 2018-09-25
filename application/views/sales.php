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
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" data-toggle="modal" data-target="#add_update_user_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a onclick="deleteMultiple()" href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                            <table class=" table table-striped- table-bordered table-hover table-checkable dt_table  m-table--head-separator-primary" id="user_list_dt_table" data-source="<?php echo $data_source; ?>">
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
                                         Contact Person
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

<div class="modal fade" id="add_update_user_modal" tabindex="-1" role="dialog" aria-labelledby="add_update_user_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-mlg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="user_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="add_update_user_modal_label">
                    <?php echo $popup_title; ?>
                    </h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group m-form__group row">
                            <label class="text-left col-lg-2 col-form-label">Account Code </label>
                            <div class="col-lg-3">
                                <select required class="form-control m-input" id="account_code" name="account_code">
                                    <option value="">Account Code</option>
                                    <?php echo $account_numbers; ?>
                                </select>
                            </div>
                            <div class="col-lg-2"></div>
                            <label class="text-left col-lg-2 col-form-label">   Document Number  </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="doc_number" required readonly name="doc_number" class="form-control m-input" placeholder="Enter Document Number">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Account Name </label>
                            <div class="col-lg-3">
                                  <input type="text" id="account_name" name="account_name" readonly class="form-control m-input" placeholder="Enter Account Name ">
                                </div>
                             <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        Document Date
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="doc_name" readonly name="doc_name" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Delivery Address </label>
                            <div class="col-lg-3">
                                  <input type="text" id="delivery_address" name="delivery_address" class="form-control m-input" placeholder="Enter Delivery Address">
                                </div>
                              <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                       Delivery Date
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="delivery_date" readonly name="delivery_date" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="Enter Delivery Date">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">GST No. </label>
                            <div class="col-lg-3">
                                  <input type="text" id="delivery_address" name="delivery_address" class="form-control m-input" placeholder="Enter GST. No">
                                </div>
                              <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        Valid Till
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="doc_name" readonly name="doc_name" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="Enter Document Date">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">PAN No. </label>
                            <div class="col-lg-3">
                                  <input type="text" id="pan_no" name="pan_no" class="form-control m-input" placeholder="Enter PAN No. Address">
                                </div>
                              <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        Status
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="status"  name="status" class="form-control m-input"   placeholder="Enter Current Status">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Contact Person </label>
                            <div class="col-lg-3">
                                  <select required class="form-control m-input" id="contact_person" required name="contact_person">
                                    <option value="">Select Contact Person</option>
                                </select>
                                </div>
                              <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        Sales Employee
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="sales_employee" required name="sales_employee" class="form-control m-input" placeholder="Enter Sales Employee" value="<?php echo  $sales_employee_name; ?>">
                                </div>
                        </div>
                         <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Contact Number </label>
                            <div class="col-lg-3">
                                  <input type="text" id="contact_no" required readonly name="contact_no" class="form-control m-input" placeholder="Enter Contact Number">
                                </div>
                              <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        Reference Quotation Number
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="ref_quote_no" readonly name="ref_quote_no" class="form-control m-input" placeholder="Reference Quotation Number">
                                </div>
                        </div>
                    </div>
                    <hr>  
                    <div class="table table-responsive">
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
                                <th class="pl-3">
                                    Quantity
                                </th>
                                <th class="pl-3">
                                    Price
                                </th>
                                <th class="pl-3">
                                    Discount
                                </th>
                                <th class="pl-3">
                                    Tax
                                </th>
                                <th class="pl-3">
                                    Total
                                </th>
                                <th class="pl-3">
                                    Remark
                                </th>
                                <th class="pl-3">
                                    <a href="javascript:;" class="btn btn-brand m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill add_more_rows btn-sm">
                                        <i class="fa fa-plus"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="item_detail_section">
                            <tr class="item_list_data" data-is_saved="0">
                            <td>
                                <div class="form-control m-input" >1</div>
                            </td>
                            <td>
                                <input type="text" id="item_code" name="item_detail[1][item_code]" required class="form-control m-input" placeholder="Item Code">
                            </td>
                            <td>
                                <input type="text" id="item_name" name="item_detail[1][item_name]" required class="form-control m-input" placeholder="Item Name">
                            </td>
                            <td>
                                <input type="text" id="quantity" name="item_detail[1][quantity]" class="form-control m-input" placeholder="Quantity">
                            </td>
                            <td>
                                <input type="text" id="price" name="item_detail[1][price]" class="form-control m-input" placeholder="Price">
                            </td>
                            <td>
                                <input type="text" id="discount" name="item_detail[1][discount]" class="form-control m-input" placeholder="Discount">
                            </td> 
                                <td>
                                    <input type="text" id="tax_amount" name="item_detail[1][tax_amount]" class="form-control m-input" placeholder="Enter Tax Amount">
                                </td>
                                <td>
                                    <input type="text" id="total" name="item_detail[1][total]" class="form-control m-input" placeholder="Total">
                                </td>
                                <td>
                                    <input type="text" id="remark" name="item_detail[1][remark]" class="form-control m-input" placeholder="Remark"> 
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill remove_crrent_row btn-sm ml-2">
                                        <i class="fa fa-minus"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>  
                    </div>
                    <div class="form-group m-form__group row">
                    <div class="col-md-6 row">
                    <label class="text-left col-lg-3 col-form-label">Pay Terms</label>
                        <div class="col-lg-7">
                            <textarea type="text" rows="3" id="pay_terms" name="pay_terms" class="form-control m-input" placeholder="Enter Payment Terms"></textarea>
                        </div>
                        <label class="text-left col-lg-3 col-form-label">Remark</label>
                        <div class="col-lg-7">
                            <textarea type="text" rows="3" id="remark" name="remark" class="form-control m-input" placeholder="Enter Remark"></textarea>
                        </div>
                        
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4 row">
                    <label class="text-left col-lg-5 col-form-label"> Total Amount </label>
                    <div class="col-lg-7 pull-right">
                            <input type="text" id="total_amount"  name="total_amount" class="form-control m-input" placeholder="Total Amount">
                        </div>
                         <label class="text-left col-lg-5 col-form-label"> Other Charges </label>
                    <div class="col-lg-7 pull-right">
                            <input type="text" id="other_charges"  name="other_charges" class="form-control m-input" placeholder="Other Charges">
                        </div>
                         <label class="text-left col-lg-5 col-form-label"> Total Tax </label>
                    <div class="col-lg-7 pull-right">
                            <input type="text" id="total_tax"  name="total_tax" class="form-control m-input" placeholder="Total Tax">
                        </div>
                         <label class="text-left col-lg-5 col-form-label"> Discount </label>
                    <div class="col-lg-7 pull-right">
                            <input type="text" id="discount"  name="discount" class="form-control m-input" placeholder="Discount">
                        </div>
                         <label class="text-left col-lg-5 col-form-label"> Actual Total </label>
                    <div class="col-lg-7 pull-right">
                            <input type="text" id="actual_total"  name="actual_total" class="form-control m-input" placeholder="Actual Total">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="company_id" id="logged_in_company_id" value="<?php echo $loggedin_company_id; ?>">
                    <input type="hidden" id="user_id" name="id" value="0">
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
                
                