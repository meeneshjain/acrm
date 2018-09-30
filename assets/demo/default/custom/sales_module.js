var form_obj = $('#sales_action_form');
var item_options = "";
$(document).ready(function () {
    $(document).on("click", ".add_update_click", function () {
        var obj = $(this);
        var title = "";
        var button_title = "";
        var form_action = '';
        var form_name = $("#form_name").val();
        if (form_name == "sales_quote") {
            $(".ref_quote_no_block").hide();
            $("#ref_quote_no").val("");
        } else if (form_name == "sales_order") {
            $(".ref_quote_no_block").show();
        }

        if (obj.attr('data-form_type') == "add") {
            $(".item_detail_section tr").html("");
            title = "Add " + ($("#sales_form_title").val());
            button_title = '<i class="fa fa-save"></i> Save';
            form_action = base_url + "sales/save_update/" + form_name;
            get_new_sales_data();
            $("#profile_section_box").show();
            $("#email").attr('disabled', false);
            $("#username").attr('disabled', false);
            $("#changed_images").attr("src", DEFAULT_IMAGE);
            $(".deleteImage").hide();
            $("#password").attr('disabled', false).parents('div').show();;
            $("#is_active").prop("checked", true);
            $("#sales_order_quotation_id").val('0');
        } else if (obj.attr('data-form_type') == "edit") {
            title = "Edit " + ($("#sales_form_title").val());
            button_title = '<i class="fa fa-save"></i> Update';
            form_action = base_url + "sales/save_update/" + form_name + '/' + obj.attr('data-el_id');
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
        if ($(".item_detail_section tr").length == 0) {
            notify_alert("danger", "Select at least 1 Item ");
            return false;
        }
        btn_text = obj.html();
        if (form_obj.parsley().validate()) {
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

    //  add rows 
    $(document).on("click", ".add_more_rows", function () {
        var block_count = $(".item_list_data").length;
        block_count++;
        var output = `<tr class="item_list_data" data-is_saved="0">
            <td> <div class="form-control m-input" >`+ block_count + `</div> </td>
            <td>  <select id="item_code_`+ block_count + `" name="item_detail[` + block_count + `][id]" required class="form-control m-input item_code_list" placeholder="Item Code">
            `+ item_options + `
                </select> </td>
            <td>
            <input type="hidden" id="item_codeid_` + block_count + `" name="item_detail[` + block_count + `][item_code]" required class="form-control m-input" data-maped_item_code="item_code_` + block_count + `" placeholder="Item Name" readonly>
            <input type="text" id="item_name_`+ block_count + `" name="item_detail[` + block_count + `][item_name]" required class="form-control m-input" data-maped_item_code_id="item_code_` + block_count + `" placeholder="Item Name" readonly>
            </td>
            <td>
            <input type="text" id="quantity_`+ block_count + `" data-item_price_quantity="price_` + block_count + `" name="item_detail[` + block_count + `][quantity]" required class="form-control m-input item_price_quantity" placeholder="Quantity">
            </td>
            <td>
            <select id="price_`+ block_count + `" required data-item_pricelist="item_code_` + block_count + `" name="item_detail[` + block_count + `][price]" class="form-control m-input price_list_select" placeholder="Price">
            </select>
            </td>
            <td>
            <input type="text" id="discount_`+ block_count + `" data-item_price_discount="price_` + block_count + `" name="item_detail[` + block_count + `][discount]" class="form-control m-input item_price_discount" placeholder="Discount">
            </td> 
            <td>
                <input data-mapped_tax_column="item_code_`+ block_count + `" data-mapped_price="price_` + block_count + `" type="text" id="tax_amount_` + block_count + `" required  name="item_detail[` + block_count + `][tax_amount]" readonly class="form-control m-input" placeholder="Enter Tax Amount">
            </td>
            <td>
                <input type="text" id="total_`+ block_count + `" data-mapped_price_total="price_` + block_count + `" name="item_detail[` + block_count + `][total]" class="form-control m-input" required placeholder="Total">
            </td>
            <td>
                <input type="text" id="remark_`+ block_count + `" name="item_detail[` + block_count + `][remark]" class="form-control m-input" placeholder="Remark"> 
            </td>
            <td>
                <a href="javascript:;" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill remove_crrent_row btn-sm ml-2">
                    <i class="fa fa-minus"></i></a>
            </td>
            </tr>`;


        $(".item_detail_section").append(output);
    });

    $(document).on("click", ".remove_crrent_row", function () {
        var obj = $(this);
        if (obj.parents(".item_list_data").attr('data-is_saved') == 1) {
            if (confirm("Are you sure, you want to remove this item?")) {
                var sales_item_id = obj.attr('data-sales_item_id');
                call_service(base_url + "sales/delete_so_detail_item/" + sales_item_id, function (res) {
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
        final_total();
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

    $(document).on("change", "#contact_person", function () {
        var obj = $(this);
        $("#contact_no").val("");
        if (obj.val() != "") {
            $("#contact_no").val($("#contact_person").find('option:selected').attr('data-contact_number'));
            $("#contact_person_name").val($("#contact_person").find('option:selected').attr('data-contact_name'));
        }
    });

    $(document).on("change", ".item_code_list", function () {
        var obj = $(this);
        var item_name = obj.find('option:selected').attr('data-item_name');
        var item_code = obj.find('option:selected').attr('data-item_code');
        var tax = obj.find('option:selected').attr('data-tax');

        var mapped_id = obj.attr('id');
        $("input[data-maped_item_code_id='" + mapped_id + "']").val("");
        $("input[data-maped_item_code='" + mapped_id + "']").val("");
        $("select[data-item_pricelist='" + mapped_id + "']").val("");
        $("select[data-item_pricelist='" + mapped_id + "']").html('<option value="">Select Price </option>');
        $("input[data-mapped_price='" + mapped_id + "']").val("");
        $("input[data-item_price_quantity='" + mapped_id + "']").val("");
        $("select[data-item_pricelist='" + mapped_id + "']").trigger('change');
        $("input[data-item_price_quantity='" + mapped_id + "']").val("");
        $("input[data-item_price_discount='" + mapped_id + "']").val("");
        $("input[data-mapped_tax_column='" + mapped_id + "']").val("");
        if (obj.val() != "") {
            var price_list_array = obj.find('option:selected').attr('data-pice_list').split("::");
            $("input[data-maped_item_code_id='" + mapped_id + "']").val(item_name);
            $("input[data-maped_item_code='" + mapped_id + "']").val(item_code);
            $("input[data-mapped_tax_column='" + mapped_id + "']").val(tax);
            $("input[data-item_price_quantity='" + mapped_id + "']").val(1);
            var count = 1;
            if (price_list_array.length > 0) {
                var price_list = '<option value="">Select Price</option>\n';
                for (var ijk = 0; ijk < price_list_array.length; ijk++) {
                    if (price_list_array[ijk] != 0) {
                        price_list += '<option value="' + price_list_array[ijk] + '">' + 'Price ' + count + ' - ' + price_list_array[ijk] + '</option>';
                    }
                    count++;
                }
                $("select[data-item_pricelist='" + mapped_id + "']").html(price_list);
            }
        } else { }
    });

    $(document).on("change", ".price_list_select", function () {
        var obj = $(this);
        var mapped_id = obj.attr('id');
        var tax = $("input[data-mapped_price='" + mapped_id + "']").val();
        var quantity = $("input[data-item_price_quantity='" + mapped_id + "']").val();
        var discount = $("input[data-item_price_discount='" + mapped_id + "']").val();
        $("input[data-mapped_price_total='" + mapped_id + "']").val("");
        var price = obj.val();
        if (obj.val() != "") {
            $("input[data-mapped_price_total='" + mapped_id + "']").val(calculate_row_amount(price, discount, quantity, tax));
        }
        final_total();
    });

    $(document).on("change, keyup", ".item_price_quantity", function () {
        var obj = $(this);
        var mapped_id = obj.data('item_price_quantity');
        var quantity = $(obj).val();
        var tax = $("input[data-mapped_price='" + mapped_id + "']").val();
        var discount = $("input[data-item_price_discount='" + mapped_id + "']").val();
        var price = $("#" + mapped_id).val();
        $("input[data-mapped_price_total='" + mapped_id + "']").val(calculate_row_amount(price, discount, quantity, tax));
        final_total();
    });

    $(document).on("change, keyup", ".item_price_discount", function () {
        var obj = $(this);
        var mapped_id = obj.data('item_price_discount');
        var quantity = $("input[data-item_price_quantity='" + mapped_id + "']").val();
        var tax = $("input[data-mapped_price='" + mapped_id + "']").val();
        var discount = $(obj).val();
        var price = $("#" + mapped_id).val();
        $("input[data-mapped_price_total='" + mapped_id + "']").val(calculate_row_amount(price, discount, quantity, tax));
        final_total();
    });

    $(document).on("change, keyup", ".actual_calculator", function () {
        actual_total();
    });
}); // document end 

// custom functions goes here - start

function final_total() {
    var total = 0;
    $(".item_detail_section tr").each(function () {
        $(this).find("input[data-mapped_price_total]").val();
        console.log($(this).find("input[data-mapped_price_total]").val());
        if ($(this).find("input[data-mapped_price_total]").val() != "" && $(this).find("input[data-mapped_price_total]").val() != undefined) {
            total += parseFloat(($(this).find("input[data-mapped_price_total]").val()));
        }
    });
    if (total == "" && total == undefined) {
        total = 0;
    } else {
        total = total.toFixed(2);
    }
    $("#total_amount").val(total);
    actual_total();
}

function actual_total() {
    var total = ($("#total_amount").val() != "") ? parseFloat($("#total_amount").val()) : 0;
    var other_charges = ($("#other_charges").val() != "") ? parseFloat($("#other_charges").val()) : 0;
    var total_tax = ($("#total_tax").val() != "") ? parseFloat($("#total_tax").val()) : 0;
    var discount = ($("#discount").val() != "") ? parseFloat($("#discount").val()) : 0;
    var full_total = (total + other_charges);
    if (total_tax != 0) {
        full_total = full_total + parseFloat(total_tax + (total_tax / 100));
    }
    var actual_total = full_total;
    if (discount != 0) {
        parseFloat(full_total - (discount / 100));
    }
    $("#actual_total").val(actual_total.toFixed(2));
}



function calculate_row_amount(price, discount, quantity, tax) {
    if (price == undefined || price == "") {
        price = 0;
    }
    if (discount != "" && discount != undefined && discount != 0) {
        price = parseFloat(price - (parseFloat(price) * parseFloat(discount / 100)));
    }

    if (quantity != "" && quantity != undefined && quantity != 0) {
        price = parseFloat(quantity * price);
    }
    var total_price = parseFloat(parseFloat(price) + parseFloat(price * (tax / 100))).toFixed(2);
    return total_price;
}

function get_new_sales_data() {
    call_service(base_url + "sales/get_sales_data/" + $("#logged_in_company_id").val(), function (res) {
        if (res['status'] == 'success') {
            var employee_code = res['data'];
            $("#doc_number").val(res['doc_number']);
            $("#sales_employee").val(res['sale_employees']);
            generate_account_list(res['account_list']);
            item_options = generate_item_list(res['item_list']);
            if ($(".item_code_list").length > 0) {
                $(".item_code_list").html(item_options);
            }

        }
    }, function (res) {
    });
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
    return item_options;

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

function get_sales_details(id) {
    $("#add_update_user_modal").modal('show');
    call_service(base_url + "sales/get_sales_details/" + id, function (res) {
        if (res['status'] == 'success') {
            var header_data = res['header'];
            generate_account_list(res['account_list'], header_data['account_id']);
            setTimeout(function () {
                $("#account_code").trigger('change');
            }, 500);
            // $("#account_code").val(header_data.account_name);
            $("#doc_number").val(header_data.doc_no);
            $("#account_name").val(header_data.account_name);
            $("#doc_date").val(header_data.doc_date);
            $("#delivery_address").val(header_data.delivery_address);
            $("#delivery_date").val(header_data.delivery_date);
            $("#gst_number").val(header_data.gst_no);
            $("#valid_till").val(header_data.valid_till);
            $("#pan_no").val(header_data.pan_card_no);
            $("#status").val(header_data.stages);
            setTimeout(function () {
                $("#contact_person").val(header_data.contact_person_id);
                $("#contact_person").trigger('change');
            }, 1000);
            $("#sales_employee").val(header_data.sales_employee);
            $("#contact_person_name").val(header_data.contact_person_name);
            $("#ref_quote_no").val(header_data.sales_quote_ref_id);
            $("#pay_terms").val(header_data.pay_terms);
            $("#remark").val(header_data.remarks);
            $("#total_amount").val(header_data.total_amount);
            $("#other_charges").val(header_data.other_charges);
            $("#total_tax").val(header_data.total_tax);
            $("#final_discount").val(header_data.discount);
            $("#actual_total").val(header_data.actual_total);
            $("#sales_order_quotation_id").val(header_data.id);
            if (res['details'].length > 0 && res['details'] !== undefined) {
                var block_count = 0;
                var output = "";
                for (var i = 0; i < res['details'].length; i++) {
                    var item_data = res['details'][i];
                    item_options = generate_item_list(res.item_list, item_data['item_id']);
                    var price_list_array = res.item_list[i].price_list.split("::");
                    var selected_price_list = '<option value="">Select Price</option>\n';
                    var selected_account = '';
                    var count = 1;
                    for (var ijk = 0; ijk < price_list_array.length; ijk++) {
                        var selected = "";
                        if (price_list_array[ijk] != 0) {
                            if (item_data['price'] == price_list_array[ijk]) {
                                selected = "selected";
                            }
                            selected_price_list += '<option value="' + price_list_array[ijk] + '" ' + selected + '>' + 'Price ' + count + ' - ' + price_list_array[ijk] + '</option>';
                        }
                        count++;
                    }
                    block_count++;
                    output += `<tr class="item_list_data" data-is_saved="1">
                    <td> <div class="form-control m-input" >` + block_count + `</div> </td>
                    <td>  <select id="item_code_`+ block_count + `" name="item_detail[` + block_count + `][id]" required class="form-control m-input item_code_list" placeholder="Item Code">
                    `+ item_options + `
                        </select> </td>
                    <td>
                    <input type="hidden" id="item_codeid_` + block_count + `" name="item_detail[` + block_count + `][item_code]" required class="form-control m-input" data-maped_item_code="item_code_` + block_count + `" placeholder="Item Name" readonly value="` + item_data['item_code'] + `">
                    <input type="text" id="item_name_`+ block_count + `" name="item_detail[` + block_count + `][item_name]" required class="form-control m-input" data-maped_item_code_id="item_code_` + block_count + `" placeholder="Item Name" readonly value="` + item_data['item_name'] + `">
                    </td>
                    <td>
                    <input type="text" id="quantity_`+ block_count + `" data-item_price_quantity="price_` + block_count + `" name="item_detail[` + block_count + `][quantity]" required class="form-control m-input item_price_quantity" placeholder="Quantity" value="` + item_data['quantity'] + `">
                    </td>
                    <td>
                    <select id="price_`+ block_count + `" required data-item_pricelist="item_code_` + block_count + `" name="item_detail[` + block_count + `][price]" class="form-control m-input price_list_select" placeholder="Price">
                    `+ selected_price_list + `
                    </select>
                    </td>
                    <td>
                    <input type="text" id="discount_`+ block_count + `" data-item_price_discount="price_` + block_count + `" name="item_detail[` + block_count + `][discount]" class="form-control m-input item_price_discount" placeholder="Discount" value="` + item_data['discount'] + `">
                    </td> 
                    <td>
                        <input data-mapped_tax_column="item_code_`+ block_count + `" data-mapped_price="price_` + block_count + `" type="text" id="tax_amount_` + block_count + `" required  name="item_detail[` + block_count + `][tax_amount]" readonly class="form-control m-input" placeholder="Enter Tax Amount" value="` + item_data['tax_amount'] + `">
                    </td>
                    <td>
                        <input type="text" id="total_`+ block_count + `" data-mapped_price_total="price_` + block_count + `" name="item_detail[` + block_count + `][total]" class="form-control m-input" required placeholder="Total" value="` + item_data['total'] + `">
                    </td>
                    <td>
                        <input type="text" id="remark_`+ block_count + `" name="item_detail[` + block_count + `][remark]" class="form-control m-input" placeholder="Remark" value="` + item_data['remark'] + `"> 
                    </td>
                    <td>
                    <input type="hidden" name="item_detail[` + block_count + `][item_detail_id]" value="` + item_data['id'] + `"  />
                        <a href="javascript:;" data-sales_item_id="`+ item_data['id'] + `" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill remove_crrent_row btn-sm ml-2">
                            <i class="fa fa-minus"></i></a>
                    </td>
                    </tr>`;
                }
                $(".item_detail_section").html(output);
            }

        }
    }, function (res) {
    });
}

function delete_sale(id) {
    if (confirm("Are you sure, You want to delete this user?")) {
        call_service(base_url + "sales/delete_sales/" + id, function (response) {
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