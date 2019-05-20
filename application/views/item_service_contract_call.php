<?php
$contractcall_permission = get_user_permission();
$page_name = $this->uri->segment(2);
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
                                

                                <?php if($page_name == "service_contract"){ 
                                if(in_array('sercon_a',$contractcall_permission)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" data-toggle="modal" data-target="#add_update_service_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <?php  }  } ?>

                                <?php if($page_name == "service_call"){ 
                                    if(in_array('sercall_a',$contractcall_permission)){ ?>
                                    <li class="m-portlet__nav-item">
                                        <a href="javascript:;" data-toggle="modal" data-target="#add_update_service_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>
                                <?php  }  } ?>
                                <!-- <li class="m-portlet__nav-item">
                                    <a onclick="deleteMultiple()" href="javascript:;" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
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
                                    <?php echo $table_header_footer; ?>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade" id="add_update_service_modal"  role="dialog" aria-labelledby="add_update_service_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-mlg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="item_service_form_obj" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="add_update_service_modal_label"></h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <div class="service_call_block">
                        <div class="form-group m-form__group row">
                            <label class="text-left col-lg-2 col-form-label">Service Contract Serial </label>
                            <div class="col-lg-3">
                                <!-- <select class="form-control m-input" id="service_contract_id" name="service_contract_id">
                                    <option value="">Select Service Contract</option>
                                </select> -->
                                <select required style="width: 100%" class="form-control select2_selectbox" id="service_contract_id" name="service_contract_id" data-placeholder="Select Service Contract">
                                    <option value="">Service Contract</option>
								</select>
                            </div>
                            <div class="col-lg-1 service_contract_serial_loader display_none">
                                <div class="text-left mt-1">
                                    <strong>
                                        <i class="fa fa-spinner fa-spin fa-1_5x"></i>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="form-group m-form__group row">
                            <label class="text-left col-lg-2 col-form-label">Account Code </label>
                            <div class="col-lg-3">
                               <!--  <select required class="form-control m-input" id="account_code" name="account_code">
                                    <option value="">Account Code</option>
                                </select> -->
                                <select required style="width: 100%" class="form-control select2_selectbox" id="account_code" name="account_code" data-placeholder="Select Account Code">
                                    <option value="">Account Code</option>
								</select>
                            </div>
                            <div class="col-lg-2"></div>
                            <label class="text-left col-lg-2 col-form-label">   Start Date  </label>
                            <div class="col-lg-3 pull-right">
                                <input type="text" id="start_date" value="<?php echo DATE ?>"  readonly name="start_date" class="form-control m-input crm_datepicker">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Account Name </label>
                            <div class="col-lg-3">
                                  <input type="text" id="account_name" name="account_name" required readonly class="form-control m-input" placeholder="Enter Account Name ">
                                </div>
                             <div class="col-lg-2"></div>
                                    <label class="text-left col-lg-2 col-form-label">
                                        End Date
                                    </label>
                            <div class="col-lg-3 pull-right">
                                    <input type="text" id="end_date" readonly name="end_date" class="form-control m-input crm_datepicker" value="<?php echo DATE ?>" placeholder="">
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Contact Person </label>
                            <div class="col-lg-3">
                                  <!-- <select required class="form-control m-input" id="contact_person" required name="contact_person">
                                    <option value="">Select Contact Person</option>
                                </select> -->
                                <select required style="width: 100%" class="form-control select2_selectbox" id="contact_person" name="contact_person" data-placeholder="Select Contact Person">
                                    <option value="">Contact Person</option>
								</select>
                                </div>
                              <div class="col-lg-2"></div>
                             <label class="text-left col-lg-2 col-form-label contract_block">
                                        Status
                                    </label>
                            <div class="col-lg-3 pull-right contract_block">
                                <select required class="form-control m-input" id="serviec_status" name="serviec_status"></select>
                            </div>
                            
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="text-left col-lg-2 col-form-label">Contact Number </label>
                            <div class="col-lg-3">
                                  <input type="text" id="contact_no" required readonly name="contact_no" class="form-control m-input" placeholder="Enter Contact Number">
                                  <input type="hidden" id="contact_person_name" required readonly name="contact_name" class="form-control m-input" placeholder="">
                                </div>
                                <div class="col-lg-2"></div>
                                 <label class="text-left col-lg-2 col-form-label contract_block">
                                    Serial Number        
                                </label>
                                <div class="col-lg-3 pull-right contract_block">
                                    <input type="text" id="serial_number" required name="serial_number" class="form-control m-input contract_block" value="" placeholder="Serial Number">
                                    <span class="text-danger show_serail_duplicate_error display_none"><b>This serial number already exists</b></span>
                                </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Item Code </label>
                            <div class="col-lg-3">
                                 <!--  <select required class="form-control m-input" id="item_code" required name="item_code">
                                    <option value="">Select Item Code</option>
                                </select> -->
                                <select required style="width: 100%" class="form-control select2_selectbox" id="item_code" name="item_code" data-placeholder="Select Item Code">
                                    <option value="">Item Code</option>
								</select>
                                </div>
                              <div class="col-lg-2"></div>
                             <label class="text-left col-lg-2 col-form-label contract_block">
                                        Free Services
                                    </label>
                            <div class="col-lg-3 pull-right contract_block">
                                <select required class="form-control m-input" id="free_services" name="free_services">
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Item Name </label>
                            <div class="col-lg-3">
                                  <input type="text" id="item_name" required readonly name="item_name" class="form-control m-input" placeholder="Item Name">
                                </div>
                              <div class="col-lg-2"></div>
                             <label class="text-left col-lg-2 col-form-label contract_block">
                                        Remark
                                    </label>
                            <div class="col-lg-3 pull-right contract_block">
                                <textarea rows="3" id="remark" name="remark" class="form-control m-input remark_box" placeholder="Remark"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row contract_block">
                                <label class="text-left col-lg-2 col-form-label">Response Time </label>
                            <div class="col-lg-3 row">
                                  <div class="col-md-5 get_closer_right">
                                      <input type="text" id="reponse_time" required name="reponse_time" class="form-control m-input">
                                  </div>
                                  <div class="col-md-7 get_closer_left">
                                      <select required class="form-control m-input" id="response_time_type" name="response_time_type">
                                      <option value="hours">Hour(s)</option>
                                      <option value="days">(Days)</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-lg-2"></div>
                                <label class="text-left col-lg-2 col-form-label ml-4">Resolution Time </label>
                            <div class="col-lg-3 row">
                                  <div class="col-md-5 get_closer_right">
                                      <input type="text" id="resolution_time" required  name="resolution_time" class="form-control m-input">
                                  </div>
                                  <div class="col-md-7 get_closer_left">
                                      <select required class="form-control m-input" id="resolution_time_type" name="resolution_time_type">
                                      <option value="hours">Hour(s)</option>
                                      <option value="days">(Days)</option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                        
                        <div class="service_call_block">
                        <hr>
                        <h4 class="heading">Call Details</h4>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Priority </label>
                            <div class="col-lg-3">
                                <select required class="form-control m-input" id="priority" required name="priority">
                                    <option value="">Select Priority</option>
                                </select>
                                </div>
                              <div class="col-lg-2"></div>
                             <label class="text-left col-lg-2 col-form-label">
                                        Subject
                                    </label>
                            <div class="col-lg-3 pull-right">
                               <input type="text" id="call_subject" name="call_subject" class="form-control m-input" value="" placeholder="Service Subject">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">Call Status </label>
                            <div class="col-lg-3">
                                <select required class="form-control m-input" id="call_status" required name="call_status">
                                    <option value="">Select Call Status</option>
                                </select>
                                </div>
                              <div class="col-lg-2"></div>
                            <label class="text-left col-lg-2 col-form-label">
                                Description
                            </label>
                            <div class="col-lg-3 pull-right">
                                <textarea id="call_description" name="call_description" class="form-control m-input" rows="3" placeholder="Service Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row call_status_block">
                           <div class="col-lg-2 call_status_label ">
                             <label class="text-left col-form-label planned_call_date">Planned Date </label>
                             <label class="text-left col-form-label tentative_call_date display_none">Tentative Date </label>
                             <label class="text-left col-form-label approved_call_date display_none">Approved Date </label>
                             <label class="text-left col-form-label rejected_call_date display_none">Rejected Date </label>
                           </div>
                            <div class="col-lg-3 status_call_input_date">
                                <input type="text" id="planned_date" name="planned_date" readonly class="form-control m-input crm_datepicker planned_call_date" value="" placeholder="Planned Date">
                                <input type="text" id="tentative_date" name="tentative_date" readonly class="form-control m-input crm_datepicker tentative_call_date display_none" value="" placeholder="Tentative date">
                                <input type="text" id="approved_date" name="approved_date" readonly class="form-control m-input crm_datepicker approved_call_date display_none" value="" placeholder="Approved date">
                                <input type="text" id="rejected_date" name="rejected_date" readonly class="form-control m-input crm_datepicker rejected_call_date display_none" value="" placeholder="Rejected date">

                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <hr>
                        <h4 class="heading">Techincal Details</h4>
                        <div class="form-groug m-form__group row">
                             <label class="text-left col-lg-2 col-form-label">
                                Problem Origin
                            </label>
                            <div class="col-lg-3 pull-right">
                               <select required class="form-control m-input" id="problem_origin" name="problem_origin">
                                    <option value="">Select Origin</option>
                                </select>
                            </div>
                             <div class="col-lg-2"></div>
                            <label class="text-left col-lg-2 col-form-label">
                                Given By
                            </label>
                            <div class="col-lg-3 pull-right">
                                <input type="text" id="given_by" name="given_by" class="form-control m-input" value="" placeholder="Given By">
                            </div>
                        </div>
                        <div class="form-groug m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">
                                    Problem Type
                                </label>
                                <div class="col-lg-3 pull-right">
                                <select required class="form-control m-input" id="problem_type" name="problem_type">
                                        <option value="">Select Type</option>
                                    </select>
                                </div>
                                <div class="col-lg-2"></div>
                                 <label class="text-left col-lg-2 col-form-label">
                                    Given To
                                </label>
                                <div class="col-lg-3 pull-right">
                                    <input type="text" id="given_to" name="given_to" class="form-control m-input" value="" placeholder="Given To">
                                </div>
                            </div>
                            <div class="form-groug m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">
                                    Problem Subtype
                                </label>
                                <div class="col-lg-3 pull-right">
                                <select class="form-control m-input" id="problem_subtype" name="problem_subtype">
                                        <option value="">Select Subtype</option>
                                    </select>
                                </div>
                                <div class="col-lg-2"></div>
                                <label class="text-left col-lg-2 col-form-label">
                                    Job Description
                                </label>
                                <div class="col-lg-3 pull-right">
                                    <input type="text" id="job_description" name="job_description" class="form-control m-input" value="" placeholder="Job Description">
                                </div>
                            </div>
                            <div class="form-groug m-form__group row">
                                 <label class="text-left col-lg-2 col-form-label">
                                    Call Type
                                </label>
                                <div class="col-lg-3 pull-right">
                                <select class="form-control m-input" id="call_type" name="call_type">
                                        <option value="">Select Call Type</option>
                                    </select>
                                </div>
                                <div class="col-lg-2"></div>
                               
                            </div>
                            <div class="form-groug m-form__group row">
                                <label class="text-left col-lg-2 col-form-label">
                                   Technician
                                </label>
                                <div class="col-lg-3 pull-right">
                                <input type="text" id="technician" name="technician" class="form-control m-input" value="" placeholder="Technician">
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sales_employee_name" name="sales_employee_name" value="<?php echo  $sales_employee_name; ?>">
                    <input type="hidden" id="sales_employee_id" name="sales_employee_id" value="<?php echo  $sales_employee_id; ?>">
                    <input type="hidden" name="form_name" id="form_name"  value="<?php echo $page_type; ?>">
                    <input type="hidden" name="sales_form_title" id="sales_form_title" value="<?php echo $page_title; ?>">
                    <input type="hidden" name="company_id" id="logged_in_company_id" value="<?php echo $loggedin_company_id; ?>">
                    <input type="hidden" id="item_service_id" name="item_service_id" value="0">
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