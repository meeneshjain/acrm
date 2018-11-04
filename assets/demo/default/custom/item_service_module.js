var form_obj = $('#item_service_form_obj');
var duplicate_error = 0;
$(document).ready(function () {
    $(document).on("click", ".add_update_click", function () {
        var obj = $(this);
        var title = "";
        var button_title = "";
        var form_action = '';
        var form_name = $("#form_name").val();
        free_service_list();
        // $("#serviec_status").html(status_option);
        if (form_name == "service_contract") {
            $(".service_call_block").addClass('display_none');
            $(".contract_block").removeClass('display_none');

        } else if (form_name == "service_call") {
            $(".service_call_block").removeClass('display_none');
            $(".contract_block").addClass('display_none');
        }

        if (obj.attr('data-form_type') == "add") {
            $("#serial_number").attr('readonly', false);
            title = "Add " + $("#sales_form_title").val();
            button_title = '<i class="fa fa-save"></i> Save';
            form_action = base_url + "items/save_update_contract/" + form_name;
            get_new_contract_call_details($("#logged_in_company_id").val(), ($("#form_name").val()));
            setTimeout(function () {
                $("#serviec_status").val('draft');
                $('#free_services').val('0');

            }, 500);
            $("#service_contract_id").attr("disabled", false);
        } else if (obj.attr('data-form_type') == "edit") {
            $("#serial_number").attr('readonly', true);
            title = "Edit " + $("#sales_form_title").val();
            button_title = '<i class="fa fa-save"></i> Update';
            form_action = base_url + "items/save_update_contract/" + form_name + '/' + obj.attr('data-service-id');
        }
        form_obj.attr('action', form_action);
        $("#add_update_service_modal_label").html(title);
        $("#save_update_button_click").html(button_title);
        $("#add_update_service_modal").modal('show');
    });

    $(document).on("click", ".close_modal_common", function () {
        form_obj.parsley().reset();
        form_obj[0].reset();
        $("#item_service_id").val(0);
    });

    $(document).on("change", "#account_code", function () {
        var obj = $(this);
        $("#contact_no").val("");
        $("#account_name").val("");
        if (obj.val() != "") {
            call_service(base_url + "sales/get_account_contacts/" + obj.val(), function (res) {
                if (res['status'] == 'success') {
                    var out = '<option value="">Select Contact Person</option>\n';
                    for (var aci = 0; aci < res['contact_list'].length; aci++) {
                        out += '<option value="' + res['contact_list'][aci]['id'] + '" data-contact_number="' + res['contact_list'][aci]['contact_number'] + '" data-contact_name="' + res['contact_list'][aci]['full_name'] + '">' + res['contact_list'][aci]['full_name'] + '</option>\n';
                    }
                    $("#contact_person").html(out);
                }
            }, function (res) {
            });
            $("#account_name").val(obj.find('option:selected').attr('data-account_name'));
        } else {
            $("#contact_person").html('<option value="">Select Contact Person</option>\n');
        }
    });

    $(document).on("change", "#item_code", function () {
        var obj = $(this);
        var item_name = obj.find('option:selected').attr('data-item_name');
        var item_code = obj.find('option:selected').attr('data-item_code');
        var tax = obj.find('option:selected').attr('data-tax');
        $('#item_name').val(item_name);
    });

    $(document).on("change", "#contact_person", function () {
        var obj = $(this);
        $("#contact_no").val("");
        if (obj.val() != "") {
            $("#contact_no").val($("#contact_person").find('option:selected').attr('data-contact_number'));
            $("#contact_person_name").val($("#contact_person").find('option:selected').attr('data-contact_name'));
        }
    });

    $(document).on("change", "#serial_number", function () {
        var obj = $(this);
        if (obj.val() != "") {
            call_service(base_url + "items/validate_serial_number/" + obj.val(), function (res) {
                if (res['status'] == 'success') {
                    if (res['is_exists'] == 0 || res['is_exists'] == '0') {
                        duplicate_error = 0;
                        $(".show_serail_duplicate_error").addClass('display_none');
                    } else if (res['is_exists'] == 1 || res['is_exists'] == '1') {
                        duplicate_error = 1;
                        $(".show_serail_duplicate_error").removeClass('display_none');
                    }
                }
            }, function (res) {
            });
        }
    });


    $(document).on("click", "#save_update_button_click", function () {
        var obj = $(this);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            if (duplicate_error == 1) {
                notify_alert('danger', 'This Serial Number already exists, please change the serial number.', "Error");
                return false;
            }
            show_loading('#save_update_button_click', 'Saving..!')
            form_submit(form_obj.attr("id"), function (res) {
                notify_alert(res.status, res.message);
                reloadTable('#user_list_dt_table');
                setTimeout(function () {
                    hide_loading('#save_update_button_click', btn_text);
                    $(".close_modal_common").trigger('click');
                }, 1000);
            }, function (res) {
                hide_loading('#save_update_button_click', btn_text);
                //     notify_alert(res.status, res.message, 'Error');
            });
        }
    });

    $(document).on("click", ".edit_item", function () {
        var obj = $(this);
        call_service(base_url + "items/get_service_details/" + obj.attr('data-service_type') + '/' + obj.attr('data-service-id'), function (res) {
            if (res['status'] == 'success') {
                var header_data = res.item_service_data;
                fill_up_drop_down_data(res);
                $("#account_code").val(header_data.account_id);
                setTimeout(function () {
                    $("#account_code").trigger('change');
                    setTimeout(function () {
                        $("#contact_person").val(header_data.contact_person_id);
                        $("#contact_person").trigger('change');
                    }, 1000);
                }, 500);
                // contract details  - start
                $("#item_code").val(header_data.item_id);
                $("#item_code").trigger('change');
                $("#resolution_time_type").val(header_data.resolution_duration_type);
                $("#resolution_time").val(header_data.resolution_time);
                $("#response_time_type").val(header_data.response_duration_type);
                $("#reponse_time").val(header_data.response_time);
                $("#serial_number").val(header_data.serial_number);
                $("#serviec_status").val(header_data.stage);
                $("#free_services").val(header_data.free_services);
                $("#start_date").val(header_data.start_date);
                $("#end_date").val(header_data.end_date);
                $("#remark").val(header_data.remark);
                $("#sales_employee_name").val(header_data.sales_employee);
                $("#sales_employee_id").val(header_data.sales_employee_id);
                // contract details  - end

                // call details  - start
                $("#priority").val(header_data.priority);
                $("#problem_origin").val(header_data.problem_origin);
                $("#problem_type").val(header_data.problem_type);
                $("#problem_subtype").val(header_data.problem_subtype);
                $("#call_subject").val(header_data.subject);
                $("#call_description").val(header_data.description);
                $("#technician").val(header_data.technician);
                $("#given_by").val(header_data.given_by);
                $("#given_to").val(header_data.given_to);
                $("#call_type").val(header_data.call_type);
                $("#call_status").val(header_data.call_status);
                setTimeout(function () {
                    $("#call_status").trigger('change');
                }, 500);
                $("#planned_date").val(header_data.planned_call_date);
                $("#tentative_date").val(header_data.tentative_call_date);
                $("#approved_date").val(header_data.approved_call_date);
                $("#rejected_date").val(header_data.rejected_call_date);
                if (header_data.item_service_contract_id !== undefined && header_data.item_service_contract_id != "") {
                    $("#service_contract_id").val(header_data.item_service_contract_id);
                    setTimeout(function () {
                        $("#service_contract_id").trigger('change');
                        $("#service_contract_id").attr("disabled", true);
                    }, 500);
                }
                $("#job_description").val(header_data.job_description);
                // call details  - end

                $("#add_update_service_modal").modal('show');
            }
        }, function (res) {
        });
    });


    $(document).on("click", ".delete_service", function () {
        var obj = $(this);
        if (confirm("Are you sure, You want to delete this.?")) {
            call_service(base_url + "items/delete_service_contract_call/" + obj.attr('data-service_type') + '/' + obj.attr('data-service-id'), function (res) {
                if (res['status'] == 'success') {
                    reloadTable('#user_list_dt_table');
                    notify_alert('success', res.message, "Success");
                } else {
                    notify_alert('danger', res.message, "Error");
                }
            }, function (res) {
            });
        }
    });

    $(document).on("click", "#call_status", function () {
        var obj = $(this);
        if (obj.val() != "") {
            $(".call_status_label").find('label').addClass('display_none');
            $(".status_call_input_date").find('input').addClass('display_none');
            $(".call_status_block").removeClass('display_none');
            var block_class = obj.val() + '_call_date';
            $("." + block_class).removeClass('display_none');
        } else {
            $(".call_status_block").addClass('display_none');
        }
    });

    $(document).on("click", "#service_contract_id", function () {
        var obj = $(this);
        if (obj.val() != "") {
            $("#serial_number").val(obj.find("option:selected").html());
        } else {
            $("#serial_number").val("");
        }
    });





}); // document end 


