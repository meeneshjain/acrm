$(document).ready(function () {
	// NOTE : target_user_role defined in target view
	if(target_user_role == 1)
	{
		rm_view();
	}
	if(target_user_role == 2)
	{
		tl_view();
	}
	if(target_user_role == 3)
	{
		user_view();
	}

	/*
	#########################################################################
	************************* CODE FOR REGIONAL MANAGER *********************
	#########################################################################
	*/

	// ADD TARGET FOR RM MODAL
	$(".target_view_data").on("click",".rm_trgt_modal_open_btn", function () {
		$("#rm_trgt_form").parsley().reset();
		$("#rm_trgt_form")[0].reset();
		$("#trgt_id").val(0);
		$("#trgt_user_id").val($(this).attr('data-user-id'));
		$("#rm_trgt_modal").modal('show');
		$("#trgt_type,#trgt_duration").removeAttr('disabled');

		$("#rm_trgt_form").attr('action', base_url + 'target/add_update_target')
		$(".rm_trgt_modal_heading").html('ADD NEW TARGET');
		$("#rm_trgt_action_btn").html('<i class="fa fa-save"></i> Save');
	});


	// SAVE / UPDATE TARGET FOR RM
	$(".target_view_data").on("click","#rm_trgt_action_btn",function () {
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
	$(".target_view_data").on("click",".rm_edit_trgt", function (e) {
		var id = $(this).attr('data-trgt-id');
		$("#rm_trgt_form").parsley().reset();
		call_service(base_url + 'target/edit_target/' + id,
			function (res) {
				if (res.status == 'success') 
				{
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
					$("#trgt_description").val(res.data[0].description);
				
					$("#trgt_type,#trgt_duration").attr('disabled','disabled');

					// IS used for check not less than assigned target
					$("#assigned_target").val(res.data[0].target-res.data[0].target_left);
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
	$(".target_view_data").on("blur","#trgt_target",function(){
		if($("#trgt_id").val() != 0)
		{
			var enter_val = parseFloat($(this).val());
			var assigned_target = parseFloat($("#assigned_target").val());
			var last_target = parseFloat($("#last_target").val());
			var type = $("#trgt_type").val();
			if(assigned_target != last_target)
			{
				if(enter_val < assigned_target)
				{
					notify_alert('danger','Already assigned '+assigned_target+' '+type+' so you can not assign less than '+assigned_target+' '+type,'Error');
					$("#trgt_target").val('');
				}
			}
		}
	});




	/******************************************************************
	####################### CODE FOR TEAM LEADER ######################
	*******************************************************************/

	// SAVE TARGET FOR TL
	$(".target_view_data").on("click",".trgt_assign_action_btn",function () {
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
	$(".target_view_data").on("click",".view_my_dl_user", function (e) {
		var user_id = $(this).attr('data-user-id');
		var user_role = $(this).attr('data-user-role');
		$("#downline_user_detail_modal").modal('show');
		$(".downline_user_detail_result").html('<i class="fa fa-spinner fa-spin"></i> Fetching Result....');
		$.get(base_url+"target/getMyDownlineUser/"+user_id+"/"+user_role,function(res,status){
			$(".downline_user_detail_result").html(res);
		});
	});


	$(".target_view_data").on('keyup','.target_amount',function(e){
		console.log('here');
		subTotal = 0;
		var total_target = $("#total_target_value").val();
		var target_type = $("#target_type").val();
		$('.target_amount').each(function(){
	    	if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	    });

	    if(parseFloat(total_target)<parseFloat(subTotal))
      	{
      		$(this).val('');
      		notify_alert('danger', 'Enter '+target_type+' exeed to sum of total '+target_type, "Error");
      	}		
	});
});

var DatatableHtmlTableDemo = {
    init: function() {
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



function rm_view()
{
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url+"target/getRegionalManager",function(res,status){
		$(".target_view_data").html(res);
		jQuery(document).ready(function() {
		    DatatableHtmlTableDemo.init()
		});
	});
}

function tl_view()
{
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url+"target/getTeamLeader",function(res,status){
		$(".target_view_data").html(res);
		jQuery(document).ready(function() {
		    DatatableHtmlTableDemo.init()
		});
	});
}

function user_view()
{
	$(".target_view_data").html('<i class="fa fa-spinner fa-spin"></i> Loading Data....');
	$.get(base_url+"target/getUsers",function(res,status){
		$(".target_view_data").html(res);
		jQuery(document).ready(function() {
		    DatatableHtmlTableDemo.init()
		});
	});
}