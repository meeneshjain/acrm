<?php
$account_permission = get_user_permission();
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
   <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Enquiry List
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
                                    Enquiry List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <?php //if(in_array('enquiry_a',$account_permission)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill enquiry_modal_open_btn" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <?php //} ?>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary " id="enquiry_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="enquirychkbxAll" onclick="checkAll('enquirychkbxAll','enquirychkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Enquiry Date
                                    </th>
                                    <th>
                                        Organizaion
                                    </th>
                                    <th>
                                        A/C Manager
                                    </th>
                                    <th>
                                        Contact
                                    </th>
                                    <th>
                                        Status
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

<div class="modal fade" id="enquiry_modal" role="dialog" aria-labelledby="enquiry_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="enquiry_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title enquiry_modal_heading" id="enquiry_modal_lable">
                        EDIT ACCOUNT DETAIL
                    </h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Organization Name*
                                </label>
                                <input type="hidden" id="enquiry_id" name="id">
                                <input type="text" required id="enquiry_organization" name="organization" class="form-control m-input" data-parsley-required-message="" placeholder="Enter organization Name">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Organization Short Name*
                                </label>
                                <input type="text"  id="enquiry_organization_short_name" name="organization_short_name" class="form-control m-input" placeholder="Enter organization short name">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Account Manager*
                                </label>
                                <input type="text" required id="enquiry_account_manager" name="account_manager" class="form-control m-input" data-parsley-required-message="" placeholder="Enter account manager name">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Initiated By
                                </label>
                                <input type="text" readonly id="enquiry_initiated_by" name="initiated_by" class="form-control m-input" value="<?php echo $this->session->userdata('full_name')?>" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Expected In*
                                </label>
                                <input type="text" readonly required id="enquiry_order_expected" name="order_expected" class="form-control m-input crm_datepicker" data-parsley-required-message="" placeholder="Date of Expected In">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    State
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select id="enquiry_state" name="state" class="form-control m-input select2_selectbox" style="width:100%">
                                        <option value="">--Select State--</option>
                                        <?php echo get_states();?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Address
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea required class="form-control m-input" id="enquiry_address" name="address" placeholder="Enter Address" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Web Address
                                </label>
                                <input type="url" required id="enquiry_web_address" name="web_address" class="form-control m-input" data-parsley-required-message="" placeholder="Enter web address">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Email
                                </label>
                                <input type="email" required id="enquiry_email" name="email" class="form-control m-input" placeholder="Enter email address">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Contact
                                </label>
                                <input type="text" required id="enquiry_mobile" name="mobile" class="form-control m-input" data-parsley-required-message="" placeholder="Enter mobile">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <?php
                                if(isset($item_list) && !empty($item_list)){
                                ?>
                                <label>Select Items</label>
                                <select class="form-control select2_selectbox" style="width:100%" id="_item_list">
                                    <option value="">--Select Item--</option>
                                    <?php  foreach ($item_list as $key => $value) {
                                    echo '<option value="'.$value['id'].'">'.$value['name'].' ('.$value['code'].' )</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                            </div>
                            <div class="col-lg-12">
                                <table id="enquiry_item_list" class="table table-responsive table-bordered" >
                                    <thead>
                                        <tr style="background:#34BFA3">
                                            <th style="vertical-align:middle;padding:5px">#</th>
                                            <th style="vertical-align:middle;padding:5px">Item</th>
                                            <th style="vertical-align:middle;padding:5px">Quantity</th>
                                            <th style="vertical-align:middle;padding:5px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                        <button type="button" id="enquiry_action_btn"  class="btn btn-primary">
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