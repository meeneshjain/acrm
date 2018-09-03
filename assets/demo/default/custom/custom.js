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

//ready goes here 
var table_object = []
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
        });
    }

    $(".crm_datetimepicker").datetimepicker({
        todayHighlight: !0,
        pickerPosition: "top-left",
        autoclose: !0,
        format: "yyyy-mm-dd hh:ii"
    });

    $(".select2_selectbox").select2({
        placeholder: ""
    });


    $("form").parsley({
        excluded: "input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden"
    });
}); // jquery end 