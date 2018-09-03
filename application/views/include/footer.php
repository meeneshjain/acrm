</div>
<!-- end:: Body -->
<!-- begin::Footer -->
<footer class="m-grid__item		m-footer ">
	<div class="m-container m-container--fluid m-container--full-height m-page__container">
		<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
			<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
				<span class="m-footer__copyright">
					<?php echo date('Y'); ?> &copy;  <a href="<?php echo COMPANY_URL; ?>" class="m-link">
						<?php  echo POWERED_BY_FULL ?>
					</a>
				</span>
			</div>
			<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
				<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								About
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#"  class="m-nav__link">
							<span class="m-nav__link-text">
								Privacy
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								T&C
							</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								Purchase
							</span>
						</a>
					</li>
					<li class="m-nav__item m-nav__item">
						<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
							<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
	<div class="m-quick-sidebar__content m--hide">
		<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
			<i class="la la-close"></i>
		</span>
		<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
			<li class="nav-item m-tabs__item get_notes_list_on_tab">
				<a class="nav-link m-tabs__link active" data-toggle="tab" href="#notes_tab" role="tab">
					Notes
				</a>
			</li>
			<li class="nav-item m-tabs__item get_meeting_list_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#meeting_tab" role="tab">
					Meetings
				</a>
			</li>
			<li class="nav-item m-tabs__item get_task_list_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#task_tab" role="tab">
					Tasks
				</a>
			</li>
			<li class="nav-item m-tabs__item">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#calls" role="tab">
					Calls
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<!-- tab 1 start -->
			<div class="tab-pane active m-scrollable" id="notes_tab" role="tabpanel">
				<div class="button_section col-md-12">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill notes_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
					   </div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>
			
				<div class="custom_notes_portlet_container"></div>
			</div>
			
			<!-- tab 1 end -->
			<!-- tab 2 start -->
			<div class="tab-pane  m-scrollable" id="meeting_tab" role="tabpanel">
				<div class="button_section col-md-12">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill meeting_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
					   </div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>
			
				<div class="custom_meeting_portlet_container"></div>
			</div>
			<!-- tab 2 end  -->
			<!-- tab 3 start -->
			<div class="tab-pane  m-scrollable" id="calls" role="tabpanel">
				<div class="m-list-timeline">
							<div class="m-list-timeline__group">
								
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 1
											
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 2
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 3
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 4
											
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 5
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 6
											
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Caller Name 7
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
								</div>
							</div>
						</div>
				
			</div>
			<!-- tab 3 end -->
			<!-- tab 4 start -->
			<div class="tab-pane m-scrollable" id="task_tab" role="tabpanel">
				<div class="button_section col-md-12 ">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
								<i class="fa fa-plus-circle"></i>
							</a>
					   </div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr> 
				<div class="clearfix"></div>
				<div class="tab-pane" id="m_widget2_tab1_content">
					<div class="m-widget2">
					<div class="m-widget2__item m-widget2__item--primary">
						<div class="m-widget2__checkbox">
							<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
								<input type="checkbox">
								<span></span>
							</label>
						</div>
						<div class="m-widget2__desc">
							<span class="m-widget2__text">
								Make Metronic Great  Again.Lorem Ipsum Amet
							</span>
							<br>
							<span class="m-widget2__user-name">
								<a href="#" class="m-widget2__link">
									By Bob
								</a>
							</span>
						</div>
						<div class="m-widget2__actions">
							<div class="m-widget2__actions-nav">
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
									<a href="#" class="m-dropdown__toggle">
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Edit
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Delete
																</span>
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
					<div class="m-widget2__item m-widget2__item--warning">
						<div class="m-widget2__checkbox">
							<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
								<input type="checkbox">
								<span></span>
							</label>
						</div>
						<div class="m-widget2__desc">
							<span class="m-widget2__text">
								Prepare Docs For Metting On Monday
							</span>
							<br>
							<span class="m-widget2__user-name">
								<a href="#" class="m-widget2__link">
									By Sean
								</a>
							</span>
						</div>
						<div class="m-widget2__actions">
							<div class="m-widget2__actions-nav">
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
									<a href="#" class="m-dropdown__toggle">
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Edit
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Delete
																</span>
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
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

		<!-- MODAL FOR NOTES, MEETINGS, TASK, CALLS -->
		<div class="modal fade" id="notes_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="notes_form" action="<?php echo base_url('schedule/add_notes');?>"  data-parsley-validate >
                        <div class="modal-header">
                            <h4 class="modal-title notes_modal_heading">
                                ADD NEW NOTES
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    &times;
                                </span>
                            </button>
                        </div>
                        <div class="modal-body">
							<div class="form-group">
								<label for="notes_title" class="form-control-label">
									Title:
								</label>
								<input required="" type="text" name="subject" id="notes_title" class="form-control" placeholder="Enter your subject" >
							</div>
							<div class="form-group">
								<label for="notes_message" class="form-control-label">
									Message:
								</label>
								<textarea name="message" required id="notes_message" class="form-control" placeholder="Enter you message" rows="5"></textarea>
							</div>
							<div class="form-group">
								<input type="hidden" name="id" id="notes_id" value="0">
								<input type="hidden" name="color" id="notes_color" class="form-control" value="m--bg-metal"  >
								<div class="">
									<a href="#" data-note_color="m--bg-metal" class="btn btn-metal m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm check_button_element">
										<i class="fa fa-check"></i>
									</a>

									<a href="#" data-note_color="m--bg-info" class="btn btn-info m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>

									<a href="#" data-note_color="m--bg-primary" class="btn btn-primary m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>

									<a href="#" data-note_color="m--bg-brand" class="btn btn-brand m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>

									<a href="#" data-note_color="m--bg-warning" class="btn btn-warning m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>
									
									<a href="#" data-note_color="m--bg-danger" class="btn btn-danger m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>
									
									<a href="#" data-note_color="m--bg-accent" class="btn btn-accent m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
										<i class=""></i>
									</a>

									<a href="#" data-note_color="m--bg-black" class="btn btn-black m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_button_element">
							          <i class=""></i>
							         </a>

								</div>
							</div>
						</div>
                        <div class="modal-footer">
                            <button type="button"  id="notes_action_btn" class="btn btn-primary">
                                Save
                            </button>
                            
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="meeting_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    		<div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="meeting_form" action="<?php echo base_url('schedule/add_meeting');?>"  data-parsley-validate >
		                <div class="modal-header">
		                    <h4 class="modal-title meeting_modal_heading">
		                        ADD NEW MEETING
		                    </h4>
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                        <span aria-hidden="true">
		                            &times;
		                        </span>
		                    </button>
		                </div>
		                <div class="modal-body">
							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label for="meeting_title" class="form-control-label">
										Title:
									</label>
									<input type="hidden" name="id" id="meeting_id" value="0">
									<input required type="text" name="subject" id="meeting_title" class="form-control" placeholder="Enter your subject" >
								</div>
							</div>
							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label for="meeting_description" class="form-control-label">
										Related to:
									</label>
									<textarea name="description" required id="meeting_description" class="form-control" placeholder="Enter you message" rows="5"></textarea>
								</div>
							</div>

							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label for="meeting_start_date" class="form-control-label">
										Start Date:
									</label>
									<input required readonly type="text" name="start_date" id="meeting_start_date" class="form-control" placeholder="" >
								</div>
								<div class="col-lg-6">
									<label for="meeting_end_date" class="form-control-label">
										End Date:
									</label>
									<input required readonly type="text" name="end_date" id="meeting_end_date" class="form-control" placeholder="" >
								</div>
							</div>

							<div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label for="meeting_type" class="form-control-label">
										Status Type:
									</label>
									<select required id="meeting_type" name="status_type" class="form-control">
										<option value="">--Status Type--</option>
										<option value="PLANED">PLANED</option>
										<option value="TENTATIVE">TENTATIVE</option>
										<option value="APPROVED">APPROVED</option>
										<option value="REJECT">REJECT</option>
									</select>
								</div>
								<div class="col-lg-6">
									<label for="meeting_alert_datetime" class="form-control-label">
										Start Date:
									</label>
									<input required readonly type="text" name="alert_datetime" id="meeting_alert_datetime" class="form-control" placeholder="" >
								</div>
							</div>

							<div class="form-group m-form__group row">
								<div class="col-lg-12">
									<label for="meeting_invitees" class="form-control-label">
										Select Invitees:
									</label>
									<select required style="width: 100%" class="form-control m-select2" id="meeting_invitees" name="meeting_invitees[]" multiple="multiple">
										<option value="1">User1</option>
										<option value="2">User2</option>
										<option value="3">User3</option>
										<option value="4">User4</option>
										<option value="5">User5</option>
										<option value="6">User6</option>
										<option value="7">User7</option>
										<option value="8">User8</option>
										<option value="9">User9</option>
										<option value="10">User10</option>
										<option value="11">User11</option>
										<option value="12">User12</option>
										<option value="13">User13</option>
										<option value="14">User14</option>
										<option value="15">User15</option>
										<option value="16">User16</option>
										<option value="17">User17</option>
										<option value="18">User18</option>
										<option value="19">User19</option>
										<option value="20">User20</option>
										<option value="21">User21</option>
										<option value="22">User22</option>
										<option value="23">User23</option>
										<option value="24">User24</option>
										<option value="25">User25</option>
										<option value="26">User26</option>
										<option value="27">User27</option>
										<option value="28">User28</option>
										<option value="29">User29</option>
										<option value="30">User30</option>
										<option value="31">User31</option>
										<option value="32">User32</option>
										<option value="33">User33</option>
										<option value="34">User34</option>
										<option value="35">User35</option>
										<option value="36">User36</option>
										<option value="37">User37</option>
										<option value="38">User38</option>
										<option value="39">User39</option>
										<option value="40">User40</option>
										<option value="41">User41</option>
										<option value="42">User42</option>
										<option value="43">User43</option>
										<option value="44">User44</option>
										<option value="45">User45</option>
										<option value="46">User46</option>
										<option value="47">User47</option>
										<option value="48">User48</option>
										<option value="49">User49</option>
										<option value="50">User50</option>
									</select>
								</div>
							</div>
						</div>
		                <div class="modal-footer">
		                    <button type="button"  id="meeting_action_btn" class="btn btn-primary">
		                        Save
		                    </button>
		                    
		                    <button type="button" class="btn btn-danger" data-dismiss="modal">
		                        Close
		                    </button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>

