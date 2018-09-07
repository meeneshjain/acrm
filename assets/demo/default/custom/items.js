$(document).ready(function () {

	/*
	 ******** ADD ITEM ********
	*/
	$(".item_modal_open_btn").on("click", function () {
		$("#item_form")[0].reset();
		$("#item_modal").modal('show');
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
					$(".item_modal_heading").html('EDIT NEW ITEM');
					$("#item_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#item_id").val(res.data[0].id);
					$("#item_name").val(res.data[0].name);
					$("#item_code").val(res.data[0].code);
					$("#item_type").val(res.data[0].type);
					$("#item_group").val(res.data[0].group_id);
					$("#item_price").val(res.data[0].price_id);
					$("#item_unit").val(res.data[0].unit);
					$("#item_description").val(res.data[0].description);
					if(res.data[0].is_gst == '1')
					{
						$("#item_gst").attr('checked','checked');
					}
					else
					{
						$("#item_gst").removeAttr('checked');
					}
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

});