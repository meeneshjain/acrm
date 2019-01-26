
<?php 
$sidebar_permission = get_user_permission(); 
?>
<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
	<div class="m-quick-sidebar__content m--hide">
		<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
			<i class="la la-close"></i>
		</span>
		<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
			<?php if(in_array('sdnts_v',$sidebar_permission)){ ?>
			<li class="nav-item m-tabs__item get_notes_list_on_tab">
				<a class="nav-link m-tabs__link active" data-toggle="tab" href="#notes_tab" role="tab">
					Notes
				</a>
			</li>
			<?php } ?>

			<?php if(in_array('sdmtng_v',$sidebar_permission)){ ?>
			<li class="nav-item m-tabs__item get_meeting_list_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#meeting_tab" role="tab">
					Meetings
				</a>
			</li>
			<?php } ?>

			<?php if(in_array('sdtsk_v',$sidebar_permission)){ ?>
			<li class="nav-item m-tabs__item get_task_list_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#task_tab" role="tab">
					Tasks
				</a>
			</li>
			<?php } ?>
			
			<?php if(in_array('sdcalls_v',$sidebar_permission)){ ?>
			<li class="nav-item m-tabs__item get_calls_sb_list_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#calls_tab" role="tab">
					Calls
				</a>
			</li>
			<?php } ?>

			<li class="nav-item m-tabs__item get_chat_onlineuser_on_tab">
				<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
					Chat
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<!-- tab 1 start -->
			<div class="tab-pane m-scrollable <?php if(in_array('sdnts_v',$sidebar_permission)){ echo 'active'; }?>" id="notes_tab" role="tabpanel">
				<div class="button_section col-md-12">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<?php if(in_array('sdnts_a',$sidebar_permission)){ ?>
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill notes_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
							<?php } ?>
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
							<?php if(in_array('sdmtng_a',$sidebar_permission)){ ?>
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill meeting_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
							<?php } ?>
					   </div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<hr>
				<div class="clearfix"></div>
			
				<div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide" data-scrollbar-shown="true" data-scrollable="true" data-max-height="380" style="overflow: visible; height: 380px; max-height: 380px; position: relative;">
					<div class="m-timeline-3">
						<div class="m-timeline-3__items custom_meeting_portlet_container">
							
						</div>
					</div>
				</div>
			</div>
			<!-- tab 2 end  -->

			<!-- tab 3 start -->
			<div class="tab-pane m-scrollable" id="task_tab" role="tabpanel">
				<div class="button_section col-md-12 ">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<?php if(in_array('sdtsk_a',$sidebar_permission)){ ?>
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill task_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
							<?php } ?>
					   </div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr> 
				<div class="clearfix"></div>
				<div class="tab-pane" id="m_widget2_tab1_content">
					<div class="m-widget2" >
						<div class="m-scrollable" data-scrollable="true" data-max-height="450" data-scrollbar-shown="true">
							<div class="custom_task_portlet_container"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- tab 3 end -->

			<!-- tab 4 start -->
			<div class="tab-pane  m-scrollable" id="calls_tab" role="tabpanel">
				<div class="button_section col-md-12 ">

				</div>
				<div class="clearfix"></div>
				<hr> 
				<div class="clearfix"></div>
			
				<div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide" data-scrollbar-shown="true" data-scrollable="true" data-max-height="380" style="overflow: visible; height: 380px; max-height: 380px; position: relative;">
					<div class="m-timeline-3">
						<div class="m-timeline-3__items custom_calls_portlet_container">
							
						</div>
					</div>
				</div>
			</div>
			<!-- tab 4 end -->
			
			<!-- tab 5 start -->
			<div class="tab-pane m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
				<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
					<div id="chat_with_user" style="display:none">
						<button class="back-to-chat btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air"><i class="fa fa-arrow-left"></i></button>
						<div class="m-messenger__messages" id="chat_history_box">
	
						</div>
						<div class="m-messenger__seperator"></div>
						<div class="m-messenger__form">
							<div class="m-messenger__form-controls chat_msg_send_box">
								<input type="hidden" id="active_chat_from_user_id" >
			        			<input type="hidden" id="active_chat_to_user_id">
								<input type="text" name="" placeholder="Type here..." class="m-messenger__form-input chattypemsginput" onkeyup="if(event.keyCode == 13){ chatMsgSend(this) }  isTyping($('#active_chat_to_user_id').val())">
							</div>
							<div class="m-messenger__form-tools">
							</div>
						</div>
					</div>
					<div id="chat_userlist">
						<div class="m-messenger__form" style="width:100%">
							<div class="m-messenger__form-controls">
								<input type="text" id="chat_searchfield" placeholder="Search User..." class="m-messenger__form-input">
							</div>
						</div>
						<div class="m-messenger__messages m-widget4" id="chat_users">
							
						</div>
					</div>
				</div>
			</div>
			<!-- tab 5 end -->

		</div>
	</div>
