                        
                        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-md-4">
                                            <div class="m-input-icon m-input-icon--left">
                                                <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-search"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="m-datatable m-table--head-bg-brand" id="html_table" width="100%">
                            <thead>
                                <tr>
                                    <th title="Field #1">
                                        User Name
                                    </th>
                                    <th title="Field #2">
                                        User Role
                                    </th>
                                    <th title="Field #3">
                                        Target Title
                                    </th>
                                    <th title="Field #4">
                                        Target Type
                                    </th>
                                    <th title="Field #5">
                                        Target
                                    </th>
                                    <th title="Field #6">
                                        Duration
                                    </th>
                                    <th title="Field #7">
                                        Downline User
                                    </th>
                                    <th title="Field #10">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //echo '<pre>';print_r($downline_user);die;
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
                                            echo '<td>'.$value['target'][0]['target'].'</td>';
                                            echo '<td>'.$value['target'][0]['name'].'</td>';
                                        }
                                        else
                                        {
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                            echo '<td>--</td>';
                                        }
                                        if($value['reported_users']>0)
                                        {
                                            echo '<td><button class="btn btn-info btn-sm view_my_dl_user" data-user-id="'.$value['id'].'" data-user-role="3" data-user-type="TL">'.$value['reported_users'].' <i class="fa fa-user"></i></button></td>';
                                        }
                                        else
                                        {
                                            echo '<td><button class="btn btn-info btn-sm" disabled data-user-id="'.$value['id'].'" data-user-role="3" data-user-type="TL">'.$value['reported_users'].' <i class="fa fa-user"></i></button></td>';
                                        }
                                        if(isset($value['target']) && !empty($value['target']))
                                        {
                                            echo '<td><button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air rm_edit_trgt" data-user-id="'.$value['id'].'" data-trgt-id="'.$value['target'][0]['id'].'" data-role="'.$value['role_name'].'"><i class="fa fa-edit"></i></button></td>';
                                        }
                                        else
                                        {
                                            echo '<td><button class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill m-btn--air rm_trgt_modal_open_btn" data-user-id="'.$value['id'].'" data-trgt-id="0" data-role="'.$value['role_name'].'"><i class="fa fa-plus"></i></button></td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="modal fade" id="rm_trgt_modal" tabindex="-1" role="dialog" aria-labelledby="rm_trgt_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title rm_trgt_modal_heading" id="rm_trgt_modal_label">
                                           ADD NEW TARGET
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                &times;
                                            </span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="" method="post" id="rm_trgt_form" action=""  data-parsley-validate>
                                            <input type="hidden" name="id" id="trgt_id">
                                            <input type="hidden" name="trgt_user_id" id="trgt_user_id">
                                            <input type="hidden" id="assigned_target">
                                            <input type="hidden" id="last_target">
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
                                                           Target
                                                        </label>
                                                        <input type="text" required id="trgt_target" name="trgt_target" class="form-control m-input" placeholder="Enter Target">
                                                    </div> 
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-6">
                                                        <label>
                                                            Start Date
                                                        </label>
                                                        <input type="text" readonly required id="trgt_start_date" name="trgt_start_date" class="form-control m-input trgt_datepicker" placeholder="Start Date">
                                                    </div>
                                                    <div class="col-lg-6" id="trgt_type_amount">
                                                        <label>
                                                           End Date
                                                        </label>
                                                        <input type="text" readonly required id="trgt_end_date" name="trgt_end_date" class="form-control m-input trgt_datepicker" placeholder="End Date">
                                                    </div> 
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label>
                                                            Description
                                                        </label>
                                                        <textarea class="form-control m-input" id="trgt_description" name="trgt_description" placeholder="description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="rm_trgt_action_btn" class="btn btn-primary">
                                            SAVE
                                        </button>
                                        <button type="button" class="btn btn-danger rm_mdl_close_btn" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            /*$(".trgt_datepicker").datepicker({
                                todayHighlight: !0,
                                orientation: "bottom left",
                                templates: {
                                    leftArrow: '<i class="la la-angle-left"></i>',
                                    rightArrow: '<i class="la la-angle-right"></i>'
                                },
                                format: "yyyy-mm-dd",
                                autoclose: !0,
                                minDate:0,
                            });*/
                        </script>