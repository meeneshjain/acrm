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
            get_new_sales_data();
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

    //  add rows 
    var block_count = $(".item_list_data").length;
    $(document).on("click", ".add_more_rows", function () {
        block_count++;
        var output = `<tr class="item_list_data" data-is_saved="0">
            <td><div class="form-control m-input" >`+ block_count + `</div></td>
            <td> <input type="text" id="item_code+`+ block_count + `" name="item_detail[` + block_count + `][item_code]" class="form-control m-input" placeholder="Item Code"> </td>
            <td><input type="text" id="item_name+`+ block_count + `" name="item_detail[` + block_count + `][item_name]" class="form-control m-input" placeholder="Item Name"></td>
            <td><input type="text" id="quantity+`+ block_count + `" name="item_detail[` + block_count + `][quantity]" class="form-control m-input" placeholder="Quantity">
            </td>
            <td><input type="text" id="price+`+ block_count + `" name="item_detail[` + block_count + `][price]" class="form-control m-input" placeholder="Price">
            </td>
            <td><input type="text" id="discount+`+ block_count + `" name="item_detail[` + block_count + `][discount]" class="form-control m-input" placeholder="Discount">
            </td>
            <td><input type="text" id="tax_amount+`+ block_count + `" name="item_detail[` + block_count + `][tax_amount]" class="form-control m-input" placeholder="Enter Tax Amount">
            </td>
            <td><input type="text" id="total+`+ block_count + `" name="item_detail[` + block_count + `][total]" class="form-control m-input" placeholder="Total">
            </td>
            <td><input type="text" id="remark+`+ block_count + `" name="item_detail[` + block_count + `][remark]" class="form-control m-input" placeholder="Remark"> 
            </td>
            <td><a href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill remove_crrent_row btn-sm ml-2"><i class="fa fa-minus"></i></a></td>
        </tr>`;


        $(".item_detail_section").append(output);
    });

    $(document).on("click", ".remove_crrent_row", function () {
        var obj = $(this);
        if (obj.parents(".item_list_data").attr('data-is_saved') == 1) {
            if (confirm("Are you sure, you want to remove this UOM?")) {
                var sales_quote_item_id = obj.attr('data-sales_quote_item_id');
                call_service(base_url + "sales/sales_quoatation_item/" + sales_quote_item_id, function (res) {
                    if (res.status == 'success') {

                        obj.parents(".item_list_data").slideUp(function () {
                            notify_alert(res.status, res.message);
                            $(this).remove();
                        });
                    } else {
                        notify_alert('danger', 'There was some error, please try again.', "Error");
                    }
                });
            }
        } else {
            obj.parents(".item_list_data").slideUp(function () {
                $(this).remove();
            });
        }
    });

    $(document).on("change", "#account_code", function () {
        var obj = $(this);
        $("#contact_no").val("");
        if (obj.val() != "") {
            call_service(base_url + "sales/get_account_contacts/" + obj.val(), function (res) {
                if (res['status'] == 'success') {
                    var out = '<option value="">Select Contact Person</option>\n';
                    for (var aci = 0; aci < res['contact_list'].length; aci++) {
                        out += '<option value="' + res['contact_list'][aci]['id'] + '" data-contact_number="' + res['contact_list'][aci]['contact_number'] + '">' + res['contact_list'][aci]['full_name'] + '</option>\n';
                    }
                    $("#contact_person").html(out);

                }
            }, function (res) {
            });
        } else {
            $("#contact_person").html('<option value="">Select Contact Person</option>\n');
        }
    });

    $(document).on("change", "#contact_person", function () {
        var obj = $(this);
        $("#contact_no").val("");
        if (obj.val() != "") {
            $("#contact_no").val($("#contact_person").find('option:selected').attr('data-contact_number'));
        }
    });



}); // document end 

// custom functions goes here - start

function get_new_sales_data() {
    call_service(base_url + "sales/get_sales_data/" + $("#logged_in_company_id").val(), function (res) {
        if (res['status'] == 'success') {
            var employee_code = res['data'];
            $("#doc_number").val(res['doc_number']);
            $("#sales_employee").val(res['sale_employees']);
            var out = '<option value="">Account Code</option>\n';
            for (var aci = 0; aci < res['account_list'].length; aci++) {
                out += '<option value="' + res['account_list'][aci]['id'] + '">' + res['account_list'][aci]['account_number'] + '</option>\n';
            }
            $("#account_code").html(out);
        }
    }, function (res) {
    });
}