
$(document).ready(function () {
    $(document).on("click", ".add_update_click", function () {
        var obj = $(this);
        var title = "";
        var button_title = "";
        var form_action = '';
        if (obj.attr('data-form_type') == "add") {
            title = "ADD COMPANY DETAIL";
            button_title = '<i class="fa fa-save"></i> Save';
            form_action = base_url + "company/save_update";
            $(".manager_section_block").show();
            $("#comp_prefix").removeAttr('disabled');

            $(".company_logo_src").attr('src',base_url+'assets/images/no.jpg');
            $(".company_logo_src_value").val('assets/images/no.jpg');
            $(".deleteImage").hide();

        } else if (obj.attr('data-form_type') == "edit") {
            title = "EDIT COMPANY DETAIL";
            button_title = '<i class="fa fa-save"></i> Update';
            form_action = base_url + "company/save_update/" + obj.attr('data-el_id');
            $(".manager_section_block").hide();
            $("#comp_prefix").attr('disabled','disabled');
        }
        $('#company_form').attr('action', form_action);
        $("#add_update_company_modal_lable").html(title);
        $("#save_update_button_click").html(button_title);
        $("#add_update_company_modal").modal('show');
    });

    $(document).on("click", ".close_modal_common", function () {
        $('#company_form').parsley().reset();
        $("#company_form")[0].reset();
        $("#company_edit_id").val(0);
        $("#company_id").val(0);
    });

    $(document).on("click", "#save_update_button_click", function () {
        var obj = $('#company_form');
        if (obj.parsley().validate()) {
            show_loading('#save_update_button_click', 'Updating..!')
            form_submit(obj.attr("id"),
                function (res) {
                    notify_alert(res.status, res.message)
                    reloadTable('#company_list_dt_table');
                    setTimeout(function () {
                        hide_loading('#save_update_button_click', '<i class="fa fa-check"></i> Save');
                        $(".close_modal_common").trigger('click');
                    }, 1000);
                }, function (res) {
                    hide_loading('#save_update_button_click', '<i class="fa fa-check"></i> Save');
                    notify_alert(res.status, res.message, 'Error');
                });
        }
    });

    /* -------Check Prefix-------*/
    $(document).on("blur","#comp_prefix",function(){
        var company_id = $("#company_id").val();
        var prefix = $(this).val();

        var url = base_url+"company/check_prefix/"+company_id+"/"+prefix;
        if(company_id == 0 && prefix != '')
        {
            $.getJSON(url,function(res){
                if(res.status == 'success')
                {
                    notify_alert(res.status, res.message, 'Success');
                    $("#comp_prefix").val(prefix.toUpperCase());
                    $("#user_name").val(prefix.toUpperCase()+'0001');
                }
                else
                {
                    notify_alert(res.status, res.message, 'Error');
                    $("#comp_prefix").val('');
                    $("#comp_prefix").focus();
                }
            });
        }
    });

}); // dom end 

function getDetail(obj, id) {
    $("#add_update_company_modal").modal('show');
    call_service(base_url + "company/edit_detail/" + id, function (res) {
        var data_res = res['data'][0];
        if (res['status'] == 'success') {
            $("#company_id").val(data_res.id);
            $("#company_name").val(data_res.company_name);
            $("#email_1").val(data_res.email_1);
            $("#email_2").val(data_res.email_2);
            $("#contact_1").val(data_res.contact_1);
            $("#contact_2").val(data_res.contact_2);
            $("#subscription").val(data_res.subscription);
            $("#about_company").val(data_res.about_company);
            $("#address").val(data_res.address);
            $("#comp_prefix").val(data_res.company_prefix);
            $("#is_active").prop("checked", ((data_res.status == 1) ? true : false));
            
            if(data_res.logo != '')
            {
                $(".company_logo_src").attr('src',data_res.logo);
                $(".company_logo_src_value").val(data_res.logo);
                if(data_res.logo == 'assets/images/no.jpg')
                {
                    $(".deleteImage").hide();
                }
                else
                {
                    $(".deleteImage").show();
                }
            }
            else
            {
                $(".company_logo_src").attr('src',base_url+'assets/images/no.jpg');
                $(".company_logo_src_value").val('assets/images/no.jpg');
                $(".deleteImage").hide();
            }
        }
    }, function (res) {
    });
}

function deleteCompany(obj, id) {
    if (confirm("Are you sure, You want to delete this company?")) {
        call_service(base_url + "company/delete_company/" + id, function (response) {
            if (response.status == 'success') {
                reloadTable('#company_list_dt_table');
                notify_alert('success', response.message, "Success")
            } else {
                notify_alert('danger', response.message, "Error");
            }
        }, function () {
            notify_alert('danger', response.message, "Error");
        });

    }
}



function deleteMultiple() {

    if ($(".compckbx:checked").length > 0) {
        if (confirm("Are you sure, You want to delete selected company?")) {
            idArr = [];
            $('.compckbx').each(function (index, value) {
                if (this.checked == true) {
                    idArr.push(this.value);
                }
            });

            call_service(base_url + "company/multiple_delete_company/?ids=" + idArr, function (response) {
                if (response.status == 'success') {
                    reloadTable();
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
        notify_alert('error', 'Please select at least one company.', 'Error');
    }

}
