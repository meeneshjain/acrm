function show_loading(button, text) {
    $(button).html('<i class="fa fa-spinner fa-spin fa-fw"></i> ' + text);
    $(button).attr("disabled", true);

}
function hide_loading(button, text) {
    $(button).html(text);
    $(button).attr("disabled", false);

}

function notify_alert(type, message, title) {
    var content = {};

    if (type == "success") {
        content.icon = 'fa fa-check ';
    } else if (type == "info") {
        content.icon = 'fa 	fa-info-circle ';
    } else if (type == "primary") {
        content.icon = 'fa 	fa-check-circle ';
    } else if (type == "warning") {
        content.icon = 'fa fa-warning ';
    } else if (type == "danger" || type == "error") {
        content.icon = 'fa fa-times ';
        type = 'danger';
    }

    content.message = message;
    if (title != "") {
        content.title = title;
    }

    $.notify(content, {
        type: type,
        allow_dismiss: true,
        newest_on_top: true,
        mouse_over: true,
        showProgressbar: false,
        spacing: 10,
        timer: 4000,
        placement: {
            from: 'bottom',
            align: 'right'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 1000,
        z_index: 10000,
        animate: {
            enter: 'animated bounceIn',
            exit: 'animated bounceOut'
        }
    });
}

function form_submit(form_id, callback, error_callback) {
    var form_obj = $("#" + form_id);
    if (form_obj.parsley().validate()) {
        $.ajax({
            url: form_obj.attr("action"),
            data: form_obj.serialize(),
            type: 'POST',
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                callback(response);
            },
            error: function (response) {
                if (error_callback != 'undefined' && error_callback !== undefined) {
                    error_callback(response);
                }
                notify_alert('danger', 'There was some error, Please try again.', "Error");
            }
        });
    }
}

function call_service(url, callback, error_callback) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            callback(response);
        },
        error: function (response) {
            error_callback(response);
            notify_alert('danger', 'There was some error, Please try again.', "Error")
        }
    });
}

function reloadTable(table_id) {
    $(table_id).DataTable().ajax.reload();
}

function checkAll(clsAll, cls) {
    $("." + clsAll).change(function () {
        $("." + cls).prop('checked', $(this).prop("checked"));
    });
}

function format_date(change_date) {
    var ftoday = new Date(change_date);
    var dd = ftoday.getDate();

    var mm = ftoday.getMonth() + 1;
    var yyyy = ftoday.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }
    ftoday = yyyy + '-' + mm + '-' + dd;
    console.log(ftoday);
    return ftoday;
}

//ready goes here 
var table_object = [];
var default_image = base_url + "assets/images/no.jpg";

$(document).ready(function () {
    if ($(".dt_table").length > 0) {
        var i = 0;
        $(".dt_table").each(function () {
            var $obj = $(this);
            table_object[i] = $($obj).DataTable({
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": $obj.attr("data-source"),
                "columnDefs": [{ "bSortable": false, "aTargets": 'no-sort' }],
            });
            i++;
        }).on("mouseover", function () {
            $('.custom-popover').popover({ trigger: "hover", html: true });
        });
    }



    $(".crm_datepicker").datepicker({
        todayHighlight: !0,
        orientation: "bottom left",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
        format: "yyyy-mm-dd",
        autoclose: !0,
    });

    $(".crm_datetimepicker").datetimepicker({
        todayHighlight: !0,
        pickerPosition: "top-left",
        autoclose: !0,
        format: "yyyy-mm-dd hh:ii"
    });

    $(".select2_selectbox").select2({
        placeholder: $(this).data("placeholder")
    });


    $(".live_select_picker").selectpicker();

    $('form:not(".exclude_parsley_validation")').parsley({
        excluded: "input[type=button],input[type=checkbox], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden"
    });

    $.listen('parsley:field:validated', function (fieldInstance) {
        if (fieldInstance.$element.is(":hidden")) {
            fieldInstance._ui.$errorsWrapper.css('display', 'none');
            fieldInstance.validationResult = true;
            return true;
        }
    });

    if ($("#upload_images_single").length > 0) {
        var button_text = $("#upload_images_single").attr("data-displayname");

        $("#upload_images_single").uploadifive({
            'auto': true,
            'multi': false,
            'buttonText': "<i class='fa fa-upload'></i> " + button_text,
            'buttonClass': 'btn btn-primary ',
            'fileType': ["image\/gif", "image\/jpeg", "image\/png"],
            'fileObjName': 'image_upload',
            'uploadScript': base_url + 'home/upload/' + $("#changed_images").data("folder_name"),
            'onUploadComplete': function (file, data) {
                if (data != "e2") {
                    var obj = $(this);
                    setTimeout(function () {
                        $("div.uploadifive-queue-item.complete").fadeOut("linear", function () {
                            $(this).remove()
                        });
                    }, 2000);
                    $("#changed_images").attr("src", "");
                    $("input[name='uploaded_images']").val(data);
                    $("#changed_images").attr("src", base_url + "" + $.trim(data));
                    $(".deleteImage").show();

                } else {
                    notify_alert('danger', 'There was some error, Please try again.', "Error");
                }
            },
            'onError': function (errorType) {
                setTimeout(function () {
                    $("div.uploadifive-queue-item.error").fadeOut("linear", function () {
                        $(this).remove()
                    });
                }, 2000);
            }
        });


        $(document).on("click", ".deleteImage", function (event) {
            event.preventDefault();
            var obj = $(this);
            var link = obj.attr("href");
            if ($("#changed_images").attr("src") != default_image) {
                if (confirm('Remove this image')) {
                    $.ajax({
                        url: link,
                        type: 'GET',
                        data: {
                            'filepath': $("input[name='uploaded_images']").val()
                        },
                        success: function (data) {
                            $("#changed_images").attr("src", default_image);
                            $("input[name='uploaded_images']").val('');
                            notify_alert('success', 'Picture removed, please save the changes before closing.', "Success");
                            obj.hide();
                        },
                        error: function (data) {
                            notify_alert('danger', 'There was some error, please try again.', "Error");

                        }
                    });
                }
            }
        });
    }

    //modal over modal functionality - start


    $(document).on("click", ".open_modal_over_modal", function () {
        var obj = $(this);
        var modal_id = obj.data("modal-id");
        $("div.modal-backdrop:first").addClass("modal_over_modal_backdrop");
        $("#" + modal_id).modal('show');
    });

    $(document).on("click", ".remove_modal_over_modal_backdrop", function () {
        $("div.modal-backdrop").removeClass('modal_over_modal_backdrop');
        setTimeout(function () {
            $("body").addClass("modal-open");
        }, 700);
    });

    //modal over modal functionality - end

    // menu resposive issue fix

    if ($(window).width() > 900) {
        $("#m_header_topbar").show();
    } else {
        $("#m_header_topbar").hide()
    }

    if ($(this).width() > 800) {
        $("table").removeClass("table-responsive");
    } else if ($(this).width() < 800) {
        $("table").addClass("table-responsive");
    }


    $(window).resize(function () {
        if ($(this).width() > 900) {
            $("#m_header_topbar").show();
        } else {
            $("#m_header_topbar").hide()
        }

        if ($(this).width() > 800) {
            $("table").removeClass("table-responsive");
        } else if ($(this).width() < 800) {
            $("table").addClass("table-responsive");
        }
    });

    $("#m_aside_header_topbar_mobile_toggle").on("click", function () {
        $("#m_header_topbar").toggle();
    })


}); // jquery end 