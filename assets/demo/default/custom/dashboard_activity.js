$(document).ready(function () {
    $(".service_datatable").html('');
    setTimeout(function () {
        service_call_report()
    }, 100);

}); // doc end 


function service_call_report() {
    call_service(base_url + "home/service_call_report/", function (res) {
        if (res['status'] == 'success') {
            console.log(res);
            var service_report_html = "";
            service_report_html = '';
            $(".service_call_loader").hide();

            service_report_html = '<table class="table">\
                <tbody>\
                    <tr>\
                        <td> </td>\
                        <td><b class="m-widget1__title">Open SO </b></td>\
                        <td><b class="m-widget1__title">Open Quotation</b></td>\
                        <td><b class="m-widget1__title">Open opportunities</b></td>\
                        <td><b class="m-widget1__title">Total </b></td>\
                    </tr>\
                    <tr>\
                        <td> <span class="m-widget1__title">Product in No</span> </td>\
                        <td>' + res.data.prod_so + '</td>\
                        <td>' + res.data.prod_sq + '</td>\
                        <td>' + res.data.prod_opportunities + '</td>\
                        <td>' + res.data.prod_total + '</td>\
                    </tr>\
                    <tr>\
                        <td> <span class="m-widget1__title">Customer in No  </span> </td>\
                        <td>' + res.data.customer_no_so + '</td>\
                        <td>' + res.data.customer_no_sq + '</td>\
                        <td>' + res.data.customer_no_opportunities + '</td>\
                        <td>' + res.data.customer_no_total + '</td>\
                    </tr>\
                    <tr>\
                        <td> <span class="m-widget1__title">Total Amount </span> </td>\
                        <td>' + res.data.total_amount_so + '</td>\
                        <td>' + res.data.total_amount_sq + '</td>\
                        <td>' + res.data.total_amount_opportunities + '</td>\
                        <td>' + res.data.total_amount_total + '</td>\
                    </tr>\
                </tbody>\
            </table>';
            $(".service_datatable").html(service_report_html);
        } else {
            $(".service_call_loader").hide();
            notify_alert('danger', 'There was some error, please try again.', "Error");
        }
    }, function (res) {
        $(".service_call_loader").hide();
        notify_alert('danger', 'There was some error, please try again.', "Error");
    });
}

function target_vs_achievement_report() {
    call_service(base_url + "home/target_vs_achivement_report/", function (res) {
        if (res['status'] == 'success') {
            console.log(res);
            $(".target_vs_achievement_block").show();
            $(".target_vs_achivement_loader").hide();
        } else {
            $(".target_vs_achivement_loader").hide();
            notify_alert('danger', 'There was some error, please try again.', "Error");
        }
    }, function (res) {
        $(".target_vs_achivement_loader").hide();
        notify_alert('danger', 'There was some error, please try again.', "Error");
    });
}
