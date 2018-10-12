$(document).ready(function () {

	/*
	 ******** ADD CONTACT ********
	*/
	$(".lead_modal_open_btn").on("click", function () {
		$("#lead_form").parsley().reset();
		$("#lead_form")[0].reset();
		$("#lead_id").val(0);
		$("#lead_modal").modal('show');

		$("#lead_account").removeAttr('disabled');

		$("#lead_form").attr('action', base_url + 'contact/add_update_account')
		$(".lead_modal_heading").html('ADD NEW LEAD');
		$("#lead_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE CONTACT ********
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
	 ******** EDIT LEAD ********
	*/
	$("#lead_list_dt_table").on("click", ".edit_cont", function (e) {
		var id = $(this).attr('data-lead-id');
		$("#lead_form").parsley().reset();
		call_service(base_url + 'lead/edit_lead/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#lead_modal").modal('show');
					$("#lead_form").attr('action', base_url + 'lead/add_update_account')
					$(".lead_modal_heading").html('EDIT LEAD DETAIL');
					$("#lead_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#lead_account").attr('disabled','disabled');

					$("#lead_id").val(res.data[0].id);

					$("#lead_account").val(res.data[0].account_id);
					$("#lead_owner_id").val(res.data[0].owner_id);
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

	/*
	******* DELETE LEAD ********
	*/
	$("#lead_list_dt_table").on("click", ".delete_lead", function (e) {
		var id = $(this).attr('data-lead-id');
		if (confirm("Are you sure, You want to delete this Contact.?")) {
			call_service(base_url + "contact/delete_contact/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					reloadTable("#lead_list_dt_table");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
	});

	$(".multiple_lead_delete").on("click",function(){
		if ($(".contchkbx:checked").length > 0) {
	        if (confirm("Are you sure, You want to delete selected Contact?")) {
	            idArr = [];
	            $('.contchkbx').each(function (index, value) {
	                if (this.checked == true) {
	                    idArr.push(this.value);
	                }
	            });

	            call_service(base_url + "contact/multiple_delete_contact/?ids=" + idArr, function (response) {
	                if (response.status == 'success') {
	                    reloadTable("#lead_list_dt_table");
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
	        notify_alert('error', 'Please select at least one contact.', 'Error');
	    }
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


	/*$('#lead_account_list').select2({
	  	placeholder: "Search for git repositories",
        allowClear: !0,
        ajax: {
            url: base_url+"contact/account_list",
            dataType: "json",
            delay: 250,
            data: function(e) {
                console.log(e);
                return {
                    q: e.result
                   // page: e.page
                }
            },
            processResults: function (data) {
            	console.log(data);
			    return {
			        results: data.result,
			    };
			},
            cache: !0
        },
        escapeMarkup: function(e) {
        	console.log(e);
            return e
        },

	});*/

	/*$("#lead_account_list").select2({
	 	disabled:false,
	  	ajax: { 
       	url: base_url+"contact/account_list",
	   	type: "post",
	   	dataType: 'json',
	   	delay: 250,
	   	data: function (params) {
	    return {
	      searchTerm: params.term // search term
	    };
	   },
	   processResults: function (response) {
	     return {
	        results: response
	     };
	   },
	   cache: true
	  }
	});*/

	/*$("#lead_account_list").select2({
            placeholder: "Search for git repositories",
            allowClear: !0,
            ajax: {
                url: base_url+"contact/account_list",
                dataType: "json",
                delay: 250,
                data: function(e) {
                    console.log(e);
                    return {
                        q: e.result
                       // page: e.page
                    }
                },
                processResults: function (data) {
                	console.log(data);
				    return {
				        results: data.result,
				    };
				},
                cache: !0
            },
            escapeMarkup: function(e) {
            	console.log(e);
                return e
            },
    });*/

    /*
	## ASSIGN CONTACT TO USER
    */
    $("#lead_list_dt_table").on("click", ".convert_to_opportunity_btn", function () {    	
    	$("#convert_to_opportunity_form").parsley().reset();
		$("#convert_to_opportunity_form")[0].reset();
		$("#convert_to_opportunity_modal").modal('show');

    	$("#oppr_id").val($(this).attr('data-lead-id'));
    	$("#oppr_name").val($(this).attr('data-opportunity-name'));
    	$("#oppr_account_name").val($(this).attr('data-account-name'));
	});

	$("#oppr_stage").on("change",function(){
		var option = $('option:selected', this).attr('data-probability');
		$('#oppr_probability').val(option)
	});

});


function convert_contact_to_lead()
{
	if ($("#contact_to_lead_form").parsley().validate()) 
	{
		idArr = [];
	    $('.contchkbx').each(function (index, value) {
	        if (this.checked == true) {
	            idArr.push(this.value);
	        }
	    });

	    var assign_to = $("#assign_to_user_list").val();

	    call_service(base_url + "contact/convert_contact_to_lead/?assign_to="+assign_to+"&ids=" + idArr, function (response) {
	        if (response.status == 'success') {
	            reloadTable("#lead_list_dt_table");
	            notify_alert('success', response.message, "Success")
	        } else {
	            notify_alert('danger', response.message, "Error");
	        }
	    }, function () {
	        notify_alert('danger', response.message, "Error");
	    });
	}
}

/*
 ****** CHECK CONTACT WITH SAME EMAIL AND NUMBER *******
*/

function checkDuplicate(obj,column)
{

	var id = $("#lead_id").val();
	var account_id = $("#lead_account").val();
	var searchValue = $(obj).val();

	var data = {"id":id,"column":column,"value":searchValue,"account_id":account_id};

	if(searchValue != '' && account_id != '')
	{
		$(".checkduplicatecontact").html(' <i class="fa fa-spinner fa-spin"></i> Please wait checking contact..');
		$.post(
				base_url+"contact/checkDuplicate",
				data,
				function(response) {
    			if(response.status == 'success'){
    				$(".checkduplicatecontact").html('');
    				//$(".checkduplicatecontact").html('<i class="fa fa-check"></i> Account Verified!!');
    			}
    			if(response.status == 'error'){
    				$(".checkduplicatecontact").html('<div class="alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><strong>Error: </strong>'+response.message+'</div>');
    				$(obj).val('').focus();
    			}
		}, 'JSON');
	}
}
