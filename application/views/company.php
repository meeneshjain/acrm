
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									State Colors
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
					<div class="m-content" style="display: none;">
						<div class="row">
							<div class="col-lg-12">
                                <div class="-portlet m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--mobile">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Company Form
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Form-->
                                    <form class="m-form m-form--state m-form--fit m-form--label-align-right" id="m_form_3">
                                        <div class="m-portlet__body">
                                            <div class="m-form__section m-form__section--first">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Billing Information
                                                    </h3>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label">
                                                            * Cardholder Name:
                                                        </label>
                                                        <input type="text" name="billing_card_name" class="form-control m-input" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label">
                                                            * Card Number:
                                                        </label>
                                                        <input type="text" name="billing_card_number" class="form-control m-input" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-4 m-form__group-sub">
                                                        <label class="form-control-label">
                                                            * Exp Month:
                                                        </label>
                                                        <select class="form-control m-input" name="billing_card_exp_month">
                                                            <option value="">
                                                                Select
                                                            </option>
                                                            <option value="01">
                                                                01
                                                            </option>
                                                            <option value="02">
                                                                02
                                                            </option>
                                                            <option value="03">
                                                                03
                                                            </option>
                                                            <option value="04">
                                                                04
                                                            </option>
                                                            <option value="05">
                                                                05
                                                            </option>
                                                            <option value="06">
                                                                06
                                                            </option>
                                                            <option value="07">
                                                                07
                                                            </option>
                                                            <option value="08">
                                                                08
                                                            </option>
                                                            <option value="09">
                                                                09
                                                            </option>
                                                            <option value="10">
                                                                10
                                                            </option>
                                                            <option value="11">
                                                                11
                                                            </option>
                                                            <option value="12">
                                                                12
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 m-form__group-sub">
                                                        <label class="form-control-label">
                                                            * Exp Year:
                                                        </label>
                                                        <select class="form-control m-input" name="billing_card_exp_year">
                                                            <option value="">
                                                                Select
                                                            </option>
                                                            <option value="2018">
                                                                2018
                                                            </option>
                                                            <option value="2019">
                                                                2019
                                                            </option>
                                                            <option value="2020">
                                                                2020
                                                            </option>
                                                            <option value="2021">
                                                                2021
                                                            </option>
                                                            <option value="2022">
                                                                2022
                                                            </option>
                                                            <option value="2023">
                                                                2023
                                                            </option>
                                                            <option value="2024">
                                                                2024
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 m-form__group-sub">
                                                        <label class="form-control-label">
                                                            * CVV:
                                                        </label>
                                                        <input type="number" class="form-control m-input" name="billing_card_cvv" placeholder="" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                            <div class="m-form__section">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Billing Address
                                                        <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info" title="If different than the corresponding address"></i>
                                                    </h3>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label">
                                                            * Address 1:
                                                        </label>
                                                        <input type="text" name="billing_address_1" class="form-control m-input" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label">
                                                            Address 2:
                                                        </label>
                                                        <input type="text" name="billing_address_2" class="form-control m-input" placeholder="" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-5 m-form__group-sub">
                                                        <label class="form-control-label">
                                                            * City:
                                                        </label>
                                                        <input type="text" class="form-control m-input" name="billing_city" placeholder="" value="">
                                                    </div>
                                                    <div class="col-lg-5 m-form__group-sub">
                                                        <label class="form-control-label">
                                                            * State:
                                                        </label>
                                                        <input type="text" class="form-control m-input" name="billing_state" placeholder="" value="">
                                                    </div>
                                                    <div class="col-lg-2 m-form__group-sub">
                                                        <label  class="form-control-label">
                                                            * ZIP:
                                                        </label>
                                                        <input type="text" class="form-control m-input" name="billing_zip" placeholder="" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                            <div class="m-form__section">
                                                <div class="m-form__heading">
                                                    <h3 class="m-form__heading-title">
                                                        Delivery Type
                                                    </h3>
                                                </div>
                                                <div class="form-group m-form__group">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="m-option">
                                                                <span class="m-option__control">
                                                                    <span class="m-radio m-radio--state-brand">
                                                                        <input type="radio" name="billing_delivery" value="">
                                                                        <span></span>
                                                                    </span>
                                                                </span>
                                                                <span class="m-option__label">
                                                                    <span class="m-option__head">
                                                                        <span class="m-option__title">
                                                                            Standart Delevery
                                                                        </span>
                                                                        <span class="m-option__focus">
                                                                            Free
                                                                        </span>
                                                                    </span>
                                                                    <span class="m-option__body">
                                                                        Estimated 14-20 Day Shipping (&nbsp;Duties end taxes may be due upon delivery&nbsp;)
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="m-option">
                                                                <span class="m-option__control">
                                                                    <span class="m-radio m-radio--state-brand">
                                                                        <input type="radio" name="billing_delivery" value="">
                                                                        <span></span>
                                                                    </span>
                                                                </span>
                                                                <span class="m-option__label">
                                                                    <span class="m-option__head">
                                                                        <span class="m-option__title">
                                                                            Fast Delevery
                                                                        </span>
                                                                        <span class="m-option__focus">
                                                                            $&nbsp;8.00
                                                                        </span>
                                                                    </span>
                                                                    <span class="m-option__body">
                                                                        Estimated 2-5 Day Shipping (&nbsp;Duties end taxes may be due upon delivery&nbsp;)
                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="m-form__help">
                                                        <!--must use this helper element to display error message for the options-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__foot m-portlet__foot--fit">
                                            <div class="m-form__actions m-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-accent">
                                                            Validate
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
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
                                                    Company List
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="javascript:;" data-toggle="modal" data-target="#extra_large_modal" onclick="$('#extra_large_modal').modal({ backdrop: 'static' }, 'show');" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="javascript:;"  class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
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
        											<th>
        												#
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
                                                    <th>
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

                <div class="modal fade" id="extra_large_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="company_form">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">
                                        ADD NEW COMPANY
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">    
                                    <!-- three column :1 start -->
                                    <h5 class="m-section__heading">Basic Information</h5>  
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Company Name:
                                            </label>
                                            <input type="text" id="company_name" name="company_name" class="form-control m-input" placeholder="Enter Company name">
                                            <span class="m-form__help">
                                                Please enter company name
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Email:
                                            </label>
                                            <input type="email" id="email_1" name="email_1" class="form-control m-input" placeholder="Enter your email">
                                            <span class="m-form__help">
                                                Please enter your email
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Email:
                                            </label>
                                            <input type="email" id="email_2" name="email_2" class="form-control m-input" placeholder="Enter your another email">
                                            <span class="m-form__help">
                                                Please enter your email
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>
                                                Contact:
                                            </label>
                                            <input type="text" id="contact_1" name="contact_1" class="form-control m-input only_number" placeholder="Enter contact number">
                                            <span class="m-form__help">
                                                Please enter your contact
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Another Contact:
                                            </label>
                                            <input type="text" id="contact_2" name="contact_2" class="form-control m-input only_number" placeholder="Enter contact number">
                                            <span class="m-form__help">
                                                Please enter your contact
                                            </span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>
                                                Subscription:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select class="form-control m-input" id="subscription" name="subscription">
                                                    <option value=""> --Select Subscription Type--</option>
                                                    <option value="1">For 1-10 users</option>
                                                    <option value="2">For 11-30 users</option>
                                                    <option value="3">For 30-50 users</option>
                                                    <option value="4">For 50+ users</option>
                                                </select>
                    
                                            </div>
                                            <span class="m-form__help">
                                                Please enter your address
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <label>
                                                About Company:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea class="form-control m-input" placeholder="Describe about the company" id="about_company" name="about_company"></textarea>
                                            </div>
                                            <span class="m-form__help">
                                                Describe about company
                                            </span>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>
                                                Address:
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <textarea class="form-control m-input" placeholder="Describe about the company" id="address" name="address"></textarea>
                                            </div>
                                            <span class="m-form__help">
                                                Address of your company
                                            </span>
                                        </div>

                                    </div>
                                    <!-- three column :1 end -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" onclick="companyInsert()"  class="btn btn-primary">
                                        Save Detail
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
 
                <script type="text/javascript">
                    function companyInsert(){
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
                                $('#company_list_dt_table').DataTable().ajax.reload();
                                /*        
                                try {
                                    var res = jQuery.parseJSON(response);
                                    if(res['status'] == 'SUCCESS')
                                    {
                                        if(typeof callback === "function") 
                                        {
                                            //callback();
                                        }
                                    }
                                    if(res['status'] == 'ERROR')
                                    {
                                        if(res['message'] != '')
                                        {
                                            if(document.getElementById("warning"))
                                            {
                                                document.getElementById("warning").play();
                                            }
                                            showErrorMsg(res['message']);
                                            //$('#errpopup').html('<i class="fa fa-warning"></i> '+res['message']+'<span class=\'pull-right\'>X</span>').show().delay(3000).fadeOut();
                                        }
                                    }
                                } catch(error) {
                                    if(document.getElementById("warning"))
                                    {
                                        document.getElementById("warning").play();
                                    }
                                    showErrorMsg('Something went wrong please try again later.');
                                } 
                                
                                $(".loadingContainer").fadeOut('slow');*/
                            },
                            error: function (status, err) {
                               //showErrorMsg('Server Not Responding please contact to Administrator');
                            }
                        });
                    }

                    function companyEdit(){

                    }
                </script>

