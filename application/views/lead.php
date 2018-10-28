
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Lead List
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
                                    Lead List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill lead_modal_open_btn" data-form_type="add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill multiple_lead_delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary table-responsive" id="lead_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="leadchkbxAll" onclick="checkAll('leadchkbxAll','leadchkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Account Name
                                    </th>
                                    <th>
                                        Lead Name
                                    </th>
                                    <th>
                                        Lead Owner
                                    </th>
                                    <th>
                                        Mobile
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Assign Date
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

<div class="modal fade" id="convert_to_opportunity_modal" tabindex="-1" role="dialog" aria-labelledby="convert_to_opportunity_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="convert_to_opportunity_label">
                   Convert to Opportunity
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" id="convert_to_opportunity_form" action="lead/convert_to_opportunity"  data-parsley-validate>
                    <input type="hidden" name="id" id="oppr_id">
                    <div class="col-lg-12">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Opportunity Name
                                </label>
                                <input type="text" disabled id="oppr_name" class="form-control m-input" placeholder="Opportunity Name">

                                
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Account Name
                                </label>
                                <input type="text" id="oppr_account_name" disabled class="form-control m-input" placeholder="Account Name">
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Currency
                                </label>
                                <select required id="oppr_currency" name="oppr_currency" class="form-control m-input">
                                    <option value="">--Currency--</option>
                                    <option value="INR"><i class="fa fa-inr"></i> INR</option>
                                    <option value="DOLLAR"><i class="fa fa-dollar"></i> Dollar</option>
                                </select>

                                
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Expected Close Date
                                </label>
                                <input type="text" required readonly id="oppr_close_date" name="oppr_close_date" class="form-control m-input crm_datepicker" placeholder="<?php echo date('Y-m-d');?>">
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                   Opportunity Amount
                                </label>
                                <input type="text" required id="oppr_amount" name="oppr_amount" class="form-control m-input" placeholder="Expected Amount">
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Type
                                </label>
                                <select required id="oppr_type" name="oppr_type" class="form-control m-input">
                                    <option value="">--Select Type--</option>
                                    <?php echo $opp_type;?>
                                </select>
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Sales Stage
                                </label>
                                <select required id="oppr_stage" name="oppr_stage" class="form-control m-input" >
                                    <option value="">--Select Sales Stage--</option>
                                    <?php 
                                    echo ($sales_stages);
                                    ?>
                                </select>
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Probability(%)
                                </label>
                                <input type="text" readonly id="oppr_probability" name="oppr_probability" class="form-control m-input" placeholder="">
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Lead Source
                                </label>
                                <select required id="oppr_source" name="oppr_source" class="form-control m-input">
                                    <option value="">--Lead Source--</option>
                                    <?php echo $lead_source;?>
                                </select>
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Next Step
                                </label>
                                <input type="text" required id="oppr_next_step" name="oppr_next_step" class="form-control m-input" placeholder="">
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Description
                                </label>
                                <textarea class="form-control m-input" id="oppr_description" name="oppr_description"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="convert_oppr_action_btn" class="btn btn-primary">
                    Convert
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lead_modal" tabindex="-1" role="dialog" aria-labelledby="lead_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="lead_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title lead_modal_heading" id="lead_modal_lable">
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
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Account Name
                                </label>
                                <select required id="lead_account" name="account_name" class="form-control m-input">
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
                            <div class="col-lg-4">
                                <label>
                                    Lead Owner
                                </label>
                                    <select required id="lead_owner_id" name="owner_id" class="form-control">
                                    <option>- Select User-</option>
                                    <?php 
                                    echo $user_list;
                                    ?>
                                </select>
                            </div> 
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    First Name
                                </label>
                                <input type="hidden" id="lead_id" name="id">
                                <input type="text" required id="lead_fname" name="first_name" class="form-control m-input" placeholder="Enter contact Name">
                            </div>

                            <div class="col-lg-6">
                                <label>
                                    Last Name
                                </label>
                                <input type="text" id="lead_lname" name="last_name" class="form-control m-input" placeholder="Enter contact number">
                            </div>
                        </div>

                        <div class="form-group m-form__group row"> 
                            <div class="col-lg-6">
                                <label>
                                    Mobile
                                </label>
                                <input type="text" required id="lead_mobile_no" name="mobile" class="form-control m-input" placeholder="Enter mobile number">
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Email
                                </label>
                                <input type="text" required id="lead_email_1" name="email_1" class="form-control m-input" placeholder="Enter email address">
                            </div> 
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Other Contact
                                </label>
                                <input type="text" id="lead_other_contact" name="other_contact" class="form-control m-input" placeholder="Enter contact Name">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Other Email
                                </label>
                                <input type="text" id="lead_other_email" name="other_email" class="form-control m-input" placeholder="Enter contact Name">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Fax
                                </label>
                                <input type="text" id="lead_fax" name="fax" class="form-control m-input" placeholder="Enter FAX number">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>
                                    Title
                                </label>
                                <input type="text" id="lead_title" name="title" class="form-control m-input" placeholder="Enter title">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Department
                                </label>
                                <input type="text" id="lead_department" name="department" class="form-control m-input" placeholder="Enter Department">
                            </div>
                            <div class="col-lg-4">
                                <label>
                                    Website
                                </label>
                                <input type="text" id="lead_website" name="website_url" class="form-control m-input" placeholder="Enter website url">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Primary Address
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  required class="form-control m-input" id="lead_paddress" name="primary_address" placeholder="Enter address" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>
                                    Other Address (Same as primary <input type="checkbox" id="clone_primary_address">)
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  class="form-control m-input" id="lead_saddress" name="secondary_address" placeholder="Enter address" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-3">
                                <label>
                                    City
                                </label>
                                <input type="text"  required id="lead_pcity" name="primary_city" class="form-control m-input" placeholder="Enter city">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    State
                                </label>
                                <input type="text"  required id="lead_pstate" name="primary_state" class="form-control m-input" placeholder="Enter state">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    City
                                </label>
                                <input type="text"  id="lead_scity" name="secondary_city" class="form-control m-input" placeholder="Enter city">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    State
                                </label>
                                <input type="text"  id="lead_sstate" name="secondary_state" class="form-control m-input" placeholder="Enter state">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-3">
                                <label>
                                    Pincode
                                </label>
                                <input type="text"  required id="lead_pcode" name="primary_pincode" class="form-control m-input" placeholder="Enter pincode">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Country
                                </label>
                                <input type="text"  required id="lead_pcountry" name="primary_country" class="form-control m-input" placeholder="Enter country">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Pincode
                                </label>
                                <input type="text"  id="lead_scode" name="secondary_pincode" class="form-control m-input" placeholder="Enter pincode">
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    Country
                                </label>
                                <input type="text"  id="lead_scountry" name="secondary_country" class="form-control m-input" placeholder="Enter country">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Description
                                </label>
                                <div class="m-input-icon m-input-icon--right">
                                    <textarea  required class="form-control m-input" id="lead_description" name="description" placeholder="Enter Description" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="lead_action_btn"  class="btn btn-primary">
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