<?php 
expire_license();
$sesion_data = $this->session->userdata(); 
$header_permission = get_user_permission();
?>
<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
<meta charset="utf-8" />
<title>
<?php echo $page_title?> | <?php echo APP_NAME; ?>
</title>
<meta name="description" content="State colors">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--begin::Web font -->
<script src="<?php echo base_url('assets/demo/default/custom/webfont.js'); ?>"></script>
<script>
WebFont.load({
google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
active: function() {
sessionStorage.fonts = true;
}
});
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
    var DEFAULT_IMAGE  = '<?php echo base_url(DEFAULT_IMAGE); ?>';

    /*chat var*/
    var my_socket_id = "<?php echo $sesion_data['logged_in'];?>";
</script>

<!--end::Web font -->

<link href="<?php echo base_url('assets/demo/default/base/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
<?php 
$settings = get_global_settings('default_theme');
if(isset($settings['default_theme'])  && $settings['default_theme'] != ""){ ?>
    <link href="<?php echo base_url('assets/demo/default/custom/themes/css/'.$settings['default_theme'].'.css'); ?>" rel="stylesheet" type="text/css" />
<?php } ?>
<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page --><div class="m-grid m-grid--hor m-grid--root m-page">
<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
<div class="m-container m-container--fluid m-container--full-height">
<div class="m-stack m-stack--ver m-stack--desktop">
<!-- BEGIN: Brand -->
<div class="m-stack__item m-brand  m-brand--skin-dark ">
<div class="m-stack m-stack--ver m-stack--general">
<div class="m-stack__item m-stack__item--middle m-brand__logo logo_css">
    <h4>
        <a href="<?php echo base_url(); ?>" class="m-brand__logo-wrapper">
           <img src="<?php echo base_url(COMPANY_LOGO); ?>" style="width: 50px;" alt=""> <?php echo APP_NAME?>
        </a>
    </h4>
</div>
<div class="m-stack__item m-stack__item--middle m-brand__tools">
    <!-- BEGIN: Left Aside Minimize Toggle -->
    <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
        <span></span>
    </a>
    <!-- END -->
<!-- BEGIN: Responsive Aside Left Menu Toggler -->
    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block" >
        <span></span>
    </a>
    <!-- END -->
<!-- BEGIN: Responsive Header Menu Toggler -->
    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block" >
        <span></span>
    </a>
    <!-- END -->
<!-- BEGIN: Topbar Toggler -->
    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
        <i class="flaticon-more"></i>
    </a>
    <!-- BEGIN: Topbar Toggler -->
</div>
</div>
</div>
<!-- END: Brand -->
<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
<!-- BEGIN: Horizontal Menu -->
<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
<i class="la la-close"></i>
</button>
<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
<!-- <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
    
    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon flaticon-line-graph"></i>
            <span class="m-menu__link-text">
                Reports
            </span>
            <i class="m-menu__hor-arrow la la-angle-down"></i>
            <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:1000px">
            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <div class="m-menu__subnav">
                <ul class="m-menu__content">
                    <li class="m-menu__item">
                        <h3 class="m-menu__heading m-menu__toggle">
                            <span class="m-menu__link-text">
                                Finance Reports
                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </h3>
                        <ul class="m-menu__inner">
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-map"></i>
                                    <span class="m-menu__link-text">
                                        Annual Reports
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-user"></i>
                                    <span class="m-menu__link-text">
                                        HR Reports
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-clipboard"></i>
                                    <span class="m-menu__link-text">
                                        IPO Reports
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                    <span class="m-menu__link-text">
                                        Finance Margins
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                    <span class="m-menu__link-text">
                                        Revenue Reports
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="m-menu__item">
                        <h3 class="m-menu__heading m-menu__toggle">
                            <span class="m-menu__link-text">
                                Project Reports
                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </h3>
                        <ul class="m-menu__inner">
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Coca Cola CRM
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Delta Airlines Booking Site
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Malibu Accounting
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Vineseed Website Rewamp
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Zircon Mobile App
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                <a  href="header/actions.html" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">
                                        Mercury CMS
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </li>
</ul> -->
</div>


