function calculate_end_date(){
	var selectedDate = new Date($("#trgt_start_date").val());
	var target_duration = $("#trgt_duration").val();
	var no_of_months = 1;
	if (target_duration == 3) {
		no_of_months = 1;
	} else if (target_duration == 4) {
		no_of_months = 3;
	} else if (target_duration == 5) {
		no_of_months = 6;
	} else if (target_duration == 6) {
		no_of_months = 12;
	}
	$("#trgt_end_date").val(format_date(new Date(selectedDate.getFullYear(), selectedDate.getMonth() + no_of_months, 0)));
}

$(document).ready(function () {
	//common events 
	$(document).on("change", "#trgt_duration", function(){
		calculate_end_date();
	});
	
	// NOTE : target_user_role defined in target view
	if (target_user_role == 1) {
		rm_view();
	}
	if (target_user_role == 2) {
		tl_view();
	}
	if (target_user_role == 3) {
		user_view();
	}

	/*
	#########################################################################
	************************* CODE FOR REGIONAL MANAGER *********************
	#########################################################################
	*/

	// ADD TARGET FOR RM MODAL
	$(".target_view_data").on("click", ".rm_trgt_modal_open_btn", function () {
		$("#rm_trgt_form").parsley().reset();
		$("#rm_trgt_form")[0].reset();
		$("#trgt_id").val(0);
		$("#trgt_user_id").val($(this).attr('data-user-id'));
		$("#rm_trgt_modal").modal('show');
		$("#trgt_type,#trgt_duration").removeAttr('disabled');
		$("#trgt_duration").val(3);
		var current_date = new Date();
		var trgt_start_date = format_date(new Date(current_date.getFullYear(), current_date.getMonth(), 1));
		var trgt_end_date = format_date(new Date(current_date.getFullYear(), current_date.getMonth() + 1, 0));
		$("#trgt_start_date").val(trgt_start_date);
		$("#trgt_end_date").val(trgt_end_date);
		$("#trgt_start_date").datepicker({
			todayHighlight: !0,
			orientation: "bottom left",
			templates: {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>'
			},
			format: "yyyy-mm-dd",
			autoclose: !0,
			startDate: trgt_start_date
		}).on("change", function(event){
			calculate_end_date();
		});

		/* $("#trgt_end_date").datepicker({
			todayHighlight: !0,
			orientation: "bottom left",
			templates: {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>'
			},
			format: "yyyy-mm-dd",
			autoclose: !0,
			minDate: new Date(),
		}); */

		$("#rm_trgt_form").attr('action', base_url + 'target/add_update_target')
		$(".rm_trgt_modal_heading").html('ADD NEW TARGET');
		$("#rm_trgt_action_btn").html('<i class="fa fa-save"></i> Save');
	});


	// SAVE / UPDATE TARGET FOR RM
	$(".target_view_data").on("click", "#rm_trgt_action_btn", function () {
		var obj = $(this);
		if ($("#rm_trgt_form").parsley().validate()) {
			var btn_text = $("#rm_trgt_action_btn").html();
			show_loading("#rm_trgt_action_btn", 'Loading..!');
			form_submit('rm_trgt_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#rm_trgt_action_btn", btn_text);
					$("#rm_trgt_form").parsley().reset();
					$("#rm_trgt_form")[0].reset();
					$("#rm_trgt_modal").modal('hide');
					$('.modal-backdrop').remove()
					rm_view();
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#rm_trgt_action_btn", btn_text);
			});
		}
	});

	// EDIT DETAIL FOR RM
	$(".target_view_data").on("click", ".rm_edit_trgt", function (e) {
		$("#trgt_start_date,#trgt_end_date").datepicker("destroy");;
		var id = $(this).attr('data-trgt-id');
		$("#rm_trgt_form").parsley().reset();
		call_service(base_url + 'target/edit_target/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#rm_trgt_modal").modal('show');
					$("#rm_trgt_form").attr('action', base_url + 'target/add_update_target')
					$(".rm_trgt_modal_heading").html('EDIT TARGET DETAIL');
					$("#rm_trgt_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#trgt_id").val(res.data[0].id);
					$("#trgt_user_id").val(res.data[0].assign_to_user_id);
					$("#trgt_name").val(res.data[0].target_title);
					$("#trgt_duration").val(res.data[0].target_duration_id);
					$("#trgt_type").val(res.data[0].target_type);
					$("#trgt_target").val(res.data[0].target);
					$("#trgt_start_date").val(res.data[0].start_date);
					$("#trgt_end_date").val(res.data[0].end_date);
					$("#trgt_description").val(res.data[0].description);


					$("#trgt_type,#trgt_duration").attr('disabled', 'disabled');

					// IS used for check not less than assigned target
					$("#assigned_target").val(res.data[0].target - res.data[0].target_left);
					$("#last_target").val(res.data[0].target);
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

	// CHECK WHEN TARGET EDIT BY ADMIN
	$(".target_view_data").on("blur", "#trgt_target", function () {
		if ($("#trgt_id").val() != 0) {
			var enter_val = parseFloat($(this).val());
			var assigned_target = parseFloat($("#assigned_target").val());
			var last_target = parseFloat($("#last_target").val());
			var type = $("#trgt_type").val();
			if (assigned_target != last_target) {
				if (enter_val < assigned_target) {
					notify_alert('danger', 'Already assigned ' + assigned_target + ' ' + type + ' so you can not assign less than ' + assigned_target + ' ' + type, 'Error');
					$("#trgt_target").val('');
				}
			}
		}
	});




	/******************************************************************
	####################### CODE FOR TEAM LEADER ######################
	*******************************************************************/

	// SAVE TARGET FOR TL
	$(".target_view_data").on("click", ".trgt_assign_action_btn", function () {
		var obj = $(this);
		if ($("#assign_target_form").parsley().validate()) {
			var btn_text = $("#trgt_assign_action_btn").html();
			show_loading("#trgt_assign_action_btn", 'Loading..!');
			form_submit('assign_target_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#trgt_assign_action_btn", btn_text);
					$("#assign_target_form").parsley().reset();
					$("#assign_target_form")[0].reset();
					tl_view();
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#trgt_assign_action_btn", btn_text);
			});
		}
	});



	// SHOW MY TL DETAIL
	$(".target_view_data").on("click", ".view_my_dl_user", function (e) {
		var user_id = $(this).attr('data-user-id');
		var user_role = $(this).attr('data-user-role');
		$("#downline_user_detail_modal").modal('show');
		$(".downline_user_detail_result").html('<i class="fa fa-spinner fa-spin"></i> Fetching Result....');
		$.get(base_url + "target/getMyDownlineUser/" + user_id + "/" + user_role, function (res, status) {
			$(".downline_user_detail_result").html(res);
		});
	});


	$(".target_view_data").on('keyup', '.target_amount', function (e) {
		console.log('here');
		subTotal = 0;
		var total_target = $("#total_target_value").val();
		var target_type = $("#target_type").val();
		$('.target_amount').each(function () {
			if ($(this).val() != '') subTotal += parseFloat($(this).val());
		});

		if (parseFloat(total_target) < parseFloat(subTotal)) {
			$(this).val('');
			notify_alert('danger', 'Enter ' + target_type + ' exeed to sum of total ' + target_type, "Error");
		}
	});
});

var DatatableHtmlTableDemo = {
	init: function () {
		var e;
		e = $(".m-datatable").mDatatable({
			data: {
				saveState: {
					cookie: !1
				}
			},
			search: {
				input: $("#generalSearch")
			},
		})
	}
};



function rm_view() {
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url + "target/getRegionalManager", function (res, status) {
		$(".target_view_data").html(res);
		jQuery(document).ready(function () {
			DatatableHtmlTableDemo.init()
		});
	});
}

function tl_view() {
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url + "target/getTeamLeader", function (res, status) {
		$(".target_view_data").html(res);
		jQuery(document).ready(function () {
			DatatableHtmlTableDemo.init()
		});
	});
}

function user_view() {
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url + "target/getUsers", function (res, status) {
		$(".target_view_data").html(res);
		jQuery(document).ready(function () {
			DatatableHtmlTableDemo.init()
		});
	});
}