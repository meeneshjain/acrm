
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Preferences and Action Center
                </h3>
            </div>
            <div>
            </div>
        </div>
    </div>

<!-- END: Subheader -->

<?php echo '<br>';; ?>
<div class="m-content">
    <div class="row">
        <div class="col-lg-4">
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                User Role & Permissions Section 
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                                <span>
                                    User Role
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon" data-toggle="modal" data-target="#user_role_modal">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <?php foreach($user_role as $role){ ?>
                            <li class="list-group-item"> <b><?php echo $role;  ?> </b></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        
            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Subscription Plans and options
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                <span>
                                   Subscription Plan
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <!-- <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <?php foreach($subscription_plan as $plans){ ?>
                            <li class="list-group-item"> <b><?php echo $plans;  ?> </b></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            
            <!-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Portlet sub title goes here
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--accent">
                                <span>
                                    Projects
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <li class="list-group-item"> <b>Cras justo odio </b></li>
                        <li class="list-group-item"> <b>Dapibus ac facilisis in </b></li>
                        <li class="list-group-item"> <b>Morbi leo risus </b></li>
                        <li class="list-group-item"> <b>Porta ac consectetur ac </b></li>
                        <li class="list-group-item"> <b>Vestibulum at eros </b></li>
                    </ul>
                </div>
            </div> -->
            <!--end::Portlet-->
        </div>
        <div class="col-lg-4">
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Sales Stages & modify probability
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                <span>
                                    Sales Stages
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="javascript:;" id="fetch_sale_stages" class="m-portlet__nav-link m-portlet__nav-link--icon" data-toggle="modal" data-target="#sale_Stages_modal">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <?php foreach($sales_stages as $sale){ ?>
                            <li class="list-group-item"> <b><?php echo $sale;  ?> </b></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        
            <!-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Portlet sub title goes here
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--success">
                                <span>
                                    Recent Customers
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <li class="list-group-item"> <b>Cras justo odio </b></li>
                        <li class="list-group-item"> <b>Dapibus ac facilisis in </b></li>
                        <li class="list-group-item"> <b>Morbi leo risus </b></li>
                        <li class="list-group-item"> <b>Porta ac consectetur ac </b></li>
                        <li class="list-group-item"> <b>Vestibulum at eros </b></li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Portlet sub title goes here
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--primary">
                                <span>
                                    Projects
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <li class="list-group-item"> <b>Cras justo odio </b></li>
                        <li class="list-group-item"> <b>Dapibus ac facilisis in </b></li>
                        <li class="list-group-item"> <b>Morbi leo risus </b></li>
                        <li class="list-group-item"> <b>Porta ac consectetur ac </b></li>
                        <li class="list-group-item"> <b>Vestibulum at eros </b></li>
                    </ul>
                </div>
            </div> -->
            <!--end::Portlet-->
        </div>
        <div class="col-lg-4">
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Targets Duration & options
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--warning">
                                <span>
                                    Targets
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                      <!--   <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <?php foreach($target_duration as $duration){ ?>
                            <li class="list-group-item"> <b><?php echo $duration;  ?> </b></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        
            <!-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Portlet sub title goes here
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--accent">
                                <span>
                                    Recent Customers
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <li class="list-group-item"> <b>Cras justo odio </b></li>
                        <li class="list-group-item"> <b>Dapibus ac facilisis in </b></li>
                        <li class="list-group-item"> <b>Morbi leo risus </b></li>
                        <li class="list-group-item"> <b>Porta ac consectetur ac </b></li>
                        <li class="list-group-item"> <b>Vestibulum at eros </b></li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-statistics"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Portlet sub title goes here
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--success">
                                <span>
                                    Projects
                                </span>
                            </h2>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="fa fa-upload"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <ul class="list-group">
                        <li class="list-group-item"> <b>Cras justo odio </b></li>
                        <li class="list-group-item"> <b>Dapibus ac facilisis in </b></li>
                        <li class="list-group-item"> <b>Morbi leo risus </b></li>
                        <li class="list-group-item"> <b>Porta ac consectetur ac </b></li>
                        <li class="list-group-item"> <b>Vestibulum at eros </b></li>
                    </ul>
                </div>
            </div> -->
            <!--end::Portlet-->
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="sale_Stages_modal" tabindex="-1" role="dialog" aria-labelledby="sale_Stages_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="edit_sale_stages"  data-parsley-validate action="<?php echo base_url('settings/update_sale_stages'); ?>">
            <div class="modal-header">
                <h4 class="modal-title" id="sale_Stages_modal_lable">
                    <b>Update Sales Stage Probabity</b>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 sale_stages_loader" style="display:none">
                    <div class="text-center">
                        <i class="fa fa-superpowersfa-spin rem-3" ></i>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group m-form__group row sale_stages_data">
                        <div class="col-lg-2">
                            <b>#</b>
                        </div>
                        <div class="col-lg-5">
                            <b>Name</b>
                        </div>
                        <div class="col-lg-5">
                            <b>Probability</b>
                        </div>
                        </div>   
                    <?php foreach($all_stages as $key => $stage){  ?>
                    <div class="form-group m-form__group row sale_stages_data">
                        <div class="col-lg-2">
                            <label>
                                <?php echo $stage['id']; ?>
                            </label>
                        </div>
                        <div class="col-lg-5">
                        <input type="text" readonly id="sale_stages_input_<?php echo $stage['id']; ?>" value="<?php echo $stage['name']; ?>" name="sale_stage[<?php echo $stage['id']; ?>][name]" class="form-control m-input" placeholder="name">
                    </div>
                    <div class="col-lg-5">
                        <input type="text" id="sale_stages_input_<?php echo $stage['id']; ?>" value="<?php echo $stage['probability']; ?>"  name="sale_stage[<?php echo $stage['id']; ?>][probability]" class="form-control m-input" placeholder="10">
                    </div>
                        
                    </div>    
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="update_note_btn"  class="btn btn-primary">
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

<div class="modal fade" id="user_role_modal" tabindex="-1" role="dialog" aria-labelledby="user_role_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="edit_sale_stages"  data-parsley-validate action="<?php echo base_url('settings/update_user_permissions'); ?>">
            <div class="modal-header">
                <h4 class="modal-title" id="user_role_modal_lable">
                    <b>User Role & Permissions</b>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
          </div>
            <div class="modal-footer">
                <button type="submit" id="update_user_btn"  class="btn btn-primary">
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