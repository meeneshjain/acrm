
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                   Target List
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
                                    Target List
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill trgt_modal_open_btn">
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
                        <form method="post" id="trgt_form" action="target/add_update_target"  data-parsley-validate>
                        <!-- <table class="table table-striped- table-bordered table-hover table-checkable dt_table m-table--head-separator-primary" id="trgt_list_dt_table" data-source="<?php echo $data_source; ?>">
                            <thead>
                                <tr>
                                    <th class="no-sort">
                                        <label class="m-checkbox m-checkbox--state-primary">
                                            <input type="checkbox" class="trgtchkbxAll" onclick="checkAll('trgtchkbxAll','trgtchkbx')" name="">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>
                                        Target Name
                                    </th>

                                    <th>
                                        Target Type
                                    </th>

                                    <th>
                                        Target
                                    </th>

                                    <th>
                                        Target Duration
                                    </th>

                                    <th>
                                        Target Days
                                    </th>
                                    
                                    <th>
                                        Assign Date
                                    </th>
                                    <th class="no-sort">
                                      Action
                                    </th>
                                </tr>
                            </thead>
                        </table> -->

                        <?php 

                        if(isset($my_target['role']))
                        {
                        ?>
                        <input type="text" name="role" value="<?php echo $my_target['role'];?>">
                        <?php
                        }


                        if(isset($downline_user) && !empty($downline_user))
                        {
                            echo '<h1>Assign Target</h1>';
                            echo '<table class="table teable-responsive">';
                            echo '<thead><tr>';
                            echo '<th>User Name</th>';
                            echo '<th>Role</th>';
                            if(isset($my_target['role']) && $my_target['role'] == 'ADMIN')
                            {
                            echo '<th>Taget Type</th>';
                            echo '<th>Target</th>';
                            echo '<th>Target Duration</th>';
                            }
                            else
                            {
                            echo '<th>Target</th>';
                            }
                            echo '</tr></thead>';
                            foreach ($downline_user as $key => $value) 
                            {
                                echo '<tr>';
                                echo '<td><input type="hidden" name="assign_to[]" value="'.$value['id'].'">'.$value['first_name'].' '.$value['last_name'].' ('.$value['username'].')</td>';
                                echo '<td>'.$value['role_name'].'</td>';

                                if(isset($my_target['role']) && $my_target['role'] == 'ADMIN')
                                {
                                    if(isset($value['target']) && !empty($value['target']))
                                    {
                                        echo '<td>--</td>';
                                        echo '<td>--</td>';
                                        echo '<td>--</td>';
                                    }
                                    else
                                    {
                                        ?>
                                        <td>
                                            <select class="form-control m-input trgt_type" name="trgt_type[]">
                                                <option value="amount">Amount</option>
                                                <option value="product">Product</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control m-input trgt_amount" required name="trgt_amount[]" placeholder="Target Amount">
                                        </td>
                                        <td>
                                            <select required name="trgt_duration[]" class="form-control m-input trgt_duration">
                                                <option value="">--Target Duration--</option>
                                                <?php 
                                                echo ($target_duration);
                                                ?>
                                            </select>
                                        </td>
                                        <?php
                                    }
                                }
                                else
                                {
                                ?>
                                <td>
                                    <input type="text" required id="trgt_amount" name="trgt_amount" class="form-control m-input" placeholder="Target Amount">
                                </td>
                                <?php
                                }
                                echo '</tr>';
                            }
                            echo '</table>';
                        }

                        ?>
                        <button type="button" id="trgt_action_btn" class="btn btn-primary">
                            SAVE
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="trgt_modal" tabindex="-1" role="dialog" aria-labelledby="trgt_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title trgt_modal_heading" id="trgt_modal_label">
                   ADD NEW TARGET
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" id="trgt_form" action=""  data-parsley-validate>
                    <input type="hidden" name="id" id="trgt_id">
                    <div class="col-lg-12">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Target Name*
                                </label>
                                <input type="text" required id="trgt_name" name="trgt_name" class="form-control m-input" placeholder="Target Name">
                            </div> 
                            <div class="col-lg-6">
                                <label>
                                    Target Duration
                                </label>
                                <select required id="trgt_duration" name="trgt_duration" class="form-control m-input">
                                    <option value="">--Target Duration--</option>
                                    <?php 
                                    echo ($target_duration);
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label>
                                    Target Type
                                </label>
                                <select class="form-control m-input" id="trgt_type" name="trgt_type">
                                    <option value="amount">Amount</option>
                                    <option value="product">Product</option>
                                </select>
                            </div>
                            <div class="col-lg-6" id="trgt_type_amount">
                                <label>
                                   Target Amount
                                </label>
                                <input type="text" required id="trgt_amount" name="trgt_amount" class="form-control m-input" placeholder="Target Amount">
                            </div> 
                            <div class="col-lg-6" id="trgt_type_product" style="display: none;">
                                <label>
                                   Target Product
                                </label>
                                <input type="text" required id="trgt_product" name="trgt_product" class="form-control m-input" placeholder="Enter no. of product">
                            </div>  
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>
                                    Description
                                </label>
                                <textarea class="form-control m-input" id="trgt_description" name="trgt_description"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="trgt_action_btn" class="btn btn-primary">
                    SAVE
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
