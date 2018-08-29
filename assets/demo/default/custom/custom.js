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
    } else if (type == "danger") {
        content.icon = 'fa fa-times ';
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

//ready goes here 

$(document).ready(function () {
    if ($(".dt_table").length > 0) {
        var table_object = []
        var i = 0;
        $(".dt_table").each(function () {
            var $obj = $(this);
            table_object[i] = $($obj).DataTable({
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": $obj.attr("data-source")
            });
            i++;
        });
    }
});