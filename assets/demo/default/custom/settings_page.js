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
            $(".uom_loader").show();
        }, function () {
            $(".uom_loader").show();
        });
    });

    var box_count = $(".uom_data").length;
    $(document).on("click", ".add_more_uom", function (event) {
        box_count++;
        var output = '<div class="form-group m-form__group row uom_data" data-block="' + box_count + '" data-is_saved="0">\
            <div class="col-lg-2" >\
                <label>\
                    '+ box_count + '\
            </label>\
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
                }, 1000);
            }, function (res) {
                hide_loading(btn_id, btn_text);
                //     notify_alert(res.status, res.message, 'Error');
            });
        }
    });




}); // dom end 