<!-- END  -->


<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
	<i class="la la-arrow-up"></i>
</div>
<script src="<?php echo base_url('assets/vendors/base/vendors.bundle.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/base/scripts.bundle.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/form-parsley/parsley.js'); ?>"></script>
<script src="<?php echo base_url('assets/demo/default/custom/components/base/bootstrap-notify.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/custom/datatables/datatables.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/demo/default/custom/custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/app/js/dashboard.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/demo/default/custom/sidebar_activities.js'); ?>" type="text/javascript"></script>

<?php  if(isset($load_js) && $load_js!=""){
	foreach(load_required_js($load_js) as $js_files){ ?>
	<script src="<?php echo base_url('assets/demo/default/custom/'.$js_files); ?>"></script>
	<?php  } } ?>
</body>

</html>
<script>



var Select2 = {
    init: function() {
        $("#meeting_invitees").select2({
            placeholder: "Please select invitees"
        });
    }
};

var BootstrapDatetimepicker = {
    init: function() {
        $("#meeting_start_date,#meeting_end_date,#meeting_alert_datetime").datetimepicker({
            todayHighlight: !0,
            pickerPosition: "top-left",
            autoclose: !0,
            format: "yyyy-mm-dd hh:ii"
        });
    }
};

$("form").parsley({ 
  excluded: "input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" 
});

jQuery(document).ready(function() {
	Select2.init()
    BootstrapDatetimepicker.init()
});



</script>