	/*
	 ******** SAVE / UPDATE OPPORTUNITY ********
	*/
	$("#lead_action_btn").click(function () {
		var obj = $(this);
		if ($("#lead_form").parsley().validate()) {
			var btn_text = $("#lead_action_btn").html();
			show_loading("#lead_action_btn", 'Loading..!');
			form_submit('lead_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#lead_action_btn", btn_text);
					$("#lead_form").parsley().reset();
					$("#lead_form")[0].reset();
					$("#lead_modal").modal('hide');					
					reloadTable("#lead_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#lead_action_btn", btn_text);
			});
		}
	});
    
    /*
	 ******** EDIT OPPORTUNITY ********
	*/
	$("#lead_list_dt_table").on("click", ".edit_cont", function (e) {
		var id = $(this).attr('data-lead-id');
		$("#lead_form").parsley().reset();
		call_service(base_url + 'lead/edit_lead/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#lead_modal").modal('show');
					$("#lead_form").attr('action', base_url + 'lead/add_update_lead')
					$(".lead_modal_heading").html('EDIT OPPORTUNITY DETAIL');
					$("#lead_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#lead_account").attr('disabled','disabled');

					$("#lead_id").val(res.data[0].id);

					$("#lead_account").val(res.data[0].account_id).trigger('change');
					$("#lead_owner_id").val(res.data[0].owner_id).trigger('change');
					$("#lead_fname").val(res.data[0].first_name);
					$("#lead_lname").val(res.data[0].last_name);
					$("#lead_mobile_no").val(res.data[0].mobile);
					$("#lead_email_1").val(res.data[0].email_1);
					$("#lead_other_contact").val(res.data[0].other_contact);
					$("#lead_other_email").val(res.data[0].other_email);
					$("#lead_title").val(res.data[0].title);
					$("#lead_fax").val(res.data[0].fax);
					$("#lead_department").val(res.data[0].department);
					$("#lead_website").val(res.data[0].website_url);

					$("#lead_paddress").val(res.data[0].primary_address);
					$("#lead_pcity").val(res.data[0].primary_city);
					$("#lead_pstate").val(res.data[0].primary_state);
					$("#lead_pcode").val(res.data[0].primary_pincode);
					$("#lead_pcountry").val(res.data[0].primary_country);

					$("#lead_saddress").val(res.data[0].secondary_address);
					$("#lead_scity").val(res.data[0].secondary_city);
					$("#lead_sstate").val(res.data[0].secondary_state);
					$("#lead_scode").val(res.data[0].secondary_pincode);
					$("#lead_scountry").val(res.data[0].secondary_country);

					$("#lead_description").val(res.data[0].description);
				
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

	$("#clone_primary_address").on("change",function(){
		if($(this).prop("checked") == true)
		{
    		$("#lead_saddress").val($("#lead_paddress").val());
			$("#lead_scity").val($("#lead_pcity").val());
			$("#lead_sstate").val($("#lead_pstate").val());
			$("#lead_scode").val($("#lead_pcode").val());
			$("#lead_scountry").val($("#lead_pcountry").val());
        }
        else if($(this).prop("checked") == false)
        {
			$("#lead_saddress").val('');
			$("#lead_scity").val('');
			$("#lead_sstate").val('');
			$("#lead_scode").val('');
			$("#lead_scountry").val('');
        }
	});