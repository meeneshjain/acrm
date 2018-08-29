
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
					<div class="m-content">
						<div class="row">
							<div class="col-lg-12">
                                <div class="-portlet m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--bordered m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Multi Column Form Validation State
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
                                                        Estimated 14-20 Day Shipping 
                    (&nbsp;Duties end taxes may be due 
                    upon delivery&nbsp;)
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
                                                        Estimated 2-5 Day Shipping
                    (&nbsp;Duties end taxes may be due
                    upon delivery&nbsp;)
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
                                Ajax Sourced Server-side Processing
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                        <a href="javascript:;" data-toggle="modal" data-target="#extra_large_modal" class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill">
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
                                <!-- search start -->
                                <form class="m-form m-form--fit m--margin-bottom-20">
									<div class="row m--margin-bottom-20">
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												RecordID:
											</label>
											<input type="text" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
										</div>
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												OrderID:
											</label>
											<input type="text" class="form-control m-input" placeholder="E.g: 37000-300" data-col-index="1">
										</div>
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												Country:
											</label>
											<select class="form-control m-input" data-col-index="2">
												<option value="">
													Select
												</option>
											</select>
										</div>
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												Agent:
											</label>
											<input type="text" class="form-control m-input" placeholder="Agent ID or name" data-col-index="4">
										</div>
									</div>
									<div class="row m--margin-bottom-20">
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												Ship Date:
											</label>
											<div class="input-daterange input-group" id="m_datepicker">
												<input type="text" class="form-control m-input" name="start" placeholder="From" data-col-index="5"/>
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-ellipsis-h"></i>
													</span>
												</div>
												<input type="text" class="form-control m-input" name="end" placeholder="To" data-col-index="5"/>
											</div>
										</div>
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												Status:
											</label>
											<select class="form-control m-input" data-col-index="6">
												<option value="">
													Select
												</option>
											</select>
										</div>
										<div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
											<label>
												Type:
											</label>
											<select class="form-control m-input" data-col-index="7">
												<option value="">
													Select
												</option>
											</select>
										</div>
									</div>
									<div class="m-separator m-separator--md m-separator--dashed"></div>
									<div class="row">
										<div class="col-lg-12">
											<button class="btn btn-brand m-btn m-btn--icon" id="m_search">
												<span>
													<i class="la la-search"></i>
													<span>
														Search
													</span>
												</span>
											</button>
											&nbsp;&nbsp;
											<button class="btn btn-secondary m-btn m-btn--icon" id="m_reset">
												<span>
													<i class="la la-close"></i>
													<span>
														Reset
													</span>
												</span>
											</button>
										</div>
									</div>
								</form>
                                <!-- search end  -->
								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable dt_table" id="m_table_1" data-source="<?php echo base_url('home/server_side_example'); ?>">
									<thead>
										<tr>
											<th>
												RecordID
											</th>
											<th>
												OrderID
											</th>
											<th>
												Country
											</th>
											<th>
												ShipCity
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

<!-- model -->

