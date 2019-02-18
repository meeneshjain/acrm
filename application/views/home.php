<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader " style="padding: 10px 40px 0 30px;">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="m-subheader__title ">
                    Dashboard
                </h3>
                <div class="pull-right">
                 <?php if($is_super_admin == 1 || $user_role_id == 1){ ?>
                <div class="row" style="margin-top: 5px;">
                    <?php if($is_super_admin == 1) { ?>
                    <div class="form-group m-form__group col-sm-6">
                     <select required class="form-control m-input report_company_change" id="company_list" name="company_list">
                        <option value="">Select a company</option>
                        <?php echo $company_options; ?>
                    </select>
                    </div>
                    <?php } ?>
                    <div class="form-group m-form__group <?php echo ($is_super_admin == 0 ) ? "col-sm-12": "col-sm-6" ?>">
                    <select required class="form-control m-input report_rm_change" id="rm_employee_list" name="rm_employee_list">
                        <option value="">Select a Regional Manager</option>
                        <?php echo $rm_list; ?>
                    </select>
                    </div>
                </div>
                 <?php } ?>
            </div>
            </div>
            </div>
    
        </div>

    <div class="clearfix"></div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet ">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Total Won Orders
                                </h4>
                                <br>
                                <span class="m-widget24__stats m--font-brand">
                                    <?php echo $top_bar_report['total_won_orders']; ?>
                                </span>
                                <div class="m--space-10"></div>


                            </div>
                        </div>
                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Feedbacks-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Total Open SO
                                </h4>
                                <br>
                                <span class="m-widget24__stats m--font-info">
                                    <?php echo $top_bar_report['total_open_so']; ?>
                                </span>
                                <div class="m--space-10"></div>

                            </div>
                        </div>
                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Orders-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Total Open Quotation
                                </h4>
                                <br>
                                <span class="m-widget24__stats m--font-danger">
                                    <?php echo $top_bar_report['total_open_sq']; ?>
                                </span>
                                <div class="m--space-10"></div>

                            </div>
                        </div>
                        <!--end::New Orders-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <!--begin::New Users-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    Total Open opportunities
                                </h4>
                                <br>
                                <span class="m-widget24__stats m--font-success">
                                    <?php echo $top_bar_report['total_open_opportunity']; ?>
                                </span>
                                <div class="m--space-10"></div>

                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="clearfix"></div>
                <div class="target_vs_achivement_loader display_none" style="width: 100%;">
                    <div class="text-center">
                        <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="h4 blank_div_heading text-center">Target vs Achievement Report</div>
                <div class="target_vs_achievement_block display_none">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-xl-2">
                            <!--begin:: Widgets/Stats2-1 -->
                            <div class="m-widget1">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">
                                                Target Type
                                            </h3>
                                            <span class="m-widget1__desc">
                                            </span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand target_type_section">
                                                +$17,800
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">
                                                Target Cost
                                            </h3>
                                            <span class="m-widget1__desc">
                                            </span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger target_cost_section">
                                                +1,800
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">
                                                Target Completed
                                            </h3>
                                            <span class="m-widget1__desc">
                                            </span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success target_completed_section">
                                                -27,49%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Stats2-1 -->
                        </div>
                        <div class="col-xl-7">
                            <!--begin:: Widgets/Daily Sales-->
                            <div class="m-widget14">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                        Daily Sales
                                    </h3>
                                   <!--  <span class="m-widget14__desc">
                                        Check out each collumn for more details
                                    </span> -->
                                </div>
                                <!-- <div class="m-widget14__chart" style="height:120px;">
                                    <canvas id="m_chart_daily_sales"></canvas>
                                </div> -->
                                <div class="m-portlet__body">
								    <div id="m_gchart_1" ></div>
                                </div>
                            </div>
                            <!--end:: Widgets/Daily Sales-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin:: Widgets/Profit Share-->
                            <div class="m-widget14">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                       Target Achievement
                                    </h3>
                                   <!--  <span class="m-widget14__desc">
                                        Profit Share between customers
                                    </span> -->
                                </div>
                                <div class="row  align-items-center">
                                    <div class="col">
                                        <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                            <div class="m-widget14__stat total_target_box">
                                                45
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="m-widget14__legends">
                                            <div class="m-widget14__legend">
                                                <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                                <span class="m-widget14__legend-text">
                                                    My Target - <span class="my_target_box">15</span> 
                                                </span>
                                            </div>
                                            <div class="m-widget14__legend">
                                                <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                                <span class="m-widget14__legend-text">
                                                    Teams Target - <span class="team_target_box">25</span> 
                                                </span>
                                            </div>
                                            <div class="m-widget14__legend">
                                                <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                                <span class="m-widget14__legend-text">
                                                    Total Target - <span class="total_target_box">40</span> 
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Widgets/Profit Share-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="m-portlet m-widget11">
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="clearfix"></div>
                    <div class="service_call_loader" style="width: 100%;">
                        <div class="text-center">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </div>
                    </div>
                    <div class="table-responsive service_datatable"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- model -->

