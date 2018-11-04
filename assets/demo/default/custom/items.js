$(document).ready(function () {

	/*
	 ******** ADD ITEM ********
	*/
	$(".item_modal_open_btn").on("click", function () {
		$("#item_form").parsley().reset();
		$("#item_form")[0].reset();
		$("#item_id").val(0);
		$("#item_modal").modal('show');
		$(".is_gst_rate_apply").show();

		$(".item_logo_src").attr('src', base_url + 'assets/images/no.jpg');
		$(".item_logo_src_value").val('assets/images/no.jpg');
		$(".deleteImage").hide();
		if ($("#item_type_id").val() == "service") {
			$("#item_group").val('SERVICE');
		} else {
			$("#item_group").val('INVENTORY');
		}
		$("#item_form").attr('action', base_url + 'items/add_update_item')
		$(".item_modal_heading").html('ADD NEW ITEM');
		$("#item_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE ITEM ********
	*/
	$("#item_action_btn").click(function () {
		var obj = $(this);
		if ($("#item_form").parsley().validate()) {
			var btn_text = $("#item_action_btn").html();
			show_loading("#item_action_btn", 'Loading..!');
			form_submit('item_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#item_action_btn", btn_text);
					$("#item_form").parsley().reset();
					$("#item_form")[0].reset();
					$("#item_modal").modal('hide');
					reloadTable("#item_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#item_action_btn", btn_text);
			});
		}
	});

	/*
	 ******** EDIT ITEM ********
	*/
	$("#item_list_dt_table").on("click", ".edit_item", function (e) {
		var id = $(this).attr('data-item-id');
		$("#item_form").parsley().reset();
		call_service(base_url + 'items/edit_item/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#item_modal").modal('show');
					$("#item_form").attr('action', base_url + 'items/add_update_item')
					$(".item_modal_heading").html('EDIT ITEM DETAILS');
					$("#item_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#item_id").val(res.data[0].id);

					if (res.data[0].logo != '') {
						$(".item_logo_src").attr('src', res.data[0].logo);
						$(".item_logo_src_value").val(res.data[0].logo);
						if (res.data[0].logo == 'assets/images/no.jpg') {
							$(".deleteImage").hide();
						}
						else {
							$(".deleteImage").show();
						}
					}
					else {
						$(".item_logo_src").attr('src', base_url + 'assets/images/no.jpg');
						$(".item_logo_src_value").val('assets/images/no.jpg');
						$(".deleteImage").hide();
					}

					$("#item_name").val(res.data[0].name);
					$("#item_code").val(res.data[0].code);
					$("#item_type").val(res.data[0].type);
					$("#item_group").val(res.data[0].group_type);
					$("#item_unit").val(res.data[0].unit);
					$("#item_description").val(res.data[0].description);

					if (res.data[0].is_gst == '1') {
						$('#item_gst').prop('checked', true);
						$("#item_gst_rate").val(res.data[0].gst_tax_rate);
						$(".is_gst_rate_apply").show();
					}
					else {
						$('#item_gst').prop('checked', false);
						$("#item_gst_rate").val('');
						$(".is_gst_rate_apply").hide();
					}
					$("#itm_price1").val(res.data[0].price1);
					$("#itm_price2").val(res.data[0].price2);
					$("#itm_price3").val(res.data[0].price3);
					$("#itm_price4").val(res.data[0].price4);
					$("#itm_price5").val(res.data[0].price5);

					$(".check_item_button_element").children('i').removeClass('fa fa-check');
					$(".check_item_button_element[data-note_color='" + res.data[0].color + "']").children('').addClass('fa fa-check');
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
	******* DELETE meeting ********
	*/
	$("#item_list_dt_table").on("click", ".delete_item", function (e) {
		var id = $(this).attr('data-item-id');
		if (confirm("Are you sure, You want to delete this item.?")) {
			call_service(base_url + "items/delete_item/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					reloadTable("#item_list_dt_table");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
	});

	$(".multiple_items_delete").on("click", function () {
		if ($(".itmckbx:checked").length > 0) {
			if (confirm("Are you sure, You want to delete selected items?")) {
				idArr = [];
				$('.itmckbx').each(function (index, value) {
					if (this.checked == true) {
						idArr.push(this.value);
					}
				});

				call_service(base_url + "items/multiple_delete_items/?ids=" + idArr, function (response) {
					if (response.status == 'success') {
						reloadTable("#item_list_dt_table");
						notify_alert('success', response.message, "Success")
					} else {
						notify_alert('danger', response.message, "Error");
					}
				}, function () {
					notify_alert('danger', response.message, "Error");
				});
			}
		}
		else {
			notify_alert('error', 'Please select at least one item.', 'Error');
		}
	});


	/*
	************************
	*/

	$("#item_price_list").on("change", function () {
		id = $(this).val();
		$('.itm_prc_input').hide();
		$("#itm_" + id).show();

	});

	$("#item_gst").on('change', function () {
		if ($(this).prop("checked") == true) {
			$(".is_gst_rate_apply").show();

		}
		else if ($(this).prop("checked") == false) {
			$("#item_gst_rate").val('');
			$(".is_gst_rate_apply").hide();
		}
	});
});