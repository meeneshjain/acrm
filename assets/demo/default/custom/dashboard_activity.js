var global_error_msg = 'There was some error, please try again.';
target_vs_achievement_google_chart();
$(document).ready(function () {
    $(".service_datatable").html('');
    if (get_rm_list == 1) {
        setTimeout(function () {
            get_list_of_all_rm(current_company);
        }, 100);
    }

    setTimeout(function () {
        service_call_report();
    }, 100);

    $(document).on("change", "#company_list", function () {
        var c_obj = $(this);
        if (c_obj.val() != "") {
            get_list_of_all_rm(c_obj.val());
        } else {
            $("#rm_employee_list").html('<option value="">Select a Regional Manager</option>');
        }
    });

    $(document).on("change", "#rm_employee_list", function () {
        var rm_obj = $(this);
        if (rm_obj.val() != "") {
            var rm_id = rm_obj.val();
            target_vs_achievement_report(rm_id);
        } else {

        }
    });


}); // doc end 

function get_list_of_all_rm(company_id = 0) {
    var called_comp_id = company_id;
    call_service(base_url + "home/get_rm_list/" + called_comp_id, function (res) {
        if (res.status == "success") {
            $("#rm_employee_list").html('<option value="">Select a Regional Manager</option>\n' + res.data);
        } else {
            $("#rm_employee_list").html('');
        }
    }, function (res) {
        notify_alert('danger', global_error_msg, "Error");
    });
}

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
            notify_alert('danger', global_error_msg, "Error");
        }
    }, function (res) {
        $(".service_call_loader").hide();
        notify_alert('danger', global_error_msg, "Error");
    });
}

function target_vs_achievement_report(current_user_id = null) {
    call_service(base_url + "home/target_vs_achivement_report/" + current_user_id, function (res) {
        if (res['status'] == 'success') {
            console.log(res);
            $(".target_vs_achievement_block").removeClass('display_none');
            $(".target_vs_achivement_loader").addClass('display_none');
        } else {
            $(".target_vs_achivement_loader").addClass('display_none');
            notify_alert('danger', global_error_msg, "Error");
        }
    }, function (res) {
        $(".target_vs_achivement_loader").addClass('display_none');
        notify_alert('danger', global_error_msg, "Error");
    });
}

function target_vs_achievement_google_chart() {
    var target_archievement = {
        init: function () {
            google.load("visualization", "1", {
                packages: ["corechart", "bar", "line"]
            }), google.setOnLoadCallback(function () {
                target_archievement.runDemos()
            })
        },
        runDemos: function () {
            var e;
            ! function () {
                var e = new google.visualization.DataTable;
                e.addColumn("timeofday", "Time of Day"), e.addColumn("number", "Motivation Level"), e.addColumn("number", "Energy Level"), e.addRows([
                    [{
                        v: [8, 0, 0],
                        f: "8 am"
                    }, 1, .25],
                    [{
                        v: [9, 0, 0],
                        f: "9 am"
                    }, 2, .5],
                    [{
                        v: [10, 0, 0],
                        f: "10 am"
                    }, 3, 1],
                    [{
                        v: [11, 0, 0],
                        f: "11 am"
                    }, 4, 2.25],
                    [{
                        v: [12, 0, 0],
                        f: "12 pm"
                    }, 5, 2.25],
                    [{
                        v: [13, 0, 0],
                        f: "1 pm"
                    }, 6, 3],
                    [{
                        v: [14, 0, 0],
                        f: "2 pm"
                    }, 7, 4],
                    [{
                        v: [15, 0, 0],
                        f: "3 pm"
                    }, 8, 5.25],
                    [{
                        v: [16, 0, 0],
                        f: "4 pm"
                    }, 9, 7.5],
                    [{
                        v: [17, 0, 0],
                        f: "5 pm"
                    }, 10, 10]
                ]);
                var a = {
                    title: "Motivation and Energy Level Throughout the Day",
                    focusTarget: "category",
                    hAxis: {
                        title: "Time of Day",
                        format: "h:mm a",
                        viewWindow: {
                            min: [7, 30, 0],
                            max: [17, 30, 0]
                        }
                    },
                    vAxis: {
                        title: "Rating (scale of 1-10)"
                    }
                };
                new google.visualization.ColumnChart(document.getElementById("m_gchart_1")).draw(e, a)
            }(), (e = new google.visualization.DataTable).addColumn("number", "Day"), e.addColumn("number", "Guardians of the Galaxy"), e.addColumn("number", "The Avengers"), e.addColumn("number", "Transformers: Age of Extinction"), e.addRows([
                [1, 37.8, 80.8, 41.8],
                [2, 30.9, 69.5, 32.4],
                [3, 25.4, 57, 25.7],
                [4, 11.7, 18.8, 10.5],
                [5, 11.9, 17.6, 10.4],
                [6, 8.8, 13.6, 7.7],
                [7, 7.6, 12.3, 9.6],
                [8, 12.3, 29.2, 10.6],
                [9, 16.9, 42.9, 14.8],
                [10, 12.8, 30.9, 11.6],
                [11, 5.3, 7.9, 4.7],
                [12, 6.6, 8.4, 5.2],
                [13, 4.8, 6.3, 3.6],
                [14, 4.2, 6.2, 3.4]
            ])

        }
    };
    target_archievement.init();
}