function get_new_contract_call_details(company_id, form_type) {
    call_service(base_url + "items/get_new_contract_call_details/" + company_id + '/' + form_type, function (res) {
        if (res['status'] == 'success') {
            fill_up_drop_down_data(res);
        }
    }, function (res) { // error callback if required
    });
}

function fill_up_drop_down_data(res) {
    generate_account_list(res['account_list'], "");
    generate_item_list(res['item_list'], "");
    $("#serviec_status").html(res['service_stage'])
    $("#priority").html(res['priority_list'])
    $("#priority").val('low');
    $("#call_status").html(res['call_status_option'])
    $("#call_status").val('planned');
    $("#problem_origin").html(res['problem_origin_options'])
    $("#problem_type").html(res['problem_type_options']);
    $("#problem_subtype").html(res['problem_subtype_options']);
    $("#call_type").html(res['call_type_options']);
    if (res['service_serial_list'] !== undefined && res['service_serial_list'] != "") {
        $("#service_contract_id").html(res['service_serial_list']);
    }
}

function generate_account_list(account_list_array, selected_account) {
    var out = '<option value="">Account Code</option>\n';
    for (var aci = 0; aci < account_list_array.length; aci++) {
        var selected = "";
        if (selected_account != "" && selected_account != undefined) {
            if (selected_account == account_list_array[aci]['id']) {
                selected = "selected";
            }
        }
        out += '<option value="' + account_list_array[aci]['id'] + '" data-account_name="' + account_list_array[aci]['name'] + '" ' + selected + '>' + account_list_array[aci]['account_number'] + '</option>\n';
    }
    $("#account_code").html(out);
}

function generate_item_list(item_list, selected_item) {
    var item_options = '<option value="">Item Code</option>\n';
    for (var ici = 0; ici < item_list.length; ici++) {
        var selected = "";
        if (selected_item != "" && selected_item != undefined) {
            if (selected_item == item_list[ici]['id']) {
                selected = "selected";
            }
        }
        item_options += '<option value="' + item_list[ici]['id'] + '" data-item_name="' + item_list[ici]['name'] + '" data-pice_list="' + item_list[ici]['price_list'] + '" data-tax="' + item_list[ici]['tax'] + '" data-item_code="' + item_list[ici]['code'] + '" ' + selected + '>' + item_list[ici]['code'] + '</option>\n';
    }
    $("#item_code").html(item_options);
}

function free_service_list() {
    var free_options = '<option value="">Free Services</option>\n';
    for (var fsi = 0; fsi <= 30; fsi++) {
        free_options += '<option value="' + fsi + '">' + fsi + '</option>';
    }

    $('#free_services').html(free_options);
}

