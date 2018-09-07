<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    User List
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
                                    User List
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
                            <table class="table-responsive table table-striped- table-bordered table-hover table-checkable dt_table  m-table--head-separator-primary" id="user_list_dt_table" data-source="<?php echo $data_source; ?>">
                                <thead class="">
                                    <tr>
                                        <th class="no-sort">
                                            <label class="m-checkbox m-checkbox--state-primary">
                                                <input type="checkbox" class="compckbxAll" onclick="checkAll('compckbxAll','compckbx')" name="">
                                                <span></span>
                                            </label>
                                        </th>
                                        <th>
                                            Company Name
                                        </th>
                                        <th>
                                           Designation
                                        </th>
                                        <th>
                                            First Name
                                        </th>
                                        <th>
                                            Last Name
                                        </th>
                                        <th>
                                            Mobile No.
                                        </th>
                                        <th>
                                            Landline
                                        </th>
                                        <th>
                                            Created Date
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

<div class="modal fade" id="add_update_user_modal" tabindex="-1" role="dialog" aria-labelledby="add_update_user_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="user_form" action=""  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="add_update_user_modal_label">
                        Add User
                    </h4>
                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <div class="profile_section" id="profile_section_box">
                        <h5 class="m-section__heading"> Profile </h5>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>   User Role </label>
                                <select required class="form-control m-input" id="user_role" name="user_role">
                                    <option value="">Select User Role</option>
                                    <?php echo $user_role;?>
                                </select>
                            </div>
                            <div class="col-lg-4" id="team_lead_dropdown" style="display:none"> <!--  -->
                                <label> Team Lead Name  </label>
                                <select required class="form-control m-input" id="team_lead_dd" name="team_lead_dd">
                                    <option value="">Assign Team Leader</option>
                                    <?php echo $team_leader_options;?>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                        
                    <h5 class="m-section__heading">User Details </h5>
                    <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                            <label>
                                Designation
                            </label>
                            <input type="text" id="designation" name="designation" class="form-control m-input" placeholder="Enter Designation">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                First Name
                            </label>
                            <input required type="text" id="first_name" name="first_name" class="form-control m-input" placeholder="Enter  First Name">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Last Name
                            </label>
                            <input required type="text" id="last_name" name="last_name" class="form-control m-input" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                            <label>
                                Email
                            </label>
                            <input type="email" id="email" name="email" data-parsley-required-message="Enter A Valid Email Address" class="form-control m-input" placeholder="Enter your another email">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                User Name
                            </label>
                            
                            <input required type="text" id="username" name="username" class="form-control m-input" placeholder="Enter  User-Name">
                        
                        </div>
                        <div class="col-lg-4">
                            <label>
                               Password
                            </label>
                            <input required type="text" id="password" name="password" class="form-control m-input" placeholder="Enter Last Name">
                        </div>
                        
                    </div>
                    <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                            <label>
                                Mobile Number
                            </label>
                            <input type="text" id="mobile" name="mobile" class="form-control m-input" placeholder="Enter your Mobile Number">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Other Contact /Landline
                            </label>
                            <input required type="text" id="contact_1" name="landline" class="form-control m-input only_number" placeholder="Enter contact number">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Address
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <textarea  class="form-control m-input" id="address" name="address" placeholder="Full Address" ></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>
                                Date Of Birth
                            </label>
                            <input type="text" id="dob" name="dob" class="form-control m-input crm_datetimepicker" placeholder="Date of Birth">
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Date Of Joining
                            </label>
                            <input type="text" id="doj" name="doj" class="form-control m-input crm_datetimepicker" placeholder="Date of Birth">
                        </div>
                        <div class="col-lg-4">
                        <label > Is Active </label> <br>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" id="is_active" name="status" value="1">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="company_id" value="<?php echo $loggedin_company_id; ?>">
                    <input type="hidden" id="user_id" name="id" value="0">
                    <button type="button" id="save_update_button_click"  class="btn btn-primary">
                        <i class="fa fa-check"></i> Save
                    </button>
                    
                    <button type="button" class="btn btn-danger close_modal_common" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>