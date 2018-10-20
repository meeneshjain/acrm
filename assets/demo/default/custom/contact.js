$(document).ready(function () {

	/*
	 ******** ADD CONTACT ********
	*/
	$(".cont_modal_open_btn").on("click", function () {
		$("#cont_form").parsley().reset();
		$("#cont_form")[0].reset();
		$("#cont_id").val(0);
		$("#cont_modal").modal('show');

		$("#cont_account").removeAttr('disabled');

		$("#cont_form").attr('action', base_url + 'contact/add_update_account')
		$(".cont_modal_heading").html('ADD NEW CONTACT');
		$("#cont_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE CONTACT ********
	*/
	$("#cont_action_btn").click(function () {
		var obj = $(this);
		if ($("#cont_form").parsley().validate()) {
			var btn_text = $("#cont_action_btn").html();
			show_loading("#cont_action_btn", 'Loading..!');
			form_submit('cont_form', function (res) {
				if (res.status == 'success') {
					notify_alert('success', res.message, "Success");
					hide_loading("#cont_action_btn", btn_text);
					$("#cont_form").parsley().reset();
					$("#cont_form")[0].reset();
					$("#cont_modal").modal('hide');					
					reloadTable("#cont_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#cont_action_btn", btn_text);
			});
		}
	});

	/*
	 ******** EDIT CONTACT ********
	*/
	$("#cont_list_dt_table").on("click", ".edit_cont", function (e) {
		var id = $(this).attr('data-cont-id');
		$("#cont_form").parsley().reset();
		call_service(base_url + 'contact/edit_contact/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#cont_modal").modal('show');
					$("#cont_form").attr('action', base_url + 'contact/add_update_account')
					$(".cont_modal_heading").html('EDIT CONTACT DETAIL');
					$("#cont_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#cont_account").attr('disabled','disabled');

					$("#cont_id").val(res.data[0].id);

					$("#cont_account").val(res.data[0].account_id);
					$("#cont_fname").val(res.data[0].first_name);
					$("#cont_lname").val(res.data[0].last_name);
					$("#cont_mobile_no").val(res.data[0].mobile);
					$("#cont_email_1").val(res.data[0].email_1);
					$("#cont_other_contact").val(res.data[0].other_contact);
					$("#cont_other_email").val(res.data[0].other_email);
					$("#cont_title").val(res.data[0].title);
					$("#cont_fax").val(res.data[0].fax);
					$("#cont_department").val(res.data[0].department);
					$("#cont_website").val(res.data[0].website_url);

					$("#cont_paddress").val(res.data[0].primary_address);
					$("#cont_pcity").val(res.data[0].primary_city);
					$("#cont_pstate").val(res.data[0].primary_state);
					$("#cont_pcode").val(res.data[0].primary_pincode);
					$("#cont_pcountry").val(res.data[0].primary_country);

					$("#cont_saddress").val(res.data[0].secondary_address);
					$("#cont_scity").val(res.data[0].secondary_city);
					$("#cont_sstate").val(res.data[0].secondary_state);
					$("#cont_scode").val(res.data[0].secondary_pincode);
					$("#cont_scountry").val(res.data[0].secondary_country);

					$("#cont_description").val(res.data[0].description);
				
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
	******* DELETE CONTACT ********
	*/
	$("#cont_list_dt_table").on("click", ".delete_cont", function (e) {
		var id = $(this).attr('data-cont-id');
		if (confirm("Are you sure, You want to delete this Contact.?")) {
			call_service(base_url + "contact/delete_contact/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					reloadTable("#cont_list_dt_table");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
	});

	$(".multiple_contact_delete").on("click",function(){
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
	                    reloadTable("#cont_list_dt_table");
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

	$("#cont_list_dt_table").on("click", ".changestats", function (e) {
		$obj = $(this);
		var id = $obj.attr('data-id');
		var status = $obj.attr('data-status');
		var msg;
		if(status == 1){ msg = 'Inactive'; }else{msg = 'Active'; }
		if (confirm("Are you sure, you want make "+msg+"?")) {
			$obj.html('<i class="fa fa-spinner fa-spin"></i> changing..');
			$.getJSON("contact/changestats/"+id+"/"+status,function(res){
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

	$("#clone_primary_address").on("change",function(){
		if($(this).prop("checked") == true)
		{
    		$("#cont_saddress").val($("#cont_paddress").val());
			$("#cont_scity").val($("#cont_pcity").val());
			$("#cont_sstate").val($("#cont_pstate").val());
			$("#cont_scode").val($("#cont_pcode").val());
			$("#cont_scountry").val($("#cont_pcountry").val());
        }
        else if($(this).prop("checked") == false)
        {
			$("#cont_saddress").val('');
			$("#cont_scity").val('');
			$("#cont_sstate").val('');
			$("#cont_scode").val('');
			$("#cont_scountry").val('');
        }
	});


	/*$('#cont_account_list').select2({
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

	/*$("#cont_account_list").select2({
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

	/*$("#cont_account_list").select2({
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
    $(".contact_to_lead_btn").on("click", function () {

    	if ($(".contchkbx:checked").length > 0) 
    	{
	        	$("#contat_to_lead_form").parsley().reset();
				$("#contat_to_lead_form")[0].reset();
				$("#contact_to_lead_modal").modal('show');
	    }
	    else {
	        notify_alert('error', 'Please select at least one contact.', 'Error');
	    }
	});

});


function convert_contact_to_lead()
{
	if ($("#contat_to_lead_form").parsley().validate()) 
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
	            reloadTable("#cont_list_dt_table");
	            notify_alert('success', response.message, "Success");
	            $("#contact_to_lead_modal").modal('hide');
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

	var id = $("#cont_id").val();
	var account_id = $("#cont_account").val();
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