</div>



<!-- MODAL FOR NOTES, MEETINGS, TASK, CALLS -->

<!-- NOTES MODAL -->
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
							<a href="#" data-note_color="m--bg-metal" class="btn btn-metal m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class="fa fa-check"></i>
							</a>

							<a href="#" data-note_color="m--bg-info" class="btn btn-info m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>

							<a href="#" data-note_color="m--bg-primary" class="btn btn-primary m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>

							<a href="#" data-note_color="m--bg-brand" class="btn btn-brand m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>

							<a href="#" data-note_color="m--bg-warning" class="btn btn-warning m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>
							
							<a href="#" data-note_color="m--bg-danger" class="btn btn-danger m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>
							
							<a href="#" data-note_color="m--bg-accent" class="btn btn-accent m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
								<i class=""></i>
							</a>

							<a href="#" data-note_color="m--bg-black" class="btn btn-black m-btn m-btn--icon btn-lg m-btn--icon-only  m-btn--pill m-btn--air btn-sm check_notes_button_element">
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

<!-- MEETING MODAL -->
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
                	<div class="col-lg-12">
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="meeting_title" class="form-control-label">
									Title:
								</label>
								<input type="hidden" name="id" id="meeting_id" value="0">
								<input required type="text" name="subject" id="meeting_title" class="form-control" placeholder="Enter your subject" >
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="meeting_description" class="form-control-label">
									Related to:
								</label>
								<textarea name="description" required id="meeting_description" class="form-control" placeholder="Enter you message" rows="5"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="meeting_start_date" class="form-control-label ">
									Start Date:
								</label>
								<input required readonly type="text" name="start_date" id="meeting_start_date" class="form-control crm_datetimepicker" placeholder="" >
							</div>
							<div class="col-lg-6">
								<label for="meeting_end_date" class="form-control-label">
									End Date:
								</label>
								<input required readonly type="text" name="end_date" id="meeting_end_date" class="form-control crm_datetimepicker" placeholder="" >
							</div>
						</div>

						<div class="form-group row">
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
									Alert Date Time:
								</label>
								<input required readonly type="text" name="alert_datetime" id="meeting_alert_datetime" class="form-control crm_datetimepicker" placeholder="" >
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-12">
								<label for="meeting_invitees" class="form-control-label">
									Select Invitees:
								</label>
								<select required style="width: 100%" class="form-control m-select2 select2_selectbox" id="meeting_invitees" name="meeting_invitees[]" multiple="multiple">
									<?php
									echo get_all_users();
									?>
								</select>
							</div>
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

<!-- TASK MODAL -->
<div class="modal fade" id="task_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="task_form" action=""  data-parsley-validate >
                <div class="modal-header">
                    <h4 class="modal-title task_modal_heading">
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
						<label for="task_title" class="form-control-label">
							Title:
						</label>
						<input required="" type="text" name="title" id="task_title" class="form-control" placeholder="Enter your subject" >
					</div>
					<div class="form-group">
						<label for="task_description" class="form-control-label">
							Message:
						</label>
						<textarea name="description" required id="task_description" class="form-control" placeholder="Enter you message" rows="5"></textarea>
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button"  id="task_action_btn" class="btn btn-primary">
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

