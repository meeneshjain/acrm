<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo $page_title?> | <?php echo APP_NAME; ?>
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="<?php echo base_url('assets/vendors/base/vendors.bundle.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/demo/default/base/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
		
		<link href="<?php echo base_url('assets/demo/default/custom/form-parsley/parsley.css'); ?>" rel="stylesheet" type="text/css" />
		
		<link href="<?php echo base_url('assets/demo/default/custom/custom.css'); ?>" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
		<script src="<?php echo base_url('assets/vendors/base/vendors.bundle.js'); ?>"></script>
		<script>
			var base_url = '<?php echo base_url(); ?>';
		</script>
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
    
	<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >