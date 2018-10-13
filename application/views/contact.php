
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Contact List
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
                                    Contact List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <?php
                                $user = 1;
                                if($user == 1)
                                {
                                ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;" class="contact_to_lead_btn m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </li>
                                <?php 
                                }
                                ?>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill cont_modal_open_btn" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill multiple_contact_delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary" id="cont_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="contchkbxAll" onclick="checkAll('contchkbxAll','contchkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Account Name
                                    </th>
                                    <th>
                                        Contact Name
                                    </th>
                                    <th>
                                        Mobile
                                    </th>
                                    <th>
                                        Email
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

<div class="modal fade" id="contact_to_lead_modal" tabindex="-1" role="dialog" aria-labelledby="contact_to_lead_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact_to_lead_label">
                    Assign Contact
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="contat_to_lead_form"  data-parsley-validate>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">
                            Assign to User:
                        </label>
                        <select class="form-control m-input" required id="assign_to_user_list" name="user_ids[]">
                            <option value="">- Select User-</option>
                            <?php 
                            echo $user_list;
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="convert_contact_to_lead()" class="btn btn-primary">
                    Assign
                </button>
                <button type="button" class="btn btn-danger"  data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cont_modal" tabindex="-1" role="dialog" aria-labelledby="cont_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="cont_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title cont_modal_heading" id="cont_modal_lable">
                        EDIT CONTACT DETAIL
                    </h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="checkduplicatecontact"></div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Account Name
                                </label>
                                <select required id="cont_account" name="account_name" class="form-control m-input">
                                    <option value=""> Select Account</option>
                                    <?php
                                    if(isset($account_list) && !empty($account_list))
                                    {
                                        foreach ($account_list as $key => $value) 
                                        {
                                            echo "<option value=".$value->id.">".$value->name." (".$value->account_number.")</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    First Name
                                </label>
                                <input type="hidden" id="cont_id" name="id">
                                <input type="text" required id="cont_fname" name="first_name" class="form-control m-input" placeholder="Enter contact Name">
                            </div>

                            <div class="col-lg-6">
                                <label>
                                    Last Name
                                </label>
                                <input type="text" id="cont_lname" name="last_name" class="form-control m-input" placeholder="Enter contact number">
                            </div>
                        </div>

                        <div class="form-group m-form__group row"> 
                            <div class="col-lg-6">
                                <label>
                                    Mobile
                                </label>
                                <input type="text" required id="cont_mobile_no" onblur="checkDuplicate(this,'mobile')" name="mobile" class="form-control m-input" placeholder="Enter mobile number">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Email
                                </label>
                                <input type="text" required id="cont_email_1" onblur="checkDuplicate(this,'email_1')" name="email_1" class="form-control m-input" placeholder="Enter email address">
                            </div> 
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Other Contact
                                </label>
                                <input type="text" id="cont_other_contact" name="other_contact" class="form-control m-input" placeholder="Enter contact Name">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Other Email
                                </label>
                                <input type="text" id="cont_other_email" name="other_email" class="form-control m-input" placeholder="Enter contact Name">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Fax
                                </label>
                                <input type="text" id="cont_fax" name="fax" class="form-control m-input" placeholder="Enter FAX number">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Title
                                </label>
                                <input type="text" id="cont_title" name="title" class="form-control m-input" placeholder="Enter title">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Department
                                </label>
                                <input type="text" id="cont_department" name="department" class="form-control m-input" placeholder="Enter Department">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Website
                                </label>
                                <input type="text" id="cont_website" name="website_url" class="form-control m-input" placeholder="Enter website url">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Primary Address
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  required class="form-control m-input" id="cont_paddress" name="primary_address" placeholder="Enter address" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Other Address (Same as primary <input type="checkbox" id="clone_primary_address">)
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  class="form-control m-input" id="cont_saddress" name="secondary_address" placeholder="Enter address" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-3">
                                <label>
                                    City
                                </label>
                                <input type="text"  required id="cont_pcity" name="primary_city" class="form-control m-input" placeholder="Enter city">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    State
                                </label>
                                <input type="text"  required id="cont_pstate" name="primary_state" class="form-control m-input" placeholder="Enter state">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    City
                                </label>
                                <input type="text"  id="cont_scity" name="secondary_city" class="form-control m-input" placeholder="Enter city">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    State
                                </label>
                                <input type="text"  id="cont_sstate" name="secondary_state" class="form-control m-input" placeholder="Enter state">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-3">
                                <label>
                                    Pincode
                                </label>
                                <input type="text"  required id="cont_pcode" name="primary_pincode" class="form-control m-input" placeholder="Enter pincode">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Country
                                </label>
                                <input type="text"  required id="cont_pcountry" name="primary_country" class="form-control m-input" placeholder="Enter country">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Pincode
                                </label>
                                <input type="text"  id="cont_scode" name="secondary_pincode" class="form-control m-input" placeholder="Enter pincode">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Country
                                </label>
                                <input type="text"  id="cont_scountry" name="secondary_country" class="form-control m-input" placeholder="Enter country">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Description
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  required class="form-control m-input" id="cont_description" name="description" placeholder="Enter Description" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="cont_action_btn"  class="btn btn-primary">
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