<!-- CALLS MODAL -->
<div class="modal fade" id="calls_sb_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="calls_sb_form" action="<?php echo base_url('schedule/add_calls');?>"  data-parsley-validate >
                <div class="modal-header">
                    <h4 class="modal-title calls_sb_modal_heading">
                        ADD NEW CALLS
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                	<div class="col-lg-12">
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="calls_sb_title" class="form-control-label">
									Name:
								</label>
								<input type="hidden" name="calls_sb_id" id="calls_sb_id" value="0">
								<input type="hidden" name="calls_sb_lead_id" id="calls_sb_lead_id" value="0">
								<input type="hidden" name="calls_sb_lead_type" id="calls_sb_lead_type" value="0">
								<input type="hidden" name="calls_sb_account_id" id="calls_sb_account_id" value="0">
								<input type="text" disabled id="calls_sb_name" class="form-control">
							</div>
							<div class="col-lg-6">
								<label for="calls_sb_title" class="form-control-label">
									Type:
								</label>
								<input type="text" disabled id="calls_sb_type" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="calls_sb_account" class="form-control-label">
									Account Name:
								</label>
								<input type="text" disabled id="calls_sb_account" class="form-control">
							</div>
							<div class="col-lg-6">
								<label for="calls_sb_contact" class="form-control-label">
									Contact:
								</label>
								<input type="text" disabled id="calls_sb_contact" class="form-control">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="calls_sb_reason" class="form-control-label">
									Reason:
								</label>
								<textarea name="reason" required id="calls_sb_reason" class="form-control" placeholder="Enter you reason" rows="5"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="calls_sb_callback" class="form-control-label ">
									Call Back Time:
								</label>
								<input required readonly type="text" name="start_date" id="calls_sb_callback" class="form-control crm_datetimepicker" placeholder="" >
							</div>
							<div class="col-lg-6">
								<label for="calls_sb_alert_datetime" class="form-control-label">
									Alert Before Minute:
								</label>
								<select required readonly type="text" name="alert_datetime" id="calls_sb_alert_datetime" class="form-control">
									<option value="">--Select Time--</option>
									<option value="1">Before 1 Minute</option>
									<option value="2">Before 2 Minute</option>
									<option value="3">Before 3 Minute</option>
									<option value="4">Before 4 Minute</option>
									<option value="5">Before 5 Minute</option>
									<option value="6">Before 6 Minute</option>
									<option value="7">Before 7 Minute</option>
									<option value="8">Before 8 Minute</option>
									<option value="9">Before 9 Minute</option>
									<option value="10">Before 10 Minute</option>
									<option value="11">Before 11 Minute</option>
									<option value="12">Before 12 Minute</option>
									<option value="13">Before 13 Minute</option>
									<option value="14">Before 14 Minute</option>
									<option value="15">Before 15 Minute</option>
									<option value="16">Before 16 Minute</option>
									<option value="17">Before 17 Minute</option>
									<option value="18">Before 18 Minute</option>
									<option value="19">Before 19 Minute</option>
									<option value="20">Before 20 Minute</option>
									<option value="21">Before 21 Minute</option>
									<option value="22">Before 22 Minute</option>
									<option value="23">Before 23 Minute</option>
									<option value="24">Before 24 Minute</option>
									<option value="25">Before 25 Minute</option>
									<option value="26">Before 26 Minute</option>
									<option value="27">Before 27 Minute</option>
									<option value="28">Before 28 Minute</option>
									<option value="29">Before 29 Minute</option>
									<option value="30">Before 30 Minute</option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6">
								<label for="calls_sb_status_type" class="form-control-label">
									Status Type:
								</label>
								<select required id="calls_sb_status_type" name="status_type" class="form-control">
									<option value="">--Status Type--</option>
									<option value="PLANED">PLANED</option>
									<option value="TENTATIVE">TENTATIVE</option>
									<option value="APPROVED">APPROVED</option>
									<option value="REJECT">REJECT</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label for="calls_sb_invitees" class="form-control-label">
									Select Invitees:
								</label>
								<select style="width: 100%" class="form-control m-select2 select2_selectbox" id="calls_sb_invitees" name="calls_sb_invitees[]" multiple="multiple">
									<?php
									echo get_all_users();
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button"  id="calls_sb_action_btn" class="btn btn-primary">
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