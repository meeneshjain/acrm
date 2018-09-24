$(document).ready(function () {

	/*
	 ******** ADD ACCOUNT ********
	*/
	$(".acnt_modal_open_btn").on("click", function () {
		$("#acnt_form").parsley().reset();
		$("#acnt_form")[0].reset();
		$("#acnt_id").val(0);
		$("#acnt_modal").modal('show');

		$("#acnt_form").attr('action', base_url + 'account/add_update_account')
		$(".acnt_modal_heading").html('ADD NEW ACCOUNT');
		$("#acnt_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE ACCOUNT ********
	*/
	$("#acnt_action_btn").click(function () {
		var obj = $(this);
		if ($("#acnt_form").parsley().validate()) {
			var btn_text = $("#acnt_action_btn").html();
			show_loading("#acnt_action_btn", 'Loading..!');
			form_submit('acnt_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#acnt_action_btn", btn_text);
					$("#acnt_form").parsley().reset();
					$("#acnt_form")[0].reset();
					$("#acnt_modal").modal('hide');					
					reloadTable("#acnt_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#acnt_action_btn", btn_text);
			});
		}
	});

	/*
	 ******** EDIT ACCOUNT ********
	*/
	$("#acnt_list_dt_table").on("click", ".edit_account", function (e) {
		var id = $(this).attr('data-acnt-id');
		$("#acnt_form").parsley().reset();
		call_service(base_url + 'account/edit_account/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#acnt_modal").modal('show');
					$("#acnt_form").attr('action', base_url + 'account/add_update_account')
					$(".acnt_modal_heading").html('EDIT ACCOUNT DETAIL');
					$("#acnt_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#acnt_id").val(res.data[0].id);

					$("#acnt_name").val(res.data[0].name);
					$("#acnt_number").val(res.data[0].account_number);
					$("#acnt_description").val(res.data[0].description);
					$("#acnt_contact").val(res.data[0].contact_no_1);
					$("#acnt_other_contact").val(res.data[0].contact_no_2);
					$("#acnt_email").val(res.data[0].email_1);
					$("#acnt_other_email").val(res.data[0].email_2);
					$("#acnt_group").val(res.data[0].group_type);
					$("#acnt_address").val(res.data[0].address);
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
	******* DELETE ACCOUNT ********
	*/
	$("#acnt_list_dt_table").on("click", ".delete_account", function (e) {
		var id = $(this).attr('data-acnt-id');
		if (confirm("Are you sure, You want to delete this Account.?")) {
			call_service(base_url + "account/delete_account/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					reloadTable("#acnt_list_dt_table");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
	});

	$("#acnt_list_dt_table").on("click", ".changestats", function (e) {
		$obj = $(this);
		var id = $obj.attr('data-id');
		var status = $obj.attr('data-status');
		var msg;
		if(status == 1){ msg = 'Inactive'; }else{msg = 'Active'; }
		if (confirm("Are you sure, you want make "+msg+"?")) {
			$obj.html('<i class="fa fa-spinner fa-spin"></i> changing..');
			$.getJSON("account/changestats/"+id+"/"+status,function(res){
				if(res.status == 'success')
				{
					if(status == 1){ 
						$obj.html('Inactive').removeClass('m-badge--success').addClass('m-badge--danger').attr('data-status','0');
					}else{
						$obj.html('Active').removeClass('m-badge--danger').addClass('m-badge--success').attr('data-status','1');
					}
					notify_alert('success', res.message, "Success");
				}
				if(res.status == 'error')
				{
					notify_alert('danger', res.message, "Error");
				}
			});
		}
	});

	/*
	 ****** CHECK ACCOUNT WITH SAME EMAIL AND NUMBER *******
	*/

	$("#acnt_email,#acnt_contact").blur(function(){

		var id = $("#acnt_id").val();
		var email = $("#acnt_email").val();
		var number = $("#acnt_contact").val();


		var data = {"id":id,"email":email,"contact":number};
		if(email != '' && number != '')
		{
			$(".checkduplicateaccount").html(' <i class="fa fa-spinner fa-spin"></i> Please wait checking account..');
			$.post(
					base_url+"account/checkDuplicate",
					data,
					function(response) {
	    			if(response.status == 'success'){
	    				notify_alert('success', response.message, "Success");
	    				$(".checkduplicateaccount").html('<i class="fa fa-check"></i> Account Verified!!');
	    				$(".checkduplicateaccount").removeClass('text-danger');
	    				$(".checkduplicateaccount").addClass('text-success');
	    				$(".checkduplicateaccount").show().fadeOut(5000);
	    			}
	    			if(response.status == 'error'){
	    				notify_alert('danger', response.message, "Error");
	    				$(".checkduplicateaccount").html('<i class="fa fa-warning"></i> Account already exist with same contact and email.!!');
	    				$(".checkduplicateaccount").removeClass('text-success');
	    				$(".checkduplicateaccount").addClass('text-danger');
	    				$(".checkduplicateaccount").show().fadeOut(5000);
	    			}
			}, 'JSON');
		}
	});

});