<div class="modal fade" id="extra_large_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xlg" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        New message
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="m-section__heading"> Direct elements </h4>
                    <div class="form-group m-form__group row m--margin-bottom-20">
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                RecordID:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                OrderID:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="E.g: 37000-300" data-col-index="1">
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                Country:
                            </label>
                            <select class="form-control m-input" data-col-index="2">
                                <option value="">
                                    Select
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>
                                Agent:
                            </label>
                            <input type="text" class="form-control m-input" placeholder="Agent ID or name"
                                data-col-index="4">
                        </div>
                    </div>

                    <!-- two column :1 start -->
                    <h3 class="m-section__heading"> Two Column 1 </h3>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                Full Name:
                            </label>
                            <input type="email" class="form-control m-input" placeholder="Enter full name">
                            <span class="m-form__help">
                                Please enter your full name
                            </span>
                        </div>
                        <div class="col-lg-6">
                            <label class="">
                                Contact Number:
                            </label>
                            <input type="email" class="form-control m-input" placeholder="Enter contact number">
                            <span class="m-form__help">
                                Please enter your contact number
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                Address:
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your address">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your address
                            </span>
                        </div>
                        <div class="col-lg-6">
                            <label class="">
                                Postcode:
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-bookmark-o"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your postcode
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                User Group:
                            </label>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" checked value="2">
                                    Sales Person
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" value="2">
                                    Customer
                                    <span></span>
                                </label>
                            </div>
                            <span class="m-form__help">
                                Please select user group
                            </span>
                        </div>
                    </div>

                    <!-- two column :1 end -->
                    <!-- two column :2 start -->

                    <h3 class="m-section__heading"> Two Column 2 </h3>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Full Name:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Enter full name">
                            <span class="m-form__help">
                                Please enter your full name
                            </span>
                        </div>
                        <label class="col-lg-2 col-form-label">
                            Contact Number:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Enter contact number">
                            <span class="m-form__help">
                                Please enter your contact number
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Address:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your address">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your address
                            </span>
                        </div>
                        <label class="col-lg-2 col-form-label">
                            Postcode:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-bookmark-o"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your postcode
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">
                            Group:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" checked value="2">
                                    Sales Person
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" value="2">
                                    Customer
                                    <span></span>
                                </label>
                            </div>
                            <span class="m-form__help">
                                Please select user group
                            </span>
                        </div>
                    </div>

                    <!-- two column :2 end -->


                    <!-- three column :1 start -->
                    <h3 class="m-section__heading"> Three Column 1 </h3>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>
                                Full Name:
                            </label>
                            <input type="email" class="form-control m-input" placeholder="Enter full name">
                            <span class="m-form__help">
                                Please enter your full name
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Email:
                            </label>
                            <input type="email" class="form-control m-input" placeholder="Enter email">
                            <span class="m-form__help">
                                Please enter your email
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Username:
                            </label>
                            <div class="input-group m-input-group m-input-group--square">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control m-input" placeholder="">
                            </div>
                            <span class="m-form__help">
                                Please enter your username
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">
                                Contact:
                            </label>
                            <input type="email" class="form-control m-input" placeholder="Enter contact number">
                            <span class="m-form__help">
                                Please enter your contact
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                Fax:
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Fax number">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-info-circle"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter fax
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label>
                                Address:
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your address">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your address
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">
                                Postcode:
                            </label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-bookmark-o"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your postcode
                            </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">
                                User Group:
                            </label>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" checked value="2">
                                    Sales Person
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" value="2">
                                    Customer
                                    <span></span>
                                </label>
                            </div>
                            <span class="m-form__help">
                                Please select user group
                            </span>
                        </div>
                    </div>

                    <!-- three column :1 end -->

                    <!-- three column :2 start -->
                    <h3 class="m-section__heading"> Three Column 2 </h3>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Full Name:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Full name">
                            <span class="m-form__help">
                                Please enter your full name
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Email:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Email">
                            <span class="m-form__help">
                                Please enter your email
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Username:
                        </label>
                        <div class="col-lg-3">
                            <div class="input-group m-input-group m-input-group--square">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control m-input" placeholder="">
                            </div>
                            <span class="m-form__help">
                                Please enter your username
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Contact:
                        </label>
                        <div class="col-lg-3">
                            <input type="email" class="form-control m-input" placeholder="Enter contact number">
                            <span class="m-form__help">
                                Please enter your contact
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Fax:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Fax number">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-info-circle"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter fax
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            Address:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your address">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-map-marker"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your address
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-1 col-form-label">
                            Postcode:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-bookmark-o"></i>
                                    </span>
                                </span>
                            </div>
                            <span class="m-form__help">
                                Please enter your postcode
                            </span>
                        </div>
                        <label class="col-lg-1 col-form-label">
                            User Group:
                        </label>
                        <div class="col-lg-3">
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" checked value="2">
                                    Sales Person
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid">
                                    <input type="radio" name="example_2" value="2">
                                    Customer
                                    <span></span>
                                </label>
                            </div>
                            <span class="m-form__help">
                                Please select user group
                            </span>
                        </div>
                    </div>

                    <!-- three column :2 end -->



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Send message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   var get_company_list = 0;
    var get_rm_list = 0;
  <?php if($is_super_admin == 1){ ?>
    var get_company_list = 1;
    var get_rm_list = 0;
    var current_company = 0;
  <?php } else if($user_role_id == 1){ ?>
    var get_company_list = 0;
    var get_rm_list = 1;
    <?php } ?>
    
    <?php if($is_super_admin != 1){ ?>
        var current_company = '<?php echo get_current_company(); ?>';
    <?php } ?>
</script>