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
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section m--hide">
												<span class="m-nav__section-text">
													Section
												</span>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																My Profile
															</span>
															<span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span>
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-share"></i>
													<span class="m-nav__link-text">
														Activity
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-chat-1"></i>
													<span class="m-nav__link-text">
														Messages
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-graphic-2"></i>
													<span class="m-nav__link-text">
														Sales
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-time-3"></i>
													<span class="m-nav__link-text">
														Events
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
													<span class="m-nav__link-text">
														Support
													</span>
												</a>
											</li>
										</ul>
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
											</ul>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-portlet__nav-item--last">
													<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
														<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
															<i class="la la-gear"></i>
														</a>
														<div class="m-dropdown__wrapper">
															<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
															<div class="m-dropdown__inner">
																<div class="m-dropdown__body">
																	<div class="m-dropdown__content">
																		<ul class="m-nav">
																			<li class="m-nav__section m-nav__section--first">
																				<span class="m-nav__section-text">
																					Quick Actions
																				</span>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-share"></i>
																					<span class="m-nav__link-text">
																						Create Post
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-chat-1"></i>
																					<span class="m-nav__link-text">
																						Send Messages
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-multimedia-2"></i>
																					<span class="m-nav__link-text">
																						Upload File
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__section">
																				<span class="m-nav__section-text">
																					Useful Links
																				</span>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-info"></i>
																					<span class="m-nav__link-text">
																						FAQ
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__item">
																				<a href="" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																					<span class="m-nav__link-text">
																						Support
																					</span>
																				</a>
																			</li>
																			<li class="m-nav__separator m-nav__separator--fit m--hide"></li>
																			<li class="m-nav__item m--hide">
																				<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																					Submit
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
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
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				}
				?>