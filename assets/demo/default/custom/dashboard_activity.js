var global_error_msg = 'There was some error, please try again.';
// target_vs_achievement_google_chart();
$(document).ready(function () {
    $(".service_datatable").html('');
    if (get_rm_list == 1) {
        setTimeout(function () {
            get_list_of_all_rm(current_company);
        }, 100);
    }

    setTimeout(function () {
        service_call_report();
        if (current_user_id != 0) {
            target_vs_achievement_report(current_user_id);
        }
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
            $(".target_vs_achivement_loader").addClass('display_none');
            $(".blank_div_heading").removeClass('display_none');
            $(".target_vs_achievement_block").addClass('display_none');
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
    $(".target_vs_achivement_loader").removeClass('display_none');
    $(".blank_div_heading").addClass('display_none');
    call_service(base_url + "home/target_vs_achivement_report/" + current_user_id, function (res) {
        if (res['status'] == 'success') {
            console.log(res);
            $(".target_type_section").html(res.data.target_type + '(' + res.data.target_duration + ')');
            $(".target_cost_section").html(res.data.target_cost);
            $(".target_completed_section").html(res.data.target_completed);
            $(".my_target_box").html(res.data.personal_current_month_target);
            $(".team_target_box").html(res.data.team_current_month_target);
            $(".total_target_box").html(res.data.total_current_month_target);
            $(".target_vs_achievement_block").removeClass('display_none');
            $(".target_vs_achivement_loader").addClass('display_none');
            $(".blank_div_heading").addClass('display_none');
            target_vs_achievement_highchart(res.data['6_month_report']);
            my_target_pie_chart();
        } else {
            $(".target_vs_achivement_loader").addClass('display_none');
            $(".target_vs_achievement_block").addClass('display_none');
            $(".blank_div_heading").addClass('display_none');
            notify_alert('danger', global_error_msg, "Error");
        }
    }, function (res) {
        $(".target_vs_achivement_loader").addClass('display_none');
        $(".blank_div_heading").removeClass('display_none');
        $(".target_vs_achievement_block").addClass('display_none');
        notify_alert('danger', global_error_msg, "Error");
    });
}

function my_target_pie_chart() {
    // load pie chart 
    if (0 != $("#m_chart_profit_share").length) {
        var e = new Chartist.Pie("#m_chart_profit_share", {
            series: [{
                value: 32,
                className: "custom",
                meta: {
                    color: mApp.getColor("brand")
                }
            }, {
                value: 32,
                className: "custom",
                meta: {
                    color: mApp.getColor("accent")
                }
            }, {
                value: 36,
                className: "custom",
                meta: {
                    color: mApp.getColor("warning")
                }
            }],
            labels: [1, 2, 3]
        }, {
                donut: !0,
                donutWidth: 17,
                showLabel: !1
            });
        e.on("draw", function (e) {
            if ("slice" === e.type) {
                var t = e.element._node.getTotalLength();
                e.element.attr({
                    "stroke-dasharray": t + "px " + t + "px"
                });
                var a = {
                    "stroke-dashoffset": {
                        id: "anim" + e.index,
                        dur: 1e3,
                        from: -t + "px",
                        to: "0px",
                        easing: Chartist.Svg.Easing.easeOutQuint,
                        fill: "freeze",
                        stroke: e.meta.color
                    }
                };
                0 !== e.index && (a["stroke-dashoffset"].begin = "anim" + (e.index - 1) + ".end"), e.element.attr({
                    "stroke-dashoffset": -t + "px",
                    stroke: e.meta.color
                }), e.element.animate(a, !1)
            }
        }), e.on("created", function () {
            window.__anim21278907124 && (clearTimeout(window.__anim21278907124), window.__anim21278907124 = null), window.__anim21278907124 = setTimeout(e.update.bind(e), 3e3)
        })
    }
}

function target_vs_achievement_highchart(report_data) {
    var chart_series = [];
    Highcharts.chart('target_vs_achievement', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Target vs Achievement'
        },
        xAxis: {
            categories: report_data.columns,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Achievement'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Target',
            data: report_data.target

        }, {
            name: 'Achievement',
            data: report_data.achievement

        }]
    });
}

/* function target_vs_achievement_google_chart() {
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
                e.addColumn("timeofday", "Timeline"),
                    e.addColumn("number", "Assigned Target"),
                    e.addColumn("number", "Achieved Target"),
                    e.addRows([
                        [{ v: [8, 0, 0], f: "8" }, 1, .25],
                        [{
                            v: [9, 0, 0],
                            f: "9"
                        }, 2, .5],
                        [{
                            v: [10, 0, 0],
                            f: "10"
                        }, 3, 1],
                        [{
                            v: [11, 0, 0],
                            f: "11"
                        }, 4, 2.25],
                        [{
                            v: [12, 0, 0],
                            f: "12"
                        }, 5, 2.25],
                        [{
                            v: [13, 0, 0],
                            f: "1"
                        }, 6, 3],
                        [{
                            v: [14, 0, 0],
                            f: "2"
                        }, 7, 4],
                        [{
                            v: [15, 0, 0],
                            f: "3"
                        }, 8, 5.25],
                        [{
                            v: [16, 0, 0],
                            f: "4"
                        }, 9, 7.5],
                        [{
                            v: [17, 0, 0],
                            f: "5"
                        }, 10, 10]
                    ]);
                var a = {
                    width: 600,
                    height: 400,
                    title: "Targets Report",
                    focusTarget: "category",
                    hAxis: {
                        title: "Timeline",
                        format: "h:mm a",
                        viewWindow: {
                            min: [7, 30, 0],
                            max: [17, 30, 0]
                        }
                    },
                    vAxis: {
                        title: "Target Achieved"
                    }
                };
                new google.visualization.ColumnChart(document.getElementById("target_vs_achievement")).draw(e, a)
            }()

        }
    };
    target_archievement.init();
}
 */