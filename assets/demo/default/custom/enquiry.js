$(document).ready(function () {

	/*
	 ******** ADD ACCOUNT ********
	*/
	$(".enquiry_modal_open_btn").on("click", function () {
		$("#enquiry_form").parsley().reset();
		$("#enquiry_form")[0].reset();
		$("#enquiry_id").val(0);
		$("#enquiry_modal").modal('show');

		$("#enquiry_form").attr('action', base_url + 'enquiry_form/add_update_enquiry')
		$(".enquiry_modal_heading").html('ADD NEW ENQUIRY FORM');
		$("#enquiry_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE ACCOUNT ********
	*/
	$("#enquiry_action_btn").click(function () {
		var obj = $(this);

			if ($("#enquiry_form").parsley().validate()) {
				if($("#enquiry_item_list tbody tr").length > 0){
					var btn_text = $("#enquiry_action_btn").html();
					show_loading("#enquiry_action_btn", 'Loading..!');
					form_submit('enquiry_form', function (res) {
							if (res.status == 'success') {
								notify_alert('success', res.message, "Success");
								hide_loading("#enquiry_action_btn", btn_text);
								$("#enquiry_form").parsley().reset();
								$("#enquiry_form")[0].reset();
								$("#enquiry_modal").modal('hide');					
								reloadTable("#enquiry_list_dt_table");
							}
						}, function (res) {
							notify_alert('danger', res.message, "Error");
							hide_loading("#enquiry_action_btn", btn_text);
					});
				}else{
					notify_alert('error','Please Select Atleast one item','Error');
				}
			}
	});


	/* ADD ROW */

	var i = 1;
	$("#_item_list").on("change", function () {
		var item_id = $("#_item_list option:selected").val();
		var item_text = $("#_item_list option:selected").text();

		if(item_id){

			if($("#_itm_id_"+item_id).length == 0){
				var html = '<tr id="_itm_id_'+item_id+'">\
							<td style="vertical-align:middle">'+i+'</td>\
							<td style="vertical-align:middle">'+item_text+'<input type="hidden" name="item_ids[]" value="'+item_id+'"><input type="hidden" name="item_names[]" value="'+item_text+'"></td>\
							<td style="vertical-align:middle"><input type="text" class="form-control" name="item_quantity[]" placeholder="Enter Quantity" required></td>\
							<td style="vertical-align:middle"><button type="button" class="btn btn-danger m-btn--icon m-btn--icon-only m-btn--pill _remv_row">x</button></td></tr>';
				$("#enquiry_item_list tbody").append(html);
				i++;
			}else{
				notify_alert('error','Item already exist in list','Error');
			}

		}
	});
	

	$("#enquiry_item_list").on("click","._remv_row",function(){
		$(this).parents('tr').remove();
	});


	/*
	 ******** EDIT ENQUIRY ********
	*/
	$("#enquiry_list_dt_table").on("click", ".edit_enquiry", function (e) {
		var id = $(this).attr('data-enquiry-id');
		$("#enquiry_form").parsley().reset();
		call_service(base_url + 'enquiry_form/edit_enquiry/' + id,
			function (res) {
				if (res.status == 'success') {
					$("#enquiry_modal").modal('show');
					$("#enquiry_form").attr('action', base_url + 'enquiry_form/add_update_enquiry')
					$(".enquiry_modal_heading").html('EDIT ENQUIRY DETAIL');
					$("#enquiry_action_btn").html('<i class="fa fa-save"></i> Update');

					$("#enquiry_id").val(res.data[0].id);

					$("#enquiry_organization").val(res.data[0].organization);
					$("#enquiry_organization_short_name").val(res.data[0].organization_short_name);
					$("#enquiry_account_manager").val(res.data[0].account_manager);
					$("#enquiry_initiated_by").val(res.data[0].initiated_by);
					$("#enquiry_order_expected").val(res.data[0].order_expected);
					$("#enquiry_web_address").val(res.data[0].web_address);
					$("#enquiry_state").val(res.data[0].state);
					$("#enquiry_address").val(res.data[0].address);
					$("#enquiry_email").val(res.data[0].email);
					$("#enquiry_mobile").val(res.data[0].mobile);


					$("#enquiry_item_list tbody").html('');
					if(res.data[0].enquiry_items){
						var enq_items = jQuery.parseJSON(res.data[0].enquiry_items);
						var html = '';
						var count = 1;
						$.each(enq_items.items,function(i,v){
							 html += '<tr id="_itm_id_'+v.id+'">\
								<td style="vertical-align:middle">'+count+'</td>\
								<td style="vertical-align:middle">'+v.name+'<input type="hidden" name="item_ids[]" value="'+v.id+'"><input type="hidden" name="item_names[]" value="'+v.name+'"></td>\
								<td style="vertical-align:middle"><input type="text" class="form-control" name="item_quantity[]" placeholder="Enter Quantity" value="'+v.quantity+'" required></td>\
								<td style="vertical-align:middle"><button type="button" class="btn btn-danger m-btn--icon m-btn--icon-only m-btn--pill _remv_row">x</button></td></tr>';
							count++;
						});
						$("#enquiry_item_list tbody").append(html);
					}

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
	$("#enquiry_list_dt_table").on("click", ".delete_enquiry", function (e) {
		var id = $(this).attr('data-enquiry-id');
		if (confirm("Are you sure, You want to delete this Enquiry.?")) {
			call_service(base_url + "enquiry_form/delete_enquiry/" + id, function (response) {
				if (response.status == 'success') {
					notify_alert('success', response.message, "Success");
					reloadTable("#enquiry_list_dt_table");
				} else {
					notify_alert('danger', response.message, "Error");
				}
			}, function (response) {
				notify_alert('danger', response.message, "Error");
			});

		}
	});

	$(".multiple_enquiry_delete").on("click",function(){
		if ($(".enquirychkbx:checked").length > 0) {
	        if (confirm("Are you sure, You want to delete selected accounts?")) {
	            idArr = [];
	            $('.enquirychkbx').each(function (index, value) {
	                if (this.checked == true) {
	                    idArr.push(this.value);
	                }
	            });

	            call_service(base_url + "enquiry_form/multiple_delete_enquiry/?ids=" + idArr, function (response) {
	                if (response.status == 'success') {
	                    reloadTable("#enquiry_list_dt_table");
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
	        notify_alert('error', 'Please select at least one account.', 'Error');
	    }
	});

	

	/*$("#enquiry_list_dt_table").on("click", ".changestats", function (e) {
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
	*/

});

/*
 ****** CHECK ACCOUNT WITH SAME EMAIL AND NUMBER *******
*/

function checkDuplicate(obj,column)
{
	var id = $("#enquiry_id").val();
	var searchValue = $(obj).val();
	var data = {"id":id,"column":column,"value":searchValue};

	if(searchValue != '')
	{
		$(".checkduplicateaccount").html(' <i class="fa fa-spinner fa-spin"></i> Please wait checking account..');
		$.post(
				base_url+"account/checkDuplicate",
				data,
				function(response) {
    			if(response.status == 'success'){
    				$(".checkduplicateaccount").html('<i class="fa fa-check"></i> Account Verified!!');
    				$(".checkduplicateaccount").removeClass('text-danger');
    				$(".checkduplicateaccount").addClass('text-success');
    				$(".checkduplicateaccount").show().fadeOut(10000);
    			}
    			if(response.status == 'error'){
    				$(".checkduplicateaccount").html('<i class="fa fa-warning"></i>'+response.message);
    				$(".checkduplicateaccount").removeClass('text-success');
    				$(".checkduplicateaccount").addClass('text-danger');
    				$(".checkduplicateaccount").show().fadeOut(10000);
    				$(obj).val('').focus();
    			}
		}, 'JSON');
	}
}