<!-- END: Horizontal Menu -->								<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid ">
<div class="m-stack__item m-topbar__nav-wrapper">
    <ul class="m-topbar__nav m-nav m-nav--inline">
        <li class="
m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" 
m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
            <a href="#" class="m-nav__link m-dropdown__toggle">
                <span class="m-nav__link-icon">
                    <i class="flaticon-search-1"></i>
                </span>
            </a>
            <div class="m-dropdown__wrapper">
                <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                <div class="m-dropdown__inner ">
                    <div class="m-dropdown__header">
                        <form  class="m-list-search__form">
                            <div class="m-list-search__form-wrapper">
                                <span class="m-list-search__form-input-wrapper">
                                    <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
                                </span>
                                <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                    <i class="la la-remove"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="m-dropdown__body">
                        <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
                            <div class="m-dropdown__content"></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
            <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                <span class="m-nav__link-icon _m_ntf_bell">
                    <i class="flaticon-music-2"></i>
                </span>
            </a>
            <div class="m-dropdown__wrapper">
                <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center purple_red_bg">
                        <span class="m-dropdown__header-title"> </span>
                    </div>
                    <div class="m-dropdown__body">
                        <div class="m-dropdown__content">
                            <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                                        Alerts
                                    </a>
                                </li>
                             
                            </ul>
                            <style type="text/css">
                                .o_f{
                                    overflow: visible !important;
                                }
                            </style>
                            <div class="tab-content">
                                <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                                    <div class="m-scrollable o_f" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                        <div class="m-widget4 _real_time_meeting_notification">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        
        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
            <a href="#" class="m-nav__link m-dropdown__toggle">
                <span class="m-topbar__userpic">
                    <img src="<?php echo base_url('assets/images/avatar-grey.png'); ?>" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                </span>
                <span class="m-topbar__username m--hide">
                    Nick
                </span>
            </a>
            <div class="m-dropdown__wrapper">
                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                <div class="m-dropdown__inner">
                    <div class="m-dropdown__header m--align-center purple_red_bg">
                        <div class="m-card-user m-card-user--skin-dark">
                            <div class="m-card-user__pic">
                                <img src="<?php echo base_url('assets/images/avatar-grey.png'); ?>" class="m--img-rounded m--marginless" alt=""/>
                            </div>
                            <div class="m-card-user__details">
                                <span class="m-card-user__name m--font-weight-500">
                                    <?php echo $sesion_data['full_name']; ?>
                                </span>
                                <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                    <?php echo  $sesion_data['email']; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="m-dropdown__body">
                        <div class="m-dropdown__content">
                            <ul class="m-nav m-nav--skin-light">
                                <li class="m-nav__section m--hide">
                                    <span class="m-nav__section-text">
                                        Section
                                    </span>
                                </li>
                                <li class="m-nav__item">
                                    <a href="<?php echo base_url('profile'); ?>" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-profile-1"></i>
                                        <span class="m-nav__link-title">
                                            <span class="m-nav__link-wrap">
                                                <span class="m-nav__link-text">
                                                    My Profile
                                                </span>
                                                <span class="m-nav__link-badge">
                                                    <span class="m-badge m-badge--success">
                                                        2
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="<?php echo base_url('settings/all'); ?>" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-settings"></i>
                                        <span class="m-nav__link-text">
                                           <i class=""></i> Preferences
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                <li class="m-nav__item">
                                    <a href="<?php echo base_url('home/logout'); ?>" class="m-nav__link">
                                        <i class="m-nav__link-icon flaticon-logout"></i>
                                        <span class="m-nav__link-text">
                                             Logout
                                        </span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li id="m_quick_sidebar_toggle" class="m-nav__item get_notes_list">
            <a href="#" class="m-nav__link m-dropdown__toggle">
                <span class="m-nav__link-icon">
                    <i class="flaticon-grid-menu"></i>
                </span>
            </a>
        </li>
        
    </ul>
