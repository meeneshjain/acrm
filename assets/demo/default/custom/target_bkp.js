$(document).ready(function () {

	/*
	 ******** ADD TARGET ********
	*/
	$(".trgt_modal_open_btn").on("click", function () {
		$("#trgt_form").parsley().reset();
		$("#trgt_form")[0].reset();
		$("#trgt_id").val(0);
		$("#trgt_user_id").val($(this).attr('data-user-id'));
		$("#trgt_modal").modal('show');
		$('#trgt_type').trigger('change');
		$("#trgt_account").removeAttr('disabled');

		$("#trgt_form").attr('action', base_url + 'target/add_update_target')
		$(".trgt_modal_heading").html('ADD NEW TARGET');
		$("#trgt_action_btn").html('<i class="fa fa-save"></i> Save');
	});

	/*
	 ******** SAVE / UPDATE TARGET FOR RM ********
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
					window.location.reload();				
					reloadTable("#trgt_list_dt_table");
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#trgt_action_btn", btn_text);
			});
		}
	});

	/*
	 ******** SAVE / UPDATE TARGET FOR TEAM ********
	*/
	$(".trgt_assign_action_btn").click(function () {
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
					window.location.reload();				
				}
			}, function (res) {
				notify_alert('danger', res.message, "Error");
				hide_loading("#trgt_assign_action_btn", btn_text);
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
	$(".edit_trgt").on("click", function (e) {
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
					$("#trgt_user_id").val(res.data[0].assign_to_user_id);

					$("#trgt_name").val(res.data[0].target_title);
					$("#trgt_duration").val(res.data[0].target_duration_id);
					$("#trgt_type").val(res.data[0].target_type);

					if(res.data[0].amount != 0)
					{
						alert('here');
						$('#trgt_amount').val(res.data[0].amount);
						$('#trgt_type_amount').show();
						$('#trgt_type_product').hide();
						$('#trgt_product').val('');
					}
					if(res.data[0].product != 0)
					{
						alert('here product');
						$('#trgt_product').val(res.data[0].product);
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


	$(".target_amount").on('keyup',function(e){
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
            columns: [{
                field: "Deposit Paid",
                type: "number"
            }, {
                field: "Order Date",
                type: "date",
                format: "YYYY-MM-DD"
            }, {
                field: "Status",
                title: "Status",
                template: function(e) {
                    var t = {
                        1: {
                            title: "Pending",
                            class: "m-badge--brand"
                        },
                        2: {
                            title: "Delivered",
                            class: " m-badge--metal"
                        },
                        3: {
                            title: "Canceled",
                            class: " m-badge--primary"
                        },
                        4: {
                            title: "Success",
                            class: " m-badge--success"
                        },
                        5: {
                            title: "Info",
                            class: " m-badge--info"
                        },
                        6: {
                            title: "Danger",
                            class: " m-badge--danger"
                        },
                        7: {
                            title: "Warning",
                            class: " m-badge--warning"
                        }
                    };
                    return '<span class="m-badge ' + t[e.Status].class + ' m-badge--wide">' + t[e.Status].title + "</span>"
                }
            }, {
                field: "Type",
                title: "Type",
                template: function(e) {
                    var t = {
                        1: {
                            title: "Online",
                            state: "danger"
                        },
                        2: {
                            title: "Retail",
                            state: "primary"
                        },
                        3: {
                            title: "Direct",
                            state: "accent"
                        }
                    };
                    return '<span class="m-badge m-badge--' + t[e.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + t[e.Type].state + '">' + t[e.Type].title + "</span>"
                }
            }]
        }), $("#m_form_status").on("change", function() {
            e.search($(this).val().toLowerCase(), "Status")
        }), $("#m_form_type").on("change", function() {
            e.search($(this).val().toLowerCase(), "Type")
        }), $("#m_form_status, #m_form_type").selectpicker()
    }
};

jQuery(document).ready(function() {
    DatatableHtmlTableDemo.init()
});


function rm_view()
{
	$.get(base_url+"target/");
}