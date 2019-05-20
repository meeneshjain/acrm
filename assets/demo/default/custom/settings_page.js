$(document).ready(function (event) {

    $("#edit_sale_stages").on("submit", function (event) {
        event.preventDefault();
        var obj = $(this);
        if (obj.parsley().validate()) {
            show_loading('#update_note_btn', 'Updating..!')
            form_submit(obj.attr("id"),
                function (res) {
                    notify_alert(res.status, res.message)

                    setTimeout(function () {
                        hide_loading('#update_note_btn', '<i class="fa fa-check"></i> Update');
                        $("#sale_Stages_modal").modal('hide');
                    }, 1000);
                }, function (res) {
                    hide_loading('#update_note_btn', '<i class="fa fa-check"></i> Update');
                    notify_alert(res.status, res.message)
                });
        }
    });

    $(".get_uom_list").on("click", function (event) {
        event.preventDefault();
        var obj = $(this);
        $(".uom_loader").show();
        //uom_data_grid
        call_service(base_url + "settings/get_uom_list/", function (res) {
            if (res.data != "" && res.data != 0) {
                var output = '';
                if (res.data.length > 0) {
                    for (let i = 0; i < res.data.length; i++) {
                        var uom_data = res.data[i];
                        output += '<div class="form-group m-form__group row uom_data" data-block="' + i + '" data-is_saved="1">\
                            <div class="col-lg-2" >\
                                <label>\
                                    '+ uom_data['id'] + '\
                            </label>\
                            <input type="hidden" id="uom_input_id_'+ i + '" name="uom[' + i + '][id]" value="' + uom_data['id'] + '" class="form-control m-input" placeholder="name">\
                        </div>\
                        <div class="col-lg-4">\
                            <input type="text"  id="uom_input_code_'+ i + '" required name="uom[' + i + '][code]" value="' + uom_data['code'] + '" class="form-control m-input" placeholder="code">\
                        </div>\
                        <div class="col-lg-4">\
                            <input type="text" id="uom_input_name_'+ i + '" required name="uom[' + i + '][name]" value="' + uom_data['name'] + '" class="form-control m-input" placeholder="name">\
                        </div>\
                        <div class="col-lg-2">\
                            <a href = "javascript:;" class="btn btn-danger btn-sm remove_current_uom"  data-uom_id="'+ uom_data['id'] + '"  > <i class="fa fa-times"></i></a >\
                        </div >\
                       </div>';
                        $(".service_block_data").html(output);
                    }
                }
            }
            $(".uom_loader").hide();
        }, function () {
            $(".uom_loader").show();
        });
    });

    $(document).on("click", ".add_more_uom", function (event) {
        var box_count = $(".uom_data").length;
        box_count++;
        var output = '<div class="form-group m-form__group row uom_data" data-block="' + box_count + '" data-is_saved="0">\
        <div class="col-lg-2" >\
        <label> '+ box_count + '</label>\
            </div >\
        <div class="col-lg-4">\
            <input type="text"  id="uom_input_code_'+ box_count + '" required name="uom[' + box_count + '][code]" value="" class="form-control m-input" placeholder="code">\
        </div>\
        <div class="col-lg-4">\
            <input type="text" id="uom_input_name_'+ box_count + '" required name="uom[' + box_count + '][name]" value="" class="form-control m-input" placeholder="name">\
        </div>\
        <div class="col-lg-2">\
            <a href = "javascript:;" class="btn btn-danger btn-sm remove_current_uom"> <i class="fa fa-times"></i></a >\
        </div >\
        </div>';
        $(".service_block_data").append(output);
    });

    $(document).on("click", ".remove_current_uom", function (event) {
        var obj = $(this);
        if (obj.parents(".uom_data").attr('data-is_saved') == 1) {
            if (confirm("Are you sure, you want to remove this UOM?")) {
                var uom_id = obj.attr('data-uom_id');
                call_service(base_url + "settings/delete_uom/" + uom_id, function (res) {
                    if (res.status == 'success') {

                        obj.parents(".uom_data").slideUp(function () {
                            notify_alert(res.status, res.message);
                            $(this).remove();
                        });
                    } else {
                        notify_alert('danger', 'There was some error, please try again.', "Error");

                    }
                });
            }
        } else {
            obj.parents(".uom_data").slideUp(function () {
                $(this).remove();
            });
        }
    });

    $(document).on("submit", "#add_edit_uom", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_uom_btn';
        var obj = $(btn_id);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            show_loading(btn_id, 'Updating..!')
            form_submit(form_obj.attr("id"), function (res) {
                notify_alert(res.status, res.message);
                setTimeout(function () {
                    hide_loading(btn_id, btn_text);
                    form_obj.parsley().reset();
                    form_obj[0].reset();
                    $('#uom_modal').modal('hide');
                    window.location.reload();
                }, 1000);
            }, function (res) {
                hide_loading(btn_id, btn_text);
                //     notify_alert(res.status, res.message, 'Error');
            });
        }
    });

    $(document).on("click", ".close_template_button", function () {
        template_loader();
    });


    $(document).on("click", ".fetch_email_temples", function () {
        template_loader();
        call_service(base_url + "settings/get_email_template_list/", function (res) {
            if (res['status'] == 'success') {
                var out = '<option value=""> Select a template</option>\n';
                out = out + res['data'];
                setTimeout(function () {
                    $("#email_template_chooser").html(out);
                    $(".template_loader").hide();
                    $(".loadded_data_section").show();
                }, 350);
            }
        }, function (res) {
        });
    });

    $(document).on("change", "#email_template_chooser", function () {
        var obj = $(this);
        $('.email_template_block').hide();
        if (obj.val() != "") {
            call_service(base_url + "settings/get_email_template_content/" + obj.val(), function (res) {
                if (res['status'] == 'success') {
                    $('.email_template_block').show();
                    $("#template_subject").val(res['data']['subject']);
                    console.log(res['data']['body']);
                    $(".email_editor").summernote('code', res['data']['body']);
                }
            }, function (res) {
            });
        }
    });


    $(document).on("submit", "#email_template_update_form", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_email_template_button';
        var obj = $(btn_id);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            show_loading(btn_id, 'Updating..!');
            $.ajax({
                url: form_obj.attr("action"),
                data: {
                    "template_key": $("#email_template_chooser").val(),
                    "subject": $("#template_subject").val(),
                    // "body": $(".email_editor").val(),
                    "body": $('.email_editor').summernote('code')
                },
                type: 'POST',
                dataType: "JSON",
                success: function (res) {
                    notify_alert(res.status, res.message);
                    setTimeout(function () {
                        hide_loading(btn_id, btn_text);
                        form_obj.parsley().reset();
                        form_obj[0].reset();
                        $('#email_template_modal').modal('hide');
                    }, 1000);
                },
                error: function (response) {
                    hide_loading(btn_id, btn_text);

                    notify_alert('danger', 'There was some error, Please try again.', "Error");
                }
            });
        }
    });

    $(document).on("click", ".email_constants_toggle", function (event) {
        $(".email_contstans").slideToggle();
    });

    $(document).on("click", ".get_general_settings", function () {
        var obj = $(this);
        $(".general_setting_block").addClass('display_none');
        $(".general_setting_loader").removeClass('display_none');
        call_service(base_url + "settings/get_general_setting_details/", function (res) {
            if (res['status'] == 'success') {
                var general_data = res.data;

                $("#default_currency").val(general_data.default_currency);
                $("#account_name").val(general_data.system_email);
                $("#is_sap_connected").val(general_data.is_sap_connected);
                $("#sap_connection_parameter_url").val(general_data.sap_connection_parameter_url);
                $("#sap_password").val(general_data.sap_password);
                $("#sap_sales_order_url").val(general_data.sap_sales_order_url);
                $("#sap_sales_quote_url").val(general_data.sap_sales_quote_url);
                $("#sap_username").val(general_data.sap_username);
                $("#sql_password").val(general_data.sql_password);
                $("#sql_server_name").val(general_data.sql_server_name);
                $("#sql_server_type").val(general_data.sql_server_type);
                $("#sql_username").val(general_data.sql_username);
                if (general_data.is_sap_connected == 0) {
                    $(".is_sap_configured").addClass('display_none');
                } else if (general_data.is_sap_connected == 1) {
                    $(".is_sap_configured").removeClass('display_none');
                }

                var theme_array = JSON.parse(general_data.available_theme);
                var theme_block_html = '';
                for (var index = 0; index < theme_array.length; index++) {
                    var current_theme = theme_array[index];
                    theme_block_html += '<div class="col-lg-3">\
                        <img src="'+ base_url + '/assets/demo/default/custom/themes/preview/' + current_theme['name'] + '.PNG"  alt = "' + current_theme['title'] + '" class="img img-thumbnail " >\
                            <p class="text-center">\
                                <input type="radio" id="theme_'+ current_theme['name'] + '" value="' + current_theme['name'] + '" name="default_theme" class="m-input" placeholder="' + current_theme['title'] + ' ">\
                                    <label class="col-form-label" for="theme_'+ current_theme['name'] + '">' + current_theme['title'] + ' </label>\
                                </p> \
                            </div>';
                }
                $(".all_theme_block").html(theme_block_html);
                setTimeout(function () {
                    $('[value="' + general_data.default_theme + '"]').prop('checked', true);
                }, 500);
                $(".general_setting_block").removeClass('display_none');
                $(".general_setting_loader").addClass('display_none');
            }
        }, function (res) {
        });
    });


    $(document).on("submit", "#general_setting_form", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_user_btn';
        var obj = $(btn_id);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            show_loading(btn_id, 'Updating..!')
            form_submit(form_obj.attr("id"), function (res) {
                notify_alert(res.status, res.message);
                setTimeout(function () {
                    hide_loading(btn_id, btn_text);
                    form_obj.parsley().reset();
                    form_obj[0].reset();
                    $('#general_setting_model').modal('hide');
                    window.location.reload();
                }, 1000);
            }, function (res) {
                hide_loading(btn_id, btn_text);
                //     notify_alert(res.status, res.message, 'Error');
            });
        }
    });

    $(document).on("change", ".db_parent_check", function () {
        var data_section = $(this).attr('data-section');
        if ($(this).is(":checked")) {
            $('.child_check[data-section="' + data_section + '"]').prop('checked', true);
        } else {
            $('.child_check[data-section="' + data_section + '"]').prop('checked', false);
        }
    });


    $(document).on("click", ".get_smtp_settings", function () {
        var obj = $(this);
        $(".smtp_setting_loader").removeClass('display_none');
        $(".smtp_setting_block").addClass('display_none');
        call_service(base_url + "settings/get_company_smtp_detail/", function (res) {
            if (res['status'] == 'success') {
                var smtp_detail = res.data;
                $("#smtp_host").val(smtp_detail.host);
                $("#smtp_port").val(smtp_detail.port);
                $("#smtp_from_name").val(smtp_detail.from_name);
                $("#smtp_from_email").val(smtp_detail.from_email);
                $("#smtp_from_password").val(smtp_detail.from_password);
                if (smtp_detail.is_configured == 1) {
                    $("#is_smtp_configured").prop("checked", true);
                } else {
                    $("#is_smtp_configured").prop("checked", false);
                }
                $(".smtp_setting_block").removeClass('display_none');
                $(".smtp_setting_loader").addClass('display_none');
            } else {
                $(".smtp_setting_loader").addClass('display_none');
                notify_alert('danger', res.message, "Error");
            }
        }, function (res) {
        });
    });

    $(document).on("click", "#send_test_mail", function () {
        var btn_test = $(this).html();
        if ($("#test_mail_id").val() != "") {
            show_loading("#send_test_mail", 'Sending..!')
            $.ajax({
                type: "POST",
                url: base_url + 'settings/send_test_mail',
                data: {
                    "host": $("#smtp_host").val(),
                    "port": $("#smtp_port").val(),
                    "from_name": $("#smtp_from_name").val(),
                    "from_email": $("#smtp_from_email").val(),
                    "from_password": $("#smtp_from_password").val(),
                    "mail_id": $("#test_mail_id").val()
                },
                dataType: "JSON",
                success: function (res) {
                    console.log(res);
                    if (res.status == "success") {
                        notify_alert('success', res.message, "Success")
                    } else {
                        notify_alert('danger', res.message, "Error")
                    }
                    hide_loading("#send_test_mail", btn_test)
                },
                error: function (res) {
                    notify_alert('danger', 'There was some error, Please try again.', "Error")
                }
            });
        } else {
            notify_alert("danger", "Enter a test mail Id", 'Error');
        }

    });

    $(document).on("submit", "#company_smtp_form", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_smtp_detail_btn';
        var obj = $(btn_id);
        btn_text = obj.html();
        show_loading(btn_id, 'Updating..!')
        form_submit(form_obj.attr("id"), function (res) {
            notify_alert(res.status, res.message);
            setTimeout(function () {
                hide_loading(btn_id, btn_text);
                form_obj.parsley().reset();
                form_obj[0].reset();
                $('#smtp_settings_modal').modal('hide');
                /* setTimeout(function () {
                    window.location.reload();
                }, 150); */
            }, 1000);
        }, function (res) {
            hide_loading(btn_id, btn_text);
            //     notify_alert(res.status, res.message, 'Error');
        });
    });

    $(document).on("click", ".edit_user_role_popup", function () {
        var obj = $(this);
        var edit_rid = obj.attr("data-role_id");
        var edit_name = obj.attr("data-role_name");
        $(".permission_loader").show();
        $("#add_edit_permission").find("ul.parsley-errors-list").remove();
        $("#edit_permission_current_role_id").val(edit_rid);
        $("#edit_permission_current_role_name").val(edit_name);
        $(".permission_name_modal").html(edit_name);
        $("input[name='perm[]']").prop("checked", false);
        call_service(base_url + "settings/get_company_urole_permission/" + edit_rid, function (res) {
            if (res['status'] == 'success') {
                if (res.data != "") {
                    var permission_data = res.data.split(",");
                    if (permission_data.length > 0) {
                        for (var pi = 0; pi < permission_data.length; pi++) {
                            var current_permission = permission_data[pi];
                            $("input[name='perm[]'][value='" + current_permission + "']").prop("checked", true);
                        }
                    }
                    $(".permission_loader").hide();
                    $(".loaded_permision_container").show();
                }
            } else {
                $(".permission_loader").hide();
                notify_alert('danger', res.message, "Error");
            }
        });
    });

    $(document).on("submit", "#add_edit_permission", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_uuser_role_btn';
        var obj = $(btn_id);
        btn_text = obj.html();
        obj.find("ul.parsley-errors-list").remove();
        show_loading(btn_id, 'Updating..!')
        form_submit(form_obj.attr("id"), function (res) {
            notify_alert(res.status, res.message);
            setTimeout(function () {
                hide_loading(btn_id, btn_text);
                form_obj.parsley().reset();
                form_obj[0].reset();
                $('#user_role_modal').modal('hide');
                setTimeout(function () {
                    window.location.reload();
                }, 150);
            }, 1000);
        }, function (res) {
            hide_loading(btn_id, btn_text);
            //     notify_alert(res.status, res.message, 'Error');
        });
    });



    $(document).on("click", ".edit_service_call_options", function () {
        var obj = $(this);
        var edit_key = obj.attr("data-json_option_key");
        var edit_name = obj.attr("data-json_option_name");
        $(".service_call_option_data_grid").hide();
        $(".service_call_option_loader").show();
        $(".service_call_option_modal_heading").html(edit_name);
        $("#service_call_option_form").attr("action", base_url + 'settings/save_update_service_call_option/' + edit_key);
        call_service(base_url + "settings/get_service_call_option_data/" + edit_key, function (res) {
            if (res['status'] == 'success') {
                console.log("res.data");
                console.log(res.data);
                var html = '';
                var sc_count = 1;
                for (var sci = 0; sci < res.data.length; sci++) {
                    var current_option = res.data[sci];
                    html += '<div class="form-group m-form__group row service_call_option_data" data-block="1" data-is_saved="1">\
                    <div class="col-lg-2" >\
                        <label>'+ sc_count + '</label>\</div>\
                    <div class="col-lg-4">\
                        <input type="text" id="service_call_option_input_code_1" required value="'+ current_option.id + '" name="service_call_option[' + sci + '][id]" class="form-control m-input" required placeholder="code"></div>\
                        <div class="col-lg-4"> <input type="text" id="service_call_option_input_name_1" required name="service_call_option['+ sci + '][value]" value="' + current_option.value + '" class="form-control m-input" required placeholder="name"> </div>\
                            <div class="col-lg-2"> <a href="javascript:;" class="btn btn-danger btn-sm remove_current_service_call_option"><i class="fa fa-times"></i></a> </div>\
                    </div>';
                    sc_count++;
                }
                $(".service_call_block_data").html(html);
                /* 
                
                    */

                $(".service_call_option_loader").hide();
                $(".service_call_option_data_grid").show();
            } else {
                $(".service_call_option_loader").hide();
                notify_alert('danger', res.message, "Error");
            }
        });
    });


    $(document).on("click", ".add_more_service_call_option", function (event) {
        var box_count = $(".service_call_option_data").length;
        var output = '<div class="form-group m-form__group row service_call_option_data" data-block="1" data-is_saved="1">\
        <div class="col-lg-2" >\
            <label>'+ box_count + '</label>\</div>\
        <div class="col-lg-4">\
            <input type="text" id="service_call_option_input_code_1" required value="" name="service_call_option[' + box_count + '][id]" class="form-control m-input" required placeholder="code"></div>\
            <div class="col-lg-4"> <input type="text" id="service_call_option_input_name_1" required name="service_call_option['+ box_count + '][value]" value="" class="form-control m-input" required placeholder="name"> </div>\
                <div class="col-lg-2"> <a href="javascript:;" class="btn btn-danger btn-sm remove_current_service_call_option"><i class="fa fa-times"></i></a> </div>\
        </div>';
        $(".service_call_block_data").append(output);
        box_count++;
    });

    $(document).on("click", ".remove_current_service_call_option", function (event) {
        $(this).parents(".service_call_option_data").remove();
    });


    $(document).on("submit", "#service_call_option_form", function (event) {
        event.preventDefault();
        var form_obj = $(this);
        var btn_id = '#update_service_call_option_btn';
        var obj = $(btn_id);
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
            show_loading(btn_id, 'Updating..!')
            form_submit(form_obj.attr("id"), function (res) {
                notify_alert(res.status, res.message);
                setTimeout(function () {
                    hide_loading(btn_id, btn_text);
                    form_obj.parsley().reset();
                    form_obj[0].reset();
                    $('#service_call_modal').modal('hide');
                    //     window.location.reload();
                }, 1000);
            }, function (res) {
                hide_loading(btn_id, btn_text);
                //     notify_alert(res.status, res.message, 'Error');
            });
        }
    });

    $(document).on("change", "#is_sap_connected", function () {
        var g_obj = $(this);
        if (g_obj.val() == 1) {
            $(".is_sap_configured").removeClass("display_none");
        } else if (g_obj.val() == 0) {
            $(".is_sap_configured").addClass("display_none");
        }
    });

    $(document).on("click", ".import_data_click", function () {
        var obj = $(this);
        var button_title = '<i class="fa fa-save"></i> Import';
        var form_action = base_url + "settings/import_data";
        call_service(base_url + "settings/get_current_company_details/", function (res) {
            //var import_key = obj.data("import_key");
            var import_label = obj.data("import_label");
            $("#import_data_option_form").attr('action', form_action);
            $("#import_data_option_lable").html(import_label);
            $("#update_import_data_option_btn").html(button_title);
            $("#import_data_modal").modal('show');
            if (res.status == 'success') {
                if ($("#current_logged_id").val() == "0") {
                   //   $("#current_company_loggedin").val(res.data.company_name);
                } else {
                    $("#current_company_loggedin").val(res.data.company_name);
                }
            }
        });
    });

}); // dom end 

function template_loader() {
    $(".email_template_block").hide();
    $(".template_loader").show();
    $(".loadded_data_section").hide();
    $("#template_subject").val("");
    $('.email_editor').summernote();
    $(".email_contstans").hide();

}