</div>
</div>
<!-- END: Topbar -->
</div>
</div>
</div>
</header>
			<!-- END: Header -->		
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
	                <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "home")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
								<a  href="<?php echo base_url(); ?>" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
								
										</span>
									</span>
								</a>
							</li>

		
							<li class="m-menu__item  m-menu__item--submenu <?php if(isset($active_sidemenu) && ($active_sidemenu == "company" || $active_sidemenu == "user" || $active_sidemenu == "target"))  { echo 'm-menu__item--open m-menu__item--expanded';  }  ?>" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Employees
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
                                        <?php if(in_array('comp_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
										<li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "company")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('company');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Company
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('user_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
								     	<li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "user")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('users');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Users
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('trgt_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "target")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('target');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Targets
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>
									</ul>
								</div>
							</li> 

                             <li class="m-menu__item  m-menu__item--submenu <?php if(isset($active_sidemenu) && ($active_sidemenu == "account" || $active_sidemenu == "contact" || $active_sidemenu == "lead" || $active_sidemenu == "opportunity"))  { echo 'm-menu__item--open m-menu__item--expanded';  }  ?>" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Contacts
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
                                        <?php if(in_array('acnt_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
									    <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "account")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('account');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Account
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('cntct_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "contact")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('contact');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Contact
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('lead_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "lead")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('lead');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Leads
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('oprt_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "opportunity")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('opportunity');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Opportunity
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>
									</ul>
								</div>
                            </li> 
                             <li class="m-menu__item  m-menu__item--submenu <?php if(isset($active_sidemenu) && ($active_sidemenu == "sales_quotation" || $active_sidemenu == "sales_order"))  { echo 'm-menu__item--open m-menu__item--expanded';  }  ?>" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Sales 
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
                                        <?php if(in_array('squtn_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
										<li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "sales_quotation")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('sales/quotation');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Sales Quotation 
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>
    
                                        <?php if(in_array('sordr_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                         <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "sales_order")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('sales/order');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Sales Order 
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                            <!--  <li class="m-menu__item <?php // if(isset($active_sidemenu) && $active_sidemenu == "item")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                <a  href="<?php // echo base_url('items');?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon fa fa-building"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                Items
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li> -->
                            <li class="m-menu__item  m-menu__item--submenu <?php if(isset($active_sidemenu) && ($active_sidemenu == "item" || $active_sidemenu == "item"))  { echo 'm-menu__item--open m-menu__item--expanded';  }  ?>" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Items 
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
                                        <?php if(in_array('invitm_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
										<li class="m-menu__item <?php if(isset($active_sub_sidemenu) && $active_sub_sidemenu == "inventory_item")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('items/inventory');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Inventory Item
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('seritm_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sub_sidemenu) && $active_sub_sidemenu == "service_item")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('items/service');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Service Item
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('sercon_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sub_sidemenu) && $active_sub_sidemenu == "service_contract")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('items/service_contract');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Service Contract
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>

                                        <?php if(in_array('sercall_v',$header_permission) || $this->session->userdata('is_admin') == 1){ ?>
                                        <li class="m-menu__item <?php if(isset($active_sub_sidemenu) && $active_sub_sidemenu == "service_call")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                            <a  href="<?php echo base_url('items/service_call');?>" class="m-menu__link ">
                                                <i class="m-menu__link-icon fa fa-building"></i>
                                                <span class="m-menu__link-title">
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Service Call
                                                        </span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>

                            <li class="m-menu__item <?php if(isset($active_sidemenu) && $active_sidemenu == "enquiryform")  { echo 'm-menu__item--active';  }  ?>" aria-haspopup="true" >
                                <a  href="<?php echo base_url('enquiry_form'); ?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-list-3"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                Enquiry Form
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END: Aside Menu -->
                </div>
<!-- END: Left Aside -->