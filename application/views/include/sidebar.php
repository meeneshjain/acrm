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
			<div class="tab-pane m-scrollable" id="task_tab" role="tabpanel">
				<div class="button_section col-md-12 ">
					<div class="pull-right">
						<div class="m-demo__preview m-demo__preview--btn">
							<a href="#" class="btn btn-info m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill task_modal_open_btn">
								<i class="fa fa-plus-circle"></i>
							</a>
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
        
        <!-- meeting modal -->
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

		<!-- task modal -->
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