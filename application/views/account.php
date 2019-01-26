<?php
$account_perminssion = get_user_permission();
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
   <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Account List
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
                                    Account List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <?php if(in_array('acnt_a',$account_perminssion)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill acnt_modal_open_btn" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <?php } ?>

                                <?php if(in_array('acnt_d',$account_perminssion)){ ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill multiple_account_delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary " id="acnt_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="acntchkbxAll" onclick="checkAll('acntchkbxAll','acntchkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Account Code
                                    </th>
                                    <th>
                                        Account Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Contact
                                    </th>
                                    <th>
                                        Create Date
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


<div class="modal fade" id="acnt_modal" tabindex="-1" role="dialog" aria-labelledby="acnt_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="acnt_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title acnt_modal_heading" id="acnt_modal_lable">
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
                                    Account Name*
                                </label>
                                <input type="hidden" id="acnt_id" name="id">
                                <input type="text" required id="acnt_name" name="name" class="form-control m-input" data-parsley-required-message="" placeholder="Enter Account Name">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Account Number
                                </label>
                                <input type="text" disabled id="acnt_number" name="account_number" class="form-control m-input onlynumber" placeholder="Enter Account number">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Account Description
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea required class="form-control m-input" id="acnt_description" name="description" placeholder="About the account..." ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <div style="padding:5px;text-align: center;">
                                    <span class="checkduplicateaccount"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Contact
                                </label>
                                <input type="text" required id="acnt_contact"  name="contact_no_1" class="form-control m-input onlynumber" onblur="checkDuplicate(this,'contact_no_1')" data-parsley-type="digits" placeholder="Enter Contact number">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Eamil Address
                                </label>
                                <input type="text" required id="acnt_email"  name="email_1" class="form-control m-input" onblur="checkDuplicate(this,'email_1')" placeholder="Enter email address">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Other Contact
                                </label>
                                <input type="text" id="acnt_other_contact" name="contact_no_2" class="form-control m-input onlynumber" data-parsley-type="digits" placeholder="Enter Other Contact number">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Other Email Adress
                                </label>
                                <input type="text" id="acnt_other_contact" name="email_2" class="form-control m-input" placeholder="Enter Other Email Adress">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Address
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea required class="form-control m-input" id="acnt_address" name="address" placeholder="Enter Address" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                        <button type="button" id="acnt_action_btn"  class="btn btn-primary">
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