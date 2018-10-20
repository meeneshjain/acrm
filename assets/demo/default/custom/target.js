$(document).ready(function () {

	/*
	 ******** ADD TARGET ********
	*/
	$(".trgt_modal_open_btn").on("click", function () {
		$("#trgt_form").parsley().reset();
		$("#trgt_form")[0].reset();
		$("#trgt_id").val(0);
		$("#trgt_modal").modal('show');
		$('#trgt_type').trigger('change');
		$("#trgt_account").removeAttr('disabled');

		$("#trgt_form").attr('action', base_url + 'target/add_update_target')
		$(".trgt_modal_heading").html('ADD NEW TARGET');
		$("#trgt_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE TARGET ********
	*/
	$("#trgt_action_btn").click(function () {
		var obj = $(this);
		if ($("#trgt_form").parsley().validate()) {
			var btn_text = $("#trgt_action_btn").html();
			show_loading("#trgt_action_btn", 'Loading..!');
			form_submit('trgt_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#trgt_action_btn", btn_text);
					$("#trgt_form").parsley().reset();
					$("#trgt_form")[0].reset();
					$("#trgt_modal").modal('hide');					
					reloadTable("#trgt_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#trgt_action_btn", btn_text);
			});
		}
	});

	/*
	********  SELECT TARGET TYPE *********
	*/
	//It will be amount type or product type
	$('#trgt_type').on('change',function(){
		if($(this).val() == 'amount')
		{
			$('#trgt_type_amount').show();
			$('#trgt_type_product').hide();
			$('#trgt_product').val('');
		}
		if($(this).val() == 'product')
		{
			$('#trgt_type_amount').hide();
			$('#trgt_type_product').show();
			$('#trgt_amount').val('');
		}
	});


	/*
	 ******** EDIT TARGET ********
	*/
	$("#trgt_list_dt_table").on("click", ".edit_trgt", function (e) {
		var id = $(this).attr('data-trgt-id');
		$("#trgt_form").parsley().reset();
		call_service(base_url + 'target/edit_target/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#trgt_modal").modal('show');
					$("#trgt_form").attr('action', base_url + 'target/add_update_target')
					$(".trgt_modal_heading").html('EDIT TARGET DETAIL');
					$("#trgt_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#trgt_id").val(res.data[0].id);

					$("#trgt_name").val(res.data[0].name);
					$("#trgt_duration").val(res.data[0].target_duration_id);
					$("#trgt_type").val(res.data[0].target_type);

					if(res.data[0].target != 0)
					{
						$('#trgt_amount').val(res.data[0].target);
						$('#trgt_type_amount').show();
						$('#trgt_type_product').hide();
						$('#trgt_product').val('');
					}
					if(res.data[0].product_id != 0)
					{
						$('#trgt_product').val(res.data[0].product_id);
						$('#trgt_type_amount').hide();
						$('#trgt_type_product').show();
						$('#trgt_amount').val('');
					}
					$("#trgt_description").val(res.data[0].description);
				
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

});