				<?php
				if(isset($is_super_admin) && $is_super_admin == '1')
				{
				?>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__title m--hide">
												Your Profile
											</div>
											<div class="m-card-profile__pic">
												<div class="m-card-profile__pic-wrapper">
													<img src="<?php echo base_url('assets/app/media/img/users/user4.jpg');?>" alt=""/>
												</div>

											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
													<?php
													if(isset($userdetail['first_name']) && !empty($userdetail['first_name']))
													{
														echo ucfirst($userdetail['first_name'])." ".ucfirst($userdetail['last_name']);
													}
													?>
												</span>
												<a href="" class="m-card-profile__email m-link">
													<?php
													if(isset($userdetail['email']) && !empty($userdetail['email']))
													{
														echo $userdetail['email'];
													}
													?>
												</a>
											</div>
										</div>
										
										<div class="m-portlet__body-separator"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#user_profile" role="tab">
														<i class="flaticon-share m--hide"></i>
														Update Profile
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#user_setting" role="tab">
														Settings
													</a>
												</li>
												
											</ul>
										</div>

									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="user_profile">
											<div class="m-portlet">
												<form class="m-form m-form--fit m-form--label-align-right" id="user_profile_activity_form" action="<?php echo base_url('users/user_profile_update');?>" data-parsley-validate >
													<div class="m-portlet__body">
														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label>
																	First Name:
																</label>
																<input type="hidden" name="id" value="<?php echo $userdetail['id'];?>">
																<input type="text" required id="u_first_name" name="first_name" class="form-control m-input" placeholder="Enter first name" value="<?php echo $userdetail['first_name'];?>">
																
															</div>
															<div class="col-lg-6">
																<label class="">
																	Last Name:
																</label>
																<input type="text" required id="u_last_name" name="last_name" class="form-control m-input" placeholder="Enter last name" value="<?php echo $userdetail['last_name'];?>">
																
															</div>
														</div>

														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label>
																	Mobile:
																</label>
																<input type="text" required id="u_mobile" name="mobile" class="form-control m-input onlynumber" placeholder="Enter contact number" value="<?php echo $userdetail['contact'];?>">
															</div>
															<div class="col-lg-6">
																<label class="">
																	Email:
																</label>
																<input type="email" required id="u_email" name="email" class="form-control m-input" placeholder="Enter your email" value="<?php echo $userdetail['email'];?>">
															</div>
														</div>
													</div>
													<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
														<div class="m-form__actions m-form__actions--solid">
															<div class="row">
																<div class="col-lg-4"></div>
																<div class="col-lg-8">
																	<button type="button" id="update_user_profile_btn" class="btn btn-sm btn-primary">
																		<i class="fa fa-save"></i> Update Detail
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>

										<div class="tab-pane " id="user_setting">
											<form class="m-form m-form--fit m-form--label-align-right" id="user_setting_form" action="<?php echo base_url('users/change_password');?>" data-parsley-validate >
												<div class="m-portlet__body">
													<div id="pswd_alrt_msg">
														
													</div>
													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															Current Password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-unlock"></i>
																</span>
															</div>
															<input type="hidden" name="user_id" value="<?php echo $userdetail['id'];?>">
															<input type="password" required id="u_p_current_password" name="password" class="form-control m-input" data-parsley-required-message="" placeholder="Enter you current password">
														</div>
													</div>

													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															New password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-lock"></i>
																</span>
															</div>
															<input type="password" required id="u_p_new_password" name="new_password" class="form-control m-input" data-parsley-required-message="" placeholder="New Passowrd" aria-describedby="basic-addon1">
														</div>
													</div>
													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															Confirm Password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-lock"></i>
																</span>
															</div>
															<input type="password" required id="u_p_confirm_password" name="confirm_password" class="form-control m-input" data-parsley-required-message="" placeholder="Confirm Password" aria-describedby="basic-addon1">
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<button type="button" class="btn btn-primary" id="user_setting_btn">
															<i class="fa fa-save"></i> Update Detail
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				else
				{

				?>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-content">
						<div class="row">
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__title m--hide">
												Your Profile
											</div>
											<div class="m-card-profile__pic">
													<?php
													$profile_img = base_url().'assets/images/no.png';
													$db_img = 'assets/images/no.png';
													if(isset($userdetail['profile_pic']) && !empty($userdetail['profile_pic']))
													{
														$profile_img = base_url().$userdetail['profile_pic'];
														$db_img = $userdetail['profile_pic'];
													}
													?>
												<div class="fileinput fileinput-new thum_img_outer" data-provides="fileinput">
													<div class="fileinput-new thumbnail thum_img" style="height: 120px;" data-trigger="fileinput">
														<img data-folder_name="users" src="<?php echo $profile_img; ?>" alt="..." id="changed_images" style="max-width: 220px;" >
													</div>
													<a href="<?php echo base_url("home/remove_image"); ?>" class="btn btn-sm btn-pill btn-danger deleteImage hide" style="display:none"><i class="fa fa-times"></i></a>
												</div>
												<input type="file" id="upload_images_single" data-displayname="Profile Photo"  name="..." accept="image/*"   >
                            					<br>

											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
													<?php
													if(isset($userdetail['first_name']) && !empty($userdetail['first_name']))
													{
														echo ucfirst($userdetail['first_name'])." ".ucfirst($userdetail['last_name']);
													}
													?>
												</span>
												<a href="" class="m-card-profile__email m-link">
													<?php
													if(isset($userdetail['email']) && !empty($userdetail['email']))
													{
														echo $userdetail['email'];
													}
													?>
												</a>
											</div>
										</div>

										<div class="m-portlet__body-separator"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#user_profile" role="tab">
														<i class="flaticon-share m--hide"></i>
														Update Profile
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#user_activities" role="tab">
														<i class="fa fa-activity"></i> Activities
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#user_setting" role="tab">
														Settings
													</a>
												</li>
												<?php if($user_role_id == 1){ ?>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#user_subscription" role="tab">
														Subscription
													</a>
												</li>
												<?php } ?>
											</ul>
										</div>
										
									</div>
									<div class="tab-content">
										<div class="tab-pane active" id="user_profile">
											<div class="m-portlet">
												<form class="m-form m-form--fit m-form--label-align-right" id="user_profile_activity_form" action="<?php echo base_url('users/user_profile_update');?>" data-parsley-validate >
													<div class="m-portlet__body">
														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label>
																	First Name:
																</label>
																<input type="hidden" name="uploaded_images" value="<?php echo $db_img;?>">
																<input type="hidden" name="id" value="<?php echo $userdetail['id'];?>">
																<input type="text" required id="u_first_name" name="first_name" class="form-control m-input" placeholder="Enter first name" value="<?php echo $userdetail['first_name'];?>">
																
															</div>
															<div class="col-lg-6">
																<label class="">
																	Last Name:
																</label>
																<input type="text" required id="u_last_name" name="last_name" class="form-control m-input" placeholder="Enter last name" value="<?php echo $userdetail['last_name'];?>">
																
															</div>
														</div>

														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label>
																	Mobile:
																</label>
																<input type="text" required id="u_mobile" name="mobile" class="form-control m-input onlynumber" placeholder="Enter contact number" value="<?php echo $userdetail['mobile_no'];?>">
															</div>
															<div class="col-lg-6">
																<label class="">
																	Ladline:
																</label>
																<input type="text" required id="u_ladline" name="landline" class="form-control m-input onlynumber" placeholder="Enter ladline number" value="<?php echo $userdetail['landline'];?>">
															</div>
														</div>

														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label class="">
																	Email:
																</label>
																<input type="email" required id="u_email" name="email" class="form-control m-input" placeholder="Enter your email" value="<?php echo $userdetail['email'];?>">
															</div>

															<div class="col-lg-6">
																<label class="">
																	Date Of Birth
																</label>
																<input type="text" id="u_dob" name="dob" class="form-control m-input crm_datepicker" readonly placeholder="Enter last name" value="<?php echo $userdetail['doj'];?>">
															</div>
														</div>

														<div class="form-group m-form__group row">
															<div class="col-lg-6">
																<label>
																	Username:
																</label>
																<div class="input-group m-input-group m-input-group--square">
																	<div class="input-group-prepend">
																		<span class="input-group-text">
																			<i class="la la-user"></i>
																		</span>
																	</div>
																	<input type="text" class="form-control m-input" placeholder="<?php echo $userdetail['roledetail']['name'];?>" disabled readonly>
																</div>
															</div>
															<div class="col-lg-6">
																<label>
																	Date Of Joining
																</label>
																<input type="text" id="u_doj" name="doj" class="form-control m-input" disabled placeholder="Enter first name" value="<?php echo $userdetail['doj'];?>">
															</div>
															
														</div>
														<div class="form-group m-form__group row">
															<div class="col-lg-12">
																<label class="">
																	Address:
																</label>
																<textarea id="u_address" name="address" class="form-control m-input"><?php echo $userdetail['address'];?></textarea>
															</div>
														</div>
													</div>
													<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
														<div class="m-form__actions m-form__actions--solid">
															<div class="row">
																<div class="col-lg-4"></div>
																<div class="col-lg-8">
																	<button type="button" id="update_user_profile_btn" class="btn btn-sm btn-primary">
																		<i class="fa fa-save"></i> Update Detail
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>

										<div class="tab-pane " id="user_activities">
											<div class="m-portlet__body">
					                            <table class=" table table-striped- table-bordered table-hover table-checkable dt_table  m-table--head-separator-primary" id="user_activities_list_dt_table" data-source="<?php echo $user_activities_data_source; ?>">
					                                <thead class="">
					                                    <tr>
					                                        <th class="no-sort">
					                                            <label class="m-checkbox m-checkbox--state-primary">
					                                                <input type="checkbox" class="usrprflckbxAll" onclick="checkAll('usrprflckbxAll','usrprflckbx')" name="">
					                                                <span></span>
					                                            </label>
					                                        </th>
					                                        <th>
					                                            Title
					                                        </th>
					                                        <th>
					                                           Log Message
					                                        </th>
					                                        
					                                        <th>
					                                            Created Date
					                                        </th>
					                                        <th>
					                                            Status
					                                        </th>
					                                    </tr>
					                                </thead>
					                            </table>
					                        </div>
										</div>

										<div class="tab-pane " id="user_setting">
											<form class="m-form m-form--fit m-form--label-align-right" id="user_setting_form" action="<?php echo base_url('users/change_password');?>" data-parsley-validate >
												<div class="m-portlet__body">

													<div id="pswd_alrt_msg">
														
													</div>
													
											

													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															Current Password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-unlock"></i>
																</span>
															</div>
															<input type="hidden" name="user_id" value="<?php echo $userdetail['id'];?>">
															<input type="password" required id="u_p_current_password" name="password" class="form-control m-input" data-parsley-required-message="" placeholder="Enter you current password">
														</div>
													</div>

													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															New password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-lock"></i>
																</span>
															</div>
															<input type="password" required id="u_p_new_password" name="new_password" class="form-control m-input" data-parsley-required-message="" placeholder="New Passowrd" aria-describedby="basic-addon1">
														</div>
													</div>
													<div class="form-group m-form__group">
														<label for="exampleInputEmail1">
															Confirm Password
														</label>
														<div class="input-group m-input-group m-input-group--pill">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1">
																	<i class="la la-lock"></i>
																</span>
															</div>
															<input type="password" required id="u_p_confirm_password" name="confirm_password" class="form-control m-input" data-parsley-required-message="" placeholder="Confirm Password" aria-describedby="basic-addon1">
														</div>
													</div>
												</div>
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<button type="button" class="btn btn-primary" id="user_setting_btn">
															<i class="fa fa-save"></i> Update Detail
														</button>
													</div>
												</div>
											</form>
										</div>
										<?php if($user_role_id == 1){ ?>
											<div class="tab-pane " id="user_subscription">
											<div class="m-portlet__body">
													<div class="col-sm-8 offset-sm-3">
											<span class="text-warning">Your Current Subscription Details</span>
											<br>
											<br>
											<div class="clearfix"></div>	
											<div class="form-group m-form__group row">
											<label class="text-left col-lg-4 col-form-label">Current Plan </label>
											<div class="col-lg-6">
												 <input type="text"  disbled readonly class="form-control m-input" value="<?php echo $current_subscription_details['subscrion_name']; ?>" placeholder="Current Plan">
											</div>
											</div>
											<div class="form-group m-form__group row">
											<label class="text-left col-lg-4 col-form-label">   Total Registration Allowed  </label>
											<div class="col-lg-6">
												<input type="text"  disbled readonly class="form-control m-input" value="<?php echo $current_subscription_details['total_allowed']; ?>" placeholder="Total Registration Allowed ">
											</div>
											</div>
											<div class="form-group m-form__group row">
											<label class="text-left col-lg-4 col-form-label">   Total Registration Done </label>
											<div class="col-lg-6">
												<input type="text"  disbled readonly class="form-control m-input" value="<?php echo $current_subscription_details['total_registration']; ?>" placeholder="Total Registration Done">
											</div>
											</div>
											<div class="form-group m-form__group row">
											<label class="text-left col-lg-4 col-form-label">  Remaining </label>
											<div class="col-lg-6">
												<input type="text"  disbled readonly class="form-control m-input" value="<?php echo $current_subscription_details['total_left']; ?>" placeholder="Remaining ">
											</div>
											</div>
											<div class="form-group m-form__group row">
												<?php  if(is_numeric($current_subscription_details['total_left'])){ ?>	
												<span class="text-danger"> You are using a limited plan, please contact administration to upgrade your plan</span>
												<?php  } ?>
											</div>
											</div>
											</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>