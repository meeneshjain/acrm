
/* NOTES MODULE CODE GOES HERE */

$(document).ready(function () {
	/*
	 ******** TOGGLE NOTES PORTLET *******
	*/
	$(document).on("click", ".custom_note_portlet_toggle", function () {
		var cobj = $(this);
		var current_el = cobj.parents(".custom_portlet");
		if (current_el.attr("data-status") == 0) {
			$(".custom_notes_portlet_container").find(".custom_portlet").each(function () {
				if ($(this).attr("data-status") == 1) {
					$(this).find(".m-portlet__body, .m-portlet__foot").slideUp();
					$(this).attr("data-status", 0)
				}
			});
			current_el.find(".m-portlet__body, .m-portlet__foot").slideDown();
			current_el.attr("data-status", 1);
		} else if (current_el.attr("data-status") == 1) {
			current_el.find(".m-portlet__body, .m-portlet__foot").slideUp();
			current_el.attr("data-status", 0)

		}
	});

	/*
	 ******** CHOOSE COLOR ********
	*/
	$(".check_notes_button_element").on('click', function () {
		$(".check_notes_button_element").children('i').removeClass('fa fa-check');
		$(this).children('i').addClass('fa fa-check');
		$("#notes_color").val($(this).attr('data-note_color'));
	});


	/*
	 ******** ADD NOTES ********
	*/
	$(".notes_modal_open_btn").on("click", function () {
		$("#notes_form")[0].reset();
		$("#notes_modal").modal('show');
		$("#notes_form").attr('action', base_url + 'schedule/add_notes')
		$(".notes_modal_heading").html('ADD NEW NOTES');
		$(".check_notes_button_element:first").click();
		$("#notes_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** EDIT NOTES ********
	*/
	$(".custom_notes_portlet_container").on("click", ".notes_edit", function (e) {
		var id = $(this).attr('data-notes-id');
		call_service(base_url + 'schedule/edit_notes/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#notes_modal").modal('show');
					$("#notes_form").attr('action', base_url + 'schedule/update_notes')
					$(".notes_modal_heading").html('EDIT NEW NOTES');
					$("#notes_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#notes_id").val(res.data[0].id);
					$("#notes_title").val(res.data[0].subject);
					$("#notes_message").val(res.data[0].message);
					$(".check_notes_button_element").children('i').removeClass('fa fa-check');
					$(".check_notes_button_element[data-note_color='" + res.data[0].color + "']").children('').addClass('fa fa-check');
				}
				if (res.status == 'error') {
					notify_alert('error', res.message, "Error");
				}
			},
			function (res) {
				notify_alert('error', res.message, "Error");
			}
		);
	});

	/*
	 ******** SAVE / UPDATE NOTES ********
	*/
	$("#notes_action_btn").click(function () {
		var obj = $(this);
		if ($("#notes_form").parsley().validate()) {
			show_loading("#notes_action_btn", 'Loading..!');
			form_submit('notes_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#notes_action_btn", $(this).text());
					$("#notes_form").parsley().reset();
					$("#notes_form")[0].reset();
					$("#notes_modal").modal('hide');
					$(".get_notes_list_on_tab").trigger("click");
				}
			});
		}
	});

	/*
	******* DELETE NOTES ********
	*/
	$(".custom_notes_portlet_container").on("click", ".notes_delete", function (e) {
		var id = $(this).attr('data-notes-id');
		if (confirm("Are you sure, You want to delete this Notes?")) {
			call_service(base_url + "schedule/delete_notes/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					$(".get_notes_list_on_tab").trigger("click");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function () {
				notify_alert('danger', response.message, "Error");
			});

		}
	});


	/*
	 ******* GET LIST OF NOTES ********
	*/
	$(".get_notes_list,.get_notes_list_on_tab").click(function () {
		call_service(base_url + 'schedule/get_notes', function (res) {
			if (res.status == 'success') {
				var html = '';
				$(res.data).each(function (index, value) {
					html += '<div class="cust_notes m-portlet m-portlet--skin-dark m-portlet--bordered-semi ' + res.data[index].color + ' custom_portlet"  data-status="0">\
							<div class="m-portlet__head">\
								<div class="m-portlet__head-caption">\
									<div class="m-portlet__head-title">\
										<span class="m-portlet__head-icon">\
											<i class="flaticon-statistics"></i>\
										</span>\
										<h3 class="m-portlet__head-text">'+ res.data[index].subject + '</h3>\
									</div>\
								</div>\
								<div class="m-portlet__head-tools">\
									<ul class="m-portlet__nav">\
										<li class="m-portlet__nav-item">\
											<a data-notes-id="'+ res.data[index].id + '" class="notes_delete m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-trash"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
											<a data-notes-id="'+ res.data[index].id + '" class="notes_edit m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-edit"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
										<a  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon custom_note_portlet_toggle">\
											<i class="la la-angle-down"></i>\
										</a>\
									</li>\
									</ul>\
								</div>\
							</div>\
							<div class="m-portlet__body" style="display:none">'+ res.data[index].message + '</div>\
							<div class="m-portlet__foot cust_notes_foot text-white" style="display:none">\
								<div class="row">\
									<div class="col-sm-6 ">\
										<div class="pull-left text-sm">\
											<em>Edited By : Meenesh</em>\
										</div>\
									</div>\
									<div class="col-sm-6">\
										<div class="pull-right text-sm">\
											<em>Created On : '+ res.data[index].created_date + '</em>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>';
				});
				$('.custom_notes_portlet_container').html(html);
			}
		}, function (res) {
			notify_alert('error', res.message, "Error");
		});
	});
});

