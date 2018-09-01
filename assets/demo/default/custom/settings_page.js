$(document).ready(function (event) {

    $("#edit_sale_stages").on("submit", function (event) {
        event.preventDefault();
        var obj = $(this);
        if (obj.parsley().validate()) {
            show_loading('update_note_btn', 'Updating..!')
            form_submit(obj.attr("id"),
                function (res) {
                    notify_alert(res.status, res.message)

                    setTimeout(function () {
                        hide_loading('update_note_btn', '');
                        $("#sale_Stages_modal").modal('hide');
                    }, 1000);
                }, function (res) {
                    hide_loading('update_note_btn', '');
                    notify_alert(res.status, res.message)
                });
        }
    })
});