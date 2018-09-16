var form_obj = $('#user_form');
$(document).ready(function () {
    $(document).on("click", ".add_update_click", function () {
        var obj = $(this);
        var title = "";
        var button_title = "";
        var form_action = '';
        $("#user_role").val("");
        $(".user_role_group").hide();
        if (obj.attr('data-form_type') == "add") {
            title = "Add User";
            button_title = '<i class="fa fa-save"></i> Save';
            form_action = base_url + "users/save_update";
            getEmployeeCode();
            $("#profile_section_box").show();
            $("#email").attr('disabled', false);
            $("#username").attr('disabled', false);
            $("#changed_images").attr("src", DEFAULT_IMAGE);
            $(".deleteImage").hide();
            $("#password").attr('disabled', false).parents('div').show();;
            $("#is_active").prop("checked", true);
        } else if (obj.attr('data-form_type') == "edit") {
            title = "Edit User";
            button_title = '<i class="fa fa-save"></i> Update';
            form_action = base_url + "users/save_update/" + obj.attr('data-el_id');
            // $("#profile_section_box").hide();
            $("#email").attr('disabled', true);
            $("#username").attr('disabled', true);
            $("#password").attr('disabled', true).parent('div').hide();;
            $("#is_active").prop("checked", false);
        }
        form_obj.attr('action', form_action);
        $("#add_update_user_modal_label").html(title);
        $("#save_update_button_click").html(button_title);
        $("#add_update_user_modal").modal('show');
    });

    $(document).on("click", ".close_modal_common", function () {
        form_obj.parsley().reset();
        form_obj[0].reset();
        $("#user_id").val(0);
    });

    $(document).on("click", "#save_update_button_click", function () {
        var obj = $(this);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            show_loading('#save_update_button_click', 'Updating..!')
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

    $(document).on("click", "#user_role", function () {
        var obj = $(this);
        $(".user_role_group").hide();
        if (obj.val() == "4") {
            $("#team_lead_dropdown").show();
        } else if (obj.val() == "3") {
            $("#rm_dropdown").show();
        }
    });

}); // dom end 

function getEmployeeCode() {
    call_service(base_url + "users/get_employee_user_name/" + $("#logged_in_company_id").val(), function (res) {
        if (res['status'] == 'success') {
            var employee_code = res['data'];
            $("#username").val(employee_code);
        }
    }, function (res) {

    });
}

function getDetail(id) {
    $("#add_update_user_modal").modal('show');
    call_service(base_url + "users/get_details/" + id, function (res) {
        if (res['status'] == 'success') {
            var data_res = res['data'];
            var user_image = base_url + data_res.profile_pic;
            $("#designation").val(data_res.designation);
            $("#first_name").val(data_res.first_name);
            $("#last_name").val(data_res.last_name);
            $("#email").val(data_res.email);
            $("#username").val(data_res.username);
            $("#mobile").val(data_res.mobile_no);
            $("#contact_1").val(data_res.landline);
            $("#address").val(data_res.address);
            $("#dob").val(data_res.dob);
            $("#doj").val(data_res.doj);
            $("#changed_images").attr("src", user_image);
            if (user_image != DEFAULT_IMAGE) {
                $(".deleteImage").show();
            }
            $("#is_active").prop("checked", ((data_res.status == 1) ? true : false));
            $("#user_id").val(data_res.id);
            $("#user_role").val(data_res.user_role_id);
            if (data_res.user_role_id == "4") {
                $("#team_lead_dd").html(res['reports_to_list'])
                $("#team_lead_dropdown").show();
            } else if (data_res.user_role_id == "3") {
                $("#rm_dd").html(res['reports_to_list'])
                $("#rm_dropdown").show();
            }
        }
    }, function (res) {
    });
}

function delete_user(id) {
    if (confirm("Are you sure, You want to delete this user?")) {
        call_service(base_url + "users/delete_user/" + id, function (response) {
            if (response.status == 'success') {
                reloadTable('#user_list_dt_table');
                notify_alert('success', response.message, "Success")
            } else {
                notify_alert('danger', response.message, "Error");
            }
        }, function () {
            notify_alert('danger', response.message, "Error");
        });

    }
}
