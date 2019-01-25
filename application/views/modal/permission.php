
<div class="modal fade" id="user_role_modal" tabindex="-1" role="dialog" aria-labelledby="user_role_modal_lable"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
  <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed exclude_parsley_validation" id="add_edit_permission"  action="<?php echo base_url('settings/update_company_urole_permission'); ?>">

                <div class="modal-header">
                    <h4 class="modal-title" id="user_role_modal_lable">
                        <b>User Role & Permissions </b> - (<span class="permission_name_modal">  </span>)
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 permission_loader" style="display:none">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin rem-3"></i>
                        </div>
                    </div>
                    <div class="loaded_permision_container" style="display:none">
                    <?php  $permArr = explode(",", 'comp_v,comp_a,comp_e,comp_d'); ?>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Company
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline" >
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="comp_v" class="_comp_per" <?php if(in_array("comp_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="comp_a" class="_comp_per" <?php if(in_array("comp_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="comp_e" class="_comp_per" <?php if(in_array("comp_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="comp_d" class="_comp_per" <?php if(in_array("comp_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            User
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="user_v" class="_user_per" <?php if(in_array("user_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="user_a" class="_user_per" <?php if(in_array("user_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="user_e" class="_user_per" <?php if(in_array("user_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="user_d" class="_user_per" <?php if(in_array("user_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Target
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="trgt_v" class="_trgt_per" <?php if(in_array("trgt_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="trgt_a" class="_trgt_per" <?php if(in_array("trgt_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="trgt_e" class="_trgt_per" <?php if(in_array("trgt_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="trgt_d" class="_trgt_per" <?php if(in_array("trgt_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Account
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="acnt_v" class="_acnt_per" <?php if(in_array("acnt_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="acnt_a" class="_acnt_per" <?php if(in_array("acnt_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="acnt_e" class="_acnt_per" <?php if(in_array("acnt_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="acnt_d" class="_acnt_per" <?php if(in_array("acnt_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Contact
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="cntct_v" class="_cntct_per" <?php if(in_array("cntct_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="cntct_a" class="_cntct_per" <?php if(in_array("cntct_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="cntct_e" class="_cntct_per" <?php if(in_array("cntct_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="cntct_d" class="_cntct_per" <?php if(in_array("cntct_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Lead
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="lead_v" class="_lead_per" <?php if(in_array("lead_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="lead_a" class="_lead_per" <?php if(in_array("lead_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="lead_e" class="_lead_per" <?php if(in_array("lead_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="lead_d" class="_lead_per" <?php if(in_array("lead_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                        <div class="alert alert-primary no-alert-padding">
                            Opportunity
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="oprt_v" class="_oprt_per" <?php if(in_array("oprt_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="oprt_a" class="_oprt_per" <?php if(in_array("oprt_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="oprt_e" class="_oprt_per" <?php if(in_array("oprt_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="oprt_d" class="_oprt_per" <?php if(in_array("oprt_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                          Sales  Quatation
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="squtn_v" class="_squtn_per" <?php if(in_array("squtn_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="squtn_a" class="_squtn_per" <?php if(in_array("squtn_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="squtn_e" class="_squtn_per" <?php if(in_array("squtn_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="squtn_d" class="_squtn_per" <?php if(in_array("squtn_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                           Sales Order
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sordr_v" class="_sordr_per" <?php if(in_array("sordr_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sordr_a" class="_sordr_per" <?php if(in_array("sordr_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sordr_e" class="_sordr_per" <?php if(in_array("sordr_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sordr_d" class="_sordr_per" <?php if(in_array("sordr_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                         Inventory   Item
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="invitm_v" class="_invitm_per" <?php if(in_array("invitm_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="invitm_a" class="_invitm_per" <?php if(in_array("invitm_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="invitm_e" class="_invitm_per" <?php if(in_array("invitm_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="invitm_d" class="_invitm_per" <?php if(in_array("invitm_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                         Service   Item
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="seritm_v" class="_seritm_per" <?php if(in_array("seritm_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="seritm_a" class="_seritm_per" <?php if(in_array("seritm_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="seritm_e" class="_seritm_per" <?php if(in_array("seritm_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="seritm_d" class="_seritm_per" <?php if(in_array("seritm_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                        Service    Contract
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercon_v" class="_sercon_per" <?php if(in_array("sercon_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercon_a" class="_sercon_per" <?php if(in_array("sercon_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercon_e" class="_sercon_per" <?php if(in_array("sercon_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercon_d" class="_sercon_per" <?php if(in_array("sercon_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                           Service Call
                        </div>
                        <div class="m-form__group form-group">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercall_v" class="_sercall_per" <?php if(in_array("sercall_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercall_a" class="_sercall_per" <?php if(in_array("sercall_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercall_e" class="_sercall_per" <?php if(in_array("sercall_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sercall_d" class="_sercall_per" <?php if(in_array("sercall_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="m-form__group form-group" style="">
                         <div class="alert alert-primary no-alert-padding">
                          Sidebar  Option
                        </div>
                        <div class="m-form__group form-group row">
                            <div class="col-md-2">  <b>Notes</b></div>
                            <div class="col-md-8">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sdnts_v" class="_sdnts_per" <?php if(in_array("sdnts_v", $permArr)){ echo 'checked'; }?>>
                                    View
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sdnts_a" class="_sdnts_per" <?php if(in_array("sdnts_a", $permArr)){ echo 'checked'; }?>>
                                    Add
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sdnts_e" class="_sdnts_per" <?php if(in_array("sdnts_e", $permArr)){ echo 'checked'; }?>>
                                    Edit
                                    <span class="permission_form" ></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="checkbox" name="perm[]" value="sdnts_d" class="_sdnts_per" <?php if(in_array("sdnts_d", $permArr)){ echo 'checked'; }?>>
                                    Delete
                                    <span class="permission_form" ></span>
                                </label>
                             </div>
                            </div>
                            </div>
                            <div class="m-form__group form-group row">
                              <div class="col-md-2">  <b>Meeting: </b></div>
                            <div class="col-md-8">
                                <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdmtng_v" class="_sdmtng_per" <?php if(in_array("sdmtng_v", $permArr)){ echo 'checked'; }?>>
                                            View
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdmtng_a" class="_sdmtng_per" <?php if(in_array("sdmtng_a", $permArr)){ echo 'checked'; }?>>
                                            Add
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdmtng_e" class="_sdmtng_per" <?php if(in_array("sdmtng_e", $permArr)){ echo 'checked'; }?>>
                                            Edit
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdmtng_d" class="_sdmtng_per" <?php if(in_array("sdmtng_d", $permArr)){ echo 'checked'; }?>>
                                            Delete
                                            <span class="permission_form" ></span>
                                        </label>
                                
                                </div>
                            </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <div class="col-md-2">  <b>  Task: </b> </div>
                            <div class="col-md-8">
                                <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdtsk_v" class="_sdtsk_per" <?php if(in_array("sdtsk_v", $permArr)){ echo 'checked'; }?>>
                                            View
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdtsk_a" class="_sdtsk_per" <?php if(in_array("sdtsk_a", $permArr)){ echo 'checked'; }?>>
                                            Add
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdtsk_e" class="_sdtsk_per" <?php if(in_array("sdtsk_e", $permArr)){ echo 'checked'; }?>>
                                            Edit
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdtsk_d" class="_sdtsk_per" <?php if(in_array("sdtsk_d", $permArr)){ echo 'checked'; }?>>
                                            Delete
                                            <span class="permission_form" ></span>
                                        </label>
                                </div>
                            </div>
                            </div>
                            <div class="m-form__group form-group row">
                              <div class="col-md-2">  <b>    Calls: </b> </div>
                           
                              <div class="col-md-8">
                                  <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdcalls_v" class="_sdcalls_per" <?php if(in_array("sdcalls_v", $permArr)){ echo 'checked'; }?>>
                                            View
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdcalls_a" class="_sdcalls_per" <?php if(in_array("sdcalls_a", $permArr)){ echo 'checked'; }?>>
                                            Add
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdcalls_e" class="_sdcalls_per" <?php if(in_array("sdcalls_e", $permArr)){ echo 'checked'; }?>>
                                            Edit
                                            <span class="permission_form" ></span>
                                        </label>
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="perm[]" value="sdcalls_d" class="_sdcalls_per" <?php if(in_array("sdcalls_d", $permArr)){ echo 'checked'; }?>>
                                            Delete
                                            <span class="permission_form" ></span>
                                        </label>
                                </div>
                              </div>
                            </div>
                            </div>
                        </div>
                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="current_role_name" id="edit_permission_current_role_name" value="">
                    <input type="hidden" name="current_role_id" id="edit_permission_current_role_id" value="">
                    <button type="submit" id="update_uuser_role_btn" class="btn btn-primary">
                        <i class="fa fa-check"></i> Update
                    </button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
                </form>
        </div>
    </div>
</div>