/* MEETING MODULE CODE GOES HERE */

$(document).ready(function () {
	/*
	 ******** TOGGLE MEETING PORTLET *******
	*/
	$(document).on("click", ".custom_meeting_portlet_toggle", function () {
		var cobj = $(this);
		var current_el = cobj.parents(".custom_portlet");
		if (current_el.attr("data-status") == 0) {
			$(".custom_meeting_portlet_container").find(".custom_portlet").each(function () {
				if ($(this).attr("data-status") == 1) {
					$(this).find(".m-portlet__body, .m-portlet__foot").slideUp();
					$(this).attr("data-status", 0)
				}
			});
			current_el.find(".m-portlet__body, .m-portlet__foot").slideDown();
			current_el.attr("data-status", 1);
		} else if (current_el.attr("data-status") == 1) {
			current_el.find(".m-portlet__body, .m-portlet__foot").slideUp();
			current_el.attr("data-status", 0)

		}
	});


	/*
	################################
		MEETING CODE GOES HERE
	################################
	*/


	/*
	 ******** ADD MEETING ********
	*/
	$(".meeting_modal_open_btn").on("click", function () {
		$("#meeting_form")[0].reset();
		$("#meeting_modal").modal('show');
		$("#meeting_form").attr('action', base_url + 'schedule/add_meeting')
		$(".meeting_modal_heading").html('ADD NEW MEETING');
		$("#meeting_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** EDIT MEETING ********
	*/
	$(".custom_meeting_portlet_container").on("click", ".meeting_edit", function (e) {
		var id = $(this).attr('data-meeting-id');
		call_service(base_url + 'schedule/edit_meeting/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#meeting_modal").modal('show');
					$("#meeting_form").attr('action', base_url + 'schedule/update_meeting')
					$(".meeting_modal_heading").html('EDIT NEW MEETING');
					$("#meeting_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#meeting_id").val(res.data[0].id);
					$("#meeting_title").val(res.data[0].subject);
					$("#meeting_description").val(res.data[0].description);
					$("#meeting_start_date").val(res.data[0].start_datetime);
					$("#meeting_end_date").val(res.data[0].end_datetime);
					$("#meeting_type").val(res.data[0].status_type);
					$("#meeting_alert_datetime").val(res.data[0].alert_before_datetime);
					var users_id = res.data[0].user_ids.split(",");
					$("#meeting_invitees").val(users_id).trigger('change');
				}
				if (res.status == 'error') {
					notify_alert('error', res.message, "Error");
				}
			},
			function (res) {
				notify_alert('error', res.message, "Error");
			}
		);
	});

	/*
	 ******** SAVE / UPDATE meeting ********
	*/
	$("#meeting_action_btn").click(function () {
		var obj = $(this);
		if ($("#meeting_form").parsley().validate()) {
			var btn_text = $("#meeting_action_btn").html();
			show_loading("#meeting_action_btn", 'Loading..!');
			form_submit('meeting_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#meeting_action_btn", btn_text);
					$("#meeting_form").parsley().reset();
					$("#meeting_form")[0].reset();
					$("#meeting_modal").modal('hide');
					$(".get_meeting_list_on_tab").trigger("click");
				}
			}, function () {
				hide_loading("#meeting_action_btn", btn_text);
			});
		}
	});

	/*
	******* DELETE MEETING ********
	*/
	$(".custom_meeting_portlet_container").on("click", ".meeting_delete", function (e) {
		var id = $(this).attr('data-meeting-id');
		if (confirm("Are you sure, You want to delete this meeting?")) {
			call_service(base_url + "schedule/delete_meeting/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					$(".get_meeting_list_on_tab").trigger("click");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function () {
				notify_alert('danger', response.message, "Error");
			});

		}
	});


	/*
	 ******* GET LIST OF MEETING ********
	*/
	$(".get_meeting_list,.get_meeting_list_on_tab").click(function () {
		call_service(base_url + 'schedule/get_meeting', function (res) {
			if (res.status == 'success') {
				var html = '';
				$(res.data).each(function (index, value) {
					html += '<div class="cust_meeting m-portlet m-portlet--skin-dark m-portlet--bordered-semi ' + res.data[index].color + ' custom_portlet"  data-status="0">\
							<div class="m-portlet__head">\
								<div class="m-portlet__head-caption">\
									<div class="m-portlet__head-title">\
										<span class="m-portlet__head-icon">\
											<i class="flaticon-statistics"></i>\
										</span>\
										<h3 class="m-portlet__head-text">'+ res.data[index].subject + '</h3>\
									</div>\
								</div>\
								<div class="m-portlet__head-tools">\
									<ul class="m-portlet__nav">\
										<li class="m-portlet__nav-item">\
											<a data-meeting-id="'+ res.data[index].id + '" class="meeting_delete m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-trash"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
											<a data-meeting-id="'+ res.data[index].id + '" class="meeting_edit m-portlet__nav-link m-portlet__nav-link--icon">\
												<i class="fa fa-edit"></i>\
											</a>\
										</li>\
										<li class="m-portlet__nav-item">\
										<a  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon custom_meeting_portlet_toggle">\
											<i class="la la-angle-down"></i>\
										</a>\
									</li>\
									</ul>\
								</div>\
							</div>\
							<div class="m-portlet__body" style="display:none">'+ res.data[index].description + '</div>\
							<div class="m-portlet__foot cust_meeting_foot text-white" style="display:none">\
								<div class="row">\
									<div class="col-sm-6 ">\
										<div class="pull-left text-sm">\
											<em>Edited By : Meenesh</em>\
										</div>\
									</div>\
									<div class="col-sm-6">\
										<div class="pull-right text-sm">\
											<em>Created On : '+ res.data[index].created_date + '</em>\
										</div>\
									</div>\
								</div>\
							</div>\
						</div>';
				});
				$('.custom_meeting_portlet_container').html(html);
			}
		}, function (res) {
			notify_alert('error', res.message, "Error");
		});
	});
});