<div class="modal fade" id="extra_large_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xlg" role="document">
            <div class="modal-content">
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New message
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="m-section__heading"> Direct elements  </h4>
                      <div class="form-group m-form__group row m--margin-bottom-20">
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                RecordID:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                OrderID:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="E.g: 37000-300" data-col-index="1">
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                Country:
                            </label>
                            <select class="form-control m-input" data-col-index="2">
                                <option value="">
                                    Select
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                Agent:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="Agent ID or name" data-col-index="4">
                        </div>
                    </div>
                    
                    <!-- two column :1 start -->
                  <h3 class="m-section__heading"> Two Column 1  </h3>  
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>
                        Full Name:
                    </label>
                    <input type="email" class="form-control m-input" placeholder="Enter full name">
                    <span class="m-form__help">
                        Please enter your full name
                    </span>
                </div>
                <div class="col-lg-6">
                    <label class="">
                        Contact Number:
                    </label>
                    <input type="email" class="form-control m-input" placeholder="Enter contact number">
                    <span class="m-form__help">
                        Please enter your contact number
                    </span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>
                        Address:
                    </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Enter your address">
                        <span class="m-input-icon__icon m-input-icon__icon--right">
                            <span>
                                <i class="la la-map-marker"></i>
                            </span>
                        </span>
                    </div>
                    <span class="m-form__help">
                        Please enter your address
                    </span>
                </div>
                <div class="col-lg-6">
                    <label class="">
                        Postcode:
                    </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                        <span class="m-input-icon__icon m-input-icon__icon--right">
                            <span>
                                <i class="la la-bookmark-o"></i>
                            </span>
                        </span>
                    </div>
                    <span class="m-form__help">
                        Please enter your postcode
                    </span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>
                        User Group:
                    </label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="example_2" checked value="2">
                            Sales Person
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="example_2" value="2">
                            Customer
                            <span></span>
                        </label>
                    </div>
                    <span class="m-form__help">
                        Please select user group
                    </span>
                </div>
            </div>
        
                    <!-- two column :1 end -->
                    <!-- two column :2 start -->
                    
                    <h3 class="m-section__heading"> Two Column 2  </h3>  
                    
            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">
                    Full Name:
                </label>
                <div class="col-lg-3">
                    <input type="email" class="form-control m-input" placeholder="Enter full name">
                    <span class="m-form__help">
                        Please enter your full name
                    </span>
                </div>
                <label class="col-lg-2 col-form-label">
                    Contact Number:
                </label>
                <div class="col-lg-3">
                    <input type="email" class="form-control m-input" placeholder="Enter contact number">
                    <span class="m-form__help">
                        Please enter your contact number
                    </span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">
                    Address:
                </label>
                <div class="col-lg-3">
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Enter your address">
                        <span class="m-input-icon__icon m-input-icon__icon--right">
                            <span>
                                <i class="la la-map-marker"></i>
                            </span>
                        </span>
                    </div>
                    <span class="m-form__help">
                        Please enter your address
                    </span>
                </div>
                <label class="col-lg-2 col-form-label">
                    Postcode:
                </label>
                <div class="col-lg-3">
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                        <span class="m-input-icon__icon m-input-icon__icon--right">
                            <span>
                                <i class="la la-bookmark-o"></i>
                            </span>
                        </span>
                    </div>
                    <span class="m-form__help">
                        Please enter your postcode
                    </span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">
                    Group:
                </label>
                <div class="col-lg-3">
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="example_2" checked value="2">
                            Sales Person
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="example_2" value="2">
                            Customer
                            <span></span>
                        </label>
                    </div>
                    <span class="m-form__help">
                        Please select user group
                    </span>
                </div>
            </div>
        
                    <!-- two column :2 end -->
                    
                    
                    <!-- three column :1 start -->
<h3 class="m-section__heading"> Three Column 1  </h3>  
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>
                            Full Name:
                        </label>
                        <input type="email" class="form-control m-input" placeholder="Enter full name">
                        <span class="m-form__help">
                            Please enter your full name
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">
                            Email:
                        </label>
                        <input type="email" class="form-control m-input" placeholder="Enter email">
                        <span class="m-form__help">
                            Please enter your email
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <label>
                            Username:
                        </label>
                        <div class="input-group m-input-group m-input-group--square">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control m-input" placeholder="">
                        </div>
                        <span class="m-form__help">
                            Please enter your username
                        </span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label class="">
                            Contact:
                        </label>
                        <input type="email" class="form-control m-input" placeholder="Enter contact number">
                        <span class="m-form__help">
                            Please enter your contact
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">
                            Fax:
                        </label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input" placeholder="Fax number">
                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                <span>
                                    <i class="la la-info-circle"></i>
                                </span>
                            </span>
                        </div>
                        <span class="m-form__help">
                            Please enter fax
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <label>
                            Address:
                        </label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input" placeholder="Enter your address">
                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                <span>
                                    <i class="la la-map-marker"></i>
                                </span>
                            </span>
                        </div>
                        <span class="m-form__help">
                            Please enter your address
                        </span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label class="">
                            Postcode:
                        </label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                <span>
                                    <i class="la la-bookmark-o"></i>
                                </span>
                            </span>
                        </div>
                        <span class="m-form__help">
                            Please enter your postcode
                        </span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">
                            User Group:
                        </label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="example_2" checked value="2">
                                Sales Person
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="example_2" value="2">
                                Customer
                                <span></span>
                            </label>
                        </div>
                        <span class="m-form__help">
                            Please select user group
                        </span>
                    </div>
                </div>
            
                    <!-- three column :1 end -->
                    
                    <!-- three column :2 start -->
                    <h3 class="m-section__heading"> Three Column 2  </h3>  
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Full Name:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Full name">
                            <span class="m-form__help">
                                Please enter your full name
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Email:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Email">
                            <span class="m-form__help">
                                Please enter your email
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Username:
                        </label>
                        <div class="col-lg-3">
                            <div class="input-group m-input-group m-input-group--square">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control m-input" placeholder="">
                            </div>
                            <span class="m-form__help">
                                Please enter your username
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Contact:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Enter contact number">
                            <span class="m-form__help">
                                Please enter your contact
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Fax:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Fax number">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-info-circle"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter fax
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Address:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your address">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your address
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Postcode:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-bookmark-o"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your postcode
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            User Group:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" checked value="2">
                                    Sales Person
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" value="2">
                                    Customer
                                    <span></span>
                                </label>
                            </div>
                            <span class="m-form__help">
                                Please select user group
                            </span>
                        </div>
                    </div>
                
                    <!-- three column :2 end -->
                    
                    
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Send message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


