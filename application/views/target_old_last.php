
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

                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <?php
                        if(isset($my_target['role']) && $my_target['role'] == 'ADMIN')
                        {
                        ?>
                        <table class="table table-bordered m-table m-table--head-bg-brand ">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Role</th>
                                    <th>Target Title</th>
                                    <th>Target Type</th>
                                    <th>Target</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <thead>
                                <?php
                                if(isset($downline_user) && !empty($downline_user))
                                {
                                    foreach ($downline_user as $key => $value) 
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$value['first_name'].' '.$value['last_name'].' ('.$value['username'].')</td>';
                                        echo '<td>'.$value['role_name'].'</td>';
                                        if(isset($value['target']) && !empty($value['target']))
                                        {
                                            echo '<td>'.$value['target'][0]['target_title'].'</td>';
                                            echo '<td>'.$value['target'][0]['target_type'].'</td>';
                                            if($value['target'][0]['target_type'] == 'amount')
                                            {
                                            echo '<td>'.$value['target'][0]['amount'].'</td>';
                                            }
                                            if($value['target'][0]['target_type'] == 'product')
                                            {
                                                echo '<td>'.$value['target'][0]['product'].'</td>';
                                            }
                                            echo '<td>'.$value['target'][0]['name'].'</td>';
                                        }
                                        else
                                        {
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                        }
                                        if(isset($value['target']) && !empty($value['target']))
                                        {
                                            echo '<td><button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air edit_trgt" data-user-id="'.$value['id'].'" data-trgt-id="'.$value['target'][0]['id'].'" data-role="'.$value['role_name'].'"><i class="fa fa-edit"></i></button></td>';
                                        }
                                        else
                                        {
                                            echo '<td><button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air trgt_modal_open_btn" data-user-id="'.$value['id'].'" data-trgt-id="0" data-role="'.$value['role_name'].'"><i class="fa fa-plus"></i></button></td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </thead>
                        </table>
                        <?php                          
                        }
                        else if(isset($my_target['role']) && ($my_target['role'] == 'REGIONAL MANAGER' || $my_target['role'] == 'TEAM LEADER'))
                        {
                            if(isset($my_target['target']) && !empty($my_target['target']))
                            {
                                ?>
                                <form method="post" id="assign_target_form" action="target/assign_team_target"  data-parsley-validate>
                                <input type="hidden" id="target_type" name="target_type" value="<?php echo $my_target['target'][0]['target_type'];?>">
                                <input type="hidden" name="target_duration" value="<?php echo $my_target['target'][0]['target_duration_id'];?>">
                                
                                <h5>Distribut Target</h5>
                                <p><strong>Target Title: </strong><?php echo $my_target['target'][0]['target_title']?></p>
                                <p><strong>Target Type: </strong><?php echo ucfirst($my_target['target'][0]['target_type'])?></p>
                                <?php
                                if($my_target['target'][0]['target_type'] == 'amount')
                                {
                                echo '<input type="hidden" id="total_target_value" value="'.$my_target['target'][0]['amount'].'">';
                                echo '<p><strong>Target Amount: </strong>'.ucfirst($my_target['target'][0]['amount']).'</p>';
                                }
                                if($my_target['target'][0]['target_type'] == 'product')
                                {
                                echo '<input type="hidden" id="total_target_value" value="'.$my_target['target'][0]['product'].'">';
                                echo '<p><strong>Target Product: </strong>'.ucfirst($my_target['target'][0]['product']).'</p>';
                                }
                                ?>
                                <p><strong>Target Duration: </strong><?php echo ucfirst($my_target['target'][0]['name']).' ('.$my_target['target'][0]['in_days'].') Days'?></p>
                                <?php
                                if(isset($downline_user) && !empty($downline_user))
                                {
                                    echo '<table class="table table-bordered">';
                                    echo '<thead><tr><th>User Name</th><th>Profile</th><th>Title</th><th>Target</th></tr></thead><tbody>';
                                    foreach ($downline_user as $key => $value) 
                                    {
                                            echo '<tr><td>'.$value['first_name'].' '.$value['last_name'].' ('.$value['username'].')</td>';
                                            echo '<td><input type="hidden" name="user_id[]" value="'.$value['id'].'">'.$value['role_name'].'</td>';
                                            if(isset($value['target']) && !empty($value['target']))
                                            {
                                                echo '<td><input type="hidden" name="target_db_id[]" value="'.$value['target'][0]['id'].'"><input class="form-control m-input" required type="text" name="title[]" value="'.$value['target'][0]['target_title'].'" placeholder="Enter Title"></td>';
                                                if($value['target'][0]['target_type'] == 'amount')
                                                {
                                                    echo '<td><input class="form-control m-input target_amount" required type="text" name="target[]" value="'.$value['target'][0]['amount'].'" placeholder="Enter Target "></td></tr>';
                                                }
                                                if($value['target'][0]['target_type'] == 'product')
                                                {
                                                    echo '<td><input class="form-control m-input target_amount" required type="text" name="target[]" value="'.$value['target'][0]['product'].'" placeholder="Enter Target "></td></tr>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<td><input type="hidden" name="target_db_id[]" value="0"><input class="form-control m-input" required type="text" name="title[]" placeholder="Enter Title"></td>';
                                                echo '<td><input class="form-control m-input target_amount" required type="text" name="target[]" placeholder="Enter Target "></td></tr>';
                                            }
                                    }
                                    echo '<tr><td colspan="4"><button type="button" class="btn btn-primary trgt_assign_action_btn">SAVE</button></td></td></tr>';
                                    echo '</tbody></table>';
                                }
                                ?>
                                <hr>
                                </form>
                                <?php
                            }
                        }
                        /*else if(isset($my_target['role']) && $my_target['role'] == 'TEAM LEADER')
                        {
                            //echo 'You can not assign target because your REGIONAL MANAGER do not assign target to you.';
                            if(isset($my_target['target']) && !empty($my_target['target']))
                            {
                                ?>
                                <form method="post" id="assign_target_form" action="target/assign_user_target"  data-parsley-validate>
                                <input type="hidden" id="target_type" name="target_type" value="<?php echo $my_target['target'][0]['target_type'];?>">
                                <input type="hidden" name="target_duration" value="<?php echo $my_target['target'][0]['target_duration_id'];?>">
                                
                                <h5>Distribut Target</h5>
                                <p><strong>Target Title: </strong><?php echo $my_target['target'][0]['target_title']?></p>
                                <p><strong>Target Type: </strong><?php echo ucfirst($my_target['target'][0]['target_type'])?></p>
                                <?php
                                if($my_target['target'][0]['target_type'] == 'amount')
                                {
                                echo '<input type="hidden" id="total_target_value" value="'.$my_target['target'][0]['amount'].'">';
                                echo '<p><strong>Target Amount: </strong>'.ucfirst($my_target['target'][0]['amount']).'</p>';
                                }
                                if($my_target['target'][0]['target_type'] == 'product')
                                {
                                echo '<input type="hidden" id="total_target_value" value="'.$my_target['target'][0]['product'].'">';
                                echo '<p><strong>Target Product: </strong>'.ucfirst($my_target['target'][0]['product']).'</p>';
                                }
                                ?>
                                <p><strong>Target Duration: </strong><?php echo ucfirst($my_target['target'][0]['name']).' ('.$my_target['target'][0]['in_days'].') Days'?></p>
                                <?php
                                if(isset($downline_user) && !empty($downline_user))
                                {
                                    echo '<table class="table table-bordered">';
                                    echo '<thead><tr><th>User Name</th><th>Profile</th><th>Title</th><th>Target</th></tr></thead><tbody>';
                                    foreach ($downline_user as $key => $value) 
                                    {
                                            //if(isset($value['target'][0][]))
                                            echo '<tr><td>'.$value['first_name'].' '.$value['last_name'].' ('.$value['username'].')</td>';
                                            echo '<td>'.$value['role_name'].'</td>';
                                            echo '<td><input class="form-control m-input" required type="text" name="title[]" placeholder="Enter Title"></td>';
                                            echo '<td><input type="hidden" name="user_id[]" value="'.$value['id'].'">
                                                  <input class="form-control m-input target_amount" required type="text" name="target[]" placeholder="Enter Target "></td></tr>';
                                    }
                                    echo '<tr><td colspan="4"><button type="button" class="btn btn-primary trgt_assign_action_btn">SAVE</button></td></td></tr>';
                                    echo '</tbody></table>';
                                }
                                ?>
                                <hr>
                                </form>
                                <?php
                            }
                        }*/
                        ?>
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
                    <input type="hidden" name="trgt_user_id" id="trgt_user_id">
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