/* TASK MODULE CODE GOES HERE */

$(document).ready(function(){
	$(".task_modal_open_btn").on("click", function () {
		$("#task_form")[0].reset();
		$("#task_modal").modal('show');
		$("#task_form").attr('action', base_url + 'schedule/add_task')
		$(".task_modal_heading").html('ADD NEW TASK');
		$("#task_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE TASK ********
	*/
	$("#task_action_btn").click(function () {
		var obj = $(this);
		if ($("#task_form").parsley().validate()) {
			var btn_text = $("#task_action_btn").html();
			show_loading("#task_action_btn", 'Loading..!');
			form_submit('task_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#task_action_btn", btn_text);
					$("#task_form").parsley().reset();
					$("#task_form")[0].reset();
					$("#task_modal").modal('hide');
					$(".get_task_list_on_tab").trigger("click");
				}
			}, function () {
				hide_loading("#task_action_btn", btn_text);
			});
		}
	});

		/*
	 ******* GET LIST OF TASK ********
	*/
	$(".get_task_list_on_tab").click(function () {
		call_service(base_url + 'schedule/get_task', function (res) {
			if (res.status == 'success') {
				var html = '';
				var i = 0;

				var color = ['primary', 'warning', 'brand', 'success', 'danger', 'info'];
				$(res.data).each(function (index, value) {
					var complete = '';
					var checked = '';
					if(res.data[index].complete == 1)
					{
						complete = 'task_completed';
						checked = 'checked';
					}
					html += '<div class="m-widget2__item m-widget2__item--'+color[i]+'">\
							<div class="m-widget2__checkbox">\
							<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--'+color[i]+'">\
							<input type="checkbox" '+checked+' class="mark_task_complete" data-mark-status="'+res.data[index].complete+'" data-task-id='+res.data[index].id+'>\
							<span></span>\
							</label>\
							</div>\
							<div class="m-widget2__desc '+complete+'" id="tsk_cmplt_id'+res.data[index].id+'">\
							<span class="m-widget2__text">'+res.data[index].title+'</span>\
							<br>\
							<span class="m-widget2__user-name">\
							<a href="#" class="m-widget2__link">'+res.data[index].description+'<br><span class="m--font-info"><i>Created On : '+res.data[index].created_date+'</i></span></a>\
							</span>\
							</div>\
							<div class="m-widget2__actions">\
							<div class="m-widget2__actions-nav">\
							<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">\
							<a href="#" class="m-dropdown__toggle">\
							<i class="la la-ellipsis-h"></i>\
							</a>\
							<div class="m-dropdown__wrapper">\
							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>\
							<div class="m-dropdown__inner">\
							<div class="m-dropdown__body">\
							<div class="m-dropdown__content">\
							<ul class="m-nav">\
							<li class="m-nav__item task_delete_btn" data-delete-id="'+res.data[index].id+'">\
							<a class="m-nav__link">\
							<i class="m-nav__link-icon fa fa-trash"></i>\
							<span class="m-nav__link-text">\
							Delete\
							</span>\
							</a>\
							</li>\
							</ul>\
							</div>\
							</div>\
							</div>\
							</div>\
							</div>\
							</div>\
							</div>\
							</div>';
						i++;
						if(i == 5){ i = 0; }
				});
				$('.custom_task_portlet_container').html(html);
			}
		}, function (res) {
			notify_alert('error', res.message, "Error");
		});
	});

	$('.custom_task_portlet_container').on("click", ".mark_task_complete", function (e) {
		var obj = $(this);
		var id = obj.attr('data-task-id');
		var status;
		if(obj.attr('data-mark-status') == '0')
		{
			var alertmsg = "Mark as complete?";
			status = 1;
		}
		else
		{
			var alertmsg = "Mark as Uncomplete?";
			status = 0;
		}
		if (confirm(alertmsg)) {
			call_service(base_url + "schedule/mark_task_complete/"+ id+"/"+status, function (response) {
				if (response.status == 'success') {
					if(status == 1)
					{
						$("#tsk_cmplt_id"+id).addClass('task_completed');
						obj.attr('data-mark-status','1');
					}
					else
					{
						$("#tsk_cmplt_id"+id).removeClass('task_completed');
						obj.attr('data-mark-status','0');						
					}
					notify_alert('success', response.message, "Success");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
		else
		{
			obj.prop('checked',false);
		}
	});

	
	/*
	******* DELETE MEETING ********
	*/
	$(".custom_task_portlet_container").on("click", ".task_delete_btn", function (e) {
		var id = $(this).attr('data-delete-id');
		if (confirm("Are you sure, You want to delete this task?")) {
			call_service(base_url + "schedule/delete_task/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					$(".get_task_list_on_tab").trigger("click");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function () {
				notify_alert('danger', response.message, "Error");
			});

		}
	});
	
});
