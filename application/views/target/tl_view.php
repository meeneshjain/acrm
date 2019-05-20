                        <?php
                        //echo '<pre>';print_r($my_target);
                        if(isset($my_target) && !empty($my_target['target']))
                        {
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="m-widget6">
                                        <div class="m-widget6__body">

                                            <div class="m-widget6__item">
                                                <span class="m-widget6__text">
                                                    Target Title
                                                </span>
                                                <span class="m-widget6__text">
                                                    : <?php echo $my_target['target'][0]['target_title'];?>
                                                </span>
                                            </div>


                                            <div class="m-widget6__item">
                                                <span class="m-widget6__text">
                                                    Target Type
                                                </span>
                                                <span class="m-widget6__text">
                                                    : <?php echo $my_target['target'][0]['target_type'];?>
                                                </span>
                                            </div>
                                            <div class="m-widget6__item">
                                                <span class="m-widget6__text">
                                                    Target
                                                </span>
                                                <span class="m-widget6__text m--font-boldest m--font-brand">
                                                    : <?php echo $my_target['target'][0]['target'];?>
                                                </span>
                                            </div>
                                            <div class="m-widget6__item">
                                                <span class="m-widget6__text">
                                                    Target Assign
                                                </span>
                                                <span class="m-widget6__text m--font-boldest m--font-brand">
                                                    : <?php echo $my_target['target'][0]['target']-$my_target['target'][0]['target_left'];?>
                                                </span>
                                            </div>
                                            <div class="m-widget6__item">
                                                <span class="m-widget6__text">
                                                    Target Left
                                                </span>
                                                <span class="m-widget6__text m--font-boldest m--font-brand">
                                                    : <?php echo $my_target['target'][0]['target_left'];?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                </div>
                            </div>
                            <hr>
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-8"></div>
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
                            <form method="post" id="assign_target_form" action="target/assign_team_target"  data-parsley-validate>
                            <input type="hidden" name="my_target_id" value="<?php echo $my_target['target'][0]['id'];?>">
                            <input type="hidden" id="total_target_value" name="total_target" value="<?php echo $my_target['target'][0]['target'];?>">
                            <input type="hidden" name="target_left" value="<?php echo $my_target['target'][0]['target_left'];?>">
                            <input type="hidden" name="start_date" value="<?php echo $my_target['target'][0]['start_date'];?>">
                            <input type="hidden" name="end_date" value="<?php echo $my_target['target'][0]['end_date'];?>">
                            <input type="hidden" id="target_type" name="target_type" value="<?php echo $my_target['target'][0]['target_type'];?>">
                            <input type="hidden" name="target_duration" value="<?php echo $my_target['target'][0]['target_duration_id'];?>">
                            <table class="m-datatable m-table--head-bg-brand" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            User Name
                                        </th>
                                        <th>
                                            User Role
                                        </th>
                                        <th>
                                            Downline User
                                        </th>
                                        <th>
                                            Target Title
                                        </th>
                                        <th>
                                            Target
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
                                                echo '<tr><td>'.$value['first_name'].' '.$value['last_name'].' ('.$value['username'].')</td>';
                                                echo '<td><input type="hidden" name="user_id[]" value="'.$value['id'].'">'.$value['role_name'].'</td>';
                                                if($value['reported_users']>0)
                                                {
                                                    echo '<td><a class="btn btn-info btn-sm view_my_dl_user" data-user-id="'.$value['id'].'" data-user-role="4" data-user-type="USER">'.$value['reported_users'].' <i class="fa fa-user"></i></a></td>';
                                                }
                                                else
                                                {
                                                    echo '<td><a class="btn btn-info btn-sm" disabled data-user-id="'.$value['id'].'" data-user-role="4" data-user-type="USER">'.$value['reported_users'].' <i class="fa fa-user"></i></a></td>';
                                                }
                                                if(isset($value['target']) && !empty($value['target']))
                                                {
                                                    echo '<td><input type="hidden" name="target_db_id[]" value="'.$value['target'][0]['id'].'"><input class="form-control m-input" required type="text" name="title[]" value="'.$value['target'][0]['target_title'].'" placeholder="Enter Title"></td>';
                                                    echo '<td><input class="form-control m-input target_amount" required type="text" name="target[]" value="'.$value['target'][0]['target'].'" placeholder="Enter Target "></td></tr>';
                                                }
                                                else
                                                {
                                                    echo '<td><input type="hidden" name="target_db_id[]" value="0"><input class="form-control m-input" required type="text" name="title[]" placeholder="Enter Title"></td>';
                                                    echo '<td><input class="form-control m-input target_amount" required type="text" name="target[]" placeholder="Enter Target "></td></tr>';
                                                }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary trgt_assign_action_btn">Assign</button>
                            </form>
                            <?php
                        }
                        else
                        {
                        ?>
                        <div class="alert alert-danger">You don't have target yet.</div>
                        <?php
                        }
                        ?>