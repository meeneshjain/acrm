


                

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
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
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
								</div>
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
                                                    <a href="javascript:;" data-toggle="modal" data-target="#company_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill">
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
        								<table class="table table-striped- table-bordered table-hover table-checkable dt_table" id="company_list_dt_table" data-source="<?php echo base_url('company/companylist'); ?>">
        									<thead>
        										<tr>
        											<th class="no-sort">
        												<input type="checkbox" class="compckbxAll" onclick="checkAll('compckbxAll','compckbx')" name="">
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

                <div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="add_company_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="company_form"  data-parsley-validate>
                                <div class="modal-header">
                                    <h4 class="modal-title" id="add_company_modal_lable">
                                        ADD NEW COMPANY
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">    
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Company Name:
                                            </label>
                                            <input required type="text" name="company_name" class="form-control m-input" placeholder="Enter Company name">
                                        
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Email:
                                            </label>
                                            <input required type="email" name="email_1" class="form-control m-input" placeholder="Enter your email">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Email:
                                            </label>
                                            <input type="email" name="email_2" class="form-control m-input" placeholder="Enter your another email">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Contact:
                                            </label>
                                            <input required type="text" name="contact_1" class="form-control m-input only_number" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Contact:
                                            </label>
                                            <input type="text" name="contact_2" class="form-control m-input only_number" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Subscription:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select required class="form-control m-input" name="subscription">
                                                    <option value=""> --Select Subscription Type--</option>
                                                    <option value="1">For 1-10 users</option>
                                                    <option value="2">For 11-30 users</option>
                                                    <option value="3">For 30-50 users</option>
                                                    <option value="4">For 50+ users</option>
                                                </select>
                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>
                                                About Company:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" placeholder="Describe about the company" name="about_company"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>
                                                Address:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" placeholder="Describe about the company" name="address"></textarea>
                                            </div>
        
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="companyInsert()"  class="btn btn-primary">
                                        Save
                                    </button>
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit_company_modal" tabindex="-1" role="dialog" aria-labelledby="edit_company_modal_lable" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="edit_company_form"  data-parsley-validate>
                                <div class="modal-header">
                                    <h4 class="modal-title" id="edit_company_modal_lable">
                                        EDIT COMPANY DETAIL
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Company Name:
                                            </label>
                                            <input type="hidden" id="company_id" name="id" value="0">
                                            <input required type="text" id="company_name" name="company_name" class="form-control m-input" placeholder="Enter Company name">
                                        
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Email:
                                            </label>
                                            <input required type="email" id="email_1" name="email_1" class="form-control m-input" placeholder="Enter your email">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Email:
                                            </label>
                                            <input type="email" id="email_2" name="email_2" data-parsley-required-message="Enter A Valid Email Address" class="form-control m-input" placeholder="Enter your another email">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Contact:
                                            </label>
                                            <input required type="text" id="contact_1" name="contact_1" class="form-control m-input only_number" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Contact:
                                            </label>
                                            <input type="text" id="contact_2" name="contact_2" class="form-control m-input only_number" placeholder="Enter contact number">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Subscription:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select required class="form-control m-input" id="subscription" name="subscription">
                                                    <option value=""> --Select Subscription Type--</option>
                                                    <option value="1">For 1-10 users</option>
                                                    <option value="2">For 11-30 users</option>
                                                    <option value="3">For 30-50 users</option>
                                                    <option value="4">For 50+ users</option>
                                                </select>
                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>
                                                About Company:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" id="about_company" name="about_company" placeholder="Describe about the company" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>
                                                Address:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea required class="form-control m-input" id="address" name="address" placeholder="Describe about the company" ></textarea>
                                            </div>
        
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="companyUpdate(this)"  class="btn btn-primary">
                                        Update
                                    </button>
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
 
                <script type="text/javascript">
                    function companyInsert(){
                       if($('#company_form').parsley().validate()) {
                            $.ajax({
                                beforeSend: function() { 
                                    $(".btn").attr("disabled", true);
                                },
                                complete: function (status) {
                                   $(".btn").attr("disabled", false);
                                },
                                type : 'POST',
                                url : base_url+'company/insert',
                                data : $("form#company_form").serialize(),
                                async: false,
                                success:function(response, status){
                                    notify_alert('success', 'New Company Created.', "Error");
                                    $('#company_form').parsley().reset();
                                    $("#company_form")[0].reset();
                                    $("#company_modal").modal('hide');
                                    reloadTable();
                                },
                                error: function (status, err) {
                                   notify_alert('danger', 'There was some error, Please try again.', "Error");
                                }
                            });
                        }
                    }


                    function getDetail(obj,id){
                        $("#edit_company_modal").modal('show');
                        $.get(base_url+"company/edit_detail/"+id,function(response,status){
                            var res = $.parseJSON(response);
                            var data_res = res['data'][0];
                            console.log(data_res);
                            if(res['status'] == 'success')
                            {
                                $("#company_id").val(data_res.id);
                                $("#company_name").val(data_res.company_name);
                                $("#email_1").val(data_res.email_1);
                                $("#email_2").val(data_res.email_2);
                                $("#contact_1").val(data_res.contact_1);
                                $("#contact_2").val(data_res.contact_2);
                                $("#subscription").val(data_res.subscription);
                                $("#about_company").val(data_res.about_company);
                                $("#address").val(data_res.address);
                            }
                        });
                    }

                    function companyUpdate(obj){
                        show_loading(obj,'Updating..');
                        if($('#edit_company_form').parsley().validate()) {
                            $.ajax({
                                beforeSend: function() { 
                                    $(".btn").attr("disabled", true);
                                },
                                complete: function (status) {
                                   $(".btn").attr("disabled", false);
                                },
                                type : 'POST',
                                url : base_url+'company/update_detail',
                                data : $("form#edit_company_form").serialize(),
                                async: false,
                                success:function(response, status){
                                    var res = $.parseJSON(response);
                                    hide_loading(obj,'Update');
                                    notify_alert('success', res['message'], "Success")
                                    reloadTable();
                                    $("#edit_company_modal").modal('hide');
                                },
                                error: function (status, err) {
                                   notify_alert('danger', 'There was some error, Please try again.', "Error");
                                }
                            });
                        }
                    }

                    function  deleteCompany(obj,id)
                    {
                        var result = confirm("Want to delete?");
                        if (result) {
                            $.get(base_url+"company/delete_company/"+id,function(response,status){
                                var res = $.parseJSON(response);
                                if(res['status'] == 'success')
                                {
                                    reloadTable();
                                    notify_alert('success', res['message'], "Success")
                                }
                                else
                                {
                                   notify_alert('danger', res['message'], "Error");
                                }
                            });
                        }
                    }

                    function checkAll(clsAll,cls)
                    {
                        $("."+clsAll).change(function () {
                            $("."+cls).prop('checked', $(this).prop("checked"));
                        });
                    }

                    function deleteMultiple()
                    {
                        var result = confirm("Want to delete?");
                        if (result) {
                            idArr = [];
                            $('.compckbx').each(function(index,value){
                                if(this.checked == true){
                                    idArr.push(this.value);
                                }
                            });
                            console.log(idArr);
                        }
                    }

                    function reloadTable()
                    {
                        $('#company_list_dt_table').DataTable().ajax.reload();
                    }




                </script>

