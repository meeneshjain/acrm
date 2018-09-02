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
			<li class="nav-item m-tabs__item">
				<a class="nav-link m-tabs__link active get_notes_list" data-toggle="tab" href="#notes_tab" role="tab">
					Notes
				</a>
			</li>
			<li class="nav-item m-tabs__item">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#meeting_tab" role="tab">
					Meetings
				</a>
			</li>
			<li class="nav-item m-tabs__item">
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
							<a href="#" data-toggle="modal" data-target="#add_notes_modal" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
								<i class="fa fa-plus-circle"></i>
							</a>
					   </div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>
			
				


				<div class="custom_portlet_container">
					<div class="m-scrollable added_notes_list" data-scrollbar-shown="true" data-scrollable="true" data-max-height="450">
						<div class="cust_notes m-portlet m-portlet--skin-dark m-portlet--bordered-semi m--bg-brand custom_portlet"  data-status="0">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="flaticon-statistics"></i>
										</span>
										<h3 class="m-portlet__head-text" contenteditable="true" maxlength="20" >
											Dark Skin
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
												<i class="fa fa-trash"></i>
											</a>
										</li>
										
										<li class="m-portlet__nav-item">
											<a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
												<i class="fa fa-save"></i>
											</a>
										</li>
										<li class="m-portlet__nav-item">
										<a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon custom_portlet_toggle">
											<i class="la la-angle-down"></i>
										</a>
									</li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body" contenteditable="true" style="display:none">
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
							</div>
							<div class="m-portlet__foot cust_notes_foot text-white" style="display:none">
								<div class="row">
											<div class="col-sm-6 ">
											<div class="pull-left text-sm">
												<em>Edited By : Meenesh</em>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="pull-right text-sm">
												<em>2018-09-31 11:70</em>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- tab 1 end -->
			<!-- tab 2 start -->
			<div class="tab-pane  m-scrollable" id="meeting_tab" role="tabpanel">
				
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
		<div class="modal fade" id="add_notes_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="add_notes_form" action="<?php echo base_url('schedule/add_notes');?>"  data-parsley-validate >
                        <div class="modal-header">
                            <h4 class="modal-title">
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
								<label for="a_notes_title" class="form-control-label">
									Title:
								</label>
								<input required="" type="text" name="subject" id="a_notes_title" class="form-control" placeholder="Enter your subject" >
							</div>
							<div class="form-group">
								<label for="a_notes_message" class="form-control-label">
									Message:
								</label>
								<textarea name="message" required id="a_notes_message" class="form-control" placeholder="Enter you message" rows="5"></textarea>
							</div>
							<div class="form-group">
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
                            <button type="button"  id="note_click" class="btn btn-primary">
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

<?php  if(isset($load_js) && $load_js!=""){
	foreach(load_required_js($load_js) as $js_files){ ?>
	<script src="<?php echo base_url('assets/demo/default/custom/'.$js_files); ?>"></script>
	<?php  } } ?>
</body>

</html>
<script>


/* NOTES MODULE CODE GOES HERE */

/*
 ******** TOGGLE NOTES PORTLET *******
*/
$(document).ready(function () {
	$(document).on("click", ".custom_portlet_toggle", function(){
		var cobj = $(this);
		var current_el = cobj.parents(".custom_portlet");
		if(current_el.attr("data-status") == 0){
			$(".custom_portlet_container").find(".custom_portlet").each(function(){
				if($(this).attr("data-status") == 1){
					$(this).find(".m-portlet__body, .m-portlet__foot").slideUp();
					$(this).attr("data-status", 0)
				}
			});
			current_el.find(".m-portlet__body, .m-portlet__foot").slideDown();
			current_el.attr("data-status", 1);
		} else if(current_el.attr("data-status") == 1){
			current_el.find(".m-portlet__body, .m-portlet__foot").slideUp();
			current_el.attr("data-status", 0)
		
		}
	});
});

/*
 ******** CHOOSE COLOR ********
*/
$(document).ready(function () {
	$(".check_button_element").on('click', function() {
	 	$(".check_button_element").children('i').removeClass('fa fa-check');
	 	$(this).children('i').addClass('fa fa-check');
	 	$("#notes_color").val($(this).attr('data-note_color'));
	});

	$("#note_click").click(function(){
		var obj = $(this);
		 if ($("#add_notes_form").parsley().validate()) {
			show_loading("#note_click", 'Saving..!');
			form_submit('add_notes_form', function(res){
				if(res.status == 'success')
				{
					notify_alert('success', res.message, "Success");
					hide_loading("#note_click", 'Save');
					$("#add_notes_form").parsley().reset();
					$("#add_notes_form")[0].reset();
					$("#add_notes_modal").modal('hide');
					$(".get_notes_list").trigger( "click" );
				}
			});
		}
	});

	$(".custom_portlet_container").on("click",".notes_edit",function(e){
		var id = $(this).attr('data-notes-id');
		call_service(base_url+'schedule/edit_notes/'+id, 
			function(res){
				if(res.status == 'success')
				{
					$("#edit_notes_modal").modal('show');
					$("#e_notes_id").val();
					$("#e_notes_title").val();
					$("#e_notes_message").val();
				}
				if(res.status == 'error')
				{
					notify_alert('error', res.message, "Error");
				}
			},
			function(res){
				notify_alert('error', res.message, "Error");
			}
		);
	});

	$(".get_notes_list").click(function(){
		call_service(base_url+'schedule/get_notes', function(res){
			if(res.status == 'success')
			{
				var html = '';
				$(res.data).each(function( index,value) {
				  		html += '<div class="cust_notes m-portlet m-portlet--skin-dark m-portlet--bordered-semi '+res.data[index].color+' custom_portlet"  data-status="0">\
							<div class="m-portlet__head">\
								<div class="m-portlet__head-caption">\
									<div class="m-portlet__head-title">\
										<span class="m-portlet__head-icon">\
											<i class="flaticon-statistics"></i>\
										</span>\
										<h3 class="m-portlet__head-text" contenteditable="true" maxlength="20" >'+res.data[index].subject+'</h3>\
									</div>\
								</div>\
								<div class="m-portlet__head-tools">\
									<ul class="m-portlet__nav">\
										<li class="m-portlet__nav-item">\
											<a data-notes-id="'+res.data[index].id+'" class="notes_delete m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-trash"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
											<a data-notes-id="'+res.data[index].id+'" class="notes_edit m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-edit"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
										<a  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon custom_portlet_toggle">\
											<i class="la la-angle-down"></i>\
										</a>\
									</li>\
									</ul>\
								</div>\
							</div>\
							<div class="m-portlet__body" contenteditable="true" style="display:none">'+res.data[index].message+'</div>\
							<div class="m-portlet__foot cust_notes_foot text-white" style="display:none">\
								<div class="row">\
									<div class="col-sm-6 ">\
										<div class="pull-left text-sm">\
											<em>Edited By : Meenesh</em>\
										</div>\
									</div>\
									<div class="col-sm-6">\
										<div class="pull-right text-sm">\
											<em>Created On : '+res.data[index].created_date+'</em>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>';
				});
				$('.added_notes_list').html(html);
			}
			},function(res){
				notify_alert('error', res.message, "Error");
		});
	});


});


</script>