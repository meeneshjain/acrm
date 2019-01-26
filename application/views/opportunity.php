
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Opportunity List
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
                                    Opportunity List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary" id="lead_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="opprchkbxAll" onclick="checkAll('opprchkbxAll','opprchkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Lead Name
                                    </th>
                                    <th>
                                        Account Name
                                    </th>
                                    <th>
                                        Lead Owner
                                    </th>
                                    <th>
                                        Expected Close Date
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Sales Stage
                                    </th>
                                    <th>
                                        Lead Source
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
                                    <option value="1"> New Business</option>
                                    <option value="2"> Existing Business</option>
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
