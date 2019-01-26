


                

				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Company List
								</h3>
							</div>

							<div>
								<!-- <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Activity
																</span>
															</a>
														</li>
														<li class="m-nav__separator m-nav__separator--fit"></li>
														<li class="m-nav__item">
															<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																Submit
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
					<!-- END: Subheader -->

                    <div class="m-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="-portlet m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--mobile">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Company List
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill add_update_click" data-form_type="add">
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
        								<table class="table table-striped- table-bordered table-hover table-checkable dt_table " id="company_list_dt_table" data-source="<?php echo base_url('company/companylist'); ?>">
        									<thead>
        										<tr>
        											<th class="no-sort">
        												<label class="m-checkbox m-checkbox--state-primary"><input type="checkbox" class="compckbxAll" onclick="checkAll('compckbxAll','compckbx')" name=""><span></span></label>
        											</th>
                                                    <th>
                                                        Logo
                                                    </th>
        											<th>
        												Company Name
        											</th>
        											<th>
        												Email
        											</th>
        											<th>
        												Contact
        											</th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Create Date
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


                <div class="modal fade" id="add_update_company_modal" tabindex="-1" role="dialog" aria-labelledby="add_update_company_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="company_form" action=""  data-parsley-validate>
                                <div class="modal-header">
                                    <h4 class="modal-title" id="add_update_company_modal_lable">
                                        EDIT COMPANY DETAIL
                                    </h4>
                                    <button type="button" class="close close_modal_common" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <h5 class="m-section__heading">Company Details </h5>
                                <div class="">
                                <div class="row">
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group" style="margin-top: 7px;">
                                            <label class="">Company Logo</label>
                                            <div class="col-sm-4 col-md-3 col-lg-2">
                                            <div class="fileinput fileinput-new thum_img_outer" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail thum_img" style="height: 120px;" data-trigger="fileinput">
                                                <img data-folder_name="company" class="company_logo_src" src="<?php echo base_url('assets/images/no.jpg') ?>" alt="..." id="changed_images" style="max-width: 220px;" >
                                                </div>
                                                <a href="<?php echo base_url("home/remove_image"); ?>" class="btn btn-sm btn-pill btn-danger deleteImage hide" style="display:none"><i class="fa fa-times"></i></a>
                                            </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <input type="file" id="upload_images_single" data-displayname="Choose Logo"  name="..." accept="image/*"   >
                                            <input type="hidden" class="company_logo_src_value" name="uploaded_images" value="">
                                            
                                            </div>
                                        </div>
                                        </div>
                                       <div class="col-lg-8">
                                        <div class="form-group m-form__group row" style="margin-top: 7px;">
                                       <div class="col-lg-6">
                                                <label>
                                                    Company Name:
                                                </label>
                                                <input type="hidden" id="company_id" name="id" value="0">
                                                <input required type="text" id="company_name" name="company_name" class="form-control m-input" placeholder="Enter Company name">
                                            
                                            </div>
                                            <div class="col-lg-6">
                                                <label>
                                                    Contact:
                                                </label>
                                                <input required type="text" id="contact_1" name="contact_1" class="form-control m-input only_number" placeholder="Enter contact number">
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                        
                                        <div class="col-lg-6">
                                            <label>
                                                Email:
                                            </label>
                                            <input required type="email" id="email_1" name="email_1" class="form-control m-input" placeholder="Enter your email">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>
                                                Subscription:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select required class="form-control m-input" id="subscription" name="subscription">
                                                    <option value=""> --Select Subscription Type--</option>
                                                    <?php echo $subscription_plan;?>
                                                </select>
                    
                                            </div>
                                        </div>
                                     </div>
                                      <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label>
                                                About Company:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" id="about_company" name="about_company" placeholder="Describe about the company" ></textarea>
                                            </div>
                                        </div>
                                        </div>
                                     
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12">
                                        
                                    
                                    <div class="form-group m-form__group row">
                                        
                                        <div class="col-lg-3">
                                            <label>
                                                Another Email:
                                            </label>
                                            <input type="email" id="email_2" name="email_2" data-parsley-required-message="Enter A Valid Email Address" class="form-control m-input" placeholder="Enter your another email">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>
                                                Another Contact:
                                            </label>
                                            <input type="text" id="contact_2" name="contact_2" class="form-control m-input only_number" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-lg-3">
                                            <label > Active/Deactive </label> <br>
                                            <span class="m-switch m-switch--icon">
                                                <label>
                                                    <input type="checkbox" id="is_active" name="status" value="1">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>
                                                Prefix <a class="btn btn-warning m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m-btn--air" style="width: 15px;height: 15px" data-container="body" data-toggle="m-popover" data-placement="left" data-content="Please choose Unique Prefix and use only 3 Letter."><i class="fa flaticon-questions-circular-button" style="font-size: 0.8rem"></i></a>
                                            </label>
                                            <input type="text" required id="comp_prefix" name="company_prefix" data-parsley-required-message="" minlength="3" maxlength="3" class="form-control m-input" placeholder="Ex. ABC">
                                        </div>
                                        
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label>
                                                Address:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" id="address" name="address" placeholder="Describe about the company" ></textarea>
                                            </div>
        
                                        </div>
                                    </div>
                                   
                                    <div class="clearfix"></div>    
                                    
                                  <div class="manager_section_block">
                                        <br>
                                        <h5 class="m-section__heading">Company Manager / Admin Details </h5>
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-4">
                                                <label>
                                                    First Name
                                                </label>
                                                <input required type="text" id="first_name" name="first_name" class="form-control m-input" placeholder="Enter First Name">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>
                                                    Last Name
                                                </label>
                                                <input required type="text" id="last_name" name="last_name" class="form-control m-input" placeholder="Enter Last Name">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <label>
                                                    Email ID
                                                </label>
                                                <input type="text" id="email_address" name="email_address" class="form-control m-input only_number" placeholder="Enter Email">
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-4">
                                                <label>
                                                   User Name
                                                </label>
                                                <input readonly required type="text" id="user_name" name="user_name" class="form-control m-input" placeholder="Enter User Name">
                                            </div>
                                            <div class="col-lg-4">
                                                <label>
                                                    Password
                                                </label>
                                                <input required="" type="text" id="password" name="password" class="form-control m-input" placeholder="Enter Password">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <label>
                                                    Contact No
                                                </label>
                                                <input type="text" id="user_contact_no" name="user_contact_no" class="form-control m-input only_number" placeholder="Enter Contact No">
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    
                                
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--  onclick="companyUpdate(this)" id="save_update_button" -->
                                    <input type="hidden" name="company_id" id="company_edit_id" value="0">
                                    <button type="button" id="save_update_button_click"  class="btn btn-primary">
                                       <i class="fa fa-check"></i> Update
                                    </button>
                                    
                                    <button type="button" class="btn btn-danger close_modal_common" data-dismiss="modal">
                                       <i class="fa fa-times"></